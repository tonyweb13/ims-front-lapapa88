<?include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/client.php";
$mobile_detect = new Mobile_Detect;?>
<div class="gamebutton-container livecasino-buttons" ng-controller="CasinoController" ng-init="init()">
    <div class="gamebutton-wrapper">
        <div id="livecasino-buttons-3" class="gamebuttons">

            <div ng-include="'pages/promoSnippet.php'"></div>
            <?if($mobile_detect->isiOS()){?>
                <?if(isset($_SESSION['accessToken'])){?>
                    <div class="gamebutton gamebutton1"  ng-click="playGame(112,10)">
                        <div class="gamebutton-content">
                            <h2 ng-bind="'UC8' | translate"></h2>
                            <p ng-bind="'Unforgettable experience with the best live casino games online' | translate"></p>
                            <button type="button" ng-bind="'Play Game' | translate"></button>
                        </div>
                    </div>
                    <div class="gamebutton gamebutton2" ng-click="playGame(204,10)">
                        <div class="gamebutton-content">
                            <h2 ng-bind="'Asia Gaming' | translate"></h2>
                            <p ng-bind="'Unforgettable experience with the best live casino games online' | translate"></p>
                            <button type="button" ng-bind="'Install IOS App' | translate"></button>
                        </div>
                    </div>
                <?}else{?>
                    <div class="gamebutton gamebutton1"  ng-click="needLogin()">
                        <div class="gamebutton-content">
                            <h2 ng-bind="'UC8' | translate"></h2>
                            <p ng-bind="'Unforgettable experience with the best live casino games online' | translate"></p>
                            <button type="button" ng-bind="'Play Game' | translate"></button>
                        </div>
                    </div>
                    <div class="gamebutton gamebutton2" ng-click="needLogin()">
                        <div class="gamebutton-content">
                            <h2 ng-bind="'Asia Gaming' | translate"></h2>
                            <p ng-bind="'Unforgettable experience with the best live casino games online' | translate"></p>
                            <button type="button" ng-bind="'Install IOS App' | translate"></button>
                        </div>
                    </div>
                <?}?>
            <?}else{?>
                <?if(isset($_SESSION['accessToken'])){?>
                    <div class="gamebutton gamebutton1" ng-click="playGame(112,10)">
                        <div class="gamebutton-content">
                            <h2 ng-bind="'UC8' | translate"></h2>
                            <p ng-bind="'Unforgettable experience with the best live casino games online' | translate"></p>
                            <button type="button" ng-bind="'Play Game' | translate"></button>
                        </div>
                    </div>
                    <div class="gamebutton gamebutton2" ng-click="playGame(204,10)">
                        <div class="gamebutton-content">
                            <h2 ng-bind="'Asia Gaming' | translate"></h2>
                            <p ng-bind="'Get the best online casino platform for Baccarat' | translate"></p>
                            <button type="button" ng-bind="'Play Now' | translate"></button>
                        </div>
                    </div>
                    <a ng-href="http://mobile-resigner.valueactive.eu/launch88livedealer/apk?btag1=<?=$_SESSION['currencyBTag']?>&btag2=<?=$_SESSION['agentBTag']?>">
                        <div class="gamebutton gamebutton3" >
                            <div class="gamebutton-content">
                                <h2 ng-bind="'Microgaming' | translate"></h2>
                                <p ng-bind="'Get the best online casino platform for Baccarat' | translate"></p>
                                <button type="button" ng-bind="'Play Now' | translate"></button>
                            </div>
                        </div>
                    </a>
                    <a ng-href="http://slot.gbit.s3.amazonaws.com/apk_gp/app-weipoker<?=str_pad($_SESSION['agentBTag'], 3, '0', STR_PAD_LEFT)?>-release-1.4.5.apk">
                        <div class="gamebutton gamebutton4" >
                            <div class="gamebutton-content">
                                <h2 ng-bind="'Gameplay' | translate"></h2>
                                <p ng-bind="'Get the best online casino platform for Baccarat' | translate"></p>
                                <button type="button" ng-bind="'Play Now' | translate"></button>
                            </div>
                        </div>
                    </a>
                <?}else{?>
                    <div class="gamebutton gamebutton1" ng-click="needLogin()">
                        <div class="gamebutton-content">
                            <h2 ng-bind="'UC8' | translate"></h2>
                            <p ng-bind="'Unforgettable experience with the best live casino games online' | translate"></p>
                            <button type="button" ng-bind="'Play Game' | translate"></button>
                        </div>
                    </div>
                    <div class="gamebutton gamebutton2" ng-click="needLogin()">
                        <div class="gamebutton-content">
                            <h2 ng-bind="'Asia Gaming' | translate"></h2>
                            <p ng-bind="'Get the best online casino platform for Baccarat' | translate"></p>
                            <button type="button" ng-bind="'Play Now' | translate"></button>
                        </div>
                    </div>
                    <div class="gamebutton gamebutton3" ng-click="needLogin()">
                        <div class="gamebutton-content">
                            <h2 ng-bind="'Microgaming' | translate"></h2>
                            <p ng-bind="'Get the best online casino platform for Baccarat' | translate"></p>
                            <button type="button" ng-bind="'Play Now' | translate"></button>
                        </div>
                    </div>
                    <div class="gamebutton gamebutton4" ng-click="needLogin()">
                        <div class="gamebutton-content">
                            <h2 ng-bind="'Gameplay' | translate"></h2>
                            <p ng-bind="'Get the best online casino platform for Baccarat' | translate"></p>
                            <button type="button" ng-bind="'Play Now' | translate"></button>
                        </div>
                    </div>
                <?}?>
            <?}?>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>