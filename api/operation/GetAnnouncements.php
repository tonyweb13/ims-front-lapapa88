<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";


if(!empty($_GET)) {
    $_GET = array_map("trim",$_GET);
    $_GET = array_map("strip_tags",$_GET);
}

$p = array(
    "announceTypeCd" => $_GET["announceTypeCd"],
    "incluedParent" => true,
//    "isPopup"=>true,
    "languageNo" => $_SESSION["browserLanguageNo"]
);

$result = RestCurl::post("Operation.svc/announcements",$p);

if($result["status"] == 200){
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
