<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}

if(!isset($_SESSION['accessToken'])){
    $message="Please Login";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>true));
    exit;
}

if(empty($_POST["fromGspWallet"])){
    $message = "Please Select Wallet";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>true));
    exit;
}

if(empty($_POST["toGspWallet"])){
    $message = "Please Select Bank";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>true));
    exit;
}

if(empty($_POST["amount"]) || $_POST["amount"] <= 0){
    $message = "Please Enter Amount";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>true));
    exit;
}

$fromImsToGsp="";

if($_POST["fromGspWallet"]==999){
    $fromImsToGsp=true;
    $gspNo=$_POST["toGspWallet"];
}else{
    $fromImsToGsp=false;
    $gspNo=$_POST["fromGspWallet"];
}

$amount = currency_decimal($_SESSION["currencyNo"],$_POST["amount"],false);

$p = array(
    "accessToken" => $_SESSION["accessToken"],
    "currencyAmount" => array("currencyNo"=>$_SESSION["currencyNo"],"amount"=>$amount),
    "gspNo"=>$gspNo,
    "fromImsToGsp"=>$fromImsToGsp,
    "productNo"=>30
);

$result = RestCurl::post("Finance.svc/walletTransfer", $p);

if($result["status"] == 200){
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
