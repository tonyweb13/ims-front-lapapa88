<?session_start()?>
<div id="popup-transfer" class="popup" ng-controller="TransferController">
    <div class="slide-menu-header" ng-init="loadGsp()">
        <span ng-bind="'Transfer' | translate"></span>
        <div class="clear"></div>
    </div>
    <div class="ngDialog">
        <div class="notes-info marginBottom" ng-repeat="gspBalance in gspBalanceList | filter:{GspNo:gspNo}">
            <p><span ng-bind="'Not enough' | translate"></span> <strong ng-bind="gspBalance.GspName"></strong> <span ng-bind="'Balance' | translate"></span><br /> <span ng-bind="'Available after transfer' | translate"></span></p>
        </div>

            <form name="depositForm" novalidate ng-submit="processForm()">
                <div class="error-danger" ng-show="error.status">
                    <div ng-bind="error.message"></div>
                </div>
                <div class="form-group">
                    <label ng-bind="'From' | translate"></label>
                    <select class="form-control input-sm"  ng-init="gspTransfer.fromGspWallet = gspWalletList[0].gspNo" ng-model="gspTransfer.fromGspWallet" ng-options="gspWallet.gspNo as gspWallet.gspName for gspWallet in gspWalletList">
                        <option ng-bind="'Please Select Wallet' | translate"></option>
                    </select>
                    <div class="notes" style="margin-top: -1px;">
                        <p><label ng-bind="'The transfer amount is from Main Wallet is' | translate"></label> <strong ng-bind="mainBalance.amount | customCurrency:cc_currency_symbol[mainBalance.currencyIsoCd]"></strong></p>
                    </div>
                </div>
                <div class="form-group">
                    <label ng-bind="'Transfer Amount' | translate"></label>
                    <span class="signCurrency" ng-bind="cc_currency_symbol[mainBalance.currencyIsoCd]"></span>
                    <input type="text" format="number" class="clearable form-control input-sm" maxlength="12" placeholder="0" pattern="\d*"  ng-model="gspTransfer.amount"  value="{{gspTransfer.amount | number}}"/>
                    <button type="button" class="btn btn-blue btn-option ng-binding ng-scope deleteText" ng-click="resetAmount()" style="margin-top: -6px;"></button>

                    <div class="btn-amounts" ng-controller="WalletController">
                        <em add-amount-list="addAmount<?=$_SESSION["currencyIsoCd"]?>"></em>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label ng-bind="'To' | translate"></label>
                    <select  class="form-control input-sm" ng-init="gspTransfer.toGspWallet = gspNo" ng-model="gspTransfer.toGspWallet" ng-options="gspWallet.gspNo as gspWallet.gspName for gspWallet in filteredGspWalletList">
                        <option ng-bind="'Please Select Wallet' | translate"></option>
                    </select>
                </div>
                <button type="submit" class="btn btn-form marginBottom" ng-disabled="isProcessing" ng-bind="'Transfer' | translate"></button>
                <button type="submit" class="btn btn-form btn-gray" ng-click="closeThisDialog();" ng-bind="'Explore' | translate"></button>
            </form>
    </div>
</div>
<div class="ngdialog-close-btn" ng-click="closeThisDialog()"></div>