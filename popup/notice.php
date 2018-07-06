<?
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/setCasinoName.php";
?>
<div id="popup-notice" ng-init="readBoardContent()">
    <h1><?=$casinoName?> <span ng-bind="'Announcements' | translate"></span></h1>
    <div class="clear"></div>

    <div class="notice-container">
        <h2>
            <strong ng-bind="anouncementPopup.title | translate"></strong>
            <span ng-bind="anouncementPopup.updateDate | userDate"></span>
        </h2>

        <div class="popup-content" ng-bind-html="anouncementPopup.readContents | nl2br">

        </div>
        <div class="close-notice" ng-click="notToday()" ng-bind="'Do not show this message for today' | translate"></div>
    </div>
</div>