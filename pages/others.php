<?include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/setCasinoName.php";?>
<div class="container" ng-controller="SportsController">
    <div class="margin-top" >
        <h1 class="pageTitleImage titleSports">
            <strong ng-bind="'Other Games' | translate"></strong>
            <span ng-bind="'We offer other exciting games only here in' | translate"></span> <span><?=$casinoName?>!</span>
        </h1>
        <div id="other-game-buttons-{{getAgentProductOtherList.length}}" class="other-game-buttons container-box box-main box-default margin-bottom">
            <div ng-repeat="otherGame in getAgentProductOtherList" class="other-game-button other-game-button-{{otherGame.gspNo}}" ng-click="getSportsURL(otherGame.gspNo)" ng-disabled="isProcessing">
                <h3 ng-bind="otherGame.gspName | translate"></h3>
                <button class="btn btn-play hvr-push" ng-bind="'Play Now' | translate"></button>
                <div class="other-game-button-overlay"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="sports-iframe">
            <iframe ng-show="isETC" ng-src="{{sportURL}}" width="1024px" height="768px"></iframe>
        </div>
        <div ng-show="isSafari" ng-include="'pages/sportsSafariDisable'"></div>
    </div>
</div>
