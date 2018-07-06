<?session_start()?>
<div class="slot-container" ng-controller="SlotContentController" ng-init="loadSlot(slotGspNo,'Mobile',false)" >
    <div id="nav-slot" data-spy="affix" data-offset-top="42" >
        <ul class="nav-slot-list">
            <li class="nav-slot-tab"
                ng-repeat="slotGame in getAgentProductSlotList"
                ng-click="loadSlot({{slotGame.gspNo}})"
                ng-class="{ active: $index == tabIndex }"
                ng-bind="slotGame.gspName | translate">
            </li>
        </ul>
    </div>
    <div class="clearfix"></div>

    <div class="wrapper">
        <ul class="responsive-thumbnails" data-max-width="100" data-padding="6" data-max-height="120" >
            <li ng-repeat="slotItem in slotItems" >
                <div ng-click="playGame(gspNo,20,slotItem.gameId,false)" class="slot-item slot-{{gspNo}}" style="background:url('http://slot.gbit.s3-ap-northeast-1.amazonaws.com/{{gspNo}}/{{slotItem.gameId}}.png') 0 59% no-repeat #2c2c2c; background-size:100%; cursor:pointer;">
                    <span class="slot-title" ng-bind="slotItem.gameName | translate" ></span>
                </div>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="clearfix"></div>
</div>

<script type="text/javascript" src="common/js/jquery-responsive-thumbnails.js"></script>