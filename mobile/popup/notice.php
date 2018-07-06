<?session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/setCasinoName.php";
?>
<div id="popup-notice" class="popup" ng-init="readBoardContent()">
    <div class="slide-menu-header">
        <span><?=$casinoName?> <label ng-bind="'Announcements' | translate"></label></span>
        <div class="clear"></div>
    </div>
    <div class="ngDialog">
        <div class="notes-info">
            <h2>
                <strong ng-bind="anouncementPopup.title | translate"></strong>
                <span ng-bind="anouncementPopup.updateDate | userDate"></span>
            </h2>
        </div>

        <div class="popup-content" ng-bind-html="anouncementPopup.readContents | nl2br"></div>

        <button type="button" class="btn btn-form btn-gray" ng-click="notToday()" ng-bind="'Do not show this message for today' | translate"></button>
    </div>
</div>
