<?session_start()?>
<div class="slide-menu-header">
            <i class="backMenu" role="button" ng-click="closeSignup()"></i>
            <span ng-bind="'Sign Up' | translate"></span>
        </div>

        <div class="signup-box1">
            <div class="header-steps">
                <strong class="pull-left" ng-bind="'Account Details' | translate"></strong>
                <strong class="pull-right" ng-bind="'Step 1 of 2' | translate"></strong>
                <div class="clearfix"></div>
            </div>

            <div class="signup-container">
                <form name="signUpContinue">
                    <div class="form-group">
                        <div ng-class="{'has-error' : signUpContinue.nickname.$invalid && !signUpContinue.nickname.$pristine, 'no-error' : signUpContinue.nickname.$valid}"
                             style="margin-top: 20px;">
                            <label><strong ng-bind="'User ID' | translate"></strong> <em>*</em></label>
                            <input type="text" class="form-control input-sm"
                                   name="nickname"
                                   ng-model="signForm.nickname"
                                   ng-pattern="/^[A-z0-9]*$/"
                                   maxlength="16"
                                   ng-minlength="4"
                                   ng-maxlength="16"
                                   user-name-duplicated
                                   required />
                            <div class="notes">4-16 (a-z, 0-9) <label ng-bind="'chars' | translate"></label>.</div>
                            <div class="error-message" ng-messages="signUpContinue.nickname.$error" ng-if="signUpContinue.nickname.$dirty">
                                <strong ng-show="signUpContinue.nickname.$pristine && signUpContinue.nickname.$dirty" ng-bind="'User ID is required' | translate"></strong>
                                <strong ng-show="signUpContinue.nickname.$error.duplicated" ng-bind="'This ID is already in use' | translate"></strong>
                                <strong ng-show="signUpContinue.nickname.$error.minlength" ng-bind="'User ID is too short' | translate"></strong>
                                <strong ng-show="signUpContinue.nickname.$error.maxlength" ng-bind="'User ID is too long' | translate"></strong>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div ng-class="{'has-error' : signUpContinue.password.$invalid && !signUpContinue.password.$pristine, 'no-error' : signUpContinue.password.$valid}">
                                <label><strong ng-bind="'Password' | translate"></strong>  <em>*</em></label>
                                <input type="password" class="form-control input-sm"
                                       name="password"
                                       ng-model="signForm.password"
                                       maxlength="16"
                                       ng-minlength="6"
                                       ng-maxlength="16"
                                       required />
                                <div class="notes">4-16 (a-z, 0-9) <label ng-bind="'chars' | translate"></label></div>
                                <div class="error-message" ng-messages="signUpContinue.password.$error" ng-if="signUpContinue.password.$dirty">
                                    <strong ng-show="signUpContinue.password.$invalid && signUpContinue.password.$pristine && signUpContinue.password.$dirty" ng-bind="'Password is required' | translate"></strong>
                                    <strong ng-show="signUpContinue.password.$error.minlength" ng-bind="'Password too short' | translate"></strong>
                                    <strong><span ng-show="signUpContinue.password.$error.maxlength" >6-16 <span ng-bind="'chars' | translate"></span>. <span ng-bind="'only' | translate"></span></span></strong>
                                 </div>
                            </div>
                        </div>
                    <div class="form-group">
                        <div ng-class="{'has-error' : signUpContinue.validPwd.$invalid && !signUpContinue.validPwd.$pristine, 'no-error' : signUpContinue.validPwd.$valid}">
                            <label ng-bind="'Confirm Password' | translate"> <em>*</em></label>
                            <input type="password" class="form-control input-sm"
                                   name="validPwd"
                                   ng-model="signForm.validPwd"
                                   maxlength="16"
                                   ng-minlength="6"
                                   ng-maxlength="16"
                                   valid-password-c
                                   required />
                            <div class="valid-message" ng-show="signUpContinue.validPwd.$valid">
                                <strong ng-bind="'Passwords Matched' | translate"></strong>
                            </div>
                            <div class="error-message" ng-messages="signUpContinue.validPwd.$error" ng-if="signUpContinue.validPwd.$dirty">
                                <strong ng-show="signUpContinue.validPwd.$error.minlength" ng-bind="'Password too short' | translate"></strong>
                                <strong><span ng-show="signUpContinue.password.$error.maxlength" >6-16 <span ng-bind="'chars' | translate"></span>. <span ng-bind="'only' | translate"></span></span></strong>
                                <strong ng-show="signUpContinue.validPwd.$invalid && signUpContinue.validPwd.$pristine && signUpContinue.validPwd.$dirty"  ng-bind="'Confirm your password' | translate"></strong>
                                <strong ng-show="signUpContinue.validPwd.$error.noMatch && signUpContinue.validPwd.$dirty"  ng-bind="'Passwords do not match' | translate""></strong>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div ng-class="{'has-error' : signUpContinue.email.$invalid && !signUpContinue.email.$pristine, 'no-error' : signUpContinue.email.$valid}">
                            <label><strong ng-bind="'Email' | translate"></strong> <em>*</em></label>
                            <input type="email" class="form-control input-sm"
                                   name="email"
                                   ng-model="signForm.email"
                                   validate-email
                                   required />
                            <div class="error-message" ng-messages="signUpContinue.email.$error" ng-if="signUpContinue.email.$dirty">
                                <strong ng-show="signUpContinue.email.$invalid && !signUpContinue.email.$pristine"  ng-bind="'Invalid Email' | translate"></strong>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div ng-class="{'has-error' : signUpContinue.currencyNo.$invalid && !signUpContinue.currencyNo.$pristine, 'no-error' : signUpContinue.currencyNo.$valid}">
                            <label><strong ng-bind="'Currency' | translate"></strong> <em>*</em></label>
                            <select class="form-control input-sm" name="currencyNo" ng-model="signForm.currencyNo" required
                                    ng-options="c.currencyNo as c.currencyIsoCd for c in getCurrency">
                                <option value="" selected="selected" ng-bind="'Please Select Currency' | translate"></option>
                            </select>
                            <div class="error-message" ng-messages="signUpContinue.currencyNo.$error" ng-if="signUpContinue.currencyNo.$dirty">
                                <strong ng-message="required" ng-bind="'Please select your preferred currency. Currency chosen is not changeable' | translate"></strong>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div ng-class="{'has-error' : signUpContinue.countryNo.$error.required && signUpContinue.countryNo.$dirty, 'no-error' : signUpContinue.countryNo.$valid}">
                            <label><strong ng-bind="'Country' | translate"></strong> <em>*</em></label>
                            <select class="form-control input-sm" name="countryNo" ng-model="signForm.countryNo" required
                                    ng-options="c.countryNo as c.countryName for c in getCountries">
                                <option value="" selected="selected" ng-bind="'Please Select Country' | translate"></option>
                            </select>
                            <label class="msg"></label>
                            <span ng-show="(signUpContinue.countryNo.$error.required && signUpContinue.countryNo.$dirty) || signUpContinue.countryNo.$pristine" class="error">
                        </div>
                    </div>
                    <div class="form-group">
                        <div ng-class="{'has-error' : signUpContinue.referrerNickName.$error.duplicated && signUpContinue.referrerNickName.$dirty,
                            'not-used' : signUpContinue.referrerNickName.$pristine,
                            'no-error' : signUpContinue.referrerNickName.$valid}">
                            <label><strong ng-bind="'Referrer ID' | translate"></strong> <em></em></label>
                            <input type="text" class="form-control input-sm inputReferrer" name="referrerNickName" ng-model="signForm.referrerNickName"
                                   referrer-check/>
                            <div class="error-message">
                                <strong  ng-show="signUpContinue.referrerNickName.$error.duplicated" ng-bind="'Referrer ID does not exists' | translate"></strong>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="continue" class="btn btn-form" ng-click="signContinue()" ng-disabled="signUpContinue.$invalid" ng-bind="'Continue to Step 2' | translate"></button>
                </form>
            </div>
        </div>

        <div class="signup-box2">
            <div class="header-steps">
                <strong class="pull-left" ng-bind="'Personal Information' | translate"></strong>
                <strong class="pull-right" ng-bind="'Step 2 of 2' | translate"></strong>
                <div class="clearfix"></div>
            </div>

            <div class="signup-container">
                <form name="signUpForm" novalidate ng-submit="processForm()">
                    <div ng-class="{'has-error' : signUpForm.playerName.$invalid && signUpForm.playerName.$pristine, 'no-error' : signUpForm.playerName.$valid}">
                            <div class="form-group">
                                <label><strong ng-bind="'Player Name' | translate"></strong> <em>*</em></label>
                                <input type="text" class="form-control input-sm"
                                       name="playerName"
                                       ng-model="signForm.playerName"
                                       maxlength="20"
                                       ng-minlength="2"
                                       ng-maxlength="30"
                                       ng-pattern="/^[a-zA-Z0-9\x20\@\,]*$/"
                                       required />
                                <div class="notes" ng-bind="'Player Name should match with Bank Account' | translate">

                                </div>
                                <div class="error-message" ng-messages="signUpContinue.playerName.$error" ng-if="signUpContinue.playerName.$dirty">
                                    <strong ng-show="signUpForm.playerName.$invalid && signUpForm.playerName.$pristine && signUpForm.playerName.$dirty" ng-bind="'Player name is required' | translate"></strong>
                                    <strong ng-show="signUpForm.playerName.$error.minlength" ng-bind="'Player name is too short' | translate"></strong>
                                    <strong ng-show="signUpForm.playerName.$error.maxlength" ng-bind="'Username is too long' | translate"></strong>
                                </div>
                            </div>
                        </div>
                    <div class="form-group">
                        <div ng-class="{'has-error' : signUpForm.phone.$invalid && !signUpForm.phone.$pristine, 'no-error' : signUpForm.phone.$valid}">
                                <label><stong ng-bind="'Phone Number' | translate"></stong> <em>*</em></label>
                                <input type="tel" class="form-control input-sm"
                                       id="signUpPhone"
                                       name="phone"
                                       international-phone-number
                                       ng-model="signForm.phone"
                                       only-countries={{countryA2List}}
                                       default-country={{getUserCountryPhoneCd}}
                                       required />
                                <div class="error-message" ng-messages="signUpForm.phone.$error" ng-if="signUpForm.phone.$dirty">
                                    <strong ng-show="signUpForm.phone.$error.required && signUpForm.phone.$error.$pristine"  ng-bind="'Invalid Phone Number' | translate"></strong>
                                    <strong ng-show="signUpForm.phone.$invalid"  ng-bind="'Invalid Phone Number' | translate"></strong>
                                </div>
                            </div>
                        </div>
                    <?if($_SESSION["playerVerifyTypeCd"] == 1){?>
                        <div class="form-group">
                            <div ng-class="{'has-error' : signUpForm.verifyCd.$dirty || signUpForm.verifyCd.$invalid && !signUpForm.verifyCd.$pristine && !isSend, 'no-error' : signUpForm.verifyCd.$valid && isSend}">
                                <label><strong ng-bind="'Verification Code' | translate"></strong> <em>*</em></label>

                                <button ng-show="!isSend" type="button" class="input-sm btn btn btn-form" ng-bind="'Send Verification Code'" style="padding: 0 34px;margin: 0;line-height: 26px;" ng-disabled="!signUpForm.phone.$valid" ng-click="sendVerifyCode();"></button>
                                <input ng-show="isSend" type="text" class="form-control input-sm txtPlayer"
                                       name="verifyCd"
                                       ng-model="signForm.verifyCd"
                                       ng-maxlength="6"
                                       ng-minlength="6"
                                       ng-pattern="/^[a-zA-Z0-9]*$/"
                                       required />

                                <!--<label ng-show="!isSend" class="msg" ng-bind="'Verify Phone Number' | translate"></label>
                                <label ng-show="isSend" class="msg" ng-bind="'Please Enter Verification Code' | translate"></label>
                                <span ng-show="signUpForm.verifyCd.$valid" class="valid"></span>-->
                                <div class="error-message" ng-show="(signUpForm.verifyCd.$error.required && signUpForm.verifyCd.$error.$pristine || signUpForm.verifyCd.$error.minlength || signUpForm.verifyCd.$error.maxlength || signUpForm.verifyCd.$invalid) && isSend">
                                    <strong class="error" ng-bind="'Please Enter Verification Code' | translate"></strong>
                                </div>
                            </div>
                        </div>
                    <?}?>
                    <div class="form-group">
                        <div ng-class="{'has-error' : signUpForm.birthDay.$invalid && !signUpForm.birthDay.$pristine
                        || signUpForm.birthMonth.$invalid && !signUpForm.birthMonth.$pristine
                        || signUpForm.birthYear.$invalid && !signUpForm.birthYear.$pristine, 'no-error' : signUpForm.birthYear.$valid && signUpForm.birthMonth.$valid && signUpForm.birthDay.$valid}">
                                <label><strong ng-bind="'Date of Birth' | translate"></strong> <em>*</em></label>
                                    <select id="birthDay" class="form-control input-sm selectDay"
                                            name="birthDay"
                                            ng-model="signForm.birthDay"
                                            required
                                            ng-options="day for day in Days | limitTo:NumberOfDays">
                                        <option value="" selected="selected" ng-bind="'Day' | translate"></option>
                                    </select>
                                <select id="birthMonth" class="form-control input-sm selectMonth"
                                        name="birthMonth"
                                        ng-model="signForm.birthMonth"
                                        required ng-options="month for month in Months" ng-change="UpdateNumberOfDays()">
                                    <option value="" selected="selected" ng-bind="'Month' | translate"></option>
                                </select>
                                <select id="birthYear" class="form-control input-sm selectYear"
                                        name="birthYear"
                                        ng-model="signForm.birthYear"
                                        required ng-options="year for year in Years" ng-change="UpdateNumberOfDays()">
                                    <option value="" selected="selected" ng-bind="'Year' | translate"></option>
                                </select>

                                <div class="error-message" ng-messages="signUpForm.birthDay.$error" ng-if="signUpForm.birthDay.$dirty">
                                    <strong ng-message="required" ng-bind="'Please Select Day of Birth' | translate"></strong>
                                </div>
                                <div class="error-message" ng-messages="signUpForm.birthMonth.$error" ng-if="signUpForm.birthMonth.$dirty">
                                    <strong ng-message="required" ng-bind="'Please Select Month of Birth' | translate"></strong>
                                </div>
                                <div class="error-message" ng-messages="signUpForm.birthYear.$error" ng-if="signUpForm.birthYear.$dirty">
                                    <strong ng-message="required" ng-bind="'Please Select Year of Birth' | translate"></strong>
                                </div>
                            </div>
                        </div>

                    <div class="form-group">
                        <div ng-class="{'has-error' : signUpForm.gender.$invalid && !signUpForm.gender.$pristine, 'no-error' : signUpForm.gender.$valid}">
                                    <label><strong ng-bind="'Gender' | translate"></strong> <em>*</em></label>
                                    <div class="btn-group btn-gender" data-toggle="buttons" ng-init="signForm.gender=1">
                                        <label class="btn" ng-repeat="gender in genderList" ng-click="selectGender($index)" ng-class="{' active': $index===selectedIndex}" >
                                            <input type="radio" ng-model="signForm.gender" name="gender" value="{{gender.genderNo}}" required/>
                                            <strong ng-bind="gender.genderName | translate"></strong>
                                        </label>
                                        <div class="clearfix"></div>
                                    </div>
                                <div class="error-message" ng-messages="signUpForm.gender.$error" ng-if="signUpForm.gender.$dirty">
                                    <strong ng-message="required" ng-bind="'Please Select Gender' | translate"></strong>
                                </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div ng-class="{'has-error' : signUpForm.securityQuestionNo.$invalid && !signUpForm.securityQuestionNo.$pristine, 'no-error' : signUpForm.securityQuestionNo.$valid}">
                                <label><strong ng-bind="'Security Question' | translate"></strong> <em>*</em></label>
                                <select class="form-control input-sm" name="securityQuestionNo" ng-model="signForm.securityQuestionNo" required
                                        ng-options="c.questionNo as c.questionDescription for c in getQuestion">
                                    <option value="" selected="selected" ng-bind="'Please Select Question' | translate"></option>
                                </select>
                                <div class="error-message" ng-messages="signUpForm.securityQuestionNo.$error" ng-if="signUpForm.securityQuestionNo.$dirty">
                                    <strong ng-message="required" ng-bind="'Security question is required' | translate"></strong>
                                </div>
                            </div>
                        </div>

                    <div class="form-group">
                        <div ng-class="{'has-error' : signUpForm.securityAnswer.$invalid && !signUpForm.securityAnswer.$pristine, 'no-error' : signUpForm.securityAnswer.$valid}">
                                <label><strong ng-bind="'Security Answer' | translate"></strong> <em>*</em></label>
                                <input type="text" class="form-control input-sm"
                                       id="securityAnswer"
                                       name="securityAnswer"
                                       ng-model="signForm.securityAnswer"
                                       required />
                                <div class="error-message" ng-messages="signUpForm.securityAnswer.$error" ng-if="signUpForm.securityAnswer.$dirty">
                                    <strong ng-message="required" ng-bind="'Security answer is required' | translate"></strong>
                                </div>
                            </div>
                        </div>
                    <p class="marginBottom">
                        <label ng-bind="'By clicking the REGISTER button, I hereby acknowledge that' | translate"></label>
                        <label ng-bind="'I am above 18 years old and have read and accepted your' | translate"></label>
                        <label><a href ng-click="openTerms()" ng-bind="'Terms & Conditions' | translate"></a></label>
                    </p>
                    <button type="button" class="btn btn-form btn-gray" ng-click="signBack()" ng-bind="'Back to Step 1' | translate"></button>
                    <button type="submit" id="register" class="btn btn-form" ng-disabled="signUpContinue.$invalid || signUpForm.$invalid || isProcessing" ng-bind="'Register' | translate"></button>
                </form>
            </div>
        </div>