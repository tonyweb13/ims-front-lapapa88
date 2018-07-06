<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

$result = RestCurl::get("SystemSetting.svc/agentCountries");


$result["data"]->countryA2List=array();
if($result["status"] == 200){
    foreach($result["data"]->countryList as $k){
        array_push($result["data"]->countryA2List,strtolower($k->countryIso3166_1_A2));
    }
    $result["data"]->countryA2List = implode (", ", $result["data"]->countryA2List );
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
