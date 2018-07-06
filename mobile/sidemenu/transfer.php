<?session_start()?>
<div ng-controller="WalletController">
    <div ng-controller="BalanceController" ng-init="init();">
        <div class="slide-menu-header">
            <i class="backMenu" role="button" ng-click="closeTransfer()"></i>
            <span ng-bind="'Transfer' | translate"></span>
        </div>

        <div ng-controller="TransferController"  ng-init="loadGsp()">
            <form name="depositForm" novalidate ng-submit="processForm()">
                <div class="error-danger" ng-show="error.status">
                    <div ng-bind="error.message"></div>
                </div>
                <div class="form-group">
                    <!--<label>From <em>The transfer amount from Main Wallet is <strong>100,000 USD</strong></em></label>-->
                    <label><strong ng-bind="'From' | translate"></strong></label>
                    <select class="form-control input-sm marginBottom"  ng-init="gspTransfer.fromGspWallet = gspWalletList[0].gspNo" ng-model="gspTransfer.fromGspWallet" ng-options="gspWallet.gspNo as gspWallet.gspName for gspWallet in gspWalletList">
                        <option ng-bind="'Please Select Wallet' | translate"></option>
                    </select>
                    <div class="notes marginBottom">
                        <p><span ng-bind="'The transfer amount is from Main Wallet is' | translate"></span> <strong ng-bind="mainBalance.amount | customCurrency:cc_currency_symbol[mainBalance.currencyIsoCd]"></strong></p>
                    </div>
                </div>
                <div class="form-group">
                    <label><strong ng-bind="'Transfer Amount' | translate"></strong></label>
                    <span class="signCurrency" ng-controller="BalanceController" ng-bind="cc_currency_symbol[mainBalance.currencyIsoCd]"></span>
                    <input type="text" format="number" class="clearable form-control input-sm" maxlength="12" placeholder="0"  ng-model="gspTransfer.amount"  value="{{gspTransfer.amount | number}}"/>
                    <button type="button" class="btn btn-blue btn-option ng-binding ng-scope deleteText" ng-click="resetAmount()"></button>
                    <div class="btn-amounts">
                        <em add-amount-list="addAmount<?=$_SESSION["currencyIsoCd"]?>"></em>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label><strong ng-bind="'To' | translate"></strong></label>
                    <select  class="form-control input-sm" ng-model="gspTransfer.toGspWallet" ng-options="gspWallet.gspNo as gspWallet.gspName for gspWallet in filteredGspWalletList">
                        <option ng-bind="'Please Select Wallet' | translate"></option>
                    </select>
                </div>
                <button type="submit" class="btn btn-form" ng-disabled="isProcessing" ng-bind="'Transfer' | translate"></button>
            </form>
        </div>
    </div>
</div>