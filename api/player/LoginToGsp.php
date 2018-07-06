<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";
if(!empty($_POST)) {
    $_POST = array_map("trim",$_POST);
    $_POST = array_map("strip_tags",$_POST);
}

if($_POST["gspNo"]){
    $gspNo=$_POST["gspNo"];
}else{
    $gspNo=209;
}


if($channelType == 4){
    $platform="Mobile";
}else{
    $platform="Web";
}

if(isset($_SESSION['accessToken'])){
    $p = array(
        "accessToken" => $_SESSION["accessToken"],
        "gspNo" => $gspNo,
        "languageCd" => $_POST["languageCd"],
        "platform" => $platform
    );

    $result = RestCurl::post("Player.svc/loginToGsp",$p);

    if($result["status"]==200){
        $message="success";
//        echo $gspNo;
        if($gspNo==203){
            $result["data"]->gameURL = str_replace("sport.eg.1sgames.com/public/validate.aspx?", "wft.frontend88.com?",$result["data"]->gameURL);
        }

        if($gspNo==209){
            if($channelType != 4) {
                $result["data"]->gameURL = str_replace("mkt.ib.gsoft88.net/Deposit_ProcessLogin.aspx?", "ibc.frontend88.com?", $result["data"]->gameURL) . "&token={$result["data"]->gspToken}";
            }
        }

        echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
    }else{
        $message=$result["data"]->errorMessage;
        echo json_encode(array("status"=>$result["status"],"message"=>$message,'alert'=>true));
    }
}else{
    $message="Please Login";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,'alert'=>true));
}
