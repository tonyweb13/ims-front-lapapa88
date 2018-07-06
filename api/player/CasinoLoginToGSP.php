<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!empty($_GET)) {
    $_GET = array_map("trim",$_GET);
    $_GET = array_map("strip_tags",$_GET);
}

$gspNo =$_GET["gspNo"];
$childGspNo="";
if($gspNo == "901" || $gspNo=="902"){
    $childGspNo=$gspNo;
    $gspNo="102";
}

if($channelType == 4){
    $platform="Mobile";
}else{
    if($_GET["platform"]=="Mini"){
        $platform="Mini";
    }else{
        $platform="Web";
    }
}

if(isset($_SESSION['accessToken'])){
    if($_GET["productNo"]==40){
        if($_SERVER["HTTP_HOST"] == "frontend88.com" || $_SERVER["HTTP_HOST"] == "www.frontend88.com" || $_SERVER["HTTP_HOST"] == "demo.frontend88.com"  || $_SERVER["HTTP_HOST"] == "cmtech.frontend88.com") {
            $gameURL = "https://int.weipoker.com/poker/#/board/cash?accessToken={$_SESSION["accessToken"]}";
        }else{
            $gameURL = "https://weipoker-int.cmt-korea.com/poker/#/board/cash?accessToken={$_SESSION["accessToken"]}";
        }
        header("Location: {$gameURL}");
        exit;
    }else{
        $p = array(
            "accessToken" => $_SESSION["accessToken"],
            "gspNo" => $gspNo,
            "platform"=>$platform,
            "productNo"=>$_GET["productNo"],
            "languageCd"=>$_GET["languageCd"]
        );

        if($_GET["productNo"]==10 && $_GET["gspNo"]==104 ){
            $p["gameId"]=6625;
        }

        if($_GET["productNo"]==20){
            $isFun=$_GET["isFun"];
            $p["gameId"]=$_GET["gameId"];
            $p["isFunMode"]=$isFun;
            if(!empty($childGspNo)){
                $p["childGspNo"]=$childGspNo;
            }
        }

        $result = RestCurl::post("Player.svc/loginToGsp",$p);

        if($result["status"]==200) {
            if(!empty($_GET["playCheck"]) && $_GET["playCheck"]="true" && $gspNo="104"){
                header("Location: https://playcheck22.gameassists.co.uk/playcheck/default.asp?serverid=2301&usertoken={$result["data"]->gspToken}");
                exit;
            }else{
                header("Location: {$result["data"]->gameURL}");
                exit;
            }
        }else{
            $message="Error";
            echo json_encode(array("status"=>$result["status"],"message"=>$message,'alert'=>true));
        }
    }
}else{
    $message="pleaseLogin";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,'alert'=>true));
}
