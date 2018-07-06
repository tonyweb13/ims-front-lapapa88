<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}


if (empty($_POST["nickname"]) || empty($_POST["password"]) ) {
    echo json_encode(array("status"=>400,"message"=>"Access Denied","alert"=>true));
    exit;
}

if (!regExp('alphanumeric',$_POST["nickname"],4,16 )) {
    echo json_encode(array("status"=>400,"message"=>"User ID must be alphanumeric between 4~16 characters","alert"=>true));
    exit;
}

if (!regExp('all',$_POST["password"],6,16 )) {
    echo json_encode(array("status"=>400,"message"=>"Password must be 6~16 characters","alert"=>true));
    exit;
}
//for os detect

// TODO: we will use each user browser language code
//for langause detect
$data = get_languages("data");
$browser_language = $data[0][0];

//ClientTime
$clientLocalTime = new Datetime($_POST["clientLocalTime"]);
//echo md5(hash("sha256",$_POST["password"]));
$p = array(
    "nickname" => $_POST["nickname"],
    "password" => hash("sha256",$_POST["password"]),
    "clientLocalTime" => $clientLocalTime->format("Y-m-d\TH:i:s.uO"),
    "loginChannelType" => $channelType,
//    "agentUrlSeqNo" => "1",
    "screenWidth" =>$_POST["screenWidth"],
    "screenHeight" => $_POST["screenHeight"]
);

$result = RestCurl::post("Player.svc/login", $p);

if($result["status"] == 200){
    $browserLanguageCd = $_SESSION["browserLanguageCd"];
    $browserLanguageNo = $_SESSION["browserLanguageNo"];
    $beforeLanguage = $_SESSION["beforeClientBrowserLanguage"];
    $black_ip = $_SESSION["BlackIp"];
//    $agentId = $_SESSION["agentId"];
//    $agentPw = $_SESSION["agentPw"];
    session_unset();
    session_regenerate_id(true);
    setcookie("nickname", $result["data"]->nickname, time() + 1800, "/");
    ini_set("session.cookie_lifetime","1800");
    $_SESSION["agentId"] = $result["data"]->agentId;
    $_SESSION["agentPw"] = $result["data"]->agentPw;
    $_SESSION["browserLanguageCd"] =  $browserLanguageCd;
    $_SESSION["browserLanguageNo"] =  $browserLanguageNo;
    $_SESSION["beforeClientBrowserLanguage"] = $beforeLanguage;
    $_SESSION["BlackIp"] =  $black_ip;
//    $_SESSION["agentId"] =  $agentId;
//    $_SESSION["agentPw"] =  $agentPw;
    $_SESSION["agentBTag"] =  $result["data"]->agentBTag;
    $_SESSION["nickname"] =  $result["data"]->nickname;
    $_SESSION["agentNo"] =  $result["data"]->agentNo;
    $_SESSION["playerId"] =  $result["data"]->playerId;
    $_SESSION["accessToken"] = $result["data"]->accessToken;
    $_SESSION["countryNo"] = $result["data"]->countryNo;
    $_SESSION["countryCd"] = $result["data"]->countryCd;
    $_SESSION["languageNo"] = $result["data"]->languageNo;
    $_SESSION["currencyNo"] = $result["data"]->currencyInfo->currencyNo;
    $_SESSION["currencyIsoCd"] = $result["data"]->currencyInfo->currencyIsoCd;
    $_SESSION["languageNo"] = $result["data"]->languageNo;
    $_SESSION["needToResetPwYn"] = $result["data"]->needToResetPwYn;
    $_SESSION["timeout"] =  time() + 1800;
    $message="login";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>false,"Cookie"=>session_id()));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}