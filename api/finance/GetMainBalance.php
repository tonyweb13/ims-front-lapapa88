<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";


if(!isset($_SESSION['accessToken'])){
    $message="Please Login";
    echo json_encode(array("status"=>403,"message"=>$message,"alert"=>true));
    exit;
}

//Session extension
//if(isset($_SESSION['timeout'])){
//    $expire=session_cache_expire();
//    $id=session_id();
//    $beforeTimeOut=$_SESSION['timeout'];
//    $check_time = strtotime("-15 minutes",$_SESSION['timeout']);
//    $sessionExtension=false;
//    if($check_time <= time()){
//        $_SESSION['timeout']=strtotime("+15 minutes",$_SESSION['timeout']);
//        ini_set("session.cache_expire","1800");
//        session_start();
//        $sessionExtension=true;
//    }
//}

$result = RestCurl::get("Finance.svc/token/{$_SESSION['accessToken']}/mainBalance");
//var_dump($result);
if($result["status"] == 200){
    foreach($result["data"] as $key => $val)
    {
        if(!empty($val)){
            $val->amount = currency_decimal($val->currencyNo,$val->amount,true);
        }
    }
    $message="Success";
//    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false,"sessionId"=>session_id(),
//        "checkTime"=>$check_time,"timeOut"=>$_SESSION['timeout'],"beforeTimeOut"=>$beforeTimeOut,"sessionExtention"=>$sessionExtension,"expire"=>$expire,
//        "sessionId"=>$id));
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
