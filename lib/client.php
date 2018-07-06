<?php
session_start();
header('Content-type:text/html; charset=UTF-8');
header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC NOI DSP COR NID ADM DEV HONK"');
//header('P3P: CP="CP=\"NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE HONK"');
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/detect_browser.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/detect_language.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/detect_mobile.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/detect_country.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/incapsula.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/setCasinoName.php";

$mobile_detect = new Mobile_Detect;

Class RestCurl{

    public function __construct() {
        if(isset($_SESSION["agentId"])&&isset($_SESSION["agentPw"])){
//            echo "use session agentID is ".$_SESSION["agentId"]."<br>";
//            echo "use session agentID pw ".$_SESSION["agentPw"]."<br>";
//            echo "use session agent verify type cd ". $_SESSION["playerVerifyTypeCd"]."<br>";
        }else{
            $result = RestCurl::get("Agent.svc/domain/{$_SERVER["HTTP_HOST"]}/AgInfo");
//            echo "<pre>";
//            echo "recived agent data is <br>";
//            print_r($result);
//            echo "</pre>";
            $_SESSION["agentId"] = $result["data"]->agentId;
            $_SESSION["agentPw"] = $result["data"]->agentPw;
            $_SESSION["playerVerifyTypeCd"] = $result["data"]->playerVerifyTypeCd; // 0:none,1:sms,2:email
        }
    }

    public static function exec($method, $url, $obj = array()) {
        $agentId=$_SESSION["agentId"];
        $agentPw=$_SESSION["agentPw"];

        if(((preg_match("/[a-zA-Z0-9]+\.frontend88\.com/",$_SERVER['HTTP_HOST'])) && $_SERVER['HTTP_HOST']!= "weipoker.frontend88.com")|| $_SERVER['HTTP_HOST']=="www.vpaysolution.com"){
            $url = trim("http://10.10.10.111/FrontAPI/".$url);
        }else{
            $url = trim("http://internal-imsfapi-private-816469653.ap-northeast-1.elb.amazonaws.com/FrontAPI/".$url);
        }

//        echo $url;
//        $_SERVER["REMOTE_ADDR"];
        $headers = array();
        $headers[] = "AgentId: {$agentId}";
        $headers[] = "AgentPw: {$agentPw}";
        $headers[] = "Content-Type: application/json";
        $headers[] = "Accept: application/json";
        $headers[] = "VisiterUrl: {$_SERVER['HTTP_HOST']}";
        $headers[] = "ServerIp:{$_SERVER['SERVER_ADDR']}";
        $headers[] = "UserIp: {$_SERVER['REMOTE_ADDR']}";

//        var_dump($headers);
        $curl = curl_init($url);

        switch($method) {
            case 'GET':
                if(strrpos($url, "?") === FALSE) {
                    $url .= '?' . http_build_query($obj);
                }
                break;
            case 'POST':
                curl_setopt($curl, CURLOPT_POST, TRUE);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($obj));
                break;
            case 'PUT':
            case 'DELETE':
            default:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, strtoupper($method)); // method
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($obj)); // body
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 6);
        curl_setopt($curl, CURLOPT_USERAGENT,$_SERVER["HTTP_USER_AGENT"]);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);

        $response = curl_exec($curl);

        $info = curl_getinfo($curl);
//        var_dump($info);
        curl_close($curl);

        // Data
        $header = trim(substr($response, 0, $info['header_size']));
        $body = substr($response, $info['header_size']);

        return array('status' => $info['http_code'], 'header' => $header, 'data' => json_decode($body));
    }
    public static function get($url, $obj = array()) {

        return RestCurl::exec("GET", $url, $obj);
    }
    public static function post($url, $obj = array()) {
        return RestCurl::exec("POST", $url, $obj);
    }
    public static function put($url, $obj = array()) {
        return RestCurl::exec("PUT", $url, $obj);
    }
    public static function delete($url, $obj = array()) {
        return RestCurl::exec("DELETE", $url, $obj);
    }
}

if(empty($_SESSION["agentId"]) || empty($_SESSION["agentPw"])){
    $restCurl = new RestCurl();
}

$channelType = "";

