<?php

class XmlToJson {

    public static function Parse ($url) {

        $fileContents= file_get_contents($url);

        $fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);

        $fileContents = trim(str_replace('"', "'", $fileContents));

        $simpleXml = simplexml_load_string($fileContents);

        $jackpotList=new stdClass();
        foreach($simpleXml->item as $k){
            $gameId = $k->attributes()->GameId;
            $jackpotList->$gameId=new stdClass();
            foreach($k->attributes() as $currency => $amount){
                if(!in_array($currency,array("GameId","Amount","TimeStamp"))){
                    $jackpotList->$gameId->$currency= (string)$amount;
                }
            }
        }


        $json = json_encode($jackpotList);

        return $json;

    }
}


print XmlToJson::Parse("http://slotservice.gpiops.com/jackpot/1.xml");

