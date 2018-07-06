<div class="customer-service-button" ng-repeat="contractSns in contactSnsList">
    <div id="agentSns0">
        <i class="icon-{{contractSns.snsName | lowercase}}"></i>
        <strong ng-bind="contractSns.snsName | translate"></strong>
        <span ng-bind="contractSns.snsId | translate"></span>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>

<div class="customer-livechat border-round">
    <i class="icon-livechat"></i>
    <strong ng-bind="'Live Chat' | translate"></strong>
    <h5 onclick="LC_API.open_chat_window();return false;"><span ng-bind="'Click Here' | translate"></span><i class="icon-arrow-click"></i></h5>
    <div class="clear"></div>
</div>
<div class="clear"></div>

<div class="customer-service-button2 border-round">
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td class="customer-service-title" ng-bind="'Hotline' | translate"></td>
            <td id="hotLine" class="customer-service-number">
                <span ng-repeat="contracttPhone in contactPhoneList" ng-bind="contracttPhone"></span>
            </td>
        </tr>
    </table>
    <div class="clear"></div>
</div>
<div class="customer-service-button2 border-round">
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td class="customer-service-title" ng-bind="'Email' | translate"></td>
            <td id="agentEmail" class="customer-service-detail">
                <a ng-repeat="contracttEmail in contactEmailList" ng-href="mailto:{{contracttEmail}}" ng-bind="contracttEmail"></a>
            </td>
        </tr>
    </table>
    <div class="clear"></div>
</div>
<div class="clear"></div>