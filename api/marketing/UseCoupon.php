<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!isset($_SESSION['accessToken'])){
    $message="Please Login";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
    exit;
}

if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}

$couponCode=$_POST["couponCode"];

$result = RestCurl::put("Marketing.svc/useCoupon/{$_SESSION['accessToken']}/$couponCode");
//var_dump($result);
if($result["status"] == 200){
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>true));
}else{
    if(empty($result["data"]->errorMessage)){
        $message="UnknownError";
    }else{
        $message=$result["data"]->errorMessage;
    }
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}



