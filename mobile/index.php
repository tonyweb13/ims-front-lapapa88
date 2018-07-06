<?include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";
if(isset($_SESSION["viewDesktop"])){
    unset($_SESSION["viewDesktop"]);
}
?>
<!DOCTYPE html>
<html ng-app="mobileApp">
<head>
    <meta charset="utf-8" />
    <!--<base href="/">-->
    <title>Welcome to <?=$casinoName?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-title" content="Ronaldo88">
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <link rel="icon" sizes="114x114" href="common/images/splash/ronaldo883.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="common/images/splash/ronaldo883.png">
    <!--<link rel="-touch-icon-precomposed" sizes="180x180" href="common/images/splash/ronaldo883.png">-->
    <link rel="apple-touch-startup-image" href="common/images/splash/splash-screen.png" media="screen and (max-device-width: 320px)" />
    <link rel="apple-touch-startup-image" href="common/images/splash/splash-screen@2x.png" media="(max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)" />
    <link rel="apple-touch-startup-image" sizes="640x1096" href="common/images/splash/splash-screen@3x.png" />
    <link rel="apple-touch-startup-image" sizes="1024x748" href="common/images/splash/splash-screen-ipad-landscape.png" media="screen and (min-device-width : 481px) and (max-device-width : 1024px) and (orientation : landscape)" />
    <link rel="apple-touch-startup-image" sizes="768x1004" href="common/images/splash/splash-screen-ipad-portrait.png" media="screen and (min-device-width : 481px) and (max-device-width : 1024px) and (orientation : portrait)" />
    <link rel="apple-touch-startup-image" sizes="1536x2008" href="common/images/splash/splash-screen-ipad-portrait-retina.png" media="(device-width: 768px)  and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)"/>
    <link rel="apple-touch-startup-image" sizes="1496x2048" href="common/images/splash/splash-screen-ipad-landscape-retina.png" media="(device-width: 768px) and (orientation: landscape)    and (-webkit-device-pixel-ratio: 2)"/>

    <link rel="stylesheet" href="common/css/bootstrap.min.css">
    <link rel="stylesheet" href="common/css/responsive-thumbnails.css">
    <link rel="stylesheet" href="common/css/ngDialog.css">
    <link rel="stylesheet" href="common/css/ngDialog-theme-default.css">
    <link rel="stylesheet" href="../common/css/datetimepicker.css">
    <link rel="stylesheet" href="../common/css/sweetalert.css">
    <link rel="stylesheet" href="../common/css/intlTelInput.css">
    <link rel="stylesheet" href="common/css/ronaldo88.css">
    <link rel="stylesheet" href="common/css/responsive.css">
    <link rel="stylesheet" href="common/css/add2Home.css">
    <link rel="stylesheet" href="common/css/fonts/roboto.css" />
    <script type="text/javascript" src="common/js/addtohomescreen.js"></script>
    <!--<script type="text/javascript" src="common/js/jquery-standalone.js"></script>-->

</head>
<?if(isset($_SESSION['accessToken'])){
    if($_SESSION['needToResetPwYn']){
        echo "<body ontouchstart=\"\" ng-controller=\"CommonController\" ng-class=\"RouteData.get('bodyClass')\"  ng-init=\"init(true,true);\">";
    }else{
        echo "<body ontouchstart=\"\" ng-controller=\"CommonController\" ng-class=\"RouteData.get('bodyClass')\" ng-init=\"init(true,false);\">";
    }
}else{
    echo "<body  ontouchstart=\"\" ng-controller=\"CommonController\" ng-class=\"RouteData.get('bodyClass')\"  ng-init=\"init(false,false);\">";
}
//echo $_SESSION['agentBTag'];
?>

<div class="cover" ng-click="coverToggle()"></div>
<div id="header-container" class="navbar">
    <div class="logo pull-left" onclick="location.href='/mobile/#/'" role="button"><img src="common/images/logo_ronaldo88.png" /></div>
    <?php if(!isset($_SESSION['accessToken'])){?>
        <div id="guest" class="btn-login-toggle pull-right" role="button" ng-click="openLogin()">
            <i class="icon-login"></i>
            <strong ng-disabled="isProcessing" ng-bind="'Login' | translate"></strong><em>|</em><strong ng-bind="'Sign Up' | translate"></strong>
        </div>
    <?}else{?>
        <div id="user" class="wallet-info pull-right" role="button" ng-click="openAccount()">
            <i class="icon-info" role="button"></i>
            <div ng-controller="BalanceController" ng-init="init();">
            <span ng-bind="'Main' | translate"></span> <strong ng-bind="mainBalance.amount | customCurrency:cc_currency_symbol[mainBalance.currencyIsoCd]" ></strong>
            </div>
        </div>
    <?}?>
