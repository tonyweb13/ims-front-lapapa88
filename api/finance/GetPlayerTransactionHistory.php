<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!isset($_SESSION['accessToken'])){
    $message="Please Login";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
    exit;
}

$endDate = new DateTime(date("Y-m-d\TH:i:s.uO"));
$startDate = new DateTime(date("Y-m-d\TH:i:s.uO"));
$startDate->modify('-45 day');

$p = array(
    "accessToken" => $_SESSION["accessToken"],
    "languageNo" => $_SESSION["browserLanguageNo"],
    "startDate" => $startDate->format("Y-m-d\TH:i:s.uO"),
    "endDate" => $endDate->format("Y-m-d\TH:i:s.uO"),
);

$result = RestCurl::post("Finance.svc/playerTransactionHistory",$p);

if($result["status"] == 200){
    $message="Success";
    foreach($result["data"]->transactionList as $k) {
        if (!empty($k)) {
            $k->currencyAmount->amount = currency_decimal($k->currencyAmount->currencyNo,$k->currencyAmount->amount,true);
        }
    }
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
