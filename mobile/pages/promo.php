<?include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/setCasinoName.php";?>
<div class="wrapper">
    <div class="container-promo-fixed noBorder">
        <div class="promo-container">

            <div class="promo_group_body">
                <div class="icon-new"></div>
                <div class="promo_group_body_inner">
                    <div class="promo-img promo1"></div>
                    <div class="promo-item-desc">
                        <h2 class="promo-title">
                            <strong>20%</strong>
                            <span ng-bind="'New Member' | translate"></span>
                            <span ng-bind="'Welcome' | translate"></span>
                            <span ng-bind="'Bonus' | translate"></span><span>!</span>
                        </h2>
                        <p class="promo-desc">
                            <span ng-bind="'Earn' | translate"></span> <span ng-bind="'up to' | translate"></span>
                            <span> THB 5000 </span>
                            <span ng-bind="'on your first deposit after sign up!' | translate"></span>
                        </p>
                        <button class="btn btn-default btn-promo viewMore" ng-bind="'Learn More' | translate"></button>
                        <button class="btn btn-default btn-promo viewLess hide" ng-bind="'Hide Details' | translate"></button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="promo_detail">
                        <div class="promo-details-body">
                            <h3 ng-bind="'Promotion Details' | translate"></h3>
                            <ul>
                                <li><span ng-bind="'First deposit money bonus for new member you will get the extra bonus' | translate"></span> 100 <span ng-bind="'baht' | translate"></span> <span ng-bind="'per' | translate"></span> 1 <span ng-bind="'Time' | translate"></span> <span ng-bind="'of' | translate"></span> 500 <span ng-bind="'baht' | translate"></span> <span ng-bind="'up to' | translate"></span> 20,000 <span ng-bind="'baht' | translate"></span>.</li>
                                <li><span ng-bind="'Never be our member before and also do not duplicate name phone number and other background in our database' | translate"></span>.</li>
                                <li><span ng-bind="'First deposit money minimum' | translate"></span> <span ng-bind="'is' | translate"></span> 500 <span ng-bind="'or' | translate"></span> <span ng-bind="'More' | translate"></span>.</li>
                                <li><span ng-bind="'Turnover condition' | translate"></span>: <span ng-bind="'first deposit money' | translate"></span> + <span ng-bind="'bonus that you got' | translate"></span>, <span ng-bind="'the turnover must be' | translate"></span> 1 <span ng-bind="'Time' | translate"></span> <span ng-bind="'and' | translate"></span> <span ng-bind="'within' | translate"></span> 48 <span ng-bind="'hours' | translate"></span> <span ng-bind="'before the customer request to withdraw money' | translate"></span>. <br />
                                    <span ng-bind="'If your turnover is not over' | translate"></span> 1 <span ng-bind="'Time' | translate"></span>, <span ng-bind="'we will cut your bonus off because the condition is not met' | translate"></span>.</li>
                                <li><span ng-bind="'Example' | translate"></span>:<br />
                                    <span ng-bind="'The turnover' | translate"></span> 1 <span ng-bind="'Time' | translate"></span> <span ng-bind="'is' | translate"></span> (500 + 100) x 1 = 600 <span ng-bind="'baht' | translate"></span>.<br />
                                    <span ng-bind="'Deposit' | translate"></span> 500 <span ng-bind="'baht' | translate"></span> <span ng-bind="'get bonus' | translate"></span> 100 <span ng-bind="'baht' | translate"></span> <span ng-bind="'and' | translate"></span> <span ng-bind="'Deposit' | translate"></span> 800 <span ng-bind="'baht' | translate"></span> <span ng-bind="'also' | translate"></span> <span ng-bind="'get' | translate"></span> 100 <span ng-bind="'baht' | translate"></span>.<br />
                                    (<span ng-bind="'This promotion you will' | translate"></span> <span ng-bind="'get bonus' | translate"></span> 100 <span ng-bind="'baht' | translate"></span> <span ng-bind="'per' | translate"></span> 1 <span ng-bind="'Time' | translate"></span> <span ng-bind="'of' | translate"></span> 500 <span ng-bind="'baht' | translate"></span>)<br />
                                    <span ng-bind="'Deposit' | translate"></span> 1,000 <span ng-bind="'baht' | translate"></span> <span ng-bind="'get bonus' | translate"></span> 200 <span ng-bind="'baht' | translate"></span> <span ng-bind="'and' | translate"></span> <span ng-bind="'Deposit' | translate"></span> 1,499 <span ng-bind="'baht' | translate"></span> <span ng-bind="'also' | translate"></span> <span ng-bind="'get bonus' | translate"></span> 200 <span ng-bind="'baht' | translate"></span>.
                                </li>
                            </ul>
                            <h3 ng-bind="'Conditions' | translate"></h3>
                            <ul>
                                <li><span ng-bind="'The customer must follow our condition only' | translate"></span>.</li>
                                <li><?=$casinoName?> <span ng-bind="'reserves the right to change or cancel these promotions at any time without notice' | translate"></span>.</li>
                                <li><span ng-bind="'The turnovers do not count the bills results which are draw and void' | translate"></span>.</li>
                                <li><span ng-bind="'If conditions are not met the customer can not request to withdraw for the bonus' | translate"></span>. <span ng-bind="'The customers who join to abuse for getting the bonus only' | translate"></span>, <?=$casinoName?> <span ng-bind="'will cut the bonus off without notice' | translate"></span>. <?=$casinoName?>’s <span ng-bind="'decision is final in all cases' | translate"></span>.</li>
                            </ul>
                        </div>

                        <div ng-show="!loggedIn" class="btn-create-account">
                            <button type="button" class="btn btn-form" onclick="slideLoginOpen()"> <span ng-bind="'Create Account' | translate"></span> <em>|</em> <span ng-bind="'Login' | translate"></span></button>
                        </div>
                        <div class="promo_group_button" role="button"></div>
                    </div>
                </div>
            </div>


            <div class="promo_group_body">
                <div class="icon-new"></div>
                <div class="promo_group_body_inner">
                    <div class="promo-img promo2"></div>
                    <div class="promo-item-desc">
                        <h2 class="promo-title">
                            <span ng-bind="'Sports' | translate"></span> <span ng-bind="'Weekly Cash Rebate' | translate"></span> <strong>0.35%!</strong>
                        </h2>
                        <p class="promo-desc">
                            <span ng-bind="'Earn unlimited cash rebate on your Sportsbook turnover!' | translate"></span>
                        </p>
                        <button class="btn btn-default btn-promo viewMore" ng-bind="'Learn More' | translate"></button>
                        <button class="btn btn-default btn-promo viewLess hide" ng-bind="'Hide Details' | translate"></button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="promo_detail">
                        <div class="promo-details-body">
                            <h3><span ng-bind="'Conditions' | translate"></span></h3>
                            <ul>
                                <li><span ng-bind="'Summary betting total and cash rebate' | translate"></span> 35% <span ng-bind="'per' | translate"></span> <span ng-bind="'week' | translate"></span> <span ng-bind="'for sports only' | translate"></span> (<span ng-bind="'SBO' | translate"></span>, <span ng-bind="'IBC' | translate"></span>, <span ng-bind="'IBS' | translate"></span>, <span ng-bind="'M2M' | translate"></span>, <span ng-bind="'3M' | translate"></span>, <span ng-bind="'GVBET' | translate"></span>, <span ng-bind="'AFB' | translate"></span>, <span ng-bind="'MIX' | translate"></span>).</li>
                                <li><span ng-bind="'We will top up the bonus in your user on Monday after' | translate"></span> 00.00 pm.</li>
                                <li><span ng-bind="'The promotion can be changed or cancelled at any time without notice' | translate"></span>.</li>
                                <li><?=$casinoName?>’s <span ng-bind="'decision is final in all cases' | translate"></span>.</li>
                            </ul>
                        </div>

                        <div ng-show="!loggedIn" class="btn-create-account">
                            <button type="button" class="btn btn-form" onclick="slideLoginOpen()"> <span ng-bind="'Create Account' | translate"></span> <em>|</em> <span ng-bind="'Login' | translate"></span></button>
                        </div>
                        <div class="promo_group_button" role="button"></div>
                    </div>
                </div>
            </div>

            <div class="promo_group_body">
                <div class="icon-new"></div>
                <div class="promo_group_body_inner">
                    <div class="promo-img promo3"></div>
                    <div class="promo-item-desc">
                        <h2 class="promo-title">
                            <span ng-bind="'Live Casino' | translate"></span> <span ng-bind="'Weekly Cash Rebate' | translate"> <strong>0.8%</strong></span><span>!</span>
                        </h2>
                        <p class="promo-desc marginBottom">
                            <span ng-bind="'Earn unlimited cash rebate on your Live Casino turnover!' | translate"></span>
                        </p>
                        <button class="btn btn-default btn-promo viewMore" ng-bind="'Learn More' | translate"></button>
                        <button class="btn btn-default btn-promo viewLess hide" ng-bind="'Hide Details' | translate"></button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="promo_detail">
                        <div class="promo-details-body">
                            <h3><span ng-bind="'Promotion Details' | translate"></span></h3>
                            <ul>
                                <li><span ng-bind="'Rebate' | translate"></span> 2% <span ng-bind="'for your lose from actual deposit' | translate"></span>.</li>
                            </ul>
                            <h3><span ng-bind="'Conditions' | translate"></span></h3>
                            <ul>
                                <li><span ng-bind="'Calculate rebate bonus from actual deposit' | translate"></span>. (<span ng-bind="'Example' | translate"></span>, <span ng-bind="'actual deposit' | translate"></span> <span ng-bind="'is' | translate"></span> 30,000 <span ng-bind="'your lose' | translate"></span> <span ng-bind="'is' | translate"></span> 25,000. <span ng-bind="'How to calculate' | translate"></span> <span ng-bind="'is' | translate"></span> (25,000 x 2% = 500).</li>
                                <li><span ng-bind="'Until' | translate"></span> 1 – 31 <span ng-bind="'of' | translate"></span> <span ng-bind="'every' | translate"></span> <span ng-bind="'Month' | translate"></span></li>
                                <li><span ng-bind="'Rebate minimum' | translate"></span> <span ng-bind="'is' | translate"></span> 100 <span ng-bind="'baht' | translate"></span> <span ng-bind="'and' | translate"></span> <span ng-bind="'maximum' | translate"></span> <span ng-bind="'is' | translate"></span> 5,000 <span ng-bind="'baht' | translate"></span>.</li>
                                <li><span ng-bind="'Rebate minimum' | translate"></span> <span ng-bind="'is' | translate"></span> 100 <span ng-bind="'baht' | translate"></span> <span ng-bind="'and' | translate"></span> <span ng-bind="'maximum' | translate"></span> <span ng-bind="'is' | translate"></span> 5,000 <span ng-bind="'baht' | translate"></span>.</li>
                                <li><span ng-bind="'We will top up the bonus in your user on 5th of next month' | translate"></span>.</li>
                                <li><span ng-bind="'The bonus has to be 1 time of turnover before request to withdraw' | translate"></span>.</li>
                                <li><span ng-bind="'The promotion can be changed or cancelled at any time without notice' | translate"></span>.</li>
                                <li><?=$casinoName?>’s <span ng-bind="'decision is final in all cases' | translate"></span>.</li>
                            </ul>
                        </div>

                        <div ng-show="!loggedIn" class="btn-create-account">
                            <button type="button" class="btn btn-form" onclick="slideLoginOpen()"> <span ng-bind="'Create Account' | translate"></span> <em>|</em> <span ng-bind="'Login' | translate"></span></button>
                        </div>
                        <div class="promo_group_button" role="button"></div>
                    </div>
                </div>
            </div>

            <div class="promo_group_body">
                <div class="icon-new"></div>
                <div class="promo_group_body_inner">
                    <div class="promo-img promo4"></div>
                    <div class="promo-item-desc">
                        <h2 class="promo-title">
                            <strong>5%</strong> <span ng-bind="'Daily Deposit' | translate"></span> <span ng-bind="'Bonus' | translate"></span><span>!</span>
                        </h2>
                        <p class="promo-desc">
                            <span ng-bind="'Earn' | translate"></span> 5% <span ng-bind="'up to' | translate"></span> THB 1000 <span ng-bind="'once a day on your deposit!' | translate"></span>
                        </p>
                        <button class="btn btn-default btn-promo viewMore" ng-bind="'Learn More' | translate"></button>
                        <button class="btn btn-default btn-promo viewLess hide" ng-bind="'Hide Details' | translate"></button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="promo_detail">
                        <div class="promo-details-body">
                            <h3><span ng-bind="'Promotion Details' | translate"></span></h3>
                            <ul>
                                <li><span ng-bind="'All users who deposited money via automatic online system in our web page on Monday to Friday until' | translate"></span> 500 <span ng-bind="'baht' | translate"></span> <span ng-bind="'or' | translate"></span> <span ng-bind="'More' | translate"></span>, <span ng-bind="'they will get a chance to join our reward game' | translate"></span> (<span ng-bind="'one chance' | translate"></span> <span ng-bind="'per' | translate"></span> <span ng-bind="'Day' | translate"></span>). <span ng-bind="'The reward prize are' | translate"></span> 100, 200, 300, 400, 500 <span ng-bind="'or' | translate"></span> <span ng-bind="'join in the next time' | translate"></span>.</li>
                            </ul>
                            <h3><span ng-bind="'Conditions' | translate"></span></h3>
                            <ul>
                                <li><span ng-bind="'Reserves the right' | translate"></span> 1 <span ng-bind="'user' | translate"></span> <span ng-bind="'per' | translate"></span> 1 <span ng-bind="'Time' | translate"></span>/<span ng-bind="'Day' | translate"></span> (<span ng-bind="'Example' | translate"></span>: <span ng-bind="'if the customer deposit via automatic online system for 5 times a day you will get 1 chance' | translate"></span>).</li>
                                <li><span ng-bind="'If the customer deposit money via automatic online system but deposit type, amount, time not match or not find the amount, it will be cancelled for this promotion' | translate"></span>.</li>
                                <li><span ng-bind="'Money deposit must be turnover for 1 time before get a chance' | translate"></span>.</li>
                                <li><span ng-bind="'The customer will get a chance on next day' | translate"></span>. <span ng-bind="'Example' | translate"></span>, <span ng-bind="'if you deposit money on' | translate"></span> 15 Aug <span ng-bind="'during time at' | translate"></span> 00.01 am – 11.59 pm. <span ng-bind="'you will get a chance to join reward game on' | translate"></span> 16 Aug <span ng-bind="'during time at' | translate"></span> 11.00 am – 11.59 pm. <span ng-bind="'The reward prize will top up in your user on' | translate"></span> 17 Aug <span ng-bind="'at' | translate"></span> 03.00 am <span ng-bind="'onwards' | translate"></span>.</li>
                                <li><span ng-bind="'If the customers missed the chance to join, it will be waived' | translate"></span>.</li>
                                <li><span ng-bind="'The promotion can be changed or cancelled at any time without notice' | translate"></span>.</li>
                                <li><?=$casinoName?>’s <span ng-bind="'decision is final in all cases' | translate"></span>.</li>
                            </ul>
                        </div>

                        <div ng-show="!loggedIn" class="btn-create-account">
                            <button type="button" class="btn btn-form" onclick="slideLoginOpen()"> <span ng-bind="'Create Account' | translate"></span> <em>|</em> <span ng-bind="'Login' | translate"></span></button>
                        </div>
                        <div class="promo_group_button" role="button"></div>
                    </div>
                </div>
            </div>

            <div class="promo_group_body">
                <div class="icon-new"></div>
                <div class="promo_group_body_inner">
                    <div class="promo-img promo5"></div>
                    <div class="promo-item-desc">
                        <h2 class="promo-title">
                            <span ng-bind="'Friend Referral' | translate"></span> <span ng-bind="'Bonus' | translate"></span><span>!</span>
                        </h2>
                        <p class="promo-desc">
                            <span class="text-center" ng-bind="'Earn unlimited cash on your friends turnover!' | translate"></span>
                        </p>
                        <button class="btn btn-default btn-promo viewMore" ng-bind="'Learn More' | translate"></button>
                        <button class="btn btn-default btn-promo viewLess hide" ng-bind="'Hide Details' | translate"></button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="promo_detail">
                        <div class="promo-details-body">
                            <h3><span ng-bind="'Promotion Details' | translate"></span></h3>
                            <ul>
                                <li><span ng-bind="'Refer your friends to be our member, you get bonus' | translate"></span> 100 <span ng-bind="'baht' | translate"></span> <span ng-bind="'per' | translate"></span> 1 <span ng-bind="'user' | translate"></span>. <span ng-bind="'We will top up the bonus in the end of the month' | translate"></span>.</li>
                            </ul>
                            <h3><span ng-bind="'Conditions' | translate"></span></h3>
                            <ul>
                                <li><span ng-bind="'Your friend must never be our member before' | translate"></span>.</li>
                                <li><span ng-bind="'Your friend user has to deposit money at least' | translate"></span> 10 <span ng-bind="'Day' | translate"></span> (<span ng-bind="'start from registered date' | translate"></span>) <span ng-bind="'and turnover must be' | translate"></span> 1 <span ng-bind="'Time' | translate"></span>.</li>
                                <li><span ng-bind="'Your user also needs to deposit money at least 10 day within the month' | translate"></span>.</li>
                                <li><span ng-bind="'We will top up the bonus for' | translate"></span> 1 <span ng-bind="'Time' | translate"></span>/<span ng-bind="'Month' | translate"></span>. (<span ng-bind="'For 5th of next month' | translate"></span>)</li>
                                <li><span ng-bind="'Turnover will be win and lose result only except draw result' | translate"></span>.</li>
                                <li><span ng-bind="'The promotion can be changed or cancelled at any time without notice' | translate"></span>.</li>
                                <li><span ng-bind="'The customers who join to abuse for getting the bonus only' | translate"></span>, <?=$casinoName?> <span ng-bind="'will cut the bonus off without notice' | translate"></span>.</li>
                            </ul>
                        </div>

                        <div ng-show="!loggedIn" class="btn-create-account">
                            <button type="button" class="btn btn-form" onclick="slideLoginOpen()"> <span ng-bind="'Create Account' | translate"></span> <em>|</em> <span ng-bind="'Login' | translate"></span></button>
                        </div>
                        <div class="promo_group_button" role="button"></div>
                    </div>
                </div>
            </div>

            <div class="promo_group_body">
                <div class="icon-new"></div>
                <div class="promo_group_body_inner">
                    <div class="promo-img promo6"></div>
                    <div class="promo-item-desc">
                        <h2 class="promo-title">
                            <span><span ng-bind="'Loyalty Points' | translate"></span>!</span>
                        </h2>
                        <p class="promo-desc">
                            <span class="text-center"><span ng-bind="'Earn Loyalty Points everytime you make a deposit' | translate"></span>!</span>
                        </p>
                        <button class="btn btn-default btn-promo viewMore" ng-bind="'Learn More' | translate"></button>
                        <button class="btn btn-default btn-promo viewLess hide" ng-bind="'Hide Details' | translate"></button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="promo_detail">
                        <div class="promo-details-body">
                            <h3><span ng-bind="'Promotion Details' | translate"></span></h3>
                            <ul>
                                <li><span ng-bind="'The turnover can be changed to cash' | translate"></span> (<span ng-bind="'turnover' | translate"></span> = 2,500 <span ng-bind="'is' | translate"></span> 1 <span ng-bind="'point' | translate"></span>/<span ng-bind="'baht' | translate"></span>. (<span ng-bind="'Sports' | translate"></span> <span ng-bind="'only' | translate"></span>)</li>
                            </ul>
                            <h3><span ng-bind="'Conditions' | translate"></span></h3>
                            <ul>
                                <li><span ng-bind="'Turnover summary for 1 time in the end of the month' | translate"></span>. (<span ng-bind="'Until' | translate"></span> 1 – 31 <span ng-bind="'only' | translate"></span>)</li>
                                <li><span ng-bind="'The customer can check turnover total in 5th of next month' | translate"></span>.</li>
                                <li><span ng-bind="'If the customer can keep turnover completely for' | translate"></span> 100 <span ng-bind="'point' | translate"></span>/<span ng-bind="'baht' | translate"></span>, <span ng-bind="'can request to change the cash' | translate"></span>.</li>
                                <li><span ng-bind="'After you change your turnover already, we will clear the last turnover and you can start to collect again until the end of this promotion' | translate"></span>.</li>
                                <li><span ng-bind="'We will top up the bonus in your user in the next day and customer can request to withdraw the bonus without turnover' | translate"></span>.</li>
                                <li><span ng-bind="'The promotion can be changed or cancelled at any time without notice' | translate"></span>.</li>
                                <li><?=$casinoName?>’s <span ng-bind="'decision is final in all cases' | translate"></span>.</li>
                                <li>**<span ng-bind="'Remark' | translate"></span>, <span ng-bind="'turnover will be win and lose result only except draw result' | translate"></span>.</li>
                            </ul>
                        </div>

                        <div ng-show="!loggedIn" class="btn-create-account">
                            <button type="button" class="btn btn-form" onclick="slideLoginOpen()"> <span ng-bind="'Create Account' | translate"></span> <em>|</em> <span ng-bind="'Login' | translate"></span></button>
                        </div>
                        <div class="promo_group_button" role="button"></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="clearfix"></div>
    </div>
</div>