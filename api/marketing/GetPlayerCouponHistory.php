<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!isset($_SESSION['accessToken'])){
    $message="Please Login";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
    exit;
}

$result = RestCurl::get("Marketing.svc/token/{$_SESSION['accessToken']}/couponHistory");

if($result["status"] == 200){
    $message="Success";
    foreach($result["data"]->CouponList as $key => $val)
    {
        if (!empty($val)) {
            $val->CurrencyAmount->amount = currency_decimal($val->CurrencyAmount->currencyIsoCd, $val->CurrencyAmount->amount, true);
        }
    }
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    if(empty($result["data"]->errorMessage)){
        $message="UnknownError";
    }else{
        $message=$result["data"]->errorMessage;
    }
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}




