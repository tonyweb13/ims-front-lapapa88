<div class="slide-menu-header">
    <i class="backMenu" role="button" ng-click="closeForgot()"></i>
    <span><strong ng-bind="'Forgot Password' | translate"></strong> <em>|</em> <strong ng-bind="'ID' | translate"></label></strong>
</div>

<div ng-controller="ForgotController as tab">
    <ul class="tabs">
        <li id="forgotPassword" ng-class="{ active:tab.isSet(1) }" ng-click="tab.setTab(1)" ng-bind="'Forgot Password' | translate"></li>
        <li id="forgotID"       ng-class="{ active:tab.isSet(2) }" ng-click="tab.setTab(2)" ng-bind="'Forgot ID' | translate"></li>
    </ul>
    <div class="clearfix"></div>
    <div ng-show="tab.isSet(1)" class="forgot-container" ng-controller="ForgotPasswordController">
        <div ng-hide="correctInfo">
                <form ng-submit="processForm()" novalidate>
                    <div class="error-danger" ng-show="error.status">
                        <div ng-bind="error.message"></div>
                    </div>
                    <div class="form-group">
                        <label ng-bind="'User ID' | translate"></label>
                        <input type="text" class="form-control input-sm" placeholder="{{ 'User ID' | translate}}" ng-cloak ng-model="forgotPwd.nickname" />
                    </div>
                    <div class="form-group">
                        <label ng-bind="'Security Question' | translate"></label>
                        <select class="form-control input-sm marginBottom" name="securityQuestionNo" ng-model="forgotPwd.securityQuestionNo"
                                ng-options="c.questionNo as c.questionDescription for c in getQuestion">
                            <option value="" selected="selected" ng-bind="'Please Select Question' | translate"></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label ng-bind="'Security Answer' | translate"></label>
                        <input type="text" class="form-control input-sm" placeholder="" name="securityAnswer" ng-model="forgotPwd.securityAnswer" />
                    </div>
                    <button type="submit" class="btn btn-form" ng-disabled="isProcessing" ng-bind="'Submit' | translate"></button>
                </form>
            <div class="clear"></div>
        </div>
        <div ng-show="correctInfo" class="form-group" align="center">
            <h3 ng-bind="'Temporary Password' | translate"></h3>
            <hr>
            <p ng-bind="'Your temporary password is' | translate"></p>
            <p>
                <i class="icon-key"></i>
                <strong ng-bind="getTempPwd | translate"></strong>
            </p>
            <p ng-bind="'Use this to access your account You can change this to a new password once logged in' | translate"></p>
        </div>
    </div>
    <div ng-show="tab.isSet(2)" class="forgot-container" ng-controller="ForgotNicknameController">
        <div ng-hide="correctInfo">
            <form ng-submit="processForm()" novalidate>
                <div class="form-group">
                    <label ng-bind="'Email' | translate"></label>
                    <input type="email" class="form-control input-sm" ng-model="forgotNick.email" value="syoon3@aaa.com" placeholder="{{'Please Enter Email' | translate}}" />
                </div>
                <button type="submit" class="btn btn-form" ng-disabled="isProcessing" ng-bind="'Submit' | translate"></button>
            </form>
        </div>
        <div ng-show="correctInfo" class="form-group" align="center">
            <h3 ng-bind="'User ID' | translate"></h3>
            <hr>
            <p ng-bind="'The User ID account is' | translate"></p>
            <p>
                <i class="icon-userID"></i>
                <strong ng-repeat="nickName in getNickNameList" ng-bind="nickName"></strong>
            </p>
        </div>
    </div>
</div>