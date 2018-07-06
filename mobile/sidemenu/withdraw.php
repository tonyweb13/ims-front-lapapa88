<?session_start()?>
<div ng-controller="WalletController">
    <div class="slide-menu-header">
        <i class="backMenu" role="button" ng-click="closeWithdraw()"></i>
        <span ng-bind="'Withdraw' | translate"></span>
    </div>

    <div ng-controller="WithdrawalController">
        <form name="withdrawalForm" novalidate ng-submit="processForm()">
            <div class="notes marginBottom">
                <p ng-controller="BalanceController" ng-init="init();" ng-bind="'Please transfer first your game funds to main wallet Your available MainWallet balance in' | translate"><strong ng-bind="mainBalance.amount | customCurrency:cc_currency_symbol[mainBalance.currencyIsoCd]"></strong></p>
            </div>
            <div class="error-danger" ng-show="error.status">
                <div ng-bind="error.message"></div>
            </div>
            <div class="form-group">
                <label><strong ng-bind="'Withdraw Amount' | translate"></strong> <em>*</em></label>
                <span class="signCurrency" ng-controller="BalanceController" ng-bind="cc_currency_symbol[mainBalance.currencyIsoCd]"></span>
                <input type="text" maxlength="12" placeholder="0"  class="clearable form-control input-sm" ng-model="withdrawal.amount" format="numberDecimal" value="{{withdrawal.amount | number}}" valid-method="blur" required />
                <button type="button" class="btn btn-blue btn-option ng-binding ng-scope deleteText" ng-click="resetAmount()"></button>
                <div class="btn-amounts">
                    <em add-amount-list="addAmount<?=$_SESSION["currencyIsoCd"]?>"></em>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="form-group">
                <label><strong ng-bind="'Bank' | translate"></strong> <em>*</em></label>
                    <select ng-model="withdrawal.bankNo"  class="form-control input-sm marginBottom" valid-method="blur" ng-options="agentBank.bankNo as agentBank.bankName  for agentBank in getAgentBankList" required>
                        <option value="" selected="selected" ng-bind="'Please Select Bank' | translate"></option>
                    </select>
                    <input type="number" class="form-control input-sm" ng-pattern="/^\d{2,4}[0-9\-]*\d{2,4}$/" placeholder="{{ 'Account Number' | translate}}" ng-model="withdrawal.bankAccountNo"  valid-method="blur" required />
                <div class="clear"></div>
            </div>
            <div class="form-group">
                <label><strong ng-bind="'Account Holder' | translate"></strong> <em>*</em></label>
                <input type="text"  class="form-control input-sm" placeholder="{{ 'Bank Account Holder Name' | translate}}" ng-model="withdrawal.bankHolder" valid-method="blur" required />
            </div>
            <div class="form-group">
                <label><strong ng-bind="'Account Information' | translate"></strong></label>
                <input type="text" class="form-control input-sm marginBottom" placeholder="{{ 'Bank Account Type' | translate}}" ng-cloak ng-model="withdrawal.bankAccountType"  />
                <input id="inputWithdrawBankPlace" type="text" class="form-control input-sm marginBottom" placeholder="{{ 'Bank Place' | translate}}" ng-cloak ng-model="withdrawal.bankPlace" />
                <input id="inputWithdrawBankOffice" type="text" class="form-control input-sm" placeholder="{{ 'Bank Office' | translate}}" ng-cloak ng-model="withdrawal.bankOffice"/>
            </div>
            <div class="form-group">
                <label><strong ng-bind="'Contact Number' | translate"></strong> <em>*</em></label>
                <input type="tel" class="form-control input-sm txt_phoneNo"
                       id="withdrawalPhone"
                       name="phone"
                       international-phone-number
                       only-countries={{playerDetail.countryCd}}
                       default-country={{playerDetail.countryCd}}
                       ng-model="withdrawal.phone"
                    />
            </div>
            <div class="form-group">
                <label ng-bind="'Comment' | translate"></label>
                <textarea rows="2" cols="20" maxlength="300" ng-model="withdrawal.memo" class="form-control input-group-sm" placeholder="{{ 'Text is limited to 300 characters' | translate}}"></textarea>
            </div>
            <button type="submit" class="btn btn-form" ng-disabled="(withdrawal.bankNo.$pristine && withdrawal.bankHolder.$pristine && withdrawal.bankAccountNo.$pristine && withdrawal.amount.$pristine) || withdrawalForm.$invalid || isProcessing" ng-bind="'Withdraw' | translate"></button>
        </form>
    </div>
</div>