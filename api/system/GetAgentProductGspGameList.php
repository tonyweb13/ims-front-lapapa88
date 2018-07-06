<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

$result = RestCurl::get("SystemSetting.svc/productGspList?token={$_SESSION['accessToken']}");
$result["data"]->AgentProductCasinoGameList=array();
$result["data"]->AgentProductSlotList=array();
$result["data"]->ProductSportsGameList=array();
$result["data"]->AgentProductPokerGameList=array();
$result["data"]->AgentProductOtherList=array();

if($result["status"] == 200){
    foreach($result["data"]->productList as $k){
        if($k->productNo == 10){
            foreach($k->gspList as $gspList) {
                if($gspList->gspNo == 104){
                    $_SESSION['currencyBTag']=$gspList->currencyBTag;
                }

            }
            array_push($result["data"]->AgentProductCasinoGameList,$k->gspList);
        }else if($k->productNo == 20){
            foreach($k->gspList as $gspList){
                if($gspList->gspNo==102){
//                    echo $gspList;
                    $BetSoft=array("gspNo"=>102,"gspName"=>"BetSoft");
                    $CTMX=array("gspNo"=>102,"gspName"=>"CTMX");
                };
            }
            array_push($result["data"]->AgentProductSlotList,$k->gspList);
        }else if($k->productNo == 30){
            foreach($oderSportArray as $key) {
                foreach($k->gspList as $gspList){
                    if($key == $gspList->gspNo){
                        array_push($result["data"]->ProductSportsGameList,$gspList);
                    }
                }
            }
        }else if($k->productNo == 40){
            array_push($result["data"]->AgentProductPokerGameList,$k->gspList);
        }else if($k->productNo == 50){
            array_push($result["data"]->AgentProductOtherList,$k->gspList);
        }
    }
    unset($result["data"]->productList);
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}

