<? include $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

if(!empty($_GET)) {
    $_GET = array_map("trim",$_GET);
    $_GET = array_map("strip_tags",$_GET);
}

$gspNo =$_GET["gspNo"];
$childGspNo="";

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

    $p = array(
        "playerId"=>$_SESSION["playerId"],
        "gspNo"=>$gspNo,
        "childGspNo" => $childGspNo,
        "gameType" => 0,
        "platform"=>$platform
    );

    echo json_encode($p);

    $result=RestCurl::post("GameLobby.svc/GetGamesListWithLimits",$p,null);
    echo json_encode($result);
//    exit;

    if ($result["status"] == 200) {
        $_SESSION["XPRO"] = $result[2]->gamesList->game;
    }else{
        unset($_SESSION["XPRO"]);
    }

    if(isset($_SESSION["XPRO"])) {
        $games = $_SESSION["XPRO"];
        var_dump($games);
        $game["xpro"] = array(
            0 => "All Games",
            1 => "Roulette",
            2 => "Blackjack",
            4 => "Baccarat",
            8 => "Single Player Poker",
            10 => "Multi Player Poker",
            12 => "Dragon Tiger",
            16 => "Sic-Bo",
            18 => "Carribean Poker"

        );

        foreach ($games as $key => $row) {
            $volume[$key] = $row->gameName;
        }


        $array_lowercase = array_map('strtolower', $volume);

        array_multisort($array_lowercase, SORT_ASC, SORT_STRING, $games);

        foreach ($games as $game) {
            if (strpos($game->gameName, "Baccarat")) {
                $type = "Baccarat";
            } else if (strpos($game->gameName, "Roulette")) {
                $type = "Roulette";
            } else if (strpos($game->gameName, "Blackjack")) {
                $type = "Blackjack";
            } else if (strpos($game->gameName, "Sic Bo")) {
                $type = "Sic-Bo";
            } else if (strpos($game->gameName, "Dragon Tiger")) {
                $type = "Dragon Tiger";
            }


            if (sizeof($game->limitSetList->limitSet) > 1) {
                for ($i = 0; $i < sizeof($game->limitSetList->limitSet); $i++) {
                    $row = new stdClass();
                    $row->gameID = (string)$game->gameID;
                    $row->gameType = (string)$game->gameType;
                    $row->limitSetID = (string)$game->limitSetList->limitSet[$i]->limitSetID;
                    $row->minBet = (string)$currency.number_format($game->limitSetList->limitSet[$i]->minBet,0);
                    $row->maxBet = (string)$currency.number_format($game->limitSetList->limitSet[$i]->maxBet,0);
                    $row->gameName = (string)$game->gameName;
                    $row->dealerName = (string)$game->dealerName;
                    $row->dealerImageUrl = (string)$game->dealerImageUrl;
                    $row->connectionUrl = (string)$game->connectionUrl;
                    $row->winParams = (string)$game->winParams;
                    $row->isOpen = (string)$game->isOpen;
                    $row->openHour = (string)$game->openHour;
                    $row->closeHour = (string)$game->closeHour;

                    $json[$type][] = $row;
                }
            } else {

                $row = new stdClass();
                $row->gameID = (string)$game->gameID;
                $row->gameType = (string)$game->gameType;
                $row->limitSetID = (string)$game->limitSetList->limitSet->limitSetID;
                $row->minBet = (string)$currency.number_format($game->limitSetList->limitSet->minBet,0);
                $row->maxBet = (string)$currency.number_format($game->limitSetList->limitSet->maxBet,0);
                $row->gameName = (string)$game->gameName;
                $row->dealerName = (string)$game->dealerName;
                $row->dealerImageUrl = (string)$game->dealerImageUrl;
                $row->connectionUrl = (string)$game->connectionUrl;
                $row->winParams = (string)$game->winParams;
                $row->isOpen = (string)$game->isOpen;
                $row->openHour = (string)$game->openHour;
                $row->closeHour = (string)$game->closeHour;

                $json[$type][] = $row;
            }
        }

//var_dump($json);


        echo json_encode($json);

    }else{
        echo "error";
    }


}else{
    $message="please Login";
    echo json_encode(array("status"=>$result["status"],"message"=>$message,'alert'=>true));
}