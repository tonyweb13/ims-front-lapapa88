<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}

//
//if (empty($_POST["dialCode"])) {
//    echo json_encode(array("status"=>400,"message"=>"Invalid Phone Number","alert"=>true));
//    exit;
//}
//
//if (empty($_POST["phone"]) || !regExp("internationalphone", $_POST["phone"], 9, 19)  ) {
//    echo json_encode(array("status"=>400,"message"=>"Invalid Phone Number","alert"=>true));
//    exit;
//}
//
//if (empty($_POST["verifyCd"])) {
//    echo json_encode(array("status"=>400,"message"=>"Invalid Verify Code","alert"=>true));
//    exit;
//}

$p = array(
    "countryCallingCd" => 66,
    "tel" => '0954658397',
    "verifyCd" => 768894
);

$result = RestCurl::post("Player.svc/VerifySmsRes", $p);
var_dump($p);
var_dump($result);
if($result["status"] == 200){
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],"alert"=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
