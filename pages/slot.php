
<?include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/detect_mobile.php";
$mobile_detect = new Mobile_Detect;
if($mobile_detect->isMobile() || $mobile_detect->isTablet()){?>
<div class="container" ng-controller="SlotController" ng-init="loadSlot(gspNo,'Mobile',false)">
<?}else{?>
<div class="container" ng-controller="SlotController" ng-init="loadSlot(gspNo)">
<?}?>
    <div class="margin-top" ng-controller="TabController as tab">
        <h1 class="pageTitleImage titleSlot">
            <strong ng-bind="'Slot Games' | translate"></strong>
            <span ng-bind="'Experience a variety of slot games to play and win' | translate"></span><span>!</span>
        </h1>
        <div id="slot-game-buttons-{{getAgentProductSlotList.length}}" class="slot-game-buttons container-box box-main box-default margin-bottom">
            <?if($mobile_detect->isMobile() || $mobile_detect->isTablet()){?>
                <div ng-repeat="slotGame in getAgentProductSlotList" class="slot-game-button slot-game-button-{{slotGame.gspNo}}" ng-click="loadSlot(slotGame.gspNo,'Mobile')" ng-class="{active: $first}">
                    <h3 ng-bind="slotGame.gspName | translate"></h3>
                    <button class="btn btn-play" ng-bind="'Play Now' | translate"></button>
                    <div class="slot-game-button-overlay"></div>
                </div>
            <?}else{?>
                <div ng-repeat="slotGame in getAgentProductSlotList" class="slot-game-button slot-game-button-{{slotGame.gspNo}}" ng-click="loadSlot(slotGame.gspNo)" ng-class="{active: $first}">
                    <h3 ng-bind="slotGame.gspName | translate"></h3>
                    <button class="btn btn-play" ng-bind="'Play Now' | translate"></button>
                    <div class="slot-game-button-overlay"></div>
                </div>
            <?}?>
            <div class="clear"></div>
        </div>
    <div>
        <div class="slot-container container box-default margin-bottom">
            <?if($mobile_detect->isMobile() || $mobile_detect->isTablet()){?>
                <ul ng-show="gspNo==102">
                    <li ng-bind="'Mobile' | translate" ng-click="loadSlot(gspNo,'Mobile',false)" class="slot-102-first"></li>
                </ul>
                <ul ng-show="gspNo==901">
                    <li ng-bind="'Mobile' | translate" ng-click="loadSlot(gspNo,'Mobile',false)" class="slot-102-first"></li>
                </ul>
                <ul ng-show="gspNo==902">
                    <li ng-bind="'Mobile' | translate" ng-click="loadSlot(gspNo,'Mobile',false)" class="slot-102-first"></li>
                </ul>
                <ul ng-show="gspNo==104">
                    <li ng-bind="'Mobile' | translate" ng-click="loadSlot(gspNo,'Mobile',false)" class="slot-102-first"></li>
                </ul>
                <ul ng-show="gspNo==112">
                    <li ng-bind="'Mobile' | translate" ng-click="loadSlot(gspNo,'Mobile',false)" class="slot-112-first"></li>
                </ul>
                <ul ng-show="gspNo==109">
                    <li ng-bind="'Mobile' | translate" ng-click="loadSlot(gspNo,'Mobile',false)" class="slot-102-first"></li>
                </ul>
            <?}else{?>
            <ul ng-show="gspNo==102">
                <li ng-bind="'3D Slots' | translate" ng-click="loadSlot(gspNo,'Slots_3d',false)" class="slot-102-first"></li>
            </ul>
            <ul ng-show="gspNo==901">
                <li ng-bind="'Slots' | translate" ng-click="loadSlot(gspNo,'Slots',false)" class="slot-901-first"></li>
                <li ng-bind="'Soft Games' | translate" ng-click="loadSlot(gspNo,'Soft_Games',false)"></li>
                <li ng-bind="'Table Games' | translate" ng-click="loadSlot(gspNo,'Table_Games',false)"></li>
                <li ng-bind="'Multihand Poker' | translate" ng-click="loadSlot(gspNo,'Multihand_Poker',false)"></li>
                <li ng-bind="'Pyramid Poker' | translate" ng-click="loadSlot(gspNo,'Pyramid_Poker',false)"></li>
                <li ng-bind="'Video Poker' | translate" ng-click="loadSlot(gspNo,'Video_Poker',false)"></li>
                <li ng-bind="'Keno' | translate" ng-click="loadSlot(gspNo,'Keno',false)"></li>
            </ul>
            <ul ng-show="gspNo==902">
                <li ng-bind="'Arcades' | translate" ng-click="loadSlot(gspNo,'Arcades',false)" class="slot-902-first"></li>
                <li ng-bind="'Slots' | translate" ng-click="loadSlot(gspNo,'Slots',false)"></li>
                <li ng-bind="'Card Games' | translate" ng-click="loadSlot(gspNo,'Card_Games',false)"></li>
                <li ng-bind="'Table Games' | translate" ng-click="loadSlot(gspNo,'Table_Games',false)"></li>
                <li ng-bind="'Video Poker' | translate" ng-click="loadSlot(gspNo,'Video_Poker',false)"></li>
            </ul>
            <ul ng-show="gspNo==104">
                <li ng-bind="'Advanced Slot' | translate" ng-click="loadSlot(gspNo,'Advanced_Slot',false)" class="slot-104-first"></li>
                <li ng-bind="'Bonus Slot' | translate" ng-click="loadSlot(gspNo,'Bonus_Slot',false)"></li>
                <li ng-bind="'Feature Slot' | translate" ng-click="loadSlot(gspNo,'Feature_Slot',false)"></li>
                <li ng-bind="'Slot' | translate" ng-click="loadSlot(gspNo,'Slots',false)"></li>
                <li ng-bind="'Classic Slot' | translate" ng-click="loadSlot(gspNo,'Classic_Slot',false)"></li>
                <li ng-bind="'Table Games' | translate" ng-click="loadSlot(gspNo,'Table_Games',false)"></li>
                <li ng-bind="'Table Gold' | translate" ng-click="loadSlot(gspNo,'Table_Gold',false)"></li>
                <li ng-bind="'Table Premier' | translate" ng-click="loadSlot(gspNo,'Table_Premier',false)"></li>
                <li ng-bind="'Multi Hand Gold Series' | translate" ng-click="loadSlot(gspNo,'Multi_Hand_Gold_Series',false)"></li>
                <li ng-bind="'4 Play Power Poker' | translate" ng-click="loadSlot(gspNo,'4_Play_Power_Poker',false)"></li>
                <li ng-bind="'Video Poker' | translate" ng-click="loadSlot(gspNo,'Video_Poker',false)"></li>
                <li ng-bind="'Parlor' | translate" ng-click="loadSlot(gspNo,'Parlor',false)"></li>
                <li ng-bind="'Scratch Card' | translate" ng-click="loadSlot(gspNo,'Scratch_Card',false)"></li>
                <li ng-bind="'Casual Game' | translate" ng-click="loadSlot(gspNo,'Casual_Game',false)"></li>
            </ul>
            <ul ng-show="gspNo==112">
                <li ng-bind="'Slots' | translate" ng-click="loadSlot(gspNo,'Slots',false)" class="slot-112-first"></li>
            </ul>
            <ul ng-show="gspNo==106">
                <li ng-bind="'Slots' | translate" ng-click="loadSlot(gspNo,'Slots',false)" class="slot-106-first"></li>
            </ul>
            <ul ng-show="gspNo==109">
                <li ng-bind="'Video Slots' | translate" ng-click="loadSlot(gspNo,'Video_Slots',false)" class="slot-109-first"></li>
                <li ng-bind="'Classic Slots' | translate" ng-click="loadSlot(gspNo,'Classic_Slots',false)"></li>
                <li ng-bind="'Table Games' | translate" ng-click="loadSlot(gspNo,'Table_Games',false)"></li>
                <li ng-bind="'Card Games' | translate" ng-click="loadSlot(gspNo,'Card_Games',false)"></li>
            </ul>
            <?}?>
            <div class="slot-wrapper">
                <div class="slot-items">
                    <div class="slot-box" ng-repeat="slotItem in slotItems">
                        <div class="slot-box-hover">
                            <button type="button" class="btn-slot-play" ng-click="playGame(gspNo,20,slotItem.gameId,false)" ng-bind="'Play Now' | translate"></button>
                            <button type="button" class="btn-slot-demo" ng-click="playGame(gspNo,20,slotItem.gameId,true)" ng-bind="'Demo' | translate"></button>
                        </div>
                        <div class="slot-item slot-{{gspNo}}" style="background:url('http://slot.gbit.s3-ap-northeast-1.amazonaws.com/{{gspNo}}/{{slotItem.gameId}}.png') 0 0 no-repeat;">
                            <p class="text-ellipsis" ng-bind="slotItem.gameName | translate"></p>
                            <!--Jackpot --- <strong>$425,233,000.00</strong>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>