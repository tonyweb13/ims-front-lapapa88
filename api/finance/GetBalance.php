<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!isset($_SESSION['accessToken'])){
    $message="Please Login";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
    exit;
}

$result = RestCurl::get("Finance.svc/token/{$_SESSION['accessToken']}/balance");
//var_dump($result);
if($result["status"] == 200){
    $message="Success";

    $result["data"]->totalBalance = new stdClass(array("currencyNo"=>"","amount"=>0));

    if(!empty($result["data"]->mainBalance)){

        $result["data"]->totalBalance->currencyIsoCd = $result["data"]->mainBalance->currencyIsoCd;
        $result["data"]->mainBalance->amount = currency_decimal($result["data"]->mainBalance->currencyIsoCd,$result["data"]->mainBalance->amount,true);
        $result["data"]->totalBalance->amount+=$result["data"]->mainBalance->amount;
    }

    $result["data"]->orderedGspBalance=array();

    foreach($oderSportArray as $orderKey) {
        foreach($result["data"]->gspBalance as $key => $val)
        {
            if($orderKey == $val->GspNo) {
                if (!empty($val)) {
                    $val->currencyAmount->amount = currency_decimal($val->currencyAmount->currencyIsoCd, $val->currencyAmount->amount, true);
                    array_push($result["data"]->orderedGspBalance,$val);
                    if($val->currencyAmount->amount>=0){
                        $result["data"]->totalBalance->amount += $val->currencyAmount->amount;
                    }
                }
            }
        }
    }


    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    if(empty($result["data"]->errorMessage)){
        $message="Unknown Error";
    }else{
        $message=$result["data"]->errorMessage;
    }
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}