if($mobile_detect->isMobile() || $mobile_detect->isTablet()){
    $channelType = 4;
}else {
    switch (browser_detection("os")) {
        case "win":
            $channelType = 1;
            break;
        case "nt":
            $channelType = 1;
            break;
        case "mac":
            $channelType = 2;
            break;
        case "unix":
            $channelType = 3;
            break;
        case "lin":
            $channelType = 3;
            break;
        default:
            $channelType = 0;
    }
}

$client_browser = get_languages("data");
$_SESSION["beforeClientBrowserLanguage"] = $client_browser[0][0];

if(empty($_SESSION["browserLanguageNo"])||$_SESSION["beforeClientBrowserLanguage"] != $client_browser[0][0]){
    $GetLanguage = RestCurl::get("SystemSetting.svc/languages");
    $browserLanguageNo="100";
    $browserLanguageCd="US";
    if($GetLanguage["status"]==200){
        foreach($GetLanguage["data"]->languageList as $value){
            if($value->lnBrowserCd  == $client_browser[0][0]){
                $browserLanguageNo=$value->languageNo;
                $browserLanguageCd=$value->lnIso639_2;
                break;
            }
            if($value->languageName == $client_browser[0][0]){
                $browserLanguageNo=$value->languageNo;
                $browserLanguageCd=$value->lnIso639_2;
                break;
            }
            if($value->lnIso639_2  == $client_browser[0][0]){
                $browserLanguageNo=$value->languageNo;
                $browserLanguageCd=$value->lnIso639_2;
                break;
            }
            if($value->lnIso639_1  == $client_browser[0][0]){
                $browserLanguageNo=$value->languageNo;
                $browserLanguageCd=$value->lnIso639_2;
                break;
            }
            if($value->lnIso639_3  == $client_browser[0][0]){
                $browserLanguageNo=$value->languageNo;
                $browserLanguageCd=$value->lnIso639_2;
                break;
            }
        }
        $_SESSION["browserLanguageCd"] = $browserLanguageCd;
        $_SESSION["browserLanguageNo"] = $browserLanguageNo;
        $_SESSION["beforeClientBrowserLanguage"] = $client_browser[0][0];
    }else{
        $message=$_SESSION["agentId"]."Please check registry url or server ip in back office if you have 400 bad request server ip is ".$_SERVER["SERVER_ADDR"];
        echo "<pre>";
        echo "error data is <br>";
        print_r($GetLanguage);
        echo "</pre>";
        echo $message."<br>";
//        echo json_encode(array("status"=>$GetLanguage["status"],"message"=>$message,"alert"=>true));
    }
}


if(empty($_SESSION["BlackIp"])){
    $GetBlackList = RestCurl::get("Fraud.svc/agentBlackIpList");
    //default question language is english(100)
    if($GetBlackList["status"]==200){
        if(in_array($_SERVER["REMOTE_ADDR"],$GetBlackList["data"]->ipBlackList)){
            $_SESSION["BlackIp"]="Checked";
            echo "
            <!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">
            <html><head>
            <title>404 Not Found</title>
            </head><body>
            <h1>Not Found</h1>
            <p>The requested URL was not found on this server.</p>
            </body></html>
            ";
            exit;
        }else{
            $_SESSION["BlackIp"]="Checked";
        }
    }else{
        $message=$result["data"]->errorMessage;
//        echo json_encode(array("status"=>$data["status"],"message"=>$message,"alert"=>true));
    }
}

