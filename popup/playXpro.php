<?include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";

/*$index = "casino";

if (!isset($_SESSION['MemberToken'])) {
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
    echo "
    <script>
    parent.location.href='/pages/lock.php?index=".$index."';
    </script>";
    exit;
}*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>XProGaming</title>
    <style type="text/css">
        body, ul, p {margin: 0;	padding: 0;}
        body {font: normal 12px Tahoma; color: #ffffff; background: #000000;}
        .clear {clear: both;}
        a img, a {border: none; outline: none;}

        .wrapper {margin: 0 auto; width: 1004px; height: 720px; z-index: 99999999; position: relative; background: url(/common/images/xpro/bg1.png) top center no-repeat #000000;}
        .container {z-index: 999999999999;}

        .header {background: url(/common/images/xpro/bg-header.png) top repeat-x #1c1d1f; padding: 5px 12px 0 12px; height: 44px; /*49px*/}
        .logo {float: left;}
        .header-links {float: right; line-height: 36px;}
        .header-account, .header-balance {float: left; margin: 0 46px 0 0;}
        .header-language {float: left; margin: 0;}
        .header-account strong, .header-balance strong {color: #fdc349; font-weight: bold;}
        .header-language ul, .header-language li, .category-container ul, .category-container li {list-style: none;}
        .header-language li {display: inline;}
        .header-language span {float: left; margin: 0 15px 0 0;}
        .header-language ul {float: right; padding-top: 5px;}

        /*IE 10+*/
        @media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
            .header-language ul {float: right; padding-top: 1px;}
        }

        /*IE 9*/ :root .header-language ul {float: right; padding-top: 1px !important;}
        
        .icon-english, .icon-chinese, .icon-vietnamese {width: 29px; height: 22px; cursor: pointer; border: none;}
        .icon-english {background: url(/common/images/xpro/icon-language.png) 29px 0;}
        .icon-english:hover, .icon-english.active {background: url(/common/images/xpro/icon-language.png) 0 0;}
        .icon-chinese {background: url(/common/images/xpro/icon-language.png) 29px 44px;}
        .icon-chinese:hover, .icon-chinese.active {background: url(/common/images/xpro/icon-language.png) 0 44px;}
        .icon-vietnamese {background: url(/common/images/xpro/icon-language.png) 29px 22px;}
        .icon-vietnamese:hover, .icon-vietnamese.active {background: url(/common/images/xpro/icon-language.png) 0 22px;}

        #tabs-category .ui-tabs {padding: 0; margin: 0; background: url(/common/images/xpro/bg-categories.png) top repeat-x; width: 1004px; height: 136px; border-top: 2px solid #000000; border-bottom: 1px solid rgba(255,255,255,0.09);}
        #tabs-category .ui-tabs .ui-widget-header {border: none;}
        #tabs-category .ui-tabs .ui-tabs-nav {padding: 0; margin: 0; height: 136px;}
        #tabs-category .ui-tabs .ui-tabs-nav li {float: left; display: inline; margin: 0; overflow: hidden; position: relative; z-index: 2;}
        #tabs-category .ui-tabs .ui-tabs-nav li a {float: left; display: inline; height: 136px; background-image: url(/common/images/xpro/categories.png); background-repeat: no-repeat;}
        #tabs-category .ui-tabs .ui-tabs-panel {float: left; width: 1004px; border-radius: 0; position: relative;}

        a.cat-icon1 {background-position: 0 0; width: 116px;}
        a.cat-icon2 {background-position: -116px 0; width: 110px;}
        a.cat-icon3 {background-position: -226px 0; width: 110px;}
        a.cat-icon4 {background-position: -336px 0; width: 110px;}
        a.cat-icon5 {background-position: -446px 0; width: 110px;}
        a.cat-icon6 {background-position: -556px 0; width: 110px;}
        a.cat-icon7 {background-position: -666px 0; width: 110px;}
        a.cat-icon8 {background-position: -776px 0; width: 110px;}
        a.cat-icon9 {background-position: -886px 0; width: 118px;}

        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon1:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon1 {background-position: 0 0;}
        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon2:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon2 {background-position: -116px 0;}
        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon3:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon3 {background-position: -226px 0;}
        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon4:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon4 {background-position: -336px 0;}
        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon5:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon5 {background-position: -446px 0;}
        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon6:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon6 {background-position: -556px 0;}
        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon7:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon7 {background-position: -666px 0;}
        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon8:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon8 {background-position: -776px 0;}
        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon9:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon9 {background-position: -886px 0;}

        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon1:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon1,
        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon2:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon2,
        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon3:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon3,
        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon4:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon4,
        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon5:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon5,
        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon6:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon6,
        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon7:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon7,
        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon8:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon8,
        #tabs-category .ui-tabs .ui-tabs-nav li a.cat-icon9:hover, #tabs-category .ui-tabs .ui-tabs-nav li.ui-tabs-active a.cat-icon9
        {
            background-image: url(/common/images/xpro/categories-hover.png);
            transition-property: background; transition-duration: 0.6s; transition-delay: 0s; -webkit-transition-property: background; -webkit-transition-duration: 0.6s; -webkit-transition-delay: 0s;
        }

        .tab-content{height: 495px; overflow-y: scroll; overflow-x: hidden; padding: 20px 0; position: relative;}
        .show {display: block;}
        .top-shadow {display: none; background: url(/common/images/xpro/bg-contentcontainer.png) top center no-repeat; width: 986px; height: 50px; position: fixed; border-top: 1px solid #33393d; z-index:99;}
        .content-container {position: relative;}
        .item-container {width: 885px; /*921px;*/ height: 127px; /*205px;*/ padding: 13px 18px 78px 18px; overflow: hidden; margin: 0 auto -46px auto; background: url(/common/images/xpro/bg-item-container.png) top no-repeat;}
        .photo{width: 93px; height: 118px;margin: 0 18px 0 0;float: left;}
        .dealer-image {width: 93px; height: 118px; float: left; margin: 0 18px 0 0; position: absolute}
        .dealer-border{position: relative}
        .dealer-info, p.dealer-category, p.dealer-name, p.dealer-server {float: left; margin: 0 25px 0 0; padding: 0;}
        p.dealer-category {width: 160px;}
        p.dealer-name {width: 140px;}
        .dealer-info {color: #666666; float: left; margin: 3px 25px 8px 0; padding: 0;}
        p.dealer-category, p.dealer-name strong, p.dealer-server strong {color: #ffffff;}
        .dealer-table {/*background: #000000;*/ float: left; height: 80px;}
        .dealer-table table {background: #3d3d3d;}
        .dealer-table table td {width: 16px; height: 16px; background: #000000; text-align: center; padding: 0; margin: 0;}

        .bet-limit-container {float: right; width: 283px; color: #9f9f9f;}
        .bet-limit-container h1 {margin: 3px auto 10px auto; padding: 0; font: normal 12px Tahoma; text-align: center;}
        .bet-limit {width: 262px; height: 27px; padding: 0 10px; background: url(/common/images/xpro/bg-betlimit.png) top center no-repeat; margin: 0 0 3px 0; cursor: pointer;}
        .bet-limit label {float: left; display: inline; margin: 0 8px 0 4px; line-height: 24px;}
        p.txt-max {float: left; display: inline; margin: 0; line-height: 24px; text-align: right; color: #fdbd42; font-weight: bold; width: 60px;}
        p.txt-min {float: left; display: inline; margin: 0 5px 0 0; line-height: 24px; text-align: right; color: #fdbd42; font-weight: bold; width: 30px;}

        .btn-play {float: right; display: inline; margin: 4px 0 0 0; line-height: 24px; border: none; width: 86px; height: 21px; background: url(/common/images/xpro/btn-play.png) 0 0; cursor: pointer;}
        .bet-limit:hover .btn-play, .btn-play:active {background: url(/common/images/xpro/btn-play.png) 0 21px;}
        #loadingWidget{width:1004px;height:495px;margin: 0 auto;}
        #Loading{width: 100%;height: 100%;background: black;opacity: 0.8;position: absolute;z-index: 5;text-align: center}
        #Loading img{border-radius: 1em;padding: 1em;position: absolute;top: 50%;left: 50%;margin-right: -50%;transform: translate(-50%, -50%);}
    </style>
    <!--[if lte IE 8]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/json2/20140204/json2.min.js"></script>
    <![endif]-->
    <!--[if lte IE 8]>
    <script>
        document.createElement('ng-include');
        document.createElement('ng-pluralize');
        document.createElement('ng-view');
        document.createElement('ng:include');
        document.createElement('ng:pluralize');
        document.createElement('ng:view');
    </script>
    <![endif]-->
    <!--[if lt IE 8]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/json2/20140204/json2.js"></script>
    <![endif]-->
    <!--[if lte IE 8]>
    <script>
        document.createElement('my-editor');
    </script>
    <![endif]-->
    <script src="/common/js/jquery-1.11.2.min.js"></script>
    <script src="/common/js/jquery-ui.js"></script>
    <script src="/common/js/angular.min.js"></script>

</head>
<body ng-app="xpro">
<div class="wrapper" ng-controller="XproController" ng-init="loadGames()"  style="overflow: hidden">
    <div id="Loading" style="">
            <img src="/common/images/xpro/loader.gif" width="100px" height="100px" style="display: block;margin-left: auto;margin-right: auto "/>
    </div>
    <div>
        <div class="container">
            <div class="header" >
                <div class="logo">
                    <a href="/popup/playXpro.php">
                        <img src="/common/images/xpro/logo-progaming.png"
                             alt="PROGraming - Professional OnLive Gaming"
                             title="PROGraming - Professional OnLive Gaming" />
                    </a>
                </div>
                <div class="header-links">
                    <div class="header-account">
                        <span>Account :</span>
                        <strong><?=$_SESSION['playerId']?></strong>
                    </div>

                    <div class="header-balance">
                        Balance :
                        <strong class="balance">...</strong><strong></strong>
                    </div>

                    <div class="header-language">
                        <span>Language</span>
                        <ul>
                            <li><input type="button" class="icon-english active" /></li>
                            <li><input type="button" class="icon-chinese" /></li>
                            <li><input type="button" class="icon-vietnamese" /></li>
                        </ul>
                    </div>

                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="content" id="tabs-category">
                <div id="tabs">
                    <ul class="category-container">
                        <li><a href="#cat1" class="cat-icon1" ng-model="Baccarat"></a></li>
                        <li><a href="#cat2" class="cat-icon2"></a></li>
                        <li><a href="#cat3" class="cat-icon3"></a></li>
                        <li><a href="#cat4" class="cat-icon4"></a></li>
                        <li><a href="#cat5" class="cat-icon5"></a></li>
                        <li><a href="#cat6" class="cat-icon6"></a></li>
                        <li><a href="#cat7" class="cat-icon7"></a></li>
                        <li><a href="#cat8" class="cat-icon8"></a></li>
                        <li><a href="#cat9" class="cat-icon9"></a></li>
                    </ul>
                    <div class="clear"></div>
                    <div class="top-shadow"></div>
                    <div ng-repeat="category in ['Baccarat','Roulette','Blackjack','SicBo','Tiger','Holdem','Poker','','Mobile']">
                        <!--<div id="cat{{$index+1}}" class="tab-content" ng-if="$index<7">-->
                        <div id="cat{{$index+1}}" class="tab-content" >
                            <div class="content-container" ng-repeat="game in getGame(category)">
                                <div class="item-container" ng-if="game.isOpen!=0">
                                    <div class="photo">
                                        <img class="dealer-image" ng-src="{{game.dealerImageUrl}}">
                                        <img class="dealer-border" src="/common/images/xpro/dealer-image-border.png"/>
                                    </div>
                                    <div class="dealer-info">
                                        <p class="dealer-category">{{game.gameName}}</p>
                                        <p class="dealer-name">Dealer : <strong>{{game.dealerName}}</strong></p>
                                        <p class="dealer-server">Server : <strong>Europe</strong></p>
                                    </div>
                                    <div class="bet-limit-container">
                                        <h1>Select Bet Limit</h1>
                                        <div class="bet-limit">
                                            <label>MIN</label> <p class="txt-min">{{game.minBet}}</p>
                                            <label>MAX</label> <p class="txt-max">{{game.maxBet}}</p>
                                            <input type="button" class="btn-play" ng-click="play(game.connectionUrl,game.winParams,category+$index)"/>
                                        </div>
                                    </div>
                                    <div class="dealer-table">
                                        <table cellpadding="0" cellspacing="1" ng-repeat="i in [1,2,3,4,5]">
                                            <tr>
                                                <td  ng-repeat="i in [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28]"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="cat{{$index+1}}" class="tab-content" ng-if="$index>=7">
                            <div class="content-container" ng-if="category=='Mobile'">
                                <div class="item-container">
                                    Mobile
                                </div>
                            </div>
                            <div class="content-container"  ng-if="category!='Mobile'">
                                    Null
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        {{updateTime}}
</div>




<script>
angular.module("xpro", []).controller("XproController", function($scope, $http) {
    $scope.games = {};
    $scope.table = {};
    $scope.loadGames = function() {
        var responsePromise = $http.get("/api/player/LoadXpro?gspNo=105");
        responsePromise.success(function(data, status, headers, config) {
            $scope.games = data;
            $("#Loading").hide();
            $("#tabs").tabs({disabled: [7]});
        });
        responsePromise.error(function(data, status, headers, config) {/*alert("AJAX failed!");*/});
    };

    $scope.getGame = function(category){
        return $scope.games[category];
    };

    var updateGames = function(){

        var responsePromise = $http.get("/api/player/LoadXpro?gspNo=105");

        responsePromise.success(function(data, status, headers, config) {
            $scope.games = data;
            $scope.updateTime = " Updated data and balance: "+ new Date();
        });
        responsePromise.error(function(data, status, headers, config) {/*alert("AJAX failed!");*/});
    };

    $scope.timer = setInterval(function() {
        $scope.$apply(updateGames);
    }, 60000);

    $scope.play = function (url, param, i) {
        var pop = window.open(url, i, param).focus();
        var responseSession = $http.get("session_extension.php");
        responseSession.success(function(data, status, headers, config) {});
    };
});
</script>
<script>
    function getBalance(){
        $.getJSON("/api/finance/GetMainBalance.php",function(data){
            if(data.result){
                $('.balance').text(data.result.mainBalance.amount+" "+data.result.mainBalance.currencyIsoCd);
            }else{
                $('.balance').text('Please login again.');
            }
        });
    }


    $('.category-container li a').click(function(){
        $('.top-shadow').css('display', 'none');
    });

    $('.tab-content').scroll(function () {
        var y = $(this).scrollTop();
        if (y > 10) {
            $('.top-shadow').fadeIn(100);
        } else {
            $('.top-shadow').fadeOut(100);
        }
    });

    $(document).ready(function(){
        getBalance();
        setInterval(getBalance,60000);
    });
</script>
</body>
</html>