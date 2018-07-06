<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

$result = RestCurl::get("SystemSetting.svc/languages");

if($result["status"] == 200){
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
