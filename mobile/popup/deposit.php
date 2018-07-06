<?session_start()?>
<div id="popup-deposit" class="popup" ng-controller="DepositDialogController">
    <div class="slide-menu-header">
        <span ng-bind="'Deposit' | translate"></span>
        <div class="clear"></div>
    </div>
    <div class="ngDialog" ng-init="loadGsp()">
        <div class="notes-info marginBottom">
            <p>
                <span ng-bind="'Not enough' | translate"></span> <strong ng-bind="'Main Wallet' | translate"></strong> <span ng-bind="'Balance' | translate"></span>.<br />
                <span ng-bind="'Available after deposit' | translate"></span>.
            </p>
        </div>
        <div class="popup-promo-snippet">
            <div class="marginBottom" ng-click="closeThisDialog()" onclick="location.href='#promo'">
                <div class="promo-img"><img src="common/images/promo1.png" /></div>
                <div class="promo-item-desc">
                    <h2 class="promo-title"><strong>20%</strong> <strong ng-bind="'New Member' | translate"></strong> <strong ng-bind="' Welcome' | translate"></strong> <strong ng-bind="' Bonus' | translate"></strong></h2>
                    <p class="promo-desc"><span ng-bind="'Earn up to THB 5000 on your first deposit after sign up' | translate"></span></p>
                </div>
            </div>

            <div class="clearfix"></div>

            <button class="btn btn-form marginBottom" ng-click="openDepositDialog()" ng-bind="'Deposit' | translate"></button>
            <button class="btn btn-form btn-gray" ng-click="closeThisDialog(0);" ng-bind="'Explore' | translate"></button>
            <!--<img src="common/images/promo-banner1.png" />
            <div class="promo-item-desc">
                <h2 class="promo-title"><span>New Member First Deposit Bonus</span> <strong>20%</strong></h2>
                <p class="promo-desc marginBottom">Get 100% Welcome Bonus up to USD 200 in all Slots Games.
                    Start winning Now! More than Hundred Slots Games & win the Jackpot.</p>
            </div>-->
        </div>
    </div>
</div>
<div class="ngdialog-close-btn" ng-click="closeThisDialog()"></div>