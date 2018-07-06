<?session_start()?>

<!--WalletController-->
<div id="popup-wallet" ng-class="walletPopup()" ng-init="setTab(selectWalletTab);">
    <div class="popup-tabs">
        <ul class="popTabs">
            <li id="walletMyWallet"     ng-class="{ active:isSet(1) }" ng-click="setTab(1)" ng-bind="'My Wallet' | translate"></li>
            <li id="walletDeposit"      ng-class="{ active:isSet(2) }" ng-click="setTab(2)" ng-bind="'Deposit' | translate"></li>
            <li id="walletWithdraw"     ng-class="{ active:isSet(3) }" ng-click="setTab(3)" ng-bind="'Withdraw' | translate"></li>
            <li id="walletCoupon"       ng-class="{ active:isSet(4) }" ng-click="setTab(4)" ng-bind="'Coupon' | translate"> <span ng-bind="couponCount"></span></li>
            <li id="walletCash"         ng-class="{ active:isSet(5) }" ng-click="setTab(5)" ng-bind="'Transaction History' | translate"></li>
            <li id="walletAccount"      ng-class="{ active:isSet(6) }" ng-click="setTab(6)" ng-bind="'Account Details' | translate"></li>
            <li id="walletResetPass"      ng-class="{ active:isSet(7) }" ng-click="setTab(7)" ng-bind="'Reset Password' | translate"></li>
        </ul>
        <div class="clear"></div>
        <div ng-show="isSet(1)" class="popup-content" ng-controller="BalanceController">
            <h1> <span ng-bind="'My Wallet' | translate"></span> <button class="btn-more" ng-click="reloadBalance()" ng-disabled="isProcessing" ><i class="icon-refresh"></i> <label ng-bind="'Refresh' | translate"></label></button></h1>
            <div id="wallet-buttons-{{1+gspBalanceListLength}}" class="wallet-items margin-top margin-bottom">
                <div class="wallet-item-box wallet-item-bg1 border-round">
                    <i class="icon-info icon-tip-mainwallet"></i>
                    <div class="tooltip tooltipMainWallet border-round">
                        <b ng-bind="'Main Wallet' | translate"></b> <label ng-bind="'is be available' | translate"></label> <b ng-bind="'Live Casinos' | translate"></b>, <b ng-bind="'Slots' | translate"></b>, <b ng-bind="'Poker' | translate"></b>, <b ng-bind="'K' | translate"></b> <b ng-bind="'Sports' | translate"></b>
                    </div>
                    <strong ng-bind="'Main Wallet' | translate"></strong>
                    <h2  ng-bind="mainBalance.amount | customCurrency:cc_currency_symbol[mainBalance.currencyIsoCd]"></h2>
                    <span ng-bind="mainBalance.currencyIsoCd"></span>
                </div>
                <!--<div class="box-separator"></div>-->
                <div class="wallet-item-box wallet-item-bg-{{gspBalance.GspName}} border-round" ng-repeat="gspBalance  in gspBalanceList">
                    <strong ng-bind="gspBalance.GspName | translate"><p ng-bind="'S' | translate"></p> <p ng-bind="'Sports' | translate"></p></strong>
                    <h2 ng-if="gspBalance.currencyAmount.amount >= 0" ng-bind="gspBalance.currencyAmount.amount | customCurrency:cc_currency_symbol[gspBalance.currencyAmount.currencyIsoCd]"></h2>
                    <span ng-if="gspBalance.currencyAmount.amount >= 0" ng-bind="gspBalance.currencyAmount.currencyIsoCd"></span>
                    <h2 ng-if="gspBalance.currencyAmount.amount == -1" ng-bind="'Load Failed' | translate"></h2>
                    <span ng-if="gspBalance.currencyAmount.amount == -2" ng-bind="'GspUnderMaintenance' | translate"></span>
                    <span ng-if="gspBalance.currencyAmount.amount == -1" ng-bind="'Try to Refresh your Balance' | translate"></span>
                </div>
                <div class="clear"></div>
            </div>
            <h1 ng-bind="'Money Transfer' | translate"></h1>
            <div class="moneyTransferBox box-gray border-round margin-top margin-bottom" ng-controller="TransferController" ng-init="loadGsp()">
                <form name="depositForm" novalidate ng-submit="processForm()">
                    <div class="col-4">
                        <label ng-bind="'From' | translate"></label>
                        <select class="inputField" ng-init="gspTransfer.fromGspWallet = gspWalletList[0].gspNo" ng-model="gspTransfer.fromGspWallet" ng-options="gspWallet.gspNo as gspWallet.gspName for gspWallet in gspWalletList">
                            <option ng-bind="'Please Select Wallet' | translate"></option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label ng-bind="'To' | translate"></label>
                        <select class="inputField" ng-model="gspTransfer.toGspWallet" ng-options="gspWallet.gspNo as gspWallet.gspName for gspWallet in filteredGspWalletList">
                            <option ng-bind="'Please Select Wallet' | translate"></option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label ng-bind="'Amount' | translate"></label>
                        <input type="text" ng-model="gspTransfer.amount"  value="{{gspTransfer.amount | number}}" class="txtAmount inputField" />
                    </div>
                    <div class="col-4 text-center">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-transfer" ng-disabled="isProcessing" ng-bind="'Transfer' | translate"></button>
                    </div>
                </form>
                <div class="clear"></div>
                <p><span ng-bind="'The transfer is from Main Wallet' | translate"></span> <strong ng-bind="mainBalance.amount | customCurrency:cc_currency_symbol[mainBalance.currencyIsoCd]"></strong></p>
            </div>
            <h1>
                <span class="margin-top" ng-bind="'Promotions' | translate"></span>
                <a href="#/promotion" class="btn-more" ng-bind="'More' | translate" ng-click="btnPromos()"></a>
            </h1>
            <div class="container-box box-gray border-round margin-top text-center">

                <div id="wallet-promo-slider" class="owl-carousel owl-theme">
                    <div>
                        <img src="/common/images/promo1.png" />
                        <div class="promo-desc">
                            <h1>20% <span ng-bind="'New Member' | translate"></span> <span ng-bind="'Welcome' | translate"></span> <span ng-bind="'Bonus' | translate"></span><span>!</span></h1>
                            <p><span ng-bind="'Earn' | translate"></span><span ng-bind="'up to' | translate"></span><span> THB 5000 </span><span ng-bind="'on your first deposit after sign up!' | translate"></span></p>
                            <a href="#promotion" class="btn btn-join" ng-click="displayPromoDetails(1)" ng-bind="'Learn More' | translate"></a>
                        </div>
                    </div>
                    <div>
                        <img src="/common/images/promo2.png" />
                        <div class="promo-desc">
                            <h1><span ng-bind="'Sports' | translate"></span><span ng-bind="'Weekly Cash Rebate' | translate"></span> 0.35%<span>!</span></h1>
                            <p><span class="text-center" ng-bind="'Earn unlimited cash rebate on your Sportsbook turnover!' | translate"></span></p>
                            <a href="#promotion" class="btn btn-join" ng-click="displayPromoDetails(2)" ng-bind="'Learn More' | translate"></a>
                        </div>
                    </div>
                    <div>
                        <img src="/common/images/promo3.png" />
                        <div class="promo-desc">
                            <h1><span ng-bind="'Live Casino' | translate"></span> <span ng-bind="'Weekly Cash Rebate' | translate"> 0.8%</span><span>!</span></h1>
                            <p><span ng-bind="'Earn unlimited cash rebate on your Live Casino turnover' | translate"></span><span>!</span></p>
                            <a href="#promotion" class="btn btn-join" ng-click="displayPromoDetails(3)" ng-bind="'Learn More' | translate"></a>
                        </div>
                    </div>
                    <div>
                        <img src="/common/images/promo4.png" />
                        <div class="promo-desc">
                            <h1>5% <span ng-bind="'Daily Deposit' | translate"></span> <span ng-bind="'Bonus' | translate"></span><span>!</span></h1>
                            <p><span ng-bind="'Earn' | translate"></span> 5% <span ng-bind="'up to' | translate"></span> THB 1000 <span ng-bind="'once a day on your deposit!' | translate"></span></p>
                            <a href="#promotion" class="btn btn-join" ng-click="displayPromoDetails(4)" ng-bind="'Learn More' | translate"></a>
                        </div>
                    </div>
                    <div>
                        <img src="/common/images/promo5.png" />
                        <div class="promo-desc">
                            <h1><span ng-bind="'Friend Referral' | translate"></span><span ng-bind="'Bonus' | translate"></span><span>!</span></h1>
                            <p><span class="text-center" ng-bind="'Earn unlimited cash on your friends turnover!' | translate"></span></p>
                            <a href="#promotion" class="btn btn-join" ng-click="displayPromoDetails(5)" ng-bind="'Learn More' | translate"></a>
                        </div>
                    </div>
                    <div>
                        <img src="/common/images/promo6.png" />
                        <div class="promo-desc">
                            <h1><span ng-bind="'Loyalty Points' | translate"></span><span>!</span></h1>
                            <p><span class="text-center" ng-bind="'Earn Loyalty Points everytime you make a deposit' | translate"></span><span>!</span></p>
                            <a href="#promotion" class="btn btn-join" ng-click="displayPromoDetails(6)" ng-bind="'Learn More' | translate"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div ng-show="isSet(2)" class="popup-content" ng-controller="DepositController" ng-init="setTabDeposit(1)">
            <ul class="popTabPills depositOption{{getAgentPspList.length+1}}" ng-show="getAgentPspList.length > 0">
                <li id="depositMANUAL" ng-class="{ active:isSetDeposit(1) }" ng-click="setTabDeposit(1)"><i class="logo-manual"></i><span ng-bind="'Manual' | translate"></span></li>
                <li id="depositIPAYDNA" ng-repeat="getAgentPsp in getAgentPspList" ng-class="{ active:isSetDeposit(getAgentPsp.PspNo) }"  ng-click="setTabDeposit(getAgentPsp.PspNo)" >
                    <i ng-show="getAgentPsp.PspNo == 50701" class="logo-vpay"></i>
                    <i ng-show="getAgentPsp.PspNo == 50702" class="logo-wepay"></i>
                </li>
            </ul>
            <div class="clear"></div>
            <div ng-show="isSetDeposit(1)" ng-controller="DepositManualController">
                <form name="depositForm" novalidate ng-submit="processForm()">
                    <div class="row-box" ng-show="error.status">
                        <div class="error-danger" ng-bind="error.message"></div>
                    </div>
                    <div class="row-box">
                        <em class="required-fields">*</em>
                        <label ng-bind="'Deposit Amount' | translate"></label>
                        <p>
                            <input type="text" maxlength="25" placeholder="0" ng-model="deposit.amount" class="inputField text-left" format="number" value="{{deposit.amount | number}}" valid-method="blur"  required/>&nbsp;
                            <em add-amount-list="addAmount<?=$_SESSION["currencyIsoCd"]?>"></em>
                            <em><button type="button" class="btn btn-blue btn-option ng-binding ng-scope" ng-click="resetAmount()" ng-bind="'Clear' | translate"></button></em>
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <em class="required-fields">*</em>
                        <label ng-bind="'Depositor' | translate"></label>
                        <p>
                            <input type="text" ng-model="deposit.bankHolder" class="inputField" valid-method="blur" required/>
                        </p>
                        <em class="note" ng-bind="'Please provide name similar with your bank account details' | translate"></em>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <em class="required-fields">*</em>
                        <label ng-bind="'Date & Time' | translate"></label>
                        <p>
                            <input id="datetimepicker" type="text" name="DepositDate" ng-model="deposit.depositDate"  class="inputField inputDate" valid-method="blur" required/>
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <em class="required-fields">*</em>
                        <label ng-bind="'Type of Deposit' | translate"></label>
                        <p>
                            <select ng-model="deposit.depositType"  class="inputField"   valid-method="blur" ng-options="depositType | translate for depositType in depositTypes" valid-method="blur" required>
                                <option value="" selected="selected" ng-bind="'Please Select Deposit Type' | translate"></option>
                            </select>
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <em class="required-fields">*</em>
                        <label ng-bind="'Deposit Account' | translate"></label>
                        <p class="depositBankDetails" id="depositBanks-{{depositBankList.length}}">
                            <label class="depositBank_radio" ng-click="selectDepositAccount()" ng-repeat="depositBank in depositBankList">
                                <input value="{{$index}}" ng-model="deposit.bankIndex" type="radio" id="BankDetails" name="BankDetails" />
                                <strong><i class="bank-{{depositBank.BankNo}}"></i> {{depositBank.BankNm}}</strong>
                                <span class="bankHolder">{{depositBank.BankHolder}}</span>
                                <span>{{depositBank.BankAcctNo}}</span>
                            </label>
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <em class="required-fields">*</em>
                        <label ng-bind="'Contact Number' | translate"></label>
                        <p>
                            <input type="text" class="inputField"
                                   id="depositPhone"
                                   name="phone"
                                   international-phone-number
                                   only-countries={{playerDetail.countryCd}}
                                   default-country={{playerDetail.countryCd}}
                                   ng-model="deposit.phone"
                                   />
                            <input id="hidden" type="hidden" name="phone-full">
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <em class="required-fields"></em>
                        <label ng-bind="'Comment' | translate"></label>
                        <p>
                            <textarea rows="2" cols="20" maxlength="300" ng-model="deposit.memo" class="inputTextarea" placeholder="{{ 'Text is limited to 300 characters' | translate}}" ng-cloak></textarea>
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box-last text-center">
                        <p class="text-left required-fields-note">* <em ng-bind="'Required Fields' | translate"></em></p>
                        <button type="submit" class="btn btn-submit" ng-disabled="(depositForm.bankHolder.$pristine && depositForm.depositDate.$pristine && depositForm.depositType.$pristine) || depositForm.$invalid || isProcessing || !isSelectedBank" ng-bind="'Deposit' | translate" ></button>
                    </div>
                </form>
            </div>
            <div ng-show="isSetDeposit(50701)" ng-controller="DepositVPayController">

                    <div ng-hide="vpayNext" style="margin: 75px 0;">
                        <div class="row-box" style="padding: 10px 0 20px 0;">
                            <div class="text-center padding10" ng-bind="'Please Select Card Account Type' | translate"></div>
                            <div class="text-center padding10">
                                <ul>
                                    <li class="selectCardType" ng-repeat="CardType in depositVPay.CardTypeList">
                                        <label class="cardType_radio" ng-click="selectCardType()">
                                            <input type="radio" ng-model="depositVPay.CardType" name="CardType" value="{{CardType.CardTypeNo}}" required />
                                            <i class="logo-{{CardType.CardTypeName}}2"></i>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="row-box-last text-right" style="margin: 0 165px;">
                            <button type="button" class="btn btn-submit" ng-click="vpayNext=true" ng-disabled="!depositVPay.CardType"  ng-bind="'Next' | translate" ></button>
                        </div>
                    </div>

                <div ng-show="vpayNext">
                    <form name="depositVPayForm" novalidate ng-submit="processForm()" >
                    <div class="row-box" ng-show="error.status">
                        <div class="error-danger" ng-bind="error.message"></div>
                    </div>
                    <div class="row-box">
                        <em class="required-fields">*</em>
                        <label ng-bind="'Address' | translate"></label>
                        <p>
                            <input type="text" ng-model="depositVPay.address" class="inputField" valid-method="blur" placeholder="Detail Address" required/>
                            <input type="text" ng-model="depositVPay.city" class="inputField" valid-method="blur" placeholder="City" required/>
                            <select class="inputField" name="countryNo" ng-model="depositVPay.countryNo" required
                                    ng-options="c.countryNo as c.countryName for c in getCountries">
                                <option value="" selected="selected" ng-bind="'Please Select Country' | translate"></option>
                            </select>
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <em class="required-fields">*</em>
                        <label ng-bind="'Zip Code' | translate"></label>
                        <p>
                            <input type="text" class="inputField inputField-xs"
                                   ng-model="depositVPay.zipCode" />
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <em class="required-fields">*</em>
                        <label ng-bind="'Deposit Amount' | translate"></label>
                        <p>
                            <input type="text" maxlength="25" placeholder="0" ng-model="depositVPay.amount" class="inputField text-left" format="number" value="{{depositVPay.amount | number}}" valid-method="blur"  required/>&nbsp;
                            <em add-amount-list="addAmount<?=$_SESSION["currencyIsoCd"]?>"></em>
                            <em><button type="button" class="btn btn-blue btn-option ng-binding ng-scope" ng-click="resetAmount()" ng-bind="'Clear' | translate"></button></em>
                        </p>
                        <div class="clear"></div>
                    </div>

