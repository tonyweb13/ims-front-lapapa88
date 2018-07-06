<?session_start()?>
<div id="popup-login" ng-controller="LoginController">
    <!--<div class="popup-close"><i class="icon-close-signup"></i></div>-->
    <div class="login-form">
        <div class="login-logo"></div>
        <h4 ng-bind="'Please login to access your account' | translate"></h4>

        <form ng-submit="processForm()">
            <div>
                <input type="text" name="nickname" ng-model="loginForm.nickname" class="login-input-user" placeholder="{{ 'User ID' | translate}}" ng-cloak>
            </div>
            <div>
                <input type="password" name="password" ng-model="loginForm.password"  class="login-input-pass" placeholder="{{ 'Password' | translate}}" ng-cloak>
            </div>
            <button type="submit" class="btn btn-dark btn-submit" ng-disabled="isProcessing" ng-bind="'Login' | translate"></button>
        </form>
        <p>
            <span class="link-signup" ng-click="displaySignUp()"><span ng-bind="'Not yet a member' | translate"></span>? <span ng-bind="'Sign Up Here' | translate"></span>!</span>
            <span class="link-forgotpassword" ng-click="displayForgotPass()"><span ng-bind="'Forgot Password' | translate"></span>?</span>
        </p>
        <div class="clear"></div>
    </div>
</div>