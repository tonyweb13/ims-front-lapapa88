<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

$result = RestCurl::get("SystemSetting.svc/agentGspList?token={$_SESSION['accessToken']}");

if($result["status"] == 200){
    $result["data"]->orderedGspWalletList=array();
    foreach($oderSportArray as $key) {
        foreach($result["data"]->gspWalletList as $gspWalletList){
            if($key == $gspWalletList->gspNo){
                array_push($result["data"]->orderedGspWalletList,$gspWalletList);
            }
        }
    }
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
