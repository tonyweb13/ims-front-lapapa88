<?include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";
//if($mobile_detect->isMobile() || $mobile_detect->isTablet()){
//    if(!isset($_SESSION["viewDesktop"])){
//        header("Location:/mobile/#/");
//    }
//}

$script_tag="";
$body_tag="";
if(isset($_SESSION['accessToken'])){

    if(((preg_match("/[a-zA-Z0-9]+\.frontend88\.com/",$_SERVER['HTTP_HOST'])) && $_SERVER['HTTP_HOST']!= "weipoker.frontend88.com")|| $_SERVER['HTTP_HOST']=="www.vpaysolution.com"){
        $script_url = "http://gamt.backoffice88.com/gam?ag_no={$_SESSION["agentNo"]}&uid={$_SESSION["nickname"]}&mode=0";
    }else{
        $script_url = "http://gam.backoffice88.com/gam?ag_no={$_SESSION["agentNo"]}&uid={$_SESSION["nickname"]}&mode=0";
    }
    $script_tag="<script src=\"{$script_url}\" type=\"text/javascript\"></script>";
    if($_SESSION['needToResetPwYn']){
        $body_tag='<body ng-controller ="CommonController"  ng-init="init(true,true);">';
    }else {
        $body_tag='<body ng-controller ="CommonController"  ng-init="init(true,false);">';
    }
}else{
    $body_tag='<body ng-controller ="CommonController"  ng-init="init(false,false);">';
}
?>
<!DOCTYPE html>
<!--[if IE 8]><!-->
<html class="no-js lt-ie9" ng-app="casinoApp">
<!--<![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" ng-app="casinoApp">
<!--<![endif]-->
<head>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/common/js/html5shiv.js"></script>
    <script type="text/javascript" src="/common/js/respond.min.js"></script>
    <![endif]-->
    <!--[if lte IE 8]>
    <script type="text/javascript" src="/common/js/es5-shim.js"></script>
    <script type="text/javascript" src="/common/js/json3.min.js"></script>
    <script type="text/javascript" src="/common/js/respond.min.js"></script>
    <script>
        document.createElement('ng-include');
        document.createElement('ng-pluralize');
        document.createElement('ng-view');
        document.createElement('ng-click');
        document.createElement('ng-repeat');
        document.createElement('ng-show');
        document.createElement('my-directive');

        // Optionally these for CSS
        document.createElement('ng:include');
        document.createElement('ng:pluralize');
        document.createElement('ng:view');
        document.createElement('ng:click');
        document.createElement('ng:repeat');
        document.createElement('ng:show');
        document.createElement('poster');
    </script>
    <![endif]-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Welcome to <?=$casinoName?></title>
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/common/css/ticker-style.css">
    <link rel="stylesheet" href="/common/css/owl.carousel.css">
    <link rel="stylesheet" href="/common/css/owl.theme.css">
    <link rel="stylesheet" href="/common/css/jquery.mCustomScrollbar.css" type="text/css" />
    <link rel="stylesheet" href="/common/css/sweetalert.css">
    <link rel="stylesheet" href="/common/css/intlTelInput.css">
    <link rel="stylesheet" href="/common/css/ngDialog.css">
    <link rel="stylesheet" href="/common/css/ngDialog-theme-default.css">
    <link rel="stylesheet" href="/common/css/datetimepicker.css">
    <link rel="stylesheet" href="/common/css/style.css">
    <link rel="stylesheet" href="/common/css/fonts/roboto.css" />
<?=$script_tag?>
</head>
<?=$body_tag?>
<div id="preloader"><div class="preloader-gif"></div></div>
<div id="wrap">
    <div id="top-container" class="whole-container">
        <div class="container">
            <div class="top-announcements">
                <label ng-bind="'Announcements' | translate"></label>
                <div class="news-ticker">
                    <ul>
                        <li ng-repeat="announcement in getAnouncementList" ng-click="displayCustomer(1,announcement)"><i class="icon-new">N</i> <span ng-bind="announcement.title | translate"></span> <em ng-bind="announcement.startDate | userDate"></em></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            <div class="top-links">
                <ul>
                    <li><i class="icon-livechat-top" ></i><span ng-bind="'Live Chat'| translate" onclick="LC_API.open_chat_window();return false;"></span></li>
                    <li  ng-click="displayCustomer(5)" ng-bind="'AFFILIATES' | translate"></li>
                    <li class="lang-option">
                        <span ng-bind="'LANGUAGE' | translate"></span>
                        <div class="lang-active">
                            <?if(!empty($_COOKIE['selectedLanguage'])) {
                                if ($_COOKIE['selectedLanguage'] == "th_TH") { //Tagalog language has different flag code
                                    echo '<span id="language-flag"><i class="icon-lang language-tl"></i></span>';

                                } else {
                                    echo '<span id="language-flag"><i class="icon-lang language-' . substr($_COOKIE['selectedLanguage'], 0, 2) . '"></i></span>';
                                }
                            }else{?>
                                <script type="text/javascript">
                                    var userLang = navigator.language || navigator.userLanguage;
                                    document.write('<span id="language-flag"><i class="icon-lang language-'+userLang.substring(0,2)+'"></i></span>');
                                </script>
                            <?}?>
                            <span class="rotate-triangle2"></span>
                        </div>
                    </li>
                </ul>
                <div id="lang-list">
                    <ul>
                        <li ng-click="setLang('en_US')"><i class="icon-lang language-en"></i> English</li>
                        <li ng-click="setLang('th_TH')"><i class="icon-lang language-th"></i> ไทย</li>
                        <li ng-click="setLang('zh_CN')"><i class="icon-lang language-zh"></i> 简体中国</li>
                        <li ng-click="setLang('zh_TW')"><i class="icon-lang language-tw"></i> 傳統</li>
                        <li ng-click="setLang('ko_KR')"><i class="icon-lang language-ko"></i> 한국어</li>
                        <li ng-click="setLang('ja_JP')"><i class="icon-lang language-ja"></i> 日本人</li>
                        <li ng-click="setLang('mm_MY')"><i class="icon-lang language-mm"></i> မြန်မာ</li>
                        <li ng-click="setLang('mn_MO')"><i class="icon-lang language-mn"></i> монгол</li>
                        <li ng-click="setLang('km_CA')"><i class="icon-lang language-km"></i> ខ្មែរ</li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div id="header-container" class="whole-container">
        <div class="container">
            <div class="logo"><a href="/#/"><img src="common/images/logo.png" /></a></div>
            <div class="login-container" ng-controller="LoginController">
                <?if(!isset($_SESSION['accessToken'])){?>
                    <div id="guest" >
                        <form ng-submit="processForm()">
                            <label ng-bind="'ID' | translate"></label>
                            <input type="text" name="nickname" ng-model="loginForm.nickname"  placeholder="{{ 'User ID' | translate}}" class="id" ng-cloak/>
                            <label ng-bind="'Password' | translate"></label>
                            <input type="password" name="password" ng-model="loginForm.password"  placeholder="{{ 'Password' | translate}}" class="pw" ng-cloak/>
                            <button type="submit" class="btn-login btn-gray hvr-sweep-to-right" ng-disabled="isProcessing" ng-bind="'Login' | translate"></button>
                        </form>
                        <button class="btn-signup hvr-sweep-to-right" ng-click="displaySignUp()" ng-bind="'Sign Up' | translate"></button>
                        <button class="btn-forgotpass btn-gray hvr-sweep-to-right" ng-click="displayForgotPass()">
                            <i class="icon-forgotpass"></i>
                            <div class="tooltip tooltipForgot border-round">
                                <span ng-bind="'Forgot Password' | translate"></span><span>?</span>
                            </div>
                        </button>
                    </div>
                <?}else{?>
                    <div id="user">
                        <label><span ng-bind="'Welcome' | translate"></span>, <strong><?=$_SESSION['nickname']?></strong></label>
                        <div class="balanceContainer">
                            <div class="balanceContent">
                                <div class="balanceWrapper">
                                    <div class="box-balance box-balance-top" ng-controller="BalanceController" ng-init="init();">
                                        <p class="float-left" ng-bind="'Main Wallet' | translate"></p>
                                        <strong ng-bind="mainBalance.amount | customCurrency:cc_currency_symbol[mainBalance.currencyIsoCd]" ></strong>
                                    </div>
                                    <div ng-show="gspNo" class="box-balance box-balance-bottom" ng-repeat="gspBalance in gspBalanceList | filter:{GspNo:gspNo}">
                                        <p class="float-left" ng-bind="gspBalance.GspName"></p>
                                        <strong ng-bind="gspBalance.currencyAmount.amount | customCurrency:cc_currency_symbol[gspBalance.currencyAmount.currencyIsoCd]"></strong>

                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="box-balance-container">
                                <div class="box-balance-item" ng-repeat="gspBalance in gspBalanceList" ng-if="gspNo != gspBalance.GspNo">
                                    <span ng-bind="gspBalance.GspName"></span>
                                    <strong ng-if="gspBalance.currencyAmount.amount >=0" ng-bind="gspBalance.currencyAmount.amount | customCurrency:cc_currency_symbol[gspBalance.currencyAmount.currencyIsoCd]"></strong>
                                    <strong ng-if="gspBalance.currencyAmount.amount == -1" ng-bind="'Load Failed' | translate"></strong>
                                    <strong ng-if="gspBalance.currencyAmount.amount == -2" ng-bind="'GspUnderMaintenance' | translate"></strong>
                                </div>
                                <div class="box-balance-item box-balance-total">
                                    <span ng-bind="'Total' | translate"></span>
                                    <strong ng-bind="totalBalance.amount | customCurrency:cc_currency_symbol[totalBalance.currencyIsoCd]"></strong>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <button ng-controller="BalanceController" class="btn-gray hvr-sweep-to-right" ng-click="reloadBalance()" ng-disabled="isProcessing"><i class="icon-refresh-btn"></i></button>
                        <button class="btn-mywallet hvr-sweep-to-right" ng-click="displayWallet(1)" ng-bind="'Main Wallet' | translate"></button>
                        <button class="btn-account btn-gray hvr-sweep-to-right" ng-click="displayWallet(6)" ng-bind="'Account' | translate" ></button>
                        <button ng-controller="LogoutController"  class="btn-logout btn-gray hvr-sweep-to-right" ng-click="logout()" ng-disabled="isProcessing"><i class="icon-logout"></i></button>
                    </div>
                <?}?>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div id="nav-container" class="whole-container nav-blue">
        <div class="container" ng-controller="NavController">
            <ul>
                <li class="nav-mobile"><a href="#mobile" ng-class="{ active: isActive('/mobile')}"><i class="icon-mobile"></i></a></li>
                <li><a href="#sports" class="navSports" ng-class="{ active: isActive('/sports')}" ng-bind="'Sports' | translate"></a></li>
                <li><a href="/#/" class="navCasino" ng-class="{ active: isActive('/')}" ng-bind="'Live Casino' | translate"></a></li>
                <li><a href="#slot" ng-class="{ active: isActive('/slot')}" ng-bind="'Slot Games' | translate"></a></li>
                <li class="navKeno">
                    <a href="#/" ng-click="alertLang()">
                        <span ng-bind="'Keno' | translate"></span> &<br />
                        <span ng-bind="'Lottery' | translate"></span>
                    </a>
                </li>
                <!--<li><a class="navPoker" ng-bind="'Others' | translate" ng-click="alertLang()"></a></li>-->
                <li><a href="#others" class="navIcon" ng-class="{ active: isActive('/others')}" ng-bind="'Others' | translate"></a></li>
                <?/*if($_SERVER["HTTP_HOST"] != "demo.frontend88.com"){*/?><!--
                    <li><a class="navPoker" ng-bind="'Poker' | translate" ng-click="alertLang()"></a></li>
                <?/*}else{*/?>
                    <li><a class="navPoker" ng-bind="'Poker' | translate" ng-click="playGame('',40)"></a></li>
                --><?/*}*/?>
                <!--<li><a href="#/" ng-click="alertLang()" ng-bind="'Mini Game' | translate"></a></li>-->
                <li class="nav-default"><a href="#promotion" ng-class="{ active: isActive('/promotion')}" class="nav-promos nav-default" ng-bind="'Promotions' | translate"></a></li>
                <li class="nav-deposit nav-default" ng-click="displayWallet(2)" ng-bind="'Deposit' | translate"></li>
                <li class="nav-withdraw nav-default" ng-click="displayWallet(3)" ng-bind="'Withdraw' | translate"></li>
                <li ng-hide="loggedIn" class="nav-customer nav-default" ng-click="displayCustomer(1)" ng-bind="'Customer' | translate"></li>
                <li ng-show="loggedIn" class="nav-customer nav-default" ng-click="displayCustomer(4)" ng-bind="'Customer' | translate"></li>
            </ul>
        </div>
    </div>
    <div ng-view></div>
    <div id="footer-container">
        <div class="container">
            <div class="footer-links">
                <ul>
                    <li><a href="#promotion" ng-bind="'Promotions' | translate"></a></li>
                    <li ng-click="displayWallet(2)" ng-bind="'Deposit' | translate"></li>
                    <li ng-click="displayWallet(3)" ng-bind="'Withdraw' | translate"></li>
                    <li ng-click="displayCustomer(5)" ng-bind="'Affiliates' | translate"></li>
                </ul>
            </div>
            <div class="copyright">
                <span>&copy;</span>
                <span>2015 </span>
                <span><?=$casinoName?> </span>
                <span ng-bind="'All Rights Reserved' | translate"></span><!--&nbsp;|&nbsp; 18-->
            </div>
            <div class="clear"></div>
            <div class="box-default margin-top margin-bottom">
                <table cellpadding="0" cellspacing="0" class="footer-table" width="100%">
                    <tr>
                        <th ng-bind="'Information' | translate"></th>
                        <th ng-bind="'Products' | translate"></th>
                        <th  ng-bind="'Info Center' | translate"></th>
                        <th  ng-bind="'Betting Info' | translate"></th>
                    </tr>
                    <tr>
                        <td>
                            <h6 ng-bind="'Registration' | translate"></h6>
                            <p ng-bind="'Open an account to enjoy all our online betting promotions and gaming entertainment of premium quality at exceptionally good value We believe in rewarding our valued customers with different type of deposit bonuses and promotions' | translate"></p>

                            <h6 ng-bind="'Affiliates' | translate"></h6>
                            <p>
                                <span ng-bind="'Become our partner and earn high commission levels every month by driving players to' | translate"></span>
                                <span> <?=$casinoName?></span>
                            </p>

                            <h6 ng-bind="'Responsible Gaming' | translate"></h6>
                            <p>
                                <span><?=$casinoName?></span>
                                <span ng-bind="'strives to provide a channel of entertainment to our customer in a positive way We have in place major safeguards to promote and ensure responsible gambling' | translate"></span>
                            </p>

                            <h6 ng-bind="'Security' | translate"></h6>
                            <p ng-bind="'A Solid and Secure Betting System The privacy of your into is important to us and we adhere to strict confidentiality and privacy policies' | translate"></p>
                        </td>
                        <td>
                            <h6 ng-bind="'Sports Betting & Live Betting' | translate"></h6>
                            <p ng-bind="'We offer all the major sports such as English Premier League Spanish La Liga Italian Serie A UEFA Champions League French Ligue 1 German Bundesliga 1 NFL NBA NCAA Women Basketball Tennis Formula 1 and many more We offer up to 4000 Live Betting soccer matches a month for your wagering pleasure' | translate"></p>

                            <h6 ng-bind="'Online Casino' | translate"></h6>
                            <p>
                                <span ng-bind="'Play casino games online Choose from Roulette Blackjack Video Poker Slots Progressives and others plus get your chance to win more Casino Jackpots on' | translate"></span>
                                <span> <?=$casinoName?></span>
                            </p>

                            <h6 ng-bind="'Live Casino' | translate"></h6>
                            <p ng-bind="'We have extensive range of offers These include Live Dealer Casino with Live Lobby view beautiful Asian dealers Live Baccarat Live Sic Bo Live Dragon Tiger and Live Roulette Online Casino Slots and easy to play Keno games' | translate"></p>
                        </td>
                        <td>
                            <h6 ng-bind="'Promotions' | translate"></h6>
                            <p ng-bind="'Deposit Bonus and Welcome Bonus offer for all new members Reload Bonus and Cash Rebates for existing customers as well' | translate"></p>

                            <h6 ng-bind="'24/7 Customer Center' | translate"></h6>
                            <p ng-bind="'Check out our FAQ page for sports betting and gaming help It contains help on account opening deposit withdrawal and technical help' | translate"></p>

                            <h6 ng-bind="'Payment Methods' | translate"></h6>
                            <p>
                                <span ng-bind="'We provide great choice for customers to deposit and withdraw when you win via NETELLER Moneybookers International Bank Transfer Western Union and many more We have it all great games start with' | translate"></span>
                                <span> <?=$casinoName?></span>
                            </p>

                            <h6 ng-bind="'Contact Us' | translate"></h6>
                            <p ng-bind="'If you need any help or have any questions about Live betting or our casino games we are available 24 7 via Live Chat Telephone and E-mail' | translate"></p>
                        </td>
                        <td>
                            <h6 ng-bind="'Sports Results' | translate"></h6>
                            <p ng-bind="'Get all of the results from sports and matches we offer' | translate"></p>

                            <h6 ng-bind="'Betting Statistics' | translate"></h6>
                            <p ng-bind="'Over 200 tournaments across all major sports showing league tables fixtures form team and player statistics injury and suspension lists' | translate"></p>

                            <h6 ng-bind="'Sports Betting' | translate"></h6>
                            <p ng-bind="'Rules Our sports rules section details the rules and regulations under which bets are accepted and provides information on sports betting rules' | translate"></p>

                            <h6 ng-bind="'Casino Betting' | translate"></h6>
                            <p> <span ng-bind="'Our Live Casino provides into such as Limit' | translate"></span>, <span ng-bind="'Live Pool' | translate"></span>, <span ng-bind="'Result History and Replay Hand History' | translate"></span>. <span ng-bind="'All necessary into is displayed on screen for your betting convenience' | translate"></span>. <span ng-bind="'You can choose hide or show different into at anytime' | translate"></span></p>
                        </td>
                    </tr>
                </table>
                <div class="payment-logos">
                    <strong ng-bind="'Payment' | translate"></strong>
                    <img src="common/images/payment.png">
                </div>
            </div>
        </div>
    </div>
</div>

<!--SCRIPTS-->
<script type="text/javascript" src="/common/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/common/js/angular.min.js"></script>
<![if !IE 8]>
<script type="text/javascript" src="/common/js/jquery-sweet-alert.min.js"></script>
<![endif]>
<script type="text/javascript" src="/common/js/utill.js"></script>
<script type="text/javascript" src="/common/js/jquery-intlTelInput.js"></script>
<script type="text/javascript" src="/common/js/jquery-browser.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-moment.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-moment-timezone.min.js"></script>
<script type="text/javascript" src="/common/js/jstz-1.0.4.min.js"></script>

<script type="text/javascript" src="/common/js/angular-route.min.js"></script>
<script type="text/javascript" src="/common/js/angular-cookies.min.js"></script>
<script type="text/javascript" src="/common/js/angular-translate.min.js"></script>
<script type="text/javascript" src="/common/js/angular-translate-storage-cookie.js"></script>
<script type="text/javascript" src="/common/js/angular-translate-storage-local.js"></script>
<script type="text/javascript" src="/common/js/angular-translate-loader-static-files.js"></script>
<script type="text/javascript" src="/common/js/ngDialog.js"></script>
<script type="text/javascript" src="/common/js/angular-module-currencyCode.min.js"></script>
<script type="text/javascript" src="/common/js/angular-pagination-ui-bootstrap.js"></script>

<script type="text/javascript" src="/common/js/angular-validation.js"></script>
<script type="text/javascript" src="/common/js/angular-validation-rule.js"></script>

<script type="text/javascript" src="/common/js/angular-custom-module.js"></script>
<script type="text/javascript" src="/common/js/angular-custom-common.js"></script>
<script type="text/javascript" src="/common/js/angular-custom-main.js"></script>
<script type="text/javascript" src="/common/js/angular-custom-signup.js"></script>
<script type="text/javascript" src="/common/js/angular-custom-sports.js"></script>
<script type="text/javascript" src="/common/js/angular-custom-slots.js"></script>
<script type="text/javascript" src="/common/js/angular-custom-promo.js"></script>
<script type="text/javascript" src="/common/js/angular-custom-wallet.js"></script>
<script type="text/javascript" src="/common/js/angular-custom-customer.js"></script>

<script type="text/javascript" src="/common/js/jquery-easy-ticker.js"></script>
<script type="text/javascript" src="/common/js/jquery-easing.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-owl-carousel.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-jOdometer.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-bPopup.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-pagination.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-placeholder.js"></script>
<script type="text/javascript" src="/common/js/jquery-mouseWheel.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-datetimepicker.js"></script>
<script type="text/javascript" src="/common/js/jquery-custom-scroll-bar.min.js"></script>
<script type="text/javascript" src="/common/js/jquery-custom.js"></script>

<script type="text/javascript">
    var __lc = {};
    __lc.license = <?=$casinoLiveChat?>;

    <? if(isset($_SESSION['nickname'])){?>
    __lc.params = [
        { name: 'MemberID', value: '<?=$_SESSION['nickname']?>' },
        { name: 'Email', value: '<?=$_SESSION['email']?>' }
    ];

    __lc.visitor = {
        name: '<?=$_SESSION['nickname']?>',
        email: '<?=$_SESSION['email']?>'
    };
    <?}else{?>
    __lc.visitor = {
        name: 'Customer',
        email: ''
    };
    <?}?>
    (function() {
        var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
        lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
    })();
</script>
</body>
</html>