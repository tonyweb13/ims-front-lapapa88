<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!empty($_GET)) {
    $_GET = array_map("trim",$_GET);
    $_GET = array_map("strip_tags",$_GET);
}

$endDate = new DateTime(date("Y-m-d\TH:i:s.uO"));
$startDate = new DateTime(date("Y-m-d\TH:i:s.uO"));
$startDate->modify('-1 year');

$p = array(
    "accessToken"=>$_SESSION["accessToken"],
    "qstAnsTypeCd"=>$_GET["qstAnsTypeCd"],
    "fromDate" => $startDate->format("Y-m-d\TH:i:s.uO"),
    "toDate" => $endDate->format("Y-m-d\TH:i:s.uO"),
    "languageNo" => $_SESSION["browserLanguageNo"]
);

$result = RestCurl::post("Operation.svc/qstAnsList",$p);
$result["data"]->AnswerList=array();
$result["data"]->QuestionList=array();
//var_dump($result);
if($result["status"] == 200){
    foreach($result["data"]->QAList as $k=>$v){
        if($v->parentBoardQstAnsSeqNo==0){
            array_push($result["data"]->QuestionList,$v);
        }else{
            array_push($result["data"]->AnswerList,$v);
        }

    }
    unset($result["data"]->QAList);
    $message="Success";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"result"=>$result["data"],'alert'=>false));
}else{
    $message=$result["data"]->errorMessage;
    echo json_encode(array("status"=>$result["status"],"message"=>$message,"alert"=>true));
}
