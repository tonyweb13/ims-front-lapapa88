<?session_start()?>
<div class="signup-form" ng-class="signup()">
    <h1><span ng-bind="'Welcome to' | translate"></span> <img src="/common/images/logo-signup.png"></h1>
    <h4><span  ng-bind="'Register Now and Enjoy our Exciting Games' | translate"></span><span>!</span></h4>

        <!--<pre>{{signForm.$valid}}</pre>
        <pre>{{signUpForm.$valid}}</pre>-->
        <div class="signUpDiv">
            <div class="signUpDivInner">
                <form name="signUpContinue">
                <div class="signup-box signup-box1 float-left" >
                    <div ng-class="{'has-error' : signUpContinue.nickname.$invalid && !signUpContinue.nickname.$pristine, 'no-error' : signUpContinue.nickname.$valid}"
                        style="margin-top: 20px;">
                        <label><em>*</em> <span ng-bind="'User ID' | translate"></span> </label>
                        <input type="text" class="form-control txtNickname"
                               name="nickname"
                               ng-model="signForm.nickname"
                               ng-pattern="/^[A-z0-9]*$/"
                               maxlength="16"
                               ng-maxlength="16"
                               user-name-duplicated
                               required ng-blur="hello()"/>
                        <label class="msg">4-16 (a-z, 0-9) <span ng-bind="'chars' | translate"></span>.</label>
                        <span ng-show="signUpContinue.nickname.$valid" class="valid" ng-bind="'User ID Available' | translate"></span>
                        <span ng-show="signUpContinue.nickname.$pristine && signUpContinue.nickname.$dirty" class="error" ng-bind="'User ID is required' | translate"></span>
                        <span ng-show="signUpContinue.nickname.$error.duplicated"  class="error" ng-bind="'This ID is already in use' | translate"></span>
                        <span ng-show="signUpContinue.nickname.$error.maxlength" class="error" ng-bind="'User ID is too long' | translate"></span>
                        <span ng-show="signUpContinue.nickname.$error.minlength" class="error" ng-bind="'User ID is too short' | translate"></span>
                    </div>
                    <div ng-class="{'has-error' : signUpContinue.password.$invalid && !signUpContinue.password.$pristine, 'no-error' : signUpContinue.password.$valid}">
                        <label><em>*</em> <span ng-bind="'Password' | translate"></span> </label>
                        <input type="password" class="form-control txtPass"
                               name="password"
                               ng-model="signForm.password"
                               maxlength="16"
                               ng-minlength="6"
                               ng-maxlength="16"
                               required />
                        <label class="msg">6-16 <span ng-bind="'chars' | translate"></span>. <span ng-bind="'only' | translate"></span></label>
                        <span ng-show="signUpContinue.password.$valid" class="valid"></span>
                        <span ng-show="signUpContinue.password.$invalid && signUpContinue.password.$pristine && signUpContinue.password.$dirty" class="error" ng-bind="'Password is required' | translate"></span>
                        <span ng-show="signUpContinue.password.$error.minlength" class="error" ng-bind="'Password too short' | translate"></span>
                        <span ng-show="signUpContinue.password.$error.maxlength" class="error">6-16 <span ng-bind="'chars' | translate"></span>. <span ng-bind="'only' | translate"></span></span>
                    </div>
                    <div ng-class="{'has-error' : signUpContinue.validPwd.$invalid && !signUpContinue.validPwd.$pristine, 'no-error' : signUpContinue.validPwd.$valid}">
                        <label><em>*</em> <span ng-bind="'Confirm Password' | translate"></span></label>
                        <input type="password"
                               name="validPwd"
                               class="form-control txtPass2" maxlength="16" ng-model="signForm.validPwd" ng-minlength="6" ng-maxlength="16" valid-password-c required />
                        <label class="msg"></label>
                        <span ng-show="signUpContinue.validPwd.$valid" class="valid" ng-bind="'Passwords Matched' | translate"></span>
                        <span ng-show="signUpContinue.validPwd.$invalid && signUpContinue.validPwd.$pristine && signUpContinue.validPwd.$dirty" class="error" ng-bind="'Confirm your password' | translate"></span>
                        <span ng-show="signUpContinue.validPwd.$error.noMatch && signUpContinue.validPwd.$dirty" class="error" ng-bind="'Passwords do not match' | translate"></span>
                    </div>
                    <div ng-class="{'has-error' : signUpContinue.email.$invalid && !signUpContinue.email.$pristine, 'no-error' : signUpContinue.email.$valid}">
                        <label><em>*</em> <span ng-bind="'Email' | translate"></span></label>
                        <p>
                            <input type="email" validate-email name="email" ng-model="signForm.email" class="form-control txtEmail" required />
                        </p>
                        <label class="msg" ng-bind="'Please Enter Email' | translate"></label>
                        <span ng-show="signUpContinue.email.$valid" class="valid"></span>
                        <span ng-show="signUpContinue.email.$invalid && !signUpContinue.email.$pristine" class="error" ng-bind="'Enter a valid email' | translate"></span>
                        <span ng-show="signUpContinue.email.$error.email" class="error" ng-bind="'Invalid Email' | translate"></span>
                    </div>
                    <div ng-class="{'has-error' : signUpContinue.currencyNo.$error.required && signUpContinue.currencyNo.$dirty, 'no-error' : signUpContinue.currencyNo.$valid}">
                        <label><em>*</em> <span ng-bind="'Currency' | translate"></span></label>
                        <p>
                            <select class="form-control txtCurrency" name="currencyNo" ng-model="signForm.currencyNo" required
                                    ng-options="c.currencyNo as c.currencyIsoCd for c in getCurrency">
                                <option value="" selected="selected" ng-bind="'Please Select Currency' | translate"></option>
                            </select>
                        </p>
                        <label class="msg"></label>
                        <span ng-show="(signUpContinue.currencyNo.$error.required && signUpContinue.currencyNo.$dirty) || signUpContinue.currencyNo.$pristine" class="error">
                        <i class="icon-info icon-tip-currency"></i>
                        <div class="tooltip tooltipCurrency border-round" ng-bind="'Currency is not changeable' | translate">
                            <br />
                            <div ng-bind="'Currency chosen is not changeable' | translate"></div>
                        </div>
                        </span>
                    </div>
                    <div ng-class="{'has-error' : signUpContinue.countryNo.$error.required && signUpContinue.countryNo.$dirty, 'no-error' : signUpContinue.countryNo.$valid}">
                        <label><em>*</em> <span ng-bind="'Country' | translate"></span></label>
                        <p>
                            <select class="form-control txtCurrency" name="countryNo" ng-model="signForm.countryNo" required
                                    ng-options="c.countryNo as c.countryName for c in getCountries">
                                <option value="" selected="selected" ng-bind="'Please Select Country' | translate"></option>
                            </select>
                        </p>
                        <label class="msg"></label>
                        <span ng-show="(signUpContinue.countryNo.$error.required && signUpContinue.countryNo.$dirty) || signUpContinue.countryNo.$pristine" class="error">
                    </div>
                    <div ng-class="{'has-error' : signUpContinue.referrerNickName.$error.duplicated && signUpContinue.referrerNickName.$dirty,
                    'not-used' : signUpContinue.referrerNickName.$pristine,
                    'no-error' : signUpContinue.referrerNickName.$valid}">
                        <label ng-bind="'Referrer ID' | translate"></label>
                        <input type="text" class="form-control txtReferrer" name="referrerNickName" ng-model="signForm.referrerNickName"
                               referrer-check/>
                        <label class="msg">4-16 (a-z, 0-9) <span ng-bind="'chars' | translate"></span>. </label>
                        <span ng-show="signUpContinue.referrerNickName.$error.duplicated" class="error" ng-bind="'Referrer ID does not exist' | translate"></span>
                    </div>

                    <div class="signup-terms">
                        <p style="line-height: 54px; font-size: 10px;">* <em ng-bind="'Required Fields' | translate"></em></p>
                        <button type="button" class="btn btn-signup-continue" ng-click="signContinue()" ng-disabled="signUpContinue.$invalid" ng-bind="'Continue' | translate"></button>
                    </div>
                </div>
            </form>
            </div>

            <div class="signUpDivInner2" style="z-index: -1;">
                <form name="signUpForm" novalidate ng-submit="processForm()" >
                <div class="signup-box signup-box2 float-right">
                    <button type="button" class="btn btn-signup-back" ng-click="signUpBack()" ng-bind="'Back' | translate"></button>
                    <div ng-class="{'has-error' : signUpForm.playerName.$invalid && !signUpForm.playerName.$pristine, 'no-error' : signUpForm.playerName.$valid}" style="margin-top: 12px;">
                        <label><em>*</em> <span ng-bind="'Player Name' | translate"></span> </label>
                        <input type="text" class="form-control txtPlayer"
                               name="playerName"
                               ng-model="signForm.playerName"
                               maxlength="40"
                               ng-minlength="2"
                               ng-maxlength="40"
                               required />
                        <label class="msg" ng-bind="'Match with Bank Account' | translate"></label>
                        <span ng-show="signUpForm.playerName.$invalid && signUpForm.playerName.$pristine && signUpForm.playerName.$dirty" class="error" ng-bind="'Username is required' | translate"></span>
                        <span ng-show="signUpForm.playerName.$error.minlength" class="error" ng-bind="'Username is too short' | translate"></span>
                        <span ng-show="signUpForm.playerName.$error.maxlength" class="error" ng-bind="'Username is too long' | translate">.</span>
                    </div>

                    <div ng-class="{'has-error' : signUpForm.phone.$dirty || signUpForm.phone.$invalid && !signUpForm.phone.$pristine, 'no-error' : signUpForm.phone.$valid}">
                        <label><em>*</em> <span ng-bind="'Phone Number' | translate"></span></label>
                        <p>
                            <input type="text" class="form-control txt_phoneNo"
                                   id="signUpPhone"
                                   name="phone"
                                   international-phone-number
                                   ng-model="signForm.phone"
                                   only-countries={{countryA2List}}
                                   default-country={{getUserCountryPhoneCd}}
                                   required />
                        </p>
                        <label class="msg" ng-bind="'Please Enter Number' | translate"></label>
                        <span ng-show="signUpForm.phone.$valid" class="valid"></span>
                        <span ng-show="signUpForm.phone.$error.required && signUpForm.phone.$error.$pristine" class="error" ng-bind="'Invalid Phone Number' | translate"></span>
                        <span ng-show="signUpForm.phone.$invalid" class="error" ng-bind="'Invalid Phone Number' | translate"></span>
                    </div>
                    <?if($_SESSION["playerVerifyTypeCd"] == 1){?>
                        <div ng-class="{'has-error' : signUpForm.verifyCd.$dirty || signUpForm.verifyCd.$invalid && !signUpForm.verifyCd.$pristine && !isSend, 'no-error' : signUpForm.verifyCd.$valid && isSend}">
                            <label><em>*</em> <span ng-bind="'Verification Code' | translate"></span></label>
                            <p>
                                <button ng-show="!isSend" type="button" class="btn btn-join" ng-bind="'Send Verification Code'" style="padding: 0 34px;margin: 0;line-height: 26px;" ng-disabled="!signUpForm.phone.$valid" ng-click="sendVerifyCode();"></button>
                                <input ng-show="isSend" type="text" class="form-control txtPlayer"
                                       name="verifyCd"
                                       ng-model="signForm.verifyCd"
                                       ng-maxlength="6"
                                       ng-minlength="6"
                                       ng-pattern="/^[a-zA-Z0-9]*$/"
                                       required />
                            </p>
                            <label ng-show="!isSend" class="msg" ng-bind="'Verify Phone Number' | translate"></label>
                            <label ng-show="isSend" class="msg" ng-bind="'Please Enter Verification Code' | translate"></label>
                            <span ng-show="signUpForm.verifyCd.$valid" class="valid"></span>
                            <span ng-show="(signUpForm.verifyCd.$error.required && signUpForm.verifyCd.$error.$pristine || signUpForm.verifyCd.$error.minlength || signUpForm.verifyCd.$error.maxlength || signUpForm.verifyCd.$invalid) && isSend" class="error" ng-bind="'Please Enter Verification Code' | translate"></span>
                        </div>
                    <?}?>
                    <div ng-class="{'has-error' : signUpForm.birthYear.$error.required && signUpForm.birthYear.$dirty || signUpForm.birthMonth.$error.required && signUpForm.birthMonth.$dirty || signUpForm.birthDay.$error.required && signUpForm.birthDay.$dirty, 'no-error' : signUpForm.birthYear.$valid && signUpForm.birthMonth.$valid && signUpForm.birthDay.$valid}">
                        <label><em>*</em> <span ng-bind="'Date of Birth' | translate"></span> </label>
                        <p>
                            <select id="birthYear" class="select_dateYear form-control"
                                    name="birthYear"
                                    ng-model="signForm.birthYear"
                                    required ng-options="year for year in Years" ng-change="UpdateNumberOfDays()">
                                <option value="" selected="selected" ng-bind="'Year' | translate"></option>
                            </select>
                            <select id="birthMonth" class="select_dateMonth form-control"
                                    name="birthMonth"
                                    ng-model="signForm.birthMonth"
                                    required ng-options="month for month in Months" ng-change="UpdateNumberOfDays()">
                                <option value="" selected="selected" ng-bind="'Month' | translate"></option>
                            </select>
                            <select id="birthDay" class="select_dateDay form-control"
                                    name="birthDay"
                                    ng-model="signForm.birthDay"
                                    required
                                    ng-options="day for day in Days | limitTo:NumberOfDays">
                                <option value="" selected="selected" ng-bind="'Day' | translate"></option>
                            </select>
                        </p>
                        <label class="msg" ng-bind="'At least 18 years old' | translate"></label>
                        <span ng-show="signUpForm.birthYear.$valid && signUpForm.birthMonth.$valid && signUpForm.birthDay.$valid" class="valid"></span>
                        <span ng-show="signUpForm.birthYear.$error.required && signUpForm.birthYear.$dirty" class="error" ng-bind="'Please Select Year of Birth' | translate"></span>
                        <span ng-show="signUpForm.birthMonth.$error.required && signUpForm.birthMonth.$dirty" class="error" ng-bind="'Please Select Month of Birth' | translate"></span>
                        <span ng-show="signUpForm.birthDay.$error.required && signUpForm.birthDay.$dirty" class="error" ng-bind="'Please Select Day of Birth' | translate"></span>
                    </div>
                    <div ng-class="{'has-error' : signUpForm.gender.$error.required && !signUpForm.gender.$pristine, 'no-error' : signUpForm.gender.$valid}">
                        <label><em>*</em> <span ng-bind="'Gender' | translate"></span></label>
                        <p class="select_gender" ng-repeat="gender in genderList" ng-init="signForm.gender=1">
                            <input type="radio" ng-model="signForm.gender" name="gender" value="{{gender.genderNo}}" required  /><span ng-bind="gender.genderName | translate"></span>
                        </p>
                        <span ng-show="signUpForm.gender.$error.required && signUpForm.gender.$dirty" class="error" ng-bind="'Gender is required' | translate"></span>
                    </div>
                    <div ng-class="{'has-error' : signUpForm.securityQuestionNo.$error.required && signUpForm.securityQuestionNo.$dirty, 'no-error' : signUpForm.securityQuestionNo.$valid}">
                        <label><em>*</em> <span ng-bind="'Security Question' | translate"></label>
                        <p>
                            <select class="form-control select_question" name="securityQuestionNo" ng-model="signForm.securityQuestionNo" required
                                    ng-options="c.questionNo as c.questionDescription for c in getQuestion">
                                <option value="" selected="selected" ng-bind="'Please Select Question' | translate"></option>
                            </select>
                        </p>
                        <span ng-show="signUpForm.securityQuestionNo.$error.required && signUpForm.securityQuestionNo.$dirty" class="error" ng-bind="'Question is required' | translate"></span>
                    </div>

                    <div ng-class="{'has-error' : signUpForm.securityAnswer.$invalid && !signUpForm.securityAnswer.$pristine, 'no-error' : signUpForm.securityAnswer.$valid}">
                        <label><em>*</em> <span ng-bind="'Security Answer' | translate"></span></label>
                        <input type="text" class="form-control txtAnswer" name="securityAnswer" ng-model="signForm.securityAnswer" required />
                        <label class="msg" ng-bind="'Enter Security Answer' | translate"></label>
                        <span ng-show="signUpForm.securityAnswer.$invalid && signUpForm.securityAnswer.$pristine && signUpForm.securityAnswer.dirty" class="error" ng-bind="'Answer is required' | translate"></span>
                    </div>
                    <button id="sing-up" type="submit" class="btn btn-dark btn-register" ng-disabled="signUpContinue.$invalid || signUpForm.$invalid || isProcessing" ng-bind="'Register' | translate" ></button>

                    <div class="signup-terms">
                        <p ng-bind="'By clicking the REGISTER button, I hereby acknowledge that' | translate"></p> <br>
                        <p ng-bind="'I am above 18 years old and have read and accepted your' | translate"></p><br>
                        <p ng-bind="'terms & conditions See the' | translate"></p>
                        <span class="link-terms" ng-bind="'Click Here' | translate"></span>.
                    </div>
                </div>
             </form>
            </div>
        </div>

    <div class="clear"></div>

    <div class="terms-container border-round">
        <h1 ng-bind="'Terms & Conditions' | translate"></h1>
        <i class="icon-close-terms"></i>
        <div class="terms-content border-round">
            <strong ng-bind="'Term Details' | translate"> 1</strong>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis
                nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie
                consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit
                praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend
                option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam;
                est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii
                legunt saepius.</p>
            <strong ng-bind="'Term Details' | translate"> 2</strong>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis
                nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie
                consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit
                praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend
                option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam;
                est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii
                legunt saepius.</p>
            <strong ng-bind="'Term Details' | translate"> 3</strong>
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis
                nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie
                consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit
                praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend
                option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam;
                est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii
                legunt saepius.</p>
        </div>
    </div>
</div>