<?session_start()?>
<div id="masthead-container" class="whole-container">
    <div class="container">
        <div class="masthead">
            <h1 class="pageTitleImage">
                <strong ng-bind="'Live Casino' | translate"></strong>
                <span ng-bind="'Experience the best of non-stop casino entertainment' | translate"></span>
            </h1>
        </div>
    </div>
</div>

<div class="container" ng-controller="MainController" ng-init="init()">
    <div class="container-box box-main margin-bottom">
        <div id="game-buttons-{{getAgentProductCasinoGameList.length}}" class="game-buttons">
            <div class="game-button game-button{{$index+1}} animated fadeIn" ng-repeat="casinoGame in getAgentProductCasinoGameList">
                <div class="game-button-wrapper game-button-wrapper{{$index+1}}" ng-click="playGame(casinoGame.gspNo,10)"></div>
                <div class="game-button-play">
                    <h3 ng-bind="casinoGame.gspName | translate"></h3>
                    <p><span ng-bind="gspLiveGameList[{{casinoGame.gspNo}}].liveGameList | translate"></span></p>
                    <h4>
                        <button class="btn btn-play" ng-bind="'Play' | translate" ng-click="playGame(casinoGame.gspNo,10)"></button>
                        <button ng-if="casinoGame.gspNo == 104" class="btn btn-play btn-list hvr-push"  ng-click="playGame(casinoGame.gspNo,10,'','',true)"><i class="icon-list"></i></button>
                    </h4>
                </div>
                <div class="game-button-overlay"></div>
            </div>

            <div class="clear"></div>
        </div>
    </div>

    <div class="container margin-bottom">
        <div class="jackpot" onclick="location.href='#slot'">
            <h1>
                <span ng-bind="'Slot Games' | translate"></span><br />
                <span ng-bind="'Progressive Jackpot' | translate"></span>
            </h1>
            <strong>$</strong>
            <div class="pjackpot"></div>
        </div>
    </div>

    <div class="container-box box-default margin-bottom">
        <div class="col-3 box-promos no-margin">
            <h3 ng-bind="'Promotions' | translate"> <a href="#promotion" class="btn-more" ng-bind="'More' | translate"></a></h3>

            <div id="promo-slider" class="owl-carousel owl-theme">
                <div class="item">
                    <h1>
                        20%
                        <span ng-bind="'New Member' | translate"></span><br />
                        <span ng-bind="'Welcome' | translate"></span>
                        <span ng-bind="'Bonus' | translate"></span><span>!</span>
                    </h1>
                    <p>
                        <span ng-bind="'Earn' | translate"></span><span ng-bind="'up to' | translate"></span>
                        <span> THB 5000 </span>
                        <span ng-bind="'on your first deposit after sign up!' | translate"></span>
                    </p>
                    <img src="common/images/promo1.png" width="315" height="218"/>
                    <h5><a href="#promotion" class="btn btn-join" ng-click="displayPromoDetails(1)" ng-bind="'Learn More' | translate"></a></h5>
                </div>
                <div class="item">
                    <h1>
                        <span ng-bind="'Sports' | translate"></span> <span ng-bind="'Weekly Cash Rebate' | translate"></span> 0.35%<span>!</span>
                    </h1>
                    <p>
                        <span class="text-center" ng-bind="'Earn unlimited cash rebate on your Sportsbook turnover!' | translate"></span>
                    </p>
                    <img src="common/images/promo2.png" width="315" height="218" />
                    <h5><a href="#promotion" class="btn btn-join" ng-click="displayPromoDetails(2)" ng-bind="'Learn More' | translate"></a></h5>
                </div>
                <div class="item">
                    <h1>
                        <span ng-bind="'Live Casino' | translate"></span><br />
                        <span ng-bind="'Weekly Cash Rebate' | translate"> 0.8%</span><span>!</span>
                    </h1>
                    <p>
                        <span ng-bind="'Earn unlimited cash rebate on your Live Casino turnover!' | translate"></span>
                    </p>
                    <img src="common/images/promo3.png" width="315" height="218" />
                    <h5><a href="#promotion" class="btn btn-join" ng-click="displayPromoDetails(3)" ng-bind="'Learn More' | translate"></a></h5>
                </div>
                <div class="item">
                    <h1>
                        5% <span ng-bind="'Daily Deposit' | translate"></span> <span ng-bind="'Bonus' | translate"></span><span>!</span>
                    </h1>
                    <p>
                        <span ng-bind="'Earn' | translate"></span> 5%
                        <span ng-bind="'up to' | translate"></span> THB 1000
                        <span ng-bind="'once a day on your deposit!' | translate"></span>
                    </p>
                    <img src="common/images/promo4.png" width="315" height="218" />
                    <h5><a href="#promotion" class="btn btn-join" ng-click="displayPromoDetails(4)" ng-bind="'Learn More' | translate"></a></h5>
                </div>
                <div class="item">
                    <h1>
                        <span ng-bind="'Friend Referral' | translate"></span>
                        <span ng-bind="'Bonus' | translate"></span><span>!</span>
                    </h1>
                    <p>
                        <span class="text-center" ng-bind="'Earn unlimited cash on your friends turnover!' | translate"></span>
                    </p>
                    <img src="common/images/promo5.png" width="315" height="218" />
                    <h5><a href="#promotion" class="btn btn-join" ng-click="displayPromoDetails(5)" ng-bind="'Learn More' | translate"></a></h5>
                </div>
                <div class="item">
                    <h1>
                        <span ng-bind="'Loyalty Points' | translate"></span><span>!</span>
                    </h1>
                    <p>
                        <span class="text-center" ng-bind="'Earn Loyalty Points everytime you make a deposit' | translate"></span><span>!</span>
                    </p>
                    <img src="common/images/promo6.png" width="315" height="218" />
                    <h5><a href="#promotion" class="btn btn-join" ng-click="displayPromoDetails(6)" ng-bind="'Learn More' | translate"></a></h5>
                </div>
            </div>
        </div>
        <div class="col-3 box-products">
            <h3 ng-bind="'Product Advantages' | translate"></h3>
            <div class="product-items">
                <h1 ng-bind="'Product Advantages' | translate"></h1>
                <p ng-bind="'Multi-Platform solution, more than 20+ brands integrated to satisfy your players gaming experience! take your business anywhere in the world!' | translate"></p>
            </div>
            <div class="product-items">
                <h1 ng-bind="'Live Casino' | translate"></h1>
                <p ng-bind="'Providing real time 24/7 live dealer products from Europe and Asia Pacific, enjoy your favorite table games from your home PC or take it on the go on your mobile device!' | translate"></p>
            </div>
            <div class="product-items">
                <h1 ng-bind="'Slots'  | translate"></h1>
                <p ng-bind="'Win Progressive Jackpots! 1,000+ slot titles with exciting 3D animations! Supports HTML5 and mobile applications to take the excitement anywhere you go!' | translate"></p>
            </div>
            <div class="product-items">
                <h1 ng-bind="'SPORTSBOOK'  | translate"></h1>
                <p ng-bind="'Offering the best odds in the market with the brands your players trust!' | translate"></p>
            </div>
            <div class="product-items">
                <h1 ng-bind="'Single Wallet'  | translate"></h1>
                <p ng-bind="'One wallet is all your player needs to enjoy multiple gaming platforms!'  | translate"></p>
            </div>
        </div>
        <div class="col-3 box-customer">
            <h3 ng-bind="'Customer Service' | translate"></h3>
            <div ng-include src="includePage" class="customer-service margin-bottom">
                <div class="clear"></div>
            </div>

            <div class="service-advantages">
                <div id="transaction-slider" class="owl-carousel owl-theme">
                    <div>
                        <h3 ng-bind="'Service Advantages' | translate"></h3>
                            <div class="service-advantages-item">
                                <h1 ng-bind="'Deposit' | translate"></h1>
                                <div class="ave-time">
                                    <span ng-bind="'Average Time' | translate"></span> <strong>2</strong> <span ng-bind="'minutes' | translate"></span>
                                </div>
                                <div id="depositBar" class="progressBars">
                                    <div></div>
                                </div>
                            </div>

                        <div class="service-advantages-item">
                            <h1 ng-bind="'Withdraw' | translate"></h1>
                            <div class="ave-time">
                                <span ng-bind="'Average Time' | translate"></span> <strong>15</strong> <span ng-bind="'minutes' | translate"></span>
                            </div>
                            <div id="withdrawBar" class="progressBars">
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 ng-bind="'Real Time Deposit' | translate"></h3>
                        <div class="top-item-list">
                            <div id="topItems" ng-repeat="currencyDeposit in currentDepositList">
                                <span class="txtID" ng-bind="currencyDeposit.nickname"></span>
                                <span class="txtAmount" ng-bind="currencyDeposit.currencyAmount.amount | customCurrency: cc_currency_symbol[currencyDeposit.currencyAmount.currencyIsoCd]"></span>
                                <span class="txtDate" ng-bind="currencyDeposit.transactionDate | userDateTime"></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 ng-bind="'Real Time Withdraw' | translate"></h3>
                        <div class="top-item-list">
                            <div id="topItems" ng-repeat="currentWithdrawal in currentWithdrawalList">
                                <span class="txtID" ng-bind="currentWithdrawal.nickname"></span>
                                <span class="txtAmount" ng-bind="currentWithdrawal.currencyAmount.amount | customCurrency: cc_currency_symbol[currentWithdrawal.currencyAmount.currencyIsoCd]"></span>
                                <span class="txtDate" ng-bind="currentWithdrawal.transactionDate | userDateTime"></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 ng-bind="'Top Withdraws' | translate"></h3>
                        <div class="top-item-list">
                            <div id="topItems" ng-repeat="topWithdrawal in topWithdrawalList">
                                <span class="txtID" ng-bind="topWithdrawal.nickname"></span>
                                <span class="txtAmount" ng-bind="topWithdrawal.currencyAmount.amount | customCurrency: cc_currency_symbol[topWithdrawal.currencyAmount.currencyIsoCd]"></span>
                                <span class="txtDate" ng-bind="topWithdrawal.transactionDate | userDateTime"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
