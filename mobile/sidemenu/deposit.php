<?session_start()?>
<div ng-controller="WalletController">
    <div class="slide-menu-header">
        <i class="backMenu" role="button" ng-click="closeDeposit()"></i>
        <span ng-bind="'Deposit' | translate"></span>
    </div>

    <div class="container"  ng-controller="DepositController as tab">
        <ul class="tabs">
            <li id="depositManual"      ng-class="{ active:tab.isSet(1) }" ng-click="tab.setTab(1)" ng-bind="'Manual' | translate"></li>
            <li id="depositNeteller"    ng-class="{ active:tab.isSet(2) }" ng-click="tab.setTab(2)" ng-bind="'IPayDNA' | translate"></li>
            <li id="depositHelp2Pay"    ng-class="{ active:tab.isSet(3) }" ng-click="tab.setTab(3)" ng-bind="'SDPay' | translate"></li>
            <li id="depositIPS"         ng-class="{ active:tab.isSet(4) }" ng-click="tab.setTab(4)" ng-bind="'Help2Pay' | translate"></li>
            <li id="depositIPDNA"       ng-class="{ active:tab.isSet(5) }" ng-click="tab.setTab(5)" ng-bind="'IBanQ' | translate"></li>
        </ul>
        <div class="clearfix"></div>

        <div ng-show="tab.isSet(1)" >
            <form name="depositForm" novalidate ng-submit="processForm()">
                <div class="error-danger" ng-show="error.status">
                    <div ng-bind="error.message"></div>
                </div>
                <div class="form-group">
                    <label><strong ng-bind="'Deposit Amount' | translate"></strong> <em>*</em></label>
                    <span class="signCurrency" ng-controller="BalanceController" ng-bind="cc_currency_symbol[mainBalance.currencyIsoCd]"></span>
                    <input type="text" format="number" name="amount" maxlength="12" placeholder="0" class="clearable form-control input-sm"  ng-model="deposit.amount"  value="{{deposit.amount | number}}" valid-method="blur"  required/>
                    <button type="button" class="btn btn-blue btn-option ng-binding ng-scope deleteText" ng-click="resetAmount()"></button>
                    <div class="btn-amounts">
                        <em add-amount-list="addAmount<?=$_SESSION["currencyIsoCd"]?>"></em>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="form-group">

                    <label><strong ng-bind="'Depositor' | translate"></strong> <em>*</em></label>
                    <input type="text" class="form-control input-sm" ng-model="deposit.bankHolder" valid-method="blur" required />
                    <div class="notes">
                        <p ng-bind="'Please provide name similar with your bank account details' | translate"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label><strong ng-bind="'Date & Time' | translate"></strong> <em>*</em></label>
                    <input type="text" class="form-control input-sm inputDate"
                           name="depositDate"
                           id="depositDatetimepicker"
                           ng-model="deposit.depositDate"
                           valid-method="blur"
                        />
                </div>
                <div class="form-group">
                    <label><strong ng-bind="'Type of Deposit' | translate"></strong> <em>*</em></label>
                    <select ng-model="deposit.depositType" ng-options="depositType | translate for depositType in depositTypes" class="form-control input-sm" valid-method="blur" required>
                        <option value="" default ng-bind="'Select Deposit Type' | translate"></option>
                    </select>
                </div>
                <div class="form-group">
                    <label><strong ng-bind="'Deposit Account' | translate"></strong> <em>*</em></label>
                    <p class="depositBankDetails">
                        <label class="depositBank_radio" ng-repeat="depositBank in depositBankList">
                            <input type="radio" value="{{$index}}" ng-click="selectDepositAccount()" ng-model="deposit.bankIndex" id="BankDetails" name="BankDetails" required/>
                            <strong><i class="bank-{{depositBank.BankNo}}"></i> {{depositBank.BankNm}}</strong>
                            <span>{{depositBank.BankHolder}}</span><span>|</span><span>{{depositBank.BankAcctNo}}</span>
                        </label>
                    <div class="clear"></div>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="form-group">
                    <label><span ng-bind="'Contact Number' | translate"></span> <em>*</em></label>
                    <input type="text" class="form-control input-sm"
                           id="depositPhone"
                           name="phone"
                           international-phone-number
                           only-countries={{playerDetail.countryCd}}
                           default-country={{playerDetail.countryCd}}
                           ng-model="deposit.phone"
                        />
                    <input id="hidden" type="hidden" name="phone-full">
                </div>
                <div class="form-group">
                    <label ng-bind="'Comment' | translate"></label>
                    <textarea class="form-control input-group-sm" maxlength="300" placeholder="{{ 'Text is limited to 300 characters' | translate}}" maxlength="300" ng-model="deposit.memo"></textarea>
                </div>
                <button type="submit" class="btn btn-form" ng-disabled="(depositForm.bankHolder.$pristine && depositForm.depositType.$pristine) || depositForm.$invalid || isProcessing" ng-bind="'Deposit' | translate"></button>
            </form>
        </div>

        <div ng-show="tab.isSet(2)" ng-bind="'IPayDNA' | translate"></div>
        <div ng-show="tab.isSet(3)" ng-bind="'SDPay' | translate"></div>
        <div ng-show="tab.isSet(4)" ng-bind="'Help2Pay' | translate"></div>
        <div ng-show="tab.isSet(5)" ng-bind="'IBanQ' | translate"></div>
        <div class="clearfix"></div>
    </div>
</div>





















