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

if (!regExp("all", $_POST["password"], 6, 16)) {
    echo json_encode(array("status"=>400,"message"=>"Please enter current password","alert"=>true));
    exit;
}

if (!regExp("all", $_POST["newPassword"], 6, 16))  {
    echo json_encode(array("status"=>400, "message" => "Please enter 6~16 characters", "alert"=>true));
    exit;
}

if ($_POST["newPassword"] != $_POST["newConfirmPassword"]) {
    echo json_encode(array("status"=>400, "message" => "Password does not match", "alert"=>true));
    exit;
}

if ($_POST["password"] == $_POST["newPassword"]) {
    echo json_encode(array("status"=>400, "message" => "New password is identical as the old password", "alert"=>true));
    exit;
}

$p = array(
    "accessToken"=>$_SESSION["accessToken"],
    "password" => hash("sha256",$_POST["password"]),
    "newPassword" => hash("sha256",$_POST["newPassword"])
);

$result = RestCurl::put("Player.svc/ChangePassword", $p);
//var_dump($result);

if($result["status"] == 200){
    if(isset($_SESSION['needToResetPwYn'])){
        $_SESSION['needToResetPwYn']=false;
    }
    $message="Password Change Complete";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],"alert"=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
