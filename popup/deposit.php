<?session_start()?>
<div id="popup-deposit" ng-controller="DepositDialogController">
    <div class="popup-content">
        <h1 ng-bind="'Deposit' | translate"></h1>
        <div class="deposit-form margin-bottom" ng-init="loadGsp()">
            <div class="notes-info marginBottom">
                <p ng-bind="'Not enough' | translate"> <strong ng-bind="'Main Wallet'"></strong> <span ng-bind="'Balance' | translate"></span><br> <span ng-bind="'Available after deposit' | translate"></span></p>
            </div>

            <div class="promo-snippet">
                <img src="common/images/promo1.png" />
                <a href="#promotion" ng-click="closeThisDialog(0);">
                    <strong class="text-center">
                        20%
                        <span ng-bind="'New Member' | translate"></span>
                        <span ng-bind="'Welcome' | translate"></span>
                        <span ng-bind="'Bonus' | translate"></span><span>!</span>
                    </strong>
                </a>
                <p class="text-center">
                    <span ng-bind="'Earn up to' | translate"></span>
                    <span> THB 5000 </span>
                    <span ng-bind="'on your first deposit after sign up' | translate"></span><span>!</span>
                </p>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-transfer" ng-bind="'Deposit' | translate" ng-click="displayWallet(2)"></button>
                <button type="button" class="btn btn-drkgray" ng-click="closeThisDialog(0);" ng-bind="'Explore' | translate"></button>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>