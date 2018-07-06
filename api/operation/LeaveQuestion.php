<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!isset($_SESSION['accessToken'])){
    echo json_encode(array("status"=>400,"message"=>"Please Login","alert"=>true));
    exit;
}

if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}

if(empty($_POST["title"])){
    $message = "Please Enter Title";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>true));
    exit;
}

if(empty($_POST["contents"])){
    $message = "Please Enter Content";
    echo json_encode(array("status"=>400,"message"=>$message,"alert"=>true));
    exit;
}

$p = array(
    "nickname"=>$_SESSION["nickname"],
    "qstAnsTypeCd"=>$_POST["qstAnsTypeCd"],
    "title"=>$_POST["title"],
    "contents"=>$_POST["contents"]
);

//var_dump($p);
$result = RestCurl::post("Operation.svc/leaveQuestion",$p);
//var_dump($result);
if($result["status"] == 200){
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
