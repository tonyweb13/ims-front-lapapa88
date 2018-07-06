<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}

if (empty($_POST["nickname"]) ) {
    echo json_encode(array("status"=>400,"message"=>"InvalidPlayer","alert"=>true));
    exit;
}

if (empty($_POST["securityQuestionNo"])) {
    echo json_encode(array("status"=>400,"message"=>"Please select Security Question","alert"=>true));
    exit;
}

if (empty($_POST["securityAnswer"]) ) {
    echo json_encode(array("status"=>400,"message"=>"Please enter Security Answer","alert"=>true));
    exit;
}

$p = array(
    "nickname" => $_POST["nickname"],
    "securityQuestionNo" => $_POST["securityQuestionNo"],
    "securityAnswer" => $_POST["securityAnswer"]
);

$result = RestCurl::put("Player.svc/forgotPassword", $p);
//var_dump($result);
if($result["status"] == 200){
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],"alert"=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
