<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

$result = RestCurl::get("SystemSetting.svc/ip/{$_SERVER["REMOTE_ADDR"]}/countryInfo");

//var_dump($result);
if($result["status"] == 200){
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"countryCd"=>$result["data"]->countryIso3166_1_A2,"countryNo"=>$result["data"]->countryNo,'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$data["status"],"message"=>$message,"alert"=>true));
}
