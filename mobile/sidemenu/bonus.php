<?session_start()?>
<div class="slide-menu-header">
    <i class="backMenu" role="button" ng-click="closeBonus()"></i>
    <span ng-bind="'Bonus Coupon' | translate"></span>
</div>
<div class="coupon-container" ng-controller="CouponController" ng-init="init();">
    <div class="coupon-item" ng-repeat="coupon in filteredPage">
        <h1 ng-bind="coupon.CouponName"></h1>
        <strong><i class="icon-balance"></i> <span ng-bind="coupon.CurrencyAmount.amount | currency:cc_currency_symbol[coupon.CurrencyAmount.currencyIsoCd]"></span></strong>
        <p ng-if="coupon.ExpirationDate"><i class="icon-expirydate"></i> <span ng-bind="coupon.ExpirationDate"></span></p>
        <p ng-if="!coupon.ExpirationDate"><i class="icon-expirydate"></i> <span ng-bind="'No Expiration Date' | translate"></span></p>
        <button type="button" class="btn btn-default" ng-if="coupon.Status=='Issued' | translate" ng-click="useCoupon(coupon.CouponCode)" ng-bind="'Use Coupon' | translate"></button>
        <button type="button" class="btn btn-default btn-gray" ng-if="coupon.Status=='Redeemed' | translate" ng-bind="coupon.Status | translate" disabled="disabled"></button>
    </div>
</div>