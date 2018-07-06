<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!empty($_GET)) {
    $_GET = array_map("trim",$_GET);
    $_GET = array_map("strip_tags",$_GET);
}

//$endDate = new DateTime(date("Y-m-d H:i:s"));
//echo $endDate->format("Y-m-d\TH:i:s.uO");

$p = array(
    "topCount" => $_GET["count"],
    "includeBotTransaction" => true,
    "languageNo" => $_SESSION["browserLanguageNo"]
);

$result = RestCurl::post("Finance.svc/paymentTransactionHistory",$p);

if($result["status"] == 200){
    foreach($result["data"] as $k=>$v) {
        if (!empty($v)) {
            foreach ($v as $detail) {
                $detail->nickname = substr_replace($detail->nickname, "****", -4);
                $detail->currencyAmount->amount = currency_decimal($detail->currencyAmount->currencyIsoCd,$detail->currencyAmount->amount,true);
            }
        }
    }
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
