<div class="gamebutton-container poker-buttons">
    <div class="gamebutton-wrapper">
        <div class="gamebuttons">

            <div ng-include="'pages/promoSnippet.php'"></div>

            <div class="gamebutton gamebutton1" onclick="location.href='itms-services://?action=download-manifest&url=https://www.agapp.net/aggaming_ios.plist'">
                <div class="gamebutton-content">
                    <h2 ng-bind="'Cash Games' | translate"></h2>
                    <p ng-bind="'Unforgettable experience with the best live casino games online' | translate"></p>
                    <button type="button" ng-bind="'Play Now' | translate"></button>
                </div>
            </div>
            <div class="gamebutton gamebutton2" onclick="alert('Gold Deluxe');">
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