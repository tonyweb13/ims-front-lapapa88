<?session_start()?>
<?include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/setCasinoName.php";?>
<div class="slide-menu-header">
    <i class="closeMenu" role="button" ng-click="closeAccount()"></i>
    <span ng-bind="'Account' | translate"></span>
</div>

<div class="slide-bar">
    <h4><i class="icon-user"></i> <?=$_SESSION['nickname']?></h4>
    <button class="btn-refresh" ng-controller="BalanceController" ng-click="reloadBalance()" ng-disabled="isProcessing"><i class="icon-refresh"></i> <span ng-bind="'Refresh' | translate"></span></button>
    <div class="clearfix"></div>
</div>

<div class="slide-wallet-items">
    <div class="wallet-item-box" ng-controller="BalanceController" ng-init="init();">
        <strong ng-bind="'Main Wallet' | translate"></strong>
        <h2 ng-bind="mainBalance.amount | customCurrency:cc_currency_symbol[mainBalance.currencyIsoCd]"></h2>
        <div class="clearfix"></div>
    </div>
    <div class="wallet-item-box"  ng-repeat="gspBalance in gspBalanceList | filter:{GspNo:gspNo}">
        <strong ng-bind="gspBalance.GspName"></strong>
        <h2 ng-bind="gspBalance.currencyAmount.amount | customCurrency:cc_currency_symbol[gspBalance.currencyAmount.currencyIsoCd]"></h2>
        <div class="clearfix"></div>
    </div>
    <div class="wallet-item-box">
        <strong ng-bind="'Total' | translate"></strong>
        <h2 ng-bind="totalBalance.amount | customCurrency:cc_currency_symbol[totalBalance.currencyIsoCd]"></h2>
        <div class="clearfix"></div>
    </div>
</div>

<!--<div class="slide-bar">
    <h5>Payment & Account</h5>
</div>-->

<div class="slide-wallet-cat">
    <div class="wallet-cat-item cat-deposit" role="button" ng-click="openDeposit()">
        <i class="icon-deposit"></i>
        <strong ng-bind="'Deposit' | translate"></strong>
    </div>
    <div class="wallet-cat-item cat-withdraw" role="button" ng-click="openWithdraw()">
        <i class="icon-withdraw"></i>
        <strong ng-bind="'Withdraw' | translate"></strong>
    </div>
    <div class="wallet-cat-item cat-transfer" role="button" ng-click="openTransfer()">
        <i class="icon-transfer"></i>
        <strong ng-bind="'Transfer' | translate"></strong>
    </div>
    <div class="wallet-cat-item cat-bonus" role="button" ng-click="openBonus()">
        <i class="icon-bonus"></i>
        <strong ng-bind="'Bonus' | translate"></strong>
    </div>
    <div class="wallet-cat-item cat-account" role="button" ng-click="openSettings()">
        <i class="icon-account"></i>
        <strong ng-bind="'Account' | translate"></strong>
    </div>
    <div ng-controller="LogoutController" ng-click="logout()" class="wallet-cat-item cat-logout" role="button">
        <i class="icon-logout"></i>
        <strong ng-disabled="isProcessing" ng-bind="'Logout' | translate"></strong>
    </div>
</div>

<div class="footer">
    <span>&copy; 2015 <?=$casinoName?>. <span ng-bind="'All Rights Reserved' | translate"></span>.</span>
    <a href="/mobile/pages/view.php?view=desktop" target="_self" ng-bind="'View Desktop Version' | translate"></a>
</div>