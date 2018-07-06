<?php
if (is_ajax()) {
    if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
         $action = $_POST["action"];
        switch($action) { //Switch case for value of action
            case "korean": language_function('korean','locale-ko_KR.json');  break;
            case "thailand": language_function('thailand','locale-th_TH.json');  break;
            case "simplified-chinese": language_function('simplified-chinese','locale-zh_CN.json');  break;
            case "traditional-chinese": language_function('traditional-chinese','locale-zh_TW.json');  break;
            case "myanmar": language_function('myanmar','locale-mm_MY.json');  break;
            case "japanese": language_function('japanese','locale-ja_JP.json');  break;
            case "mongolian": language_function('mongolian','locale-mn_MO.json');  break;
            case "khmer": language_function('khmer','locale-km_CA.json');  break;
        }
    }
}
//Function to check if the request is an AJAX request

function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function replace($post){
    return preg_replace("/\r|\n|\r\n/",'',$post);
}

function language_function($country,$jsonFile){

    if(!empty($_POST)) {
        $_POST = array_map("trim",$_POST);
        $_POST = array_map("strip_tags",$_POST);
        $_POST = array_map("replace",$_POST);
    }

    $return = $_POST;

    $write_number = file_put_contents($_SERVER['DOCUMENT_ROOT'].'common/js/resources/'.$jsonFile, preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", str_replace('_', ' ', json_encode($return , JSON_PRETTY_PRINT ) )) );

    if($write_number){
        $message = $write_number." characters, ". Ucfirst($country) ." Language Successfully Save! Please Refresh Page";
        echo json_encode(array("status"=>"success","message"=>$message));
    }else{
        $message = $write_number."Error! Please contact support. Closing the browser will result in data loss.";
        echo json_encode(array("status"=>"error","message"=>$message));
    }

    exec("git add ../common/js/resources/".$jsonFile." 2>&1");
    exec("git commit -m '".$message."' 2>&1");
    exec("git push origin master 2>&1");
    exec('ssh -vT git@bitbucket.org 2>&1');
}