<!--                    <div class="row-box">
                        <em class="required-fields">*</em>
                        <label ng-bind="'Card Account Type' | translate"></label>
                        <p class="selectCardType">
                            <label class="cardType_radio" ng-click="selectCardType()">
                                <input value="1" type="radio" id="CardType" name="CardType" checked="checked" ng-checked="true"/>
                                <i class="logo-visa"></i>
                            </label>
                            <label class="cardType_radio" ng-click="selectCardType()">
                                <input value="1" type="radio" id="CardType" name="CardType" />
                                <i class="logo-mastercard"></i>
                            </label>
                        </p>
                        <p class="selectCardType" ng-repeat="CardType in depositVPay.CardTypeList">
                            <label class="cardType_radio" ng-click="selectCardType()">
                                <input type="radio" ng-model="depositVPay.CardType" name="CardType" value="{{CardType.CardTypeNo}}" required />
                                <i class="logo-{{CardType.CardTypeName}}"></i>
                            </label>
                        </p>
                        <div class="clear"></div>
                    </div>-->

                    <div class="row-box">
                        <em class="required-fields">*</em>
                        <label ng-bind="'Card Holder Name' | translate"></label>
                        <p>
                            <input type="text" ng-model="depositVPay.firstName" class="inputField" valid-method="blur"  placeholder="First Name" required/>
                            <input type="text" ng-model="depositVPay.lastName" class="inputField" valid-method="blur" placeholder="Last Name" required/>
                        </p>
                        <em class="note" ng-bind="'Enter name exactly as it appears on your credit card' | translate"></em>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <em class="required-fields">*</em>
                        <label ng-bind="'Contact Number' | translate"></label>
                        <p>
                            <input type="text" class="inputField"
                                   id="depositPhone"
                                   name="phone"
                                   international-phone-number
                                   only-countries={{playerDetail.countryCd}}
                                   default-country={{playerDetail.countryCd}}
                                   ng-model="depositVPay.phone"
                                />
                            <input id="hidden" type="hidden" name="phone-full">
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <em class="required-fields"></em>
                        <label ng-bind="'Comment' | translate"></label>
                        <p>
                            <textarea rows="2" cols="20" maxlength="300" ng-model="depositVPay.memo" class="inputTextarea" placeholder="{{ 'Text is limited to 300 characters' | translate}}" ng-cloak></textarea>
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box-last text-center">
                        <p class="text-left required-fields-note">* <em ng-bind="'Required Fields' | translate"></em></p>
                        <button type="submit" class="btn btn-submit" ng-disabled="depositVPay.amount <= 0 || depositVPayForm.$invalid || isProcessing" ng-bind="'Deposit' | translate" ></button>
                    </div>
                  </div><!--end ng-show-->
                </form>
            </div>
            <div ng-show="isSetDeposit(50702)" ng-controller="DepositWePayController">
                <form name="depositWePayForm" novalidate ng-submit="processForm()">

                    <div class="row-box" ng-show="error.status">
                        <div class="error-danger" ng-bind="error.message"></div>
                    </div>
                    <div class="row-box">
                        <em class="required-fields">*</em>
                        <label ng-bind="'Deposit Amount' | translate"></label>
                        <p>
                            <input type="text" maxlength="25" placeholder="0" ng-model="depositWePay.amount" class="inputField text-left" format="number" value="{{depositWePay.amount | number}}" valid-method="blur"  required/>&nbsp;
                            <em add-amount-list="addAmount<?=$_SESSION["currencyIsoCd"]?>"></em>
                            <em><button type="button" class="btn btn-blue btn-option ng-binding ng-scope" ng-click="resetAmount()" ng-bind="'Clear' | translate"></button></em>
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <em class="required-fields">*</em>
                        <label ng-bind="'Deposit Account' | translate"></label>
                        <p class="depositBankDetails" id="depositBanks-{{wePayBankCode.length}}">
                            <label class="depositBank_radio depositBankName" ng-click="selectDepositAccount()" ng-repeat="wePayBank in wePayBankList | filter:{'Currency':mainBalance.currencyIsoCd}">
                                <input value="{{wePayBank.BankCode}}" ng-model="depositWePay.bankCode" type="radio" id="BankDetails" name="BankDetails" />
                                <strong><i class="bank-{{wePayBank.BankCode}}"></i> {{wePayBank.BankName}}</strong>
                            </label>
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <em class="required-fields">*</em>
                        <label ng-bind="'Contact Number' | translate"></label>
                        <p>
                            <input type="text" class="inputField"
                                   id="depositPhone"
                                   name="phone"
                                   international-phone-number
                                   only-countries={{playerDetail.countryCd}}
                                   default-country={{playerDetail.countryCd}}
                                   ng-model="depositWePay.phone"
                                />
                            <input id="hidden" type="hidden" name="phone-full">
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <em class="required-fields"></em>
                        <label ng-bind="'Comment' | translate"></label>
                        <p>
                            <textarea rows="2" cols="20" maxlength="300" ng-model="depositWePay.memo" class="inputTextarea" placeholder="{{ 'Text is limited to 300 characters' | translate}}" ng-cloak></textarea>
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box-last text-center">
                        <p class="text-left required-fields-note">* <em ng-bind="'Required Fields' | translate"></em></p>
                        <button type="submit" class="btn btn-submit" ng-disabled="depositWePay.amount <= 0 || depositWePay.$invalid || isProcessing || !isSelectedBank" ng-bind="'Deposit' | translate" ></button>
                    </div>
                </form>
            </div>
            <div ng-show="isSetDeposit(3)" ng-bind="'SDPay' | translate"></div>
            <div ng-show="isSetDeposit(4)" ng-bind="'Help2Pay' | translate"></div>
            <div ng-show="isSetDeposit(5)" ng-bind="'IBanQ' | translate"></div>
        </div>
        <div ng-show="isSet(3)" class="popup-content" ng-controller="WithdrawalController">
            <form name="withdrawalForm" novalidate ng-submit="processForm()">
                <div class="popup-desc">
                    <span ng-bind="'Please transfer first your game funds to main wallet Your available balance from main wallet is' | translate"></span> <strong ng-bind="mainBalance.amount | customCurrency:cc_currency_symbol[mainBalance.currencyIsoCd]"></strong>
                </div>
                <div class="row-box" ng-show="error.status">
                    <div class="error-danger"  ng-bind="error.message"></div>
                </div>
                <div class="row-box">
                    <em class="required-fields">*</em>
                    <label ng-bind="'Withdrawal Amount' | translate"></label>
                    <p>
                        <input type="text" placeholder="0" ng-model="withdrawal.amount" class="inputField text-left" format="numberDecimal" value="{{withdrawal.amount | number}}" valid-method="blur" required />&nbsp;
                        <em add-amount-list="addAmount<?=$_SESSION["currencyIsoCd"]?>">
                        </em>
                        <em>
                            <button type="button" class="btn btn-blue btn-option ng-binding ng-scope" ng-click="resetAmount()" ng-bind="'Clear' | translate"></button>
                        </em>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box">
                    <em class="required-fields">*</em>
                    <label ng-bind="'Bank' | translate"></label>
                    <p>
                        <select ng-model="withdrawal.bankNo"  class="inputField" style="margin-right: 4px;"  valid-method="blur" ng-options="agentBank.bankNo as agentBank.bankName  for agentBank in getAgentBankList" required>
                            <option value="" selected="selected" ng-bind="'Please Select Bank' | translate"></option>
                        </select>
                        <input type="text" ng-pattern="/^\d{2,4}[0-9\-]*\d{2,4}$/" placeholder="{{ 'Account Number' | translate}}" ng-model="withdrawal.bankAccountNo"  class="inputField"  valid-method="blur" required />
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box">
                    <em class="required-fields">*</em>
                    <label ng-bind="'Account Holder' | translate"></label>
                    <p>
                        <input type="text" placeholder="{{ 'Bank Account Holder Name' | translate}}" ng-model="withdrawal.bankHolder" class="inputField"  valid-method="blur" required />
                    </p>
                    <div class="clear"></div>
                </div>
