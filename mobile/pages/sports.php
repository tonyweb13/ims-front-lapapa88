<?session_start();?>
<div class="gamebutton-container sports-buttons" ng-controller="SportsController">
    <div class="gamebutton-wrapper">
        <div id="sports-buttons-{{getAgentProductSportsGameList.length}}" class="gamebuttons">

            <div ng-include="'pages/promoSnippet.php'"></div>

            <div ng-repeat="sportsGame in getAgentProductSportsGameList" class="gamebutton gamebutton{{$index+1}} gamebutton{{sportsGame.gspNo}}" ng-click="getSportsURL(sportsGame.gspNo)" >
                <div class="gamebutton-content sports-game-button-{{sportsGame.gspNo}}">
                    <h2 ng-bind="sportsGame.gspName | translate"></h2>
                    <p ng-if="sportsGame.gspNo == 208" ng-bind="'Well known Asian view Sports Betting available here' | translate"></p>
                    <p ng-if="sportsGame.gspNo == 209"><span ng-bind="'Over' | translate"></span> 18,500 <span ng-bind="'Live Matches' | translate"></span> <span ng-bind="'with' | translate"></span> Malay/HK <span ng-bind="'Odds' | translate"></span></p>
                    <p ng-if="sportsGame.gspNo == 203" ng-bind="'Best odds guaranteed for every sport events' | translate"></p>
                    <p ng-if="sportsGame.gspNo == 202" ng-bind="'Offers Variety of Sporting Events' | translate"></p>
                    <p ng-if="sportsGame.gspNo == 201" ng-bind="'Check out Sports Betting here' | translate"></p>
                    <button type="button" ng-click="getSportsURL(sportsGame.gspNo)" ng-bind="'Play Now' | translate"></button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

