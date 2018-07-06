<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

$result = RestCurl::get("Fraud.svc/agentBlackIpList");

if($result["status"] == 200){
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    if(empty($result["data"]->errorMessage)){
        $message="UnknownError";
    }else{
        $message=$result["data"]->errorMessage;
    }
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}




