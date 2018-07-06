<?
//echo $_SERVER['HTTP_REFERRER'];
$url = file_get_contents("http://www.tickerassist.co.uk/ProgressiveTickers/WebServiceProgressiveTickerScriptScroll.asmx/renderScript?form=json&strProgId=jackpot&strCurrId=null");
preg_match("/current_value=(.*?);/", $url, $match);
$value = $match[1];
preg_match("/difference=(.*?);/", $url, $match);
$difference = $match[1];
echo $value . "|" . $difference;
