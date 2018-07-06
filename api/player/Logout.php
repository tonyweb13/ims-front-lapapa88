<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";
$logoutTypeCd=1;
$result = RestCurl::put("Player.svc/logout/{$_SESSION["accessToken"]}/{$logoutTypeCd}");


if($result["status"]==200){

    session_unset($_SESSION["nickname"]);
    session_unset($_SESSION["accessToken"]);

    unset($_COOKIE["MemberID"]);
    unset($_COOKIE["MemberID"]);
    setcookie("MemberID", null, -1,"/");
    setcookie(
        "PHPSESSID",
        session_id(),
        time() - 3600/*ini_get("session.cookie_lifetime"),*/,
        ini_get("session.cookie_path"),
        ini_get("session.cookie_domain"),
        ini_get("session.cookie_secure"),
        ini_get("session.cookie_httponly")
    );
    session_regenerate_id(true);
    $result = RestCurl::get("Agent.svc/domain/{$_SERVER["HTTP_HOST"]}/AgInfo");
    $_SESSION["agentId"] = $result["data"]->agentId;
    $_SESSION["agentPw"] = $result["data"]->agentPw;
    $_SESSION["playerVerifyTypeCd"] = $result["data"]->playerVerifyTypeCd; // 0:none,1:sms,2:email

    $message="Logged Out";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>false));
}else{
//    var_dump($result);
    $message=$result["data"]->errorMessage;

    session_unset($_SESSION["nickname"]);
    session_unset($_SESSION["accessToken"]);

    unset($_COOKIE["MemberID"]);
    unset($_COOKIE["MemberID"]);
    setcookie("MemberID", null, -1,"/");
    setcookie(
        "PHPSESSID",
        session_id(),
        time() - 3600/*ini_get("session.cookie_lifetime"),*/,
        ini_get("session.cookie_path"),
        ini_get("session.cookie_domain"),
        ini_get("session.cookie_secure"),
        ini_get("session.cookie_httponly")
    );
    session_regenerate_id(true);
    $message="Logged Out";

    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}