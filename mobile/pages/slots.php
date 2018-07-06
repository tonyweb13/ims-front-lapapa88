<?session_start()?>
<div class="gamebutton-container slot-buttons" ng-controller="SlotController">
    <div class="gamebutton-wrapper">
        <div id="slots-buttons-{{getAgentProductSlotList.length}}" class="gamebuttons">

            <div ng-include="'pages/promoSnippet.php'"></div>

    <!--        <div ng-repeat="slotGame in getAgentProductSlotList" class="gamebutton gamebutton{{slotGame.gspNo}}" onclick="location.href='#slotsContent'" ng-init="setTab(selectWalletTab);" >-->
            <div ng-repeat="slotGame in getAgentProductSlotList" class="gamebutton gamebutton{{slotGame.gspNo}}" ng-click="slotContent({{$index}}, {{slotGame.gspNo}});">
                <div class="gamebutton-content">
                    <h2 ng-bind="slotGame.gspName | translate"></h2>
                    <!--<strong>$ 1,408,231.89</strong>-->
                    <button type="button" ng-bind="'Play Now' | translate"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>