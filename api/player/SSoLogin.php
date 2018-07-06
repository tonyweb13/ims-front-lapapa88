<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!empty($_GET)) {
    $_GET = array_map("trim",$_GET);
    $_GET = array_map("strip_tags",$_GET);
}

$result = RestCurl::get("Player.svc/token/{$_GET["accessToken"]}/ssoLogin");
$location="";


if($result["status"] == 200){
    $browserLanguageNo = $_SESSION["browserLanguageNo"];
    $browserLanguageCd = $_SESSION["browserLanguageCd"];
    session_unset();
    session_regenerate_id(true);
    setcookie("nickname", $result["data"]->nickname, 0, "/");
    $_SESSION["nickname"] =  $result["data"]->nickname;
    $_SESSION["browserLanguageNo"] =  $browserLanguageNo;
    $_SESSION["browserLanguageCd"] =  $browserLanguageCd;
    $_SESSION["agentNo"] =  $result["data"]->agentNo;
    $_SESSION["accessToken"] = $result["data"]->accessToken;
    $_SESSION["languageNo"] = $result["data"]->languageNo;
    $_SESSION["currencyNo"] = $result["data"]->currencyInfo->currencyNo;
    $_SESSION["currencyIsoCd"] = $result["data"]->currencyInfo->currencyIsoCd;
    $_SESSION["languageNo"] = $result["data"]->languageNo;
    $message="login";
    switch($_GET["pageName"]){
        case "deposit":
            $location= "/#/?redirectPage=deposit";
            break;
        case "withdrawal":
            $location= "/#/?redirectPage=withdrawal";
            break;
        case "sport":
            $location= "/#/sports";
            break;
        case "casino":
            $location= "/#/casino";
            break;
        case "slot":
            $location= "/#/slot";
            break;
        default:
            $location= "/#/";
    }
    echo "success";
    header("Location: ".$location);
    exit;
}else{
    $message=$result["data"]->errorMessage;
//    echo json_encode(array("status"=>$data["status"],"message"=>$message,"alert"=>true));
    switch($_GET["pageName"]){
        case "sport":
            $location= "/#/sports";
            break;
        case "casino":
            $location= "/#/casino";
            break;
        case "slot":
            $location= "/#/slot";
            break;
        default:
            $location= "/#/";
    }
    echo "failed";
    header("Location: ".$location);
    exit;
}


