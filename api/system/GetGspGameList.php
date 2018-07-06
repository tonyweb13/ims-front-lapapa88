<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}

$gspNo = $_POST["gspNo"];
$childGspNo="";
$isFun="false";
$isiOS="";
$isAndroidOS="";

if($_POST["isFun"]=="true"){//don't modify this one
    $isFun="true";
}

//901 betsoft 902 ctmx
if($gspNo==901 || $gspNo==902){
    $childGspNo=$gspNo;
    $gspNo=102;
}

//todo:we ready to mobile page use this function
if($channelType == 4){
    $platform="Mobile";
    if( $mobile_detect->isiOS()){
        $isiOS=true;
    }else{
        $isAndroidOS=true;//todo:it's reason make default any mobile machine without ios
    }
}else{
    if($_POST["platform"]=="Mini"){
        $platform="Mini";
    }else{
        $platform="Web";
    }
}

//todo:we ready to mobile page remove this function
//if($_POST["platform"]=="Mini"){
//    $platform="Mini";
//}else{
//    $platform="Web";
//}
////
$p = array(
    "productNo"=>20,
    "gspNo"=>$gspNo,
    "platform"=>$platform,
    "category"=>$_POST["category"],
    "isFunMode"=>$isFun
);

//
//
//$p = array(
//    "productNo"=>20,
//    "gspNo"=>102,
//    "platform"=>"Mobile",
//    "category"=>"Mobile",
//    "androidYn"=>"true",
//    "iosYn"=>"false",
//    "isFunMode"=>"false"
//);
//
//echo "<pre>";
//print_r($p);
//echo "</pre>";
//


if(!empty($isiOS)){
    $p["isiOS"]=$isiOS;
}

if(!empty($isAndroidOS)){
    $p["isAndroidOS"]=$isAndroidOS;
}


if(!empty($childGspNo)){
    $p["childGspNo"]=$childGspNo;
}

//var_dump($p);

$result = RestCurl::post("/SystemSetting.svc/gspGameList",$p);

if($result["status"] == 200){
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}

