<?include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/setCasinoName.php";?>
<div class="container">
    <div class="promo-container margin-top">
        <h1 class="pageTitleImage">
            <strong ng-bind="'Promotions' | translate"></strong>
            <span ng-bind="'Exclusive promotions and events you will find only from' | translate"></span> <span><?=$casinoName?>!</span>
        </h1>
        <div class="promo-box promo-box1" ng-click="displayPromoDetails(1)">
            <strong class="text-center">
                20%
                <span ng-bind="'New Member' | translate"></span>
                <span ng-bind="'Welcome' | translate"></span>
                <span ng-bind="'Bonus' | translate"></span><span>!</span>
            </strong>
            <p>
                <span ng-bind="'Earn' | translate"></span>
                <span ng-bind="'up to' | translate"></span>
                <span> THB 5000 </span>
                <span ng-bind="'on your first deposit after sign up!' | translate"></span>
            </p>
            <div class="game-button-play">
                <button type="button" class="btn btn-join" ng-bind="'Learn More' | translate"></button>
            </div>
        </div>
        <div class="promo-box promo-box2" ng-click="displayPromoDetails(2)">
            <strong class="text-center">
                <span ng-bind="'Sports'"></span> <span ng-bind="'Weekly Cash Rebate' | translate"></span> 0.35%<span>!</span>
            </strong>
            <p>
                <span class="text-center" ng-bind="'Earn unlimited cash rebate on your Sportsbook turnover!' | translate"></span>
            </p>
            <div class="game-button-play">
                <button type="button" class="btn btn-join" ng-bind="'Learn More' | translate"></button>
            </div>
        </div>
        <div class="promo-box promo-box3 no-margin" ng-click="displayPromoDetails(3)">
            <strong class="text-center">
                <span ng-bind="'Live Casino' | translate"></span> <span ng-bind="'Weekly Cash Rebate' | translate"> 0.8%</span><span>!</span>
            </strong>
            <p>
                <span ng-bind="'Earn unlimited cash rebate on your Live Casino turnover!' | translate"></span>
            </p>
            <div class="game-button-play">
                <button type="button" class="btn btn-join" ng-bind="'Learn More' | translate"></button>
            </div>
        </div>
        <div class="promo-box promo-box4" ng-click="displayPromoDetails(4)">
            <strong class="text-center">
                5% <span ng-bind="'Daily Deposit' | translate"></span>
                <span ng-bind="'Bonus' | translate"></span><span>!</span>
            </strong>
            <p>
                <span ng-bind="'Earn' | translate"></span> 5%
                <span ng-bind="'up to' | translate"></span> THB 1000
                <span ng-bind="'once a day on your deposit!' | translate"></span>
            </p>
            <div class="game-button-play">
                <button type="button" class="btn btn-join" ng-bind="'Learn More' | translate"></button>
            </div>
        </div>
        <div class="promo-box promo-box5" ng-click="displayPromoDetails(5)">
            <strong class="text-center">
                <span ng-bind="'Friend' | translate"></span>
                <span ng-bind="'Referral' | translate"></span>
                <span ng-bind="'Bonus' | translate"></span><span>!</span>
            </strong>
            <p>
                <span class="text-center" ng-bind="'Earn unlimited cash on your friends turnover!' | translate"></span>
            </p>
            <div class="game-button-play">
                <button type="button" class="btn btn-join" ng-bind="'Learn More' | translate"></button>
            </div>
        </div>
        <div class="promo-box promo-box6 no-margin" ng-click="displayPromoDetails(6)">
            <strong class="text-center">
                <span ng-bind="'Loyalty Points' | translate"></span><span>!</span>
            </strong>
            <p>
                <span class="text-center" ng-bind="'Earn Loyalty Points everytime you make a deposit' | translate"></span><span>!</span>
            </p>
            <div class="game-button-play">
                <button type="button" class="btn btn-join" ng-bind="'Learn More' | translate"></button>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>