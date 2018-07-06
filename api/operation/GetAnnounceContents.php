<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

$p = array(
    "announceNo" => $_GET["announceNo"],
);

$result = RestCurl::get("Operation.svc/announceNo/{$_POST["announceNo"]}/contents",$p);

if($result["status"] == 200){
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
