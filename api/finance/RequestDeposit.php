<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!isset($_SESSION['accessToken'])){
    $message="Please Login";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>true));
    exit;
}

//var_dump($_POST);

if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}

$countryCallingCd=$_POST["dialCode"];
$amount=0;

if (empty($_POST["amount"]) || $_POST["amount"] <= 0) {
    $message = "Please Enter Amount";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>false));
    exit;
}

if (empty($_POST["bankHolder"])) {
    $message="Please enter between 2-30 characters";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>false));
    exit;
}

if (empty($_POST["depositDate"])) {
    $message="Please Select Deposit Date and Time";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>false));
    exit;
}

if (empty($_POST["bankIndex"]) && $_POST["bankIndex"] !="0") {
    $message = "Please Select Deposit Account";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>false));
    exit;
}

if (empty($_POST["depositType"])) {
    $message="Please Select Deposit Type";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>false));
    exit;
}

if (empty($_POST["phone"]) || !regExp("internationalphone", $_POST["phone"], 8, 15)) {
    $message="Invalid Phone Number";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>false));
    exit;
}

$result = RestCurl::get("Agent.svc/token/{$_SESSION["accessToken"]}/DepWdLimit");
if($result["status"] == 200){
    $minDepositAmount = currency_decimal($result["data"]->currencyNo,$result["data"]->minDeposit,true);
    if($_POST["amount"]<$minDepositAmount){
        $message="Minimum deposit amount is";
        echo json_encode(array("status"=>400,"message"=>$message,"amount"=>$minDepositAmount,"alert"=>true));
        exit;
    }
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
    exit;
}

$amount = currency_decimal($_SESSION["currencyNo"],$_POST["amount"],false);

$checkTimeStamp = strtotime('-3 days');
$currentTimeStamp = time();
$depositDateTimestamp = date("U",strtotime($_POST["depositDate"]));

//echo $currentTimeStamp;
//echo $checkTimeStamp;
//echo $depositDateTimestamp;

if($checkTimeStamp > $depositDateTimestamp){
    $depositDateTimestamp = $currentTimeStamp;
}

$depositDate = gmdate("Y-m-d\TH:i:s.uO", $depositDateTimestamp);

$memo="";
if(!empty($_POST["memo"])){
    $memo =  ",memo:".$_POST["memo"];
}

$p = array(
    "accessToken" => $_SESSION["accessToken"],
    "currencyAmount" => array("currencyNo"=>$_SESSION["currencyNo"],"amount"=>$amount),
    "depositDate" =>$depositDate,
    "bankNo"=> $_POST["bankNo"],
    "countryCallingCd"=> $countryCallingCd,
    "phone"=>$_POST["phone"],
    "bankHolder"=>$_POST["bankHolder"],
    "depositType"=>$_POST["depositType"],
    "agBankNo"=>$_POST["agBankNo"],
    "agBankAcctSeqNo"=>$_POST["agBankAcctSeqNo"],
    "memo"=>"{$_POST["BankNm"]},AccName:{$_POST["BankHolder"]},Acc#:{$_POST["BankAcctNo"]}{$memo}"
);

$result = RestCurl::post("Finance.svc/requestDeposit", $p);

if($result["status"] == 200){
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
