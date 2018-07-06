<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}

if(!isset($_SESSION['accessToken'])){
    echo json_encode(array("status"=>$result["status"],"message"=>"Please Login","alert"=>true));
    exit;
}

if (empty($_POST["countryNo"])) {
    echo json_encode(array("status"=>400,"message"=>"Please Select Country","alert"=>true));
    exit;
}

if (empty($_POST["languageNo"])) {
    echo json_encode(array("status"=>400,"message"=>"Please Select Language","alert"=>true));
    exit;
}

if (empty($_POST["gender"])) {
    echo json_encode(array("status"=>400,"message"=>"Please Select Gender","alert"=>true));
    exit;
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array("status"=>400,"message"=>"Please Enter Email","alert"=>true));
    exit;
}

if (empty($_POST["phone"])) {
    echo json_encode(array("status"=>400,"message"=>"Invalid Phone Number","alert"=>true));
    exit;
}

$p = array(
    "accessToken" => $_SESSION["accessToken"],
    "email"=>$_POST["email"],
    "firstName"=>$_POST["firstName"],
    "lastName"=>$_POST["lastName"],
    "dateOfBirth"=>$_POST["dateOfBirth"],
    "countryNo"=>$_POST["countryNo"],
    "phone"=>$_POST["phone"],
    "address"=>$_POST["address"],
    "city"=>$_POST["city"],
    "zipCode"=>$_POST["zipCode"],
    "languageNo"=>$_POST["languageNo"],
    "gender"=>$_POST["gender"]
);


$result = RestCurl::put("Player.svc/editPlayerDetail", $p);

if($result["status"] == 200){
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