</div>

<div class="coverInside" ng-click="langToggle()"></div>
<div class="langSelection" ng-click="langToggle()" ng-controller="MainController" style="display: none;">
    <div class="lang-active">
        <h2 ng-bind="'Select Your Language' | translate"></h2>
        <div id="language-flag-main">
            <?if(!empty($_COOKIE['selectedLanguage'])) {
                if(substr($_COOKIE['selectedLanguage'], 0, 2) == "th"){ $lang = "ไทย"; }
                else if(substr($_COOKIE['selectedLanguage'], 0, 2) == "zh"){ $lang = "简体中国"; }
                else if(substr($_COOKIE['selectedLanguage'], 0, 2) == "tw"){ $lang = "傳統"; }
                else if(substr($_COOKIE['selectedLanguage'], 0, 2) == "ko"){ $lang = "한국어"; }
                else if(substr($_COOKIE['selectedLanguage'], 0, 2) == "ja"){ $lang = "日本人"; }
                else if(substr($_COOKIE['selectedLanguage'], 0, 2) == "mm"){ $lang = "မြန်မာ"; }
                else if(substr($_COOKIE['selectedLanguage'], 0, 2) == "mn"){ $lang = "монгол"; }
                else { $lang = "English"; }

                echo '<span id="language-flag"><i class="icon-lang language-' . substr($_COOKIE['selectedLanguage'], 0, 2) . '"></i> '.$lang.'</span>';

            } else{?>
                <span id="language-flag"></span>
            <?}?>
            <i class="icon-down"></i>
        </div>
        <span class="rotate-triangle2"></span>
    </div>
    <div class="clearfix"></div>
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
        </ul>
    </div>
</div>


<div ng-view></div>
<div class="clearfix"></div>
<div class="nav-shadowLeft"></div>
<div class="nav-shadowRight"></div>
<div class="nav navbar-fixed-bottom" role="navigation" ng-controller="NavController">
    <ul id="nav-list">
        <li class="nav-tab"><a href="/mobile/#/"    ng-class="{active: isActive('/')}"          class="nav-home"><i class="navicon"></i><span ng-bind="'Home' | translate"></span></a></li>
        <li class="nav-tab"><a href="#promo"        ng-class="{active: isActive('/promo')}"     class="nav-promo"><i class="navicon"><span class="pop-count">6</span></i><span ng-bind="'Promos' | translate"></span></a></li>
        <li class="nav-tab"><a href="#sports"       ng-class="{active: isActive('/sports')}"    class="nav-sports"><i class="navicon"></i><span ng-bind="'Sports' | translate"></span></a></li>
        <li class="nav-tab"><a href="#casino"       ng-class="{active: isActive('/casino')}"    class="nav-casino"><i class="navicon"></i><span ng-bind="'Casino' | translate"></span></a></li>
        <li class="nav-tab"><a href="#slots"        ng-class="{active: isActive('/slots')}"     class="nav-slot"><i class="navicon"></i><span ng-bind="'Slots' | translate"></span></a></li>
        <li class="nav-tab"><a href="#poker"        ng-class="{active: isActive('/poker')}"     class="nav-poker"><i class="navicon"></i><span ng-bind="'Poker' | translate"></span></a></li>
        <!--<li class="nav-tab"><a href="#keno"     ng-class="{active: isActive('/keno')}"      class="nav-keno"><i class="navicon"></i>Keno/Lottery</a></li>-->
    </ul>
</div>

