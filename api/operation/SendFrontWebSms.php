<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

$code = rand(1000, 9999); // random 4 digit code
$sendMessage = "verification code is {$code}";
$phoneNumber="0954658397";
$p = array(
    "countryCallingCd"=>66,
    "tel"=>$phoneNumber,
    "languageIsoCd"=>"ENG",
    "message"=>"verification",
);

var_dump($p);
$result = RestCurl::post("Operation.svc/sendSms",$p);
var_dump($result);
if($result["status"] == 200){
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