<!--                <div class="row-box">-->
<!--                    <em class="required-fields"></em>-->
<!--                    <label ng-bind="'Account Info' | translate"></label>-->
<!--                    <p>-->
<!--                        <input type="text" placeholder="{{ 'Bank Account Type' | translate}}" ng-cloak ng-model="withdrawal.bankAccountType" class="inputField"  style="margin-right: 4px;"  >-->
<!--                        <input id="inputWithdrawBankPlace" type="text" placeholder="{{ 'Bank Place' | translate}}" ng-cloak ng-model="withdrawal.bankPlace" class="inputField" style="margin-right: 4px;" />-->
<!--                        <input id="inputWithdrawBankOffice" type="text" placeholder="{{ 'Bank Office' | translate}}" ng-cloak ng-model="withdrawal.bankOffice" class="inputField" style="margin-right: 4px;" />-->
<!--                    </p>-->
<!--                    <div class="clear"></div>-->
<!--                </div>-->
                <div class="row-box">
                    <em class="required-fields">*</em>
                    <label ng-bind="'Contact Number' | translate"></label>
                    <p>
                        <input type="text" class="inputField"
                               id="withdrawalPhone"
                               name="phone"
                               international-phone-number
                               only-countries={{playerDetail.countryCd}}
                               default-country={{playerDetail.countryCd}}
                               ng-model="withdrawal.phone"
                               />
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box">
                    <em class="required-fields"></em>
                    <label ng-bind="'Comment' | translate"></label>
                    <p>
                        <textarea rows="2" cols="20" maxlength="300" ng-model="withdrawal.memo" class="inputTextarea" placeholder="{{ 'Text is limited to 300 characters' | translate}}"></textarea>
                    </p>
                    <div class="clear"></div>
                </div>

                <div class="row-box-last text-center">
                    <p class="text-left required-fields-note">* <em ng-bind="'Required Fields' | translate"></em></p>
                    <button type="submit" class="btn btn-submit" ng-disabled="(withdrawal.bankNo.$pristine && withdrawal.bankHolder.$pristine && withdrawal.bankAccountNo.$pristine && withdrawal.amount.$pristine) || withdrawalForm.$invalid || isProcessing" ng-bind="'Withdrawal' | translate" ></button>
                </form>
                </div>
        </div>
        <div ng-show="isSet(4)" class="popup-content" ng-controller="CouponController" ng-init="loadCoupon();">
            <div class="header-row-box">
                <div class="header-title width30 text-center" ng-bind="'Coupon Name' | translate"></div>
                <div class="header-title width20 text-center" ng-bind="'Balance' | translate"></div>
                <div class="header-title width20 text-center" ng-bind="'Expiration Date' | translate"></div>
                <div class="header-title width30 text-center" ng-bind="'Status' | translate"></div>
                <div class="clear"></div>
            </div>
            <div class="pagination-items margin-bottom">
                <div ng-repeat="coupon in filteredPage">
                    <div class="list-row-box">
                        <div class="row-col width30 text-center" ng-bind="coupon.CouponName"></div>
                        <div class="row-col width20 text-right paddingR20" ng-bind="coupon.CurrencyAmount.amount | currency:cc_currency_symbol[coupon.CurrencyAmount.currencyIsoCd]"></div>
                        <div ng-if="coupon.ExpirationDate" class="row-col width20 text-center" ng-bind="coupon.ExpirationDate | userDate""></div>
                        <div ng-if="!coupon.ExpirationDate" class="row-col width20 text-center" ng-bind="'No Expiration Date' | translate"></div>
                        <div ng-if="coupon.Status=='Issued'" class="row-col width30 text-center"><button type="button" class="btn btn-blue btn-coupon ng-binding ng-scope" ng-click="useCoupon(coupon.CouponCode)" ng-bind="'Use Coupon' | translate"></button> </div>
                        <div ng-if="coupon.Status=='Redeemed'" class="row-col width30 text-center" ng-bind="coupon.Status | translate"></div>
                    </div>
                </div>
            </div>

            <div class="clear"></div>
            <pagination boundary-links="true" total-items="totalItems" ng-model="currentPage" items-per-page="numPerPage" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></pagination>


            <div class="clear"></div>
        </div>
        <div ng-show="isSet(5)" class="popup-content" ng-controller="TransactionHistoryController">
            <div class="header-row-box">
                <div class="header-title width15 text-center" ng-bind="'Index' | translate"></div>
                <div class="header-title width15 text-center" ng-bind="'Date' | translate"></div>
                <div class="header-title width15 text-center" ng-bind="'Currency Amount' | translate"></div>
                <div class="header-title width15 text-center" ng-bind="'Transaction Source' | translate"></div>
                <div class="header-title width15 text-center" ng-bind="'Type' | translate"></div>
                <div class="header-title width25 text-center" ng-bind="'Description' | translate"></div>
                <div class="clear"></div>
            </div>
            <div class="pagination-items margin-bottom">
                <div ng-repeat="transaction in filteredPage">
                    <div class="list-row-box">
                        <div class="row-col width15 text-center" ng-bind="transaction.transactionId"></div>
                        <div class="row-col width15 text-center" ng-bind="transaction.transactionDate | userDate"></div>
                        <div class="row-col width15 text-right" ng-bind="transaction.currencyAmount.amount | customCurrency:cc_currency_symbol[transaction.currencyAmount.currencyIsoCd]"></div>
                        <div class="row-col width15 text-center" ng-bind="transaction.transactionSource" ng-bind="transaction.transactionSource | translate"></div>
                        <div class="row-col width15 text-center" ng-bind="transaction.transactionType" ng-bind="transaction.transactionType | translate"></div>
                        <div class="row-col width25 text-left" ng-bind="transaction.transactionDescription" ng-bind="transaction.transactionDescription | translate"></div>
                    </div>
                </div>
            </div>

            <div class="clear"></div>
            <pagination boundary-links="true" total-items="totalItems" ng-model="currentPage" items-per-page="numPerPage" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></pagination>
            <div class="clear"></div>
        </div>
        <div ng-show="isSet(6)" class="popup-content editForm" ng-controller="AccountDetailsController">
            <form name="editPlayerForm" novalidate ng-submit="processForm()">
                <!--<div class="popup-desc margin-bottom20">
                    <span>Please complete your account details first before you proceed to deposit.</span>
                </div>-->
                <h1 ng-bind="'Account Details' | translate"></h1>
                <div class="editFormBox float-left margin-bottom">
                    <div class="row-box">
                        <label ng-bind="'User ID' | translate"></label>
                        <p ng-bind="editPlayerForm.nickname"></p>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="editFormBox float-right">
                    <div class="row-box">
                        <label ng-bind="'Player Name' | translate"></label>
                        <p ng-bind="editPlayerForm.playerName"></p>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="editFormBox float-left margin-bottom">
                    <div class="row-box">
                        <label ng-bind="'First Name' | translate"></label>
                        <input type="text" class="inputField"
                               ng-model="editPlayerForm.firstName" />
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="editFormBox float-right">
                    <div class="row-box">
                        <label ng-bind="'Last Name' | translate"></label>
                        <input type="text" class="inputField"
                               ng-model="editPlayerForm.lastName" />
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
                <h1 ng-bind="'Personal Information' | translate"></h1>
                <div class="editFormBox float-left">
                    <div class="row-box">
                        <label ng-bind="'Address' | translate"></label>
                        <p>
                            <input type="text" class="inputField"
                                   ng-model="editPlayerForm.address"/>
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <label ng-bind="'City' | translate"></label>
                        <p>
                            <input type="text" class="inputField"
                                   ng-model="editPlayerForm.city"/>
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <label ng-bind="'Zip Code' | translate"></label>
                        <p>
                            <input type="text" class="inputField inputField-xs"
                                   ng-model="editPlayerForm.zipCode" />
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <label ng-bind="'Country' | translate"></label>
                        <p>
                            <select class="inputField" name="countryNo" ng-model="editPlayerForm.countryNo" required
                                    ng-options="c.countryNo as c.countryName for c in getCountries">
                                <option value="" selected="selected" ng-bind="'Please Select Country' | translate"></option>
                            </select>
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <label ng-bind="'Language' | translate"></label>
                        <p>
                            <select class="inputField" ng-model="editPlayerForm.languageNo" required
                                    ng-options="c.languageNo as c.languageName for c in getLanguages">
                                <option value="" selected="selected" ng-bind="'Please Select Language' | translate"></option>
                            </select>
                        </p>
                        <div class="clear"></div>
                    </div>

                </div>

                <div class="editFormBox float-right">
                    <div class="row-box">
                        <label ng-bind="'Date of Birth' | translate"></label>
                        <p ng-bind="editPlayerForm.dateOfBirth | userDate"></p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <label ng-bind="'Gender' | translate"></label>
                        <p class="select_gender" ng-repeat="gender in genderList">
                            <input type="radio" ng-model="editPlayerForm.gender" name="gender" value="{{gender.genderNo}}" required  /><span ng-bind="gender.genderName | translate"></span>
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <label ng-bind="'Email Address' | translate"></label>
                        <p>
                            <input type="email" validate-email ng-model="editPlayerForm.email" class="inputField" required />
                        </p>
                        <div class="clear"></div>
                    </div>
                    <div class="row-box">
                        <label ng-bind="'Phone Number' | translate"></label>
                        <p>
                            <input type="text" class="inputField"
                                   id="editPlayerFormPhone"
                                   name="phone"
                                   international-phone-number
                                   only-countries={{countryA2List}}
                                   default-country={{playerDetail.countryCd}}
                                   ng-model="editPlayerForm.phone"
                                   required />
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>

                <div class="row-box-last text-center">
                    <button type="submit" class="btn btn-submit" ng-disabled="isProcessing" ng-bind="'Edit' | translate"></button>
                </div>
            </form>
            <div class="clear"></div>
        </div>
        <div ng-show="isSet(7)" class="popup-content" ng-controller="ChangePasswordController">
            <form name="changePasswordForm" novalidate  ng-submit="processForm()">
                <div class="row-box">
                    <label style="margin-left:167px;" ng-bind="'Current Password' | translate"></label>
                    <p>
                        <input type="password" maxlength="16" placeholder="" ng-model="changePwd.password" class="inputField" required/>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box">
                    <label style="margin-left:167px;" ng-bind="'New Password' | translate"></label>
                    <p>
                        <input type="password" maxlength="16"  placeholder="" ng-model="changePwd.newPassword" class="inputField" required/>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box">
                    <label style="margin-left:167px;" ng-bind="'Confirm New Password' | translate"></label>
                    <p>
                        <input type="password" maxlength="16" placeholder=""  ng-model="changePwd.newConfirmPassword" class="inputField" required/>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="row-box-last text-center">
                    <button type="submit" class="btn btn-submit" ng-disabled="isProcessing" ng-bind="'Change Password' | translate"></button>
                </div>
            </form>
        </div>
    </div>
</div>
