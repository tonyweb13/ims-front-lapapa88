<?session_start()?>
<?include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/setCasinoName.php";?>
<div class="slide-menu-header">
    <i class="closeMenu" role="button" ng-click="closeLogin()"></i>
    <!--<button class="pull-right" type="button">Logout</button>-->
</div>

<div class="login-container" ng-controller="LoginController">
    <div class="logo" onclick="location.href='index.php'"><img src="/mobile/common/images/logo-login.png" /></div>
    <p ng-bind="'Please login to access your account' | translate"></p>
    <form ng-submit="processForm()">
        <div class="form-group">
            <input type="text" class="form-control input-sm" ng-model="loginForm.nickname" placeholder="{{ 'User ID' | translate}}" ng-cloak />
        </div>
        <div class="form-group">
            <input type="password" class="form-control input-sm" ng-model="loginForm.password" placeholder="{{ 'Password' | translate}}" ng-cloak />
        </div>
        <button type="submit" class="btn btn-form" ng-disabled="isProcessing" ng-bind="'Login' | translate"></button>
        <button type="button" class="btn btn-form" ng-click="openSignup()" ng-bind="'Create Account' | translate"></button>
        <button type="button" class="btn btn-form btn-gray" ng-click="openForgot()"><span ng-bind="'Forgot ID' | translate"></span> / <span ng-bind="'Password' | translate"></span></button>
    </form>
    <!--<p>If you encounter any issues while logging in,
        please contact our Customer Service for further assistance.
        This site uses the latest 256 BIT SSL
        server encryption mechanism.</p>-->

</div>

<div class="footer">
    <span>&copy; 2015 <?=$casinoName?>. <span ng-bind="'All Rights Reserved' | translate"></span></span>
    <a href="/mobile/pages/view.php?view=desktop" class="view-desktop" ng-bind="'View Desktop Version' | translate"></a>
</div>