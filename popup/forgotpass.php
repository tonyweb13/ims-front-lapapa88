<?session_start()?>
<div id="popup-forgotpass">
    <!--<div class="popup-close"><i class="icon-close-popup"></i></div>-->

    <div class="popup-tabs" ng-controller="TabController as tab">
        <ul class="popTabs">
            <li ng-class="{active:tab.isSet(1)}" ng-click="tab.setTab(1)"><i class="icon-popup-forgotpass"></i>&nbsp; <label ng-bind="'Forgot Password' | translate"></label></li>
            <li ng-class="{active:tab.isSet(2)}" ng-click="tab.setTab(2)"><i class="icon-popup-forgotid"></i>&nbsp; <label ng-bind="'Forgot ID' | translate"></label></li>
        </ul>
        <div class="clear"></div>

        <div ng-show="tab.isSet(1)">
            <div class="forgotpass-form" ng-controller="ForgotPasswordController">
                <div ng-hide="correctInfo">
                    <h1><span ng-bind="'Forgot Password' | translate"></span><span>?</span></h1>
                    <h4 ng-bind="'Enter your username and email address below and we\'ll send you instructions on how to reset your password' | translate"></h4>
                    <form ng-submit="processForm()" novalidate>
                        <div>
                            <label ng-bind="'User ID' | translate"></label>
                            <p>
                                <input type="text" ng-model="forgotPwd.nickname" />
                            </p>
                            <div class="clear"></div>
                        </div>
                        <div>
                            <label ng-bind="'Security Question' | translate"></label>
                            <p>
                                <select class="form-control" name="securityQuestionNo" ng-model="forgotPwd.securityQuestionNo"
                                        ng-options="c.questionNo as c.questionDescription for c in getQuestion">
                                    <option value="" selected="selected" ng-bind="'Please Select Question' | translate"></option>
                                </select>
                            </p>
                            <div class="clear"></div>
                        </div>
                        <div>
                            <label ng-bind="'Security Answer' | translate"></label>
                            <p>
                                <input type="text" class="form-control" name="securityAnswer" ng-model="forgotPwd.securityAnswer"/>
                            </p>
                            <div class="clear"></div>
                        </div>
                        <button class="btn btn-dark btn-submit" ng-disabled="isProcessing" ng-bind="'Submit' | translate"></button>
                    </form>
                    <div class="clear"></div>
                </div>
                <div ng-show="correctInfo">
                    <h1 ng-bind="'Temporary Password' | translate"></h1>
                    <h4><span ng-bind="'Your temporary password is' | translate"></span><span> :</span></h4>
                    <div class="text-center" style="margin: 5px 0;">
                        <i class="icon-key"></i>
                        <span ng-bind="getTempPwd | translate"></span>
                        <div class="clear"></div>
                    </div>
                    <h4 ng-bind="'Use this to access your account You can change this to a new password once logged in' | translate"></h4>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div ng-show="tab.isSet(2)">
            <div class="forgotpass-form" ng-controller="ForgotNicknameController">
                <div ng-hide="correctInfo">
                    <h1><span ng-bind="'Forgot User ID' | translate"></span><span>?</span></h1>
                    <h4 ng-bind="'Enter your email address below and we\'ll send you instructions on how to reset your password' | translate"></h4>
                    <form ng-submit="processForm()" novalidate>
                        <div>
                            <label style="width: 77px;" ng-bind="'Email' | translate"></label>
                            <p>
                                <input type="text" ng-model="forgotNick.email" value="syoon3@aaa.com"/>
                            </p>
                        </div>
                        <button type="submit" class="btn btn-dark btn-submit" ng-disabled="isProcessing" ng-bind="'Submit' | translate"></button>
                    </form>
                    <div class="clear"></div>
                </div>
                <div ng-show="correctInfo">
                    <h1 ng-bind="'User ID' | translate"></h1>
                    <h4><span ng-bind="'The User ID account is' | translate"></span><span>:</span></h4>
                    <div class="text-center" style="margin: 5px 0;">
                        <i class="icon-user"></i>
                        <span ng-repeat="nickName in getNickNameList" ng-bind="nickName"></span>
                        <div class="clear"></div>
                    </div>
                    <h4></h4>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>