<?session_start()?>
<div id="popup-transfer" ng-controller="TransferController">
    <div class="popup-content" ng-init="loadGsp()">
        <h1 ng-bind="'Transfer' | translate"></h1>

        <div class="transfer-form margin-bottom" ng-controller="TransferController"  ng-repeat="gspBalance in gspBalanceList | filter:{GspNo:gspNo}">
            <div class="notes-info marginBottom" >
                <p>
                    <span ng-bind="'Not enough' | translate"></span>
                    <strong ng-bind="gspBalance.GspName"></strong>
                    <span ng-bind="'Balance' | translate"></span>.
                </p>
                <p>
                    <span ng-bind="'Your available Main Wallet balance is' | translate"></span>
                    <strong ng-bind="mainBalance.amount | customCurrency:cc_currency_symbol[mainBalance.currencyIsoCd]"></strong>.
                </p>
            </div>
            <form name="depositForm" novalidate ng-submit="processForm()">
                <div class="form-group">
                    <label ng-bind="'From' | translate"></label>
                    <select class="inputField" ng-init="gspTransfer.fromGspWallet = gspWalletList[0].gspNo" ng-model="gspTransfer.fromGspWallet" ng-options="gspWallet.gspNo as gspWallet.gspName for gspWallet in gspWalletList">
                        <option ng-bind="'Please Select Bank' | translate"></option>
                    </select>
                </div>
                <div class="btn-options">
                    <p ng-bind="'The transfer is from Main Wallet' | translate" > <strong>$ 10,000</strong>.</p>
                </div>
                <div class="form-group">
                    <label ng-bind="'Amount' | translate"></label>
                    <input type="text" ng-model="gspTransfer.amount"  value="{{gspTransfer.amount | number}}" class="txtAmount inputField" />
                </div>
                <div class="form-group">
                    <label ng-bind="'To' | translate"></label>
                    <select class="inputField" ng-init="gspTransfer.toGspWallet = gspNo" ng-model="gspTransfer.toGspWallet" ng-options="gspWallet.gspNo as gspWallet.gspName for gspWallet in filteredGspWalletList">
                        <option ng-bind="'Please Select Game' | translate"></option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-transfer" ng-disabled="isProcessing" ng-bind="'Transfer' | translate"></button>
                    <button type="button" class="btn btn-drkgray" ng-click="closeThisDialog();" ng-bind="'Explore' | translate"></button>
                </div>
            </form>
            <div class="clear"></div>
        </div>
    </div>
</div>