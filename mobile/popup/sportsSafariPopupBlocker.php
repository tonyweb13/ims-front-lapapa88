<?include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/detect_mobile.php";
$mobile_detect = new Mobile_Detect;?>
<div class="safari-notice popup">
    <h1><span ng-bind="'The site is attempting to open a popup window' | translate"></span>.</h1>
    <h2><span ng-bind="'To allow' | translate"></span>, <span ng-bind="'please turn off the popup blocker from safari settings' | translate"></span>.</h2>

    <?if($mobile_detect->isIOS() && $mobile_detect->version('iPhone')) {?>

        <div class="safari-iphone-block">
            <h3><span ng-bind="'Go to Settings' | translate"></span> &raquo; <span ng-bind="'Safari' | translate"></span></h3>
            <h4><span ng-bind="'Turn OFF' | translate"></span> '<span ng-bind="'Block Pop-ups' | translate"></span>'</h4>
        </div>

    <?} else if ($mobile_detect->isIOS() && ( $mobile_detect->version('iPad') || $mobile_detect->version('iPod')) ) {?>

        <div class="safari-ipad-block">
            <h3><span ng-bind="'Go to Settings' | translate"></span> &raquo; <span ng-bind="'Safari' | translate"></span></h3>
            <h4><span ng-bind="'Turn OFF' | translate"></span> '<span ng-bind="'Block Pop-ups' | translate"></span>'</h4>
        </div>

    <?}?>
</div>
<div class="ngdialog-close-btn" ng-click="closeThisDialog()"></div>