<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}

$countryCallingCd=$_POST["dialCode"];

if (!regExp('alphanumeric',$_POST["nickname"],4,16 )) {
    echo json_encode(array("status"=>400,"message"=>"Alphanumeric between 4~16 characters","alert"=>true));
    exit;
}

if (!regExp('all',$_POST["password"],6,16 )) {
    echo json_encode(array("status"=>400,"message"=>"Please enter password between 6~16 characters","alert"=>true));
    exit;
}

if ($_POST["password"] != $_POST["validPwd"]) {
    echo json_encode(array("status"=>400,"message"=>"Please confirm your Password","alert"=>true));
    exit;
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array("status"=>400,"message"=>"Please confirm Email","alert"=>true));
    exit;
}

if (empty($_POST["currencyNo"])) {
    echo json_encode(array("status"=>400,"message"=>"Please select Currency","alert"=>true));
    exit;
}

if (empty($_POST["playerName"])) {
    echo json_encode(array("status"=>400,"message"=>"Please enter between 2-30 characters","alert"=>true));
    exit;
}

if (empty($_POST["phone"]) || !regExp("internationalphone", $_POST["phone"], 9, 19)  ) {
    echo json_encode(array("status"=>400,"message"=>"Invalid Phone Number","alert"=>true));
    exit;
}

if (empty($_POST["birthYear"]) || empty($_POST["birthMonth"]) || empty($_POST["birthDay"]) ) {
    echo json_encode(array("status"=>400,"message"=>"Please Select Date of Birth","alert"=>true));
    exit;
}

if (empty($_POST["securityQuestionNo"])) {
    echo json_encode(array("status"=>400,"message"=>"Please select Security Question","alert"=>true));
    exit;
}

if (empty($_POST["securityAnswer"])) {
    echo json_encode(array("status"=>400,"message"=>"Please enter Security Answer","alert"=>true));
    exit;
}

$dateOfBirth = new DateTime($_POST['birthYear']."-".$_POST['birthMonth']."-".$_POST['birthDay']);
$clientLocalTime = new DateTime($_POST["clientLocalTime"]);

if($_SESSION["playerVerifyTypeCd"]==1) {
    $p = array(
        "countryCallingCd" => $_POST["dialCode"],
        "tel" => $_POST["phone"],
        "verifyCd" => $_POST["verifyCd"]
    );

    $result = RestCurl::post("Player.svc/VerifySmsRes", $p);
//    var_dump($result);
    if($result["status"] != 200){
        $message=$result["data"]->errorMessage;
        echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
        exit;
    }
}




$p = array(
    "nickname" => $_POST["nickname"],
    "password" => hash("sha256",$_POST["password"]),
    "playerName" => $_POST["playerName"],
    "countryNo" => $_POST["countryNo"],
    "languageNo" => $_SESSION["browserLanguageNo"],
    "dateOfBirth" => $dateOfBirth->format("Y-m-d\TH:i:s.uO"),
    "email" => $_POST["email"],
    "countryCallingCd" => $_POST["callingCd"],
    "phone" => $_POST["phone"],
    "gender" => $_POST["gender"],
    "currencyNo" => $_POST["currencyNo"],
    "securityQuestionNo" => $_POST["securityQuestionNo"],
    "securityAnswer" => $_POST["securityAnswer"],
    "referrerNickName" => $_POST["referrerNickName"],
    "signupChannelType" => $channelType
);

//echo json_encode($p);
//exit;
//echo json_encode(array("status"=>200,"message"=>"login","alert"=>false));
//exit;

$result = RestCurl::post("Player.svc/signup", $p);
//var_dump($result);
if($result["status"] == 200){
    $p = array(
        "nickname" => $_POST["nickname"],
        "password" => hash("sha256",$_POST["password"]),
        "clientLocalTime" => $clientLocalTime->format("Y-m-d\TH:i:s.uO"),
        "loginChannelType" => $channelType,
        "agentUrlSeqNo" => "1",
        "screenWidth" =>$_POST["screenWidth"],
        "screenHeight" => $_POST["screenHeight"]
    );

    $result = RestCurl::post("Player.svc/login", $p);

    if($result["status"] == 200){
        session_unset();
        session_regenerate_id(true);
        setcookie("MemberID", $result["data"]->nickname, 0, "/");
        $_SESSION["nickname"] =  $result["data"]->nickname;
        $_SESSION["agentNo"] =  $result["data"]->agentNo;
        $_SESSION["accessToken"] = $result["data"]->accessToken;
        $_SESSION["languageNo"] = $result["data"]->languageNo;
        $_SESSION["currencyNo"] = $result["data"]->currencyInfo->currencyNo;
        $_SESSION["currencyIsoCd"] = $result["data"]->currencyInfo->currencyIsoCd;
        $_SESSION["languageNo"] = $result["data"]->languageNo;
        $message="login";
        echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>false));
    }else{
        $message=$result["data"]->errorMessage;
        echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
    }
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
