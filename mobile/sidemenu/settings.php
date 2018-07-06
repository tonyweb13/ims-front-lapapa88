<?session_start()?>
<div class="slide-menu-header">
    <i class="backMenu" role="button" ng-click="closeSettings()"></i>
    <span ng-bind="'Account Settings' | translate"></span>
</div>
<div ng-controller="SettingsController as tab">
    <ul class="tabs">
        <li id="settingsAccount"    ng-class="{ active:tab.isSet(1) }" ng-click="tab.setTab(1)" ng-bind="'Account Details' | translate"></li>
        <li id="settingsChangePass" ng-class="{ active:tab.isSet(2) }" ng-click="tab.setTab(2)" ng-bind="'Change Password' | translate"></li>
    </ul>
    <div class="clearfix"></div>
    <div ng-show="tab.isSet(1)" ng-controller="AccountDetailsController" ng-init="loadPlayerDetail();">
        <form name="editPlayerForm" novalidate ng-submit="processForm()">
            <div class="row-box" ng-show="error.status">
                <div class="error-danger"  ng-bind="error.message"></div>
            </div>
            <div class="slide-bar">
                <label ng-bind="'User ID' | translate"></label>
                <label class="pull-right" ng-bind="editPlayerForm.nickname"></label>
                <div class="clearfix"></div>
            </div>
            <div class="slide-bar">
                <label ng-bind="'Player Name' | translate"></label>
                <label class="pull-right" ng-bind="editPlayerForm.playerName"></label>
                <div class="clearfix"></div>
            </div>
            <div class="slide-bar">
                <label ng-bind="'Date of Birth' | translate"></label>
                <label class="pull-right" ng-bind="editPlayerForm.dateOfBirth | userDate"></label>
                <div class="clear"></div>
            </div>
            <div class="form-group">
                <label ng-bind="'Gender' | translate"></label>
                <div class="btn-group btn-gender" data-toggle="buttons" >
                    <label class="btn" ng-repeat="gender in genderList" ng-class="{' active': gender.genderNo == editPlayerForm.gender}">
                        <input type="radio"
                               ng-model="editPlayerForm.gender"
                               name="gender"
                               value="{{gender.genderNo}}"
                               required />
                        <strong ng-bind="gender.genderName | translate"></strong>
                    </label>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="form-group">
                <label ng-bind="'Email Address' | translate"></label>
                <input type="email" class="form-control input-sm" validate-email ng-model="editPlayerForm.email" required/>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label ng-bind="'Phone Number' | translate"></label>
                <input type="text" class="form-control input-sm"
                       id="editPlayerFormPhone"
                       name="phone"
                       international-phone-number
                       only-countries={{countryA2List}}
                       default-country={{playerDetail.countryCd}}
                       ng-model="editPlayerForm.phone"
                       required />
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label ng-bind="'Address' | translate"></label>
                <input type="text" class="form-control input-sm" ng-model="editPlayerForm.address" />
            </div>
            <div class="form-group">
                <label ng-bind="'Zip Code' | translate"></label>
                <input type="text" pattern="[0-9]*" class="form-control input-sm" ng-model="editPlayerForm.zipCode" />
            </div>
            <div class="form-group">
                <label ng-bind="'Country' | translate"></label>
                <select class="form-control input-sm" name="countryNo" ng-model="editPlayerForm.countryNo"
                        ng-options="c.countryNo as c.countryName | translate for c in getCountries" required>
                    <option value="" selected="selected" ng-bind="'Please Select Country' | translate"></option>
                </select>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label ng-bind="'Language' | translate"></label>
                <select class="form-control input-sm" ng-model="editPlayerForm.languageNo" required
                        ng-options="c.languageNo as c.languageName for c in getLanguages">
                    <option value="" selected="selected" ng-bind="'Please Select Language' | translate"></option>
                </select>
            </div>
            <button type="submit" class="btn btn-form marginBottom" ng-disabled="isProcessing" ng-bind="'Save' | translate"></button>
        </form>
    </div>

    <div ng-show="tab.isSet(2)" ng-controller="ChangePasswordController">
        <form name="changePasswordForm" novalidate  ng-submit="processForm()">
            <div class="form-group" ng-show="error.status">
                <div class="error-danger"  ng-bind="error.message"></div>
            </div>
            <div class="form-group">
                <label ng-bind="'Current Password' | translate"></label>
                <input type="password" class="form-control input-sm" placeholder="" ng-model="changePwd.password" required/>
            </div>
            <div class="form-group">
                <label ng-bind="'New Password' | translate"></label>
                <input type="password" class="form-control input-sm" placeholder="" ng-model="changePwd.newPassword" class="inputField" required/>
            </div>
            <div class="form-group">
                <label ng-bind="'Confirm Password' | translate"></label>
                <input type="password" class="form-control input-sm" placeholder="" ng-model="changePwd.newConfirmPassword" required/>
            </div>
            <button type="submit" class="btn btn-form" ng-disabled="isProcessing" ng-bind="'Save' | translate"></button>
        </form>
    </div>
</div>