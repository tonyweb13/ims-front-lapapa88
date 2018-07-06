<div class="gamebutton-container poker-buttons">
    <div class="gamebutton-wrapper">
        <div class="gamebuttons">
            <div ng-include="'pages/promoSnippet.php'"></div>

            <?if($_SERVER["HTTP_HOST"] != "demo.frontend88.com"){?>
                <div class="gamebutton gamebutton1" ng-click="commingSoon()">
            <?}else{?>
                <div class="gamebutton gamebutton1" ng-click="playGame('',40)">
            <?}?>
                <div class="gamebutton-content">
                    <h2 ng-bind="'Cash Games' | translate"></h2>
                    <p ng-bind="'Unforgettable experience with the best live casino games online' | translate"></p>
                    <button type="button" ng-bind="'Play Now' | translate"></button>
                </div>
            </div>

             <?if($_SERVER["HTTP_HOST"] != "demo.frontend88.com"){?>
                   <div class="gamebutton gamebutton2" ng-click="commingSoon()">
             <?}else{?>
                    <div class="gamebutton gamebutton2" ng-click="playGame('',40)">
             <?}?>
                <div class="gamebutton-content">
                    <h2 ng-bind="'Tournaments' | translate"></h2>
                    <p ng-bind="'Unforgettable experience with the best live casino games online' | translate"></p>
                    <button type="button" ng-bind="'Play Now' | translate"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>