function currency_decimal($currency,$amount,$display){
    if($amount != 0){
        if(is_numeric($currency)){
            $currencyDecimal=
                [10 =>100000000, //BTC
                    100=>100,  //USD
                    101=>100,  //CAD
                    102=>100,  //MXN
                    200=>100,  //EUR
                    201=>100,  //GBP
                    202=>100,  //CHF
                    203=>100,  //DKK
                    204=>100,  //NOK
                    205=>100,  //RON
                    206=>100,  //RUB
                    300=>100,  //ZAR
                    400=>100,  //AUD
                    500=>100,  //CNY
                    501=>100,  //RMB
                    502=>100,  //HKD
                    503=>100,  //IDR
                    504=>100,  //INR
                    505=>0,  //JPY
                    506=>0,  //KRW
                    507=>100,  //MYR
                    508=>100,  //SGD
                    509=>100,  //THB
                    510=>100,  //TWD
                    511=>100,  //VND
                    207=>100,  //SEK
                    208=>100,  //PLN
                    209=>100,  //CZK
                    301=>100,  //NGN
                    401=>100,  //NZD
                    512=>100,  //MOP
                    513=>100,  //TRY
                    514=>100,  //BND
                    515=>100,  //ILS
                    516=>100,  //MMK
                    517=>100];  //PHP
        }else{
            $currencyDecimal=
                [
                    "BTC"=>100000000,
                    "USD"=>100,
                    "CAD"=>100,
                    "MXN"=>100,
                    "EUR"=>100,
                    "GBP"=>100,
                    "CHF"=>100,
                    "DKK"=>100,
                    "NOK"=>100,
                    "RON"=>100,
                    "RUB"=>100,
                    "ZAR"=>100,
                    "AUD"=>100,
                    "CNY"=>100,
                    "RMB"=>100,
                    "HKD"=>100,
                    "IDR"=>100,
                    "INR"=>100,
                    "JPY"=>0,
                    "KRW"=>0,
                    "MYR"=>100,
                    "SGD"=>100,
                    "THB"=>100,
                    "TWD"=>100,
                    "VND"=>100,
                    "SEK"=>100,
                    "PLN"=>100,
                    "CZK"=>100,
                    "NGN"=>100,
                    "NZD"=>100,
                    "MOP"=>100,
                    "TRY"=>100,
                    "BND"=>100,
                    "ILS"=>100,
                    "MMK"=>100,
                    "PHP"=>100];
        }


        if($display){
            $amount = $amount/$currencyDecimal[$currency];
        }else{
            $amount =  floor($amount*$currencyDecimal[$currency]);
        }
    }
    return $amount;
}

/* reg exp ver=2012.07.16.1 */
function regExp($mode, $str, $min = null, $max = null)
{
    if ($mode == "integer") {
        $regex = "/^\d+$/";
    } else if ($mode == "valid_account") {
        $regex = "/^\d{2,4}[0-9\-]*\d{2,4}$/";
    } else if ($mode == "float") {
        $regex = "/[-+]?[0-9]*\.?[0-9]+/";
    } else if ($mode == "password") {
        $regex = "/^[ A-Za-z0-9\_\@\.\/\#\&\%\+\-]*$/";
    } else if ($mode == "alphanumeric") {
        $regex = "/^[a-zA-Z0-9-_]*$/";
    } else if ($mode == "alphanumericspace") {
        $regex = "/^[a-zA-Z0-9\x20]*$/";
    } else if ($mode == "kor_alpha_num") {
        $regex = "/^([\xEA-\xED][\x80-\xBF]{2}|[a-zA-Z0-9])*$/";
    } else if ($mode == "phone") {
        $regex = "/^[0-9]{11,12}$/";
    } else if ($mode == "phone2") {
        $regex = "/^\d{4}-\d{4}|\d{2,3}-\d{3,4}-\d{4}$/";
    } else if ($mode == "internationalphone") {
        $regex = "/([0-9\s\-]{7,})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/";
    } else if ($mode == "noDash") { //no dash, no space
        $regex = "/([0-9]{7,})(?:(?:#|x\.?|ext\.?|extension)(\d+))?$/";
    } else if ($mode == "ip") {
        $regex = "/^((\+|00)\d{1,3})?\d+$/";
    } else if ($mode == "domain") {
        $regex = "/^[a-zA-Z0-9.]*$/";
    } else if ($mode == "bank_account") {
        $regex = "/^[0-9-]*$/";
    } else if ($mode == "valid_player") { //accept spaces, @ sign, comma only
        $regex = "/^[a-zA-Z0-9\x20\@\,]*$/";
    } else if ($mode == "all") {
        $regex = "/.*/";
    } else {
        return false;
    }

    if (!is_null($min)) {
        $length = strlen_utf8($str, true);

        if ($length < $min || $length > $max) {
            return false;
        }
    }
    if (!preg_match($regex, $str)) {
        return false;
    }
    return true;
}

function strlen_utf8($str, $checkmb = false)
{
    preg_match_all('/[\xE0-\xFF][\x80-\xFF]{2}|./', $str, $match); // target for BMP

    $m = $match[0];
    $mlen = count($m); // length of matched characters

    if (!$checkmb) return $mlen;

    $count = 0;
    for ($i = 0; $i < $mlen; $i++) {
        $count += ($checkmb && strlen($m[$i]) > 1) ? 2 : 1;
    }

    return $count;
}


$oderSportArray = array(208,209,203,202,201,210,211,212);
