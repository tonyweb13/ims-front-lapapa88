<?session_start()?>
<div id="popup-resetpass" ng-controller="ChangePasswordPopupController">
    <div class="popup-content">
        <div class="icon-resetpass"></div>
        <h1 ng-bind="'Reset Your Password' | translate"></h1>
        <h4><span ng-bind="'Your temporary password has been expired' | translate"></span>. <br>
            <span ng-bind="'Please reset your password first to access your account' | translate"></span></h4>
        <form novalidate  ng-submit="processForm()" class="resetpass-form">
            <div>
                <label ng-bind="'Current Password' | translate"></label>
                <p>
                    <input type="password" placeholder="" ng-model="changePwd.password" class="inputField" />
                </p>
                <div class="clear"></div>
            </div>
            <div>
                <label ng-bind="'New Password' | translate"></label>
                <p>
                    <input type="password" placeholder="" ng-model="changePwd.newPassword" class="inputField" />
                </p>
                <div class="clear"></div>
            </div>
            <div>
                <label ng-bind="'Confirm New Password' | translate"></label>
                <p>
                    <input type="password" placeholder=""  ng-model="changePwd.newConfirmPassword" class="inputField" />
                </p>
                <div class="clear"></div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-submit" ng-disabled="isProcessing" ng-bind="'Reset Password' | translate"></button>
            </div>
        </form>
    </div>
</div>