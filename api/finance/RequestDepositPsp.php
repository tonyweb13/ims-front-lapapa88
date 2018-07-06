<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!isset($_SESSION['accessToken'])){
    $message="Please Login";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>true));
    exit;
}

//var_dump($_POST);

if(!empty($_GET)) {
    $_GET = array_map("trim",$_GET);
    $_GET = array_map("strip_tags",$_GET);
}

$countryCallingCd=$_GET["dialCode"];
$amount=0;

if($_POST["pspNo"]=="50701") {
    if ($_SESSION["firstName"] != $_GET["firstName"] || $_SESSION["lastName"] != $_GET["lastName"] || $_SESSION["countryNo"] != $_GET["countryNo"] || $_SESSION["address"] != $_GET["address"] || $_SESSION["zipCode"] != $_GET["zipCode"]) {
        $_SESSION["firstName"] = $_GET["firstName"];
        $_SESSION["lastName"] = $_GET["lastName"];
        $_SESSION["countryCd"] = $_GET["countryCd"];
        $_SESSION["address"] = $_GET["address"];
        $_SESSION["zipCode"] = $_GET["zipCode"];

        $p = array(
            "accessToken" => $_SESSION["accessToken"],
            "email" => $_SESSION["email"],
            "firstName" => $_SESSION["firstName"],
            "lastName" => $_SESSION["lastName"],
            "dateOfBirth" => $_SESSION["dateOfBirth"],
            "countryNo" => $_SESSION["countryNo"],
            "phone" => $_SESSION["phone"],
            "address" => $_SESSION["address"],
            "city" => $_SESSION["city"],
            "zipCode" => $_SESSION["zipCode"],
            "languageNo" => $_SESSION["languageNo"],
            "gender" => $_SESSION["gender"]
        );

        $result = RestCurl::put("Player.svc/editPlayerDetail", $p);
        $p = "";

        $result = RestCurl::get("Player.svc/token/{$_SESSION['accessToken']}/playerDetail");
        if ($result["status"] == 200) {
            $_SESSION["countryCd"] = strtolower($result["data"]->countryIso3166_1_Alpha2);
        }
    }
}

if (empty($_GET["amount"]) || $_GET["amount"] <= 0) {
    $message = "Please Enter Amount";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>false));
    exit;
}

if (empty($_GET["phone"]) || !regExp("internationalphone", $_GET["phone"], 8, 15)) {
    $message="Invalid Phone Number";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>false));
    exit;
}

$result = RestCurl::get("Agent.svc/token/{$_SESSION["accessToken"]}/DepWdLimit");
if($result["status"] == 200){
    $minDepositAmount = currency_decimal($result["data"]->currencyNo,$result["data"]->minDeposit,true);
    if($_GET["amount"]<$minDepositAmount){
        $message="Minimum deposit amount is";
        echo json_encode(array("status"=>400,"message"=>$message,"amount"=>$minDepositAmount,"alert"=>true));
        exit;
    }
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
    exit;
}

$amount = currency_decimal($_SESSION["currencyNo"],$_GET["amount"],false);

$timestamp = date("U",strtotime($_POST["depositDate"]));
$depositDate = gmdate("Y-m-d\TH:i:s.uO", $timestamp);

$p = array(
    "accessToken" => $_SESSION["accessToken"],
    "pspNo" => $_GET["pspNo"],
    "currencyAmount" => array("currencyNo"=>$_SESSION["currencyNo"],"amount"=>$amount),
    "countryCallingCd"=> $countryCallingCd,
    "phone"=>$_GET["phone"]
);

if($_GET["memo"]!="undefined"){
    $p["memo"]=$_GET["memo"];
}

$result = RestCurl::post("Finance.svc/requestDeposit", $p);
$dateOfBirth = date_create($_SESSION["dateOfBirth"]);
if($result["status"] == 200){
    if($_GET['pspNo'] == "50701"){
            $PayPostData =array(
                "agentId" => $_SESSION["agentId"],
                "agentPw" => $_SESSION["agentPw"],
                "depositNo" => $result["data"]->depositNo,
                "accessToken" => $_SESSION["accessToken"],
                "firstName" => $_SESSION["firstName"],
                "lastName" => $_SESSION["lastName"],
                "address"=>$_GET["address"],
                "city"=> $_GET["city"],
                "country"=>strtoupper($_SESSION["countryCd"]),
                "zip"=>$_SESSION["zipCode"],
                "email"=>$_SESSION["email"],
                "currencyText" =>$_SESSION["currencyIsoCd"],
                "purchaseAmount" =>$_GET['amount'],
                "phone"=>$_GET["phone"],
                "birthDate"=>date_format($dateOfBirth,"Y-m-d"),
                "serverIP" => $_SERVER["SERVER_ADDR"]
            );
            $paymentURL="https://vm.vpaysolution.com/";
    }else if($_GET['pspNo'] == "50702"){
            $PayPostData =array(
                "agentId"=>$_SESSION["agentId"],
                "agentPw" => $_SESSION["agentPw"],
                "depositNo" => $result["data"]->depositNo,
                "accessToken"=>$_SESSION["accessToken"],
                "Currency" => $_SESSION["currencyIsoCd"],
                "Customer" => $_SESSION["nickname"],
                "serverIP" => $_SERVER["SERVER_ADDR"],
                "Amount" => number_format($_GET['amount'],2,'.',''),
                "BankCode" => $_GET['BankCode'],
                "Note" => $p["memo"],
                "Language"=> "en-us",
            );
            $paymentURL="https://wepay88.com/";
    }

/*var_dump($PayPostData);
exit;*/
?>
    <html>
    <head>
        <title>Loading......</title>
        <meta http-equiv="content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>

    <?
    echo "<form action='".$paymentURL."' method='post' id='frm'>";
    foreach ($PayPostData as $a => $b) {
        echo "<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>";
    }
    echo "</form>";
    ?>

    <script language="JavaScript">
        document.getElementById("frm").submit();
    </script>
    </body>
    </html>

<?}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
