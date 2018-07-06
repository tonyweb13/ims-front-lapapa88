<div class="container" ng-controller="SportsController" ng-init="getSportsURL(208)">
    <div class="margin-top" >
        <h1 class="pageTitleImage titleSports">
            <strong ng-bind="'Sportsbook' | translate"></strong>
            <span ng-bind="'Meet variety of leagues in the world here in one place' | translate"></span><span>!</span>
        </h1>
        <div id="sports-game-buttons-{{getAgentProductSportsGameList.length}}" class="sports-game-buttons container-box box-main box-default margin-bottom">
            <div ng-repeat="sportsGame in getAgentProductSportsGameList" class="sports-game-button sports-game-button-{{sportsGame.gspNo}}" ng-click="getSportsURL(sportsGame.gspNo)" ng-disabled="isProcessing">
                <h3 ng-bind="sportsGame.gspName | translate"></h3>
                <button class="btn btn-play hvr-push" ng-bind="'Play Now' | translate"></button>
                <div class="sports-game-button-overlay"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="sports-iframe">
            <iframe ng-show="isETC" ng-src="{{sportURL}}" width="1024px" height="768px"></iframe>
            <iframe ng-show="isIBC" ng-src="{{sportIBCURL}}" width="1024px" height="768px"></iframe>
            <iframe ng-show="isWFT" name="sportFrame" class="sportFrame"  ng-src="{{sportWFTURL}}" width="1034px" height="768px"></iframe>
        </div>
        <div ng-show="isSafari" ng-include="'pages/sportsSafariDisable'"></div>
    </div>
</div>
