<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(isset($_SESSION['accessToken'])){
    $result = RestCurl::get("Player.svc/token/{$_SESSION['accessToken']}/playerDetail");
    if($result["status"]==200){
//        var_dump($result);
        $playerDetail["nickname"]=$result["data"]->nickname;
        $playerDetail["playerName"]=$result["data"]->playerName;
        $playerDetail["dateOfBirth"]=$result["data"]->dateOfBirth;
        $playerDetail["email"]=$result["data"]->email;
        $playerDetail["languageNo"]=$result["data"]->languageNo;
        $playerDetail["phone"]=$result["data"]->phone;
        $playerDetail["countryNo"]=$result["data"]->countryNo;
        $playerDetail["countryCd"]=strtolower($result["data"]->countryIso3166_1_Alpha2);
        $playerDetail["gender"]=$result["data"]->gender;
        $playerDetail["firstName"]=$result["data"]->firstName;
        $playerDetail["lastName"]=$result["data"]->lastName;
        $playerDetail["address"]=$result["data"]->address;
        $playerDetail["zipCode"]=$result["data"]->zipCode;
        $playerDetail["city"]=$result["data"]->city;


        $_SESSION["playerName"]=$result["data"]->playerName;
        $_SESSION["firstName"]=$result["data"]->firstName;
        $_SESSION["lastName"]=$result["data"]->lastName;
        $_SESSION["email"]=$result["data"]->email;
        $_SESSION["dateOfBirth"]=$result["data"]->dateOfBirth;
        $_SESSION["countryCd"]=strtolower($result["data"]->countryIso3166_1_Alpha2);
        $_SESSION["gender"]=$result["data"]->gender;
        $_SESSION["address"]=$result["data"]->address;
        $_SESSION["zipCode"]=$result["data"]->zipCode;
        $_SESSION["city"]=$result["data"]->city;

        $message="Success";
        echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$playerDetail,'alert'=>false));
    }else{
        $message=$result["data"]->errorMessage;
        echo json_encode(array("status"=>$result["status"],"message"=>$message,'alert'=>true));
    }
}else{
    $message="Please Login";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,'alert'=>true));
}
