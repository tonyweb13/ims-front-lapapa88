<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!isset($_SESSION['accessToken'])){
    $message="Please Login";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>true));
    exit;
}

if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}

$countryCallingCd=$_POST["dialCode"];

if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}

if (empty($_POST["amount"]) || $_POST["amount"] <= 0) {
    $message = "Please Enter Amount";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>false));
    exit;
}

if (empty($_POST["bankNo"])) {
    $message = "Please Select Bank";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>false));
    exit;
}

if (empty($_POST["bankAccountNo"]) || !regExp("valid_account", $_POST["bankAccountNo"],4,25)  ) {
    $message = "Invalid Account Number";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>false));
    exit;
}

if (empty($_POST["bankHolder"])) {
    $message = "Please enter correct Account Holder between 2 to 30 characters";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>false));
    exit;
}

if (empty($_POST["phone"]) || !regExp("internationalphone", $_POST["phone"], 9, 19)  ) {
    $message = "Invalid Phone Number";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>false));
    exit;
}

$result = RestCurl::get("Agent.svc/token/{$_SESSION["accessToken"]}/DepWdLimit");
if($result["status"] == 200){
    $minWithdrawalAmount = currency_decimal($result["data"]->currencyNo,$result["data"]->minWithdrawal,true);
    $maxWithdrawalAmount = currency_decimal($result["data"]->currencyNo,$result["data"]->maxWithdrawal,true);
    if($_POST["amount"]<$minWithdrawalAmount){
        $message="Minimum withdrawal amount is";
        echo json_encode(array("status"=>400,"message"=>$message,"amount"=>$minWithdrawalAmount,"alert"=>false));
        exit;
    }else if($_POST["amount"]>$maxWithdrawalAmount){
        $message="Maximum withdrawal amount is";
        echo json_encode(array("status"=>400,"message"=>$message,"amount"=>$maxWithdrawalAmount,"alert"=>false));
        exit;
    }
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
    exit;
}

$amount = currency_decimal($_SESSION["currencyNo"],$_POST["amount"],false);

$p = array(
    "accessToken" => $_SESSION["accessToken"],
    "currencyAmount" => array("currencyNo"=>$_SESSION["currencyNo"],"amount"=>$amount),
    "bankNo"=> $_POST["bankNo"],
    "countryCallingCd"=> $countryCallingCd,
    "phone"=>$_POST["phone"],
    "bankHolder"=>$_POST["bankHolder"],
    "bankAccountNo"=> $_POST["bankAccountNo"],
    "bankAccountType"=> $_POST["bankAccountType"],
    "bankPlace"=>$_POST["bankPlace"],
    "bankOffice"=>$_POST["bankOffice"],
    "memo"=>$_POST["memo"]
);

$result = RestCurl::post("Finance.svc/requestWithdrawal", $p);

if($result["status"] == 200){
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$data["status"],"message"=>$message,"alert"=>true));
}