<?php if(!isset($_SESSION['accessToken'])){?>
<div id="slide-login"
     class="slide-menu slide-menu-close"
     ng-include="'sidemenu/login.php'"></div>
<div id="slide-signup"
         class="slide-menu slide-menu-close"
         ng-include="'sidemenu/signup.php'"
         ng-controller="SignUpController"></div>

<div id="slide-terms"
         class="slide-menu slide-menu-close"
         ng-include="'sidemenu/terms.php'"></div>

<div id="slide-forgot"
         class="slide-menu slide-menu-close"
         ng-include="'sidemenu/forgot.php'"></div>
<?}else{?>
<div id="slide-account"
     class="slide-menu slide-menu-close slide-account"
     ng-include="'sidemenu/account.php'"></div>

<div id="slide-transfer"
     class="slide-menu slide-menu-close slide-account slide-form"
     ng-include="'sidemenu/transfer.php'"></div>

<div id="slide-deposit"
     class="slide-menu slide-menu-close slide-account slide-form"
     ng-include="'sidemenu/deposit.php'"></div>

<div id="slide-withdraw"
     class="slide-menu slide-menu-close slide-account slide-form"
     ng-include="'sidemenu/withdraw.php'"></div>

<div id="slide-bonus"
     class="slide-menu slide-menu-close slide-account slide-form"
     ng-include="'sidemenu/bonus.php'"></div>

<div id="slide-settings" class="slide-menu slide-menu-close slide-account slide-form"
     ng-include="'sidemenu/settings.php'" ></div>
<?}?>

<!--Scripts-->
<script type="text/javascript" src="../common/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../common/js/angular.min.js"></script>
<script type="text/javascript" src="../common/js/es5-shim.js"></script>

<script type="text/javascript" src="common/js/angular-routeData.js"></script>
<script type="text/javascript" src="common/js/angular-ngDialog.min.js"></script>
<script type="text/javascript" src="common/js/jquery-bootstrap.min.js"></script>

<script type="text/javascript" src="common/js/jquery-custom.js"></script>
<script type="text/javascript" src="common/js/angular-messages.js"></script>
<script type="text/javascript" src="common/js/angular-touch.js"></script>

<script type="text/javascript" src="common/js/angular-mobile.js"></script>
<script type="text/javascript" src="../common/js/angular-custom-module.js"></script>
<script type="text/javascript" src="common/js/angular-mobile-signup.js"></script>
<script type="text/javascript" src="common/js/angular-mobile-account.js"></script>
<script type="text/javascript" src="common/js/angular-mobile-wallet.js"></script>
<script type="text/javascript" src="common/js/angular-mobile-slots.js"></script>
<script type="text/javascript" src="common/js/angular-mobile-casino.js"></script>
<script type="text/javascript" src="common/js/angular-mobile-sports.js"></script>

<script type="text/javascript" src="../common/js/jquery-bPopup.min.js"></script>
<script type="text/javascript" src="../common/js/jquery-easing.min.js"></script>
<script type="text/javascript" src="../common/js/jquery-intlTelInput.js"></script>
<script type="text/javascript" src="../common/js/jquery-datetimepicker.js"></script>
<script type="text/javascript" src="../common/js/angular-route.min.js"></script>

<![if !IE 8]>
<script type="text/javascript" src="../common/js/jquery-sweet-alert.min.js"></script>
<![endif]>
<!--<script type="text/javascript" src="../common/js/utill.js"></script>-->
<script type="text/javascript" src="../common/js/jquery-moment.min.js"></script>
<script type="text/javascript" src="../common/js/jquery-moment-timezone.min.js"></script>
<script type="text/javascript" src="../common/js/jstz-1.0.4.min.js"></script>
<script type="text/javascript" src="../common/js/jquery-easy-ticker.js"></script>
<script type="text/javascript" src="../common/js/jquery-browser.min.js"></script>
<script type="text/javascript" src="../common/js/angular-cookies.min.js"></script>
<script type="text/javascript" src="../common/js/angular-translate.min.js"></script>
<script type="text/javascript" src="../common/js/angular-translate-storage-cookie.js"></script>
<script type="text/javascript" src="../common/js/angular-translate-storage-local.js"></script>
<script type="text/javascript" src="../common/js/angular-translate-loader-static-files.js"></script>

<script type="text/javascript" src="../common/js/angular-module-currencyCode.min.js"></script>
<script type="text/javascript" src="../common/js/angular-validation.js"></script>
<script type="text/javascript" src="../common/js/angular-validation-rule.js"></script>
<!--<script src="http://192.168.0.120:8080/target/target-script-min.js#anonymous"></script>-->
</body>
</html>