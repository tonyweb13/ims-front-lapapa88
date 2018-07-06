app.controller("SignUpController", function($scope,$rootScope,$http, $window, SweetAlert, $translate) {
    $scope.isProcessing = undefined; //Disabled button after call ajax function
    $scope.signForm = {};
    $scope.sendSmsFrom = {};
    $scope.userInfo = {};
    $scope.Years = {};
    $scope.isSend = false;
    $scope.isProcessing = false;
    $scope.selectedIndex = 0; /* first one set active by default */
    $scope.selectGender= function(i) {
        $scope.selectedIndex=i;
    };

    $scope.sendVerifyCode = function(){
        if(!$scope.isProcessing) {
            $scope.isProcessing=true;
            var countryData = $("#signUpPhone").intlTelInput("getSelectedCountryData");
            $scope.sendSmsFrom.dialCode = countryData.dialCode;
            $scope.sendSmsFrom.phone = $scope.signForm.phone;

            var url = "../api/player/VerifySmsReq";
            $http({
                method: 'POST',
                url: url,
                data: $.param($scope.sendSmsFrom), // pass in data as strings
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                } // set the headers so angular passing info as form data (not request payload)
            }).success(function (data) {
                if (data.status == 200) {
                    $scope.isSend = true;
                } else {
                    if (data.alert) {
                        if (bowser.msie && bowser.version <= 8) {
                            alert(data.message);
                        } else {
                            $translate([data.message, "PleaseTryAgain"]).then(function (translations) {
                                SweetAlert.swal(translations[data.message], translations.PleaseTryAgain, "error");
                            });
                        }
                    }
                }
            }).error(function (data, status) {
                console.error('Repos error', status, data);
            })["finally"](function () {
                $scope.isProcessing = false;
            });
        }
    };

    $scope.smsVerification = function(){
        if(!$scope.isProcessing) {
            $scope.isProcessing=true;
            var countryData = $("#signUpPhone").intlTelInput("getSelectedCountryData");
            $scope.verifyFrom.dialCode = countryData.dialCode;
            $scope.verifyFrom.phone = $scope.signForm.phone;
            $scope.verifyFrom.verifyCd = $scope.signForm.verifyCd;

            var url = "../api/player/VerifySmsReq";
            $http({
                method: 'POST',
                url: url,
                data: $.param($scope.verifyFrom), // pass in data as strings
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                } // set the headers so angular passing info as form data (not request payload)
            }).success(function (data) {
                if (data.status == 200) {
                    $scope.isSend = true;
                } else {
                    if (data.alert) {
                        if (bowser.msie && bowser.version <= 8) {
                            alert(data.message);
                        } else {
                            $translate([data.message, "PleaseTryAgain"]).then(function (translations) {
                                SweetAlert.swal(translations[data.message], translations.PleaseTryAgain, "error");
                            });
                        }
                    }
                }
            }).error(function (data, status) {
                console.error('Repos error', status, data);
            })["finally"](function () {
                $scope.isProcessing = false;
            });
        }
    };

    $scope.processForm = function() {
        if(!$scope.isProcessing){
            $scope.isProcessing = true;
            var countryData = $("#signUpPhone").intlTelInput("getSelectedCountryData");
            $scope.signForm.dialCode=countryData.dialCode;
            var width = (screen.width) ? screen.width : '';
            var height = (screen.height) ? screen.height : '';
            // check for windows off standard dpi screen res
            if (typeof(screen.deviceXDPI) == 'number') {
                width *= screen.deviceXDPI / screen.logicalXDPI;
                height *= screen.deviceYDPI / screen.logicalYDPI;
            }
            var visitorTime = moment().format("YYYY-MM-DDTHH:mm:ss.SSSZZ");
            $scope.userInfo = {
                "clientLocalTime": visitorTime,
                "screenWidth": width,
                "screenHeight": height,
                "userCountryNo":$rootScope.getUserCountryNo
            };
            angular.extend($scope.signForm, $scope.userInfo);

             var url = "../api/player/SignUp";

            $http({
                method: 'POST',
                url: url,
                data: $.param($scope.signForm), // pass in data as strings
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                } // set the headers so angular passing info as form data (not request payload)
            }).success(function(data) {
                if (data.status == 200) {
                    $window.location.reload();
                } else {
                    console.log(JSON.stringify(data, null, 4));
                    if (data.alert) {
                        if (bowser.msie && bowser.version <= 8) {
                            alert(data.message);
                        } else {
                            $translate([data.message, "PleaseTryAgain"]).then(function (translations) {
                                SweetAlert.swal(translations[data.message], translations.PleaseTryAgain, "error");
                            });
                        }
                    }
                }
            }).error(function(data, status) {
                console.error('Repos error', status, data);
            })["finally"](function() {
                $scope.isProcessing = false;
            });
        }
    };

    var numberOfYears = new Date().getFullYear() - 18;
    var numberOfRange = 90;
    var years = $.map($(Array(numberOfRange)), function(val, i) {
        return numberOfYears - i;
    });

    var months = $.map($(Array(12)), function(val, i) {
        return i + 1;
    });
    var days = $.map($(Array(31)), function(val, i) {
        return i + 1;
    });

    var isLeapYear = function() {
        var year = $scope.signForm.birthYear || 0;
        return ((year % 400 === 0 || year % 100 !== 0) && (year % 4 === 0)) ? 1 : 0;
    };

    var getNumberOfDaysInMonth = function() {
        var selectMonths = $scope.signForm.birthMonth || 0;
        return 31 - ((selectMonths === 2) ? (3 - isLeapYear()) : ((selectMonths - 1) % 7 % 2));
    };

    $scope.UpdateNumberOfDays = function() {
        $scope.NumberOfDays = getNumberOfDaysInMonth();
    };

    $scope.Years = years;
    $scope.Months = months;
    $scope.Days = days;
    $scope.NumberOfDays = 31;

        $scope.signContinue = function () {
            $('.signup-box1').hide();
            $('.signup-box2').show();

            if($("input[name='playerName']").hasClass("ng-valid")
                && $("input[name='phone']").hasClass("ng-valid") && $("select[name='birthYear']").hasClass("ng-valid")
                && $("select[name='birthMonth']").hasClass("ng-valid") && $("select[name='birthDay']").hasClass("ng-valid")
                && $("select[name='securityQuestionNo']").hasClass("ng-valid") && $("input[name='securityAnswer']").hasClass("ng-valid")){
                $("#register").removeAttr("disabled");
            }else{
                $("#register").attr("disabled", true);
            }
        }

        $scope.signBack = function () {
            $('.signup-box1').show();
            $('.signup-box2').hide();
        }

    $scope.$watch($rootScope.getUserCountryCd,function () {
        var countryA2Array  = $.map($rootScope.countryA2List.split(","), $.trim);
        var hasCountry =false;
        if ($rootScope.getUserCountryCd != undefined ) {
            angular.forEach(countryA2Array,function(val){
                if(val==angular.lowercase($rootScope.getUserCountryCd)){
                    hasCountry=true;
                    $rootScope.getUserCountryPhoneCd = val;
                }
            });
            if(!hasCountry){
                $rootScope.getUserCountryPhoneCd = countryA2Array[0]
            }
        }else{
            $rootScope.getUserCountryPhoneCd = countryA2Array[0];
        }
    }, true);

    $scope.$watch($rootScope.getUserCountryNo,function () {
        if (!angular.equals({}, $rootScope.getCurrency) && !angular.equals({}, $rootScope.getUserCountryNo) ) {
            angular.forEach($rootScope.getCurrency, function (val) {
                if (val.currencyNo == $rootScope.getUserCountryNo) {
                    $scope.signForm.currencyNo = $rootScope.getUserCountryNo;
                }
            });

            if ($scope.signForm.currencyNo) {

            } else {
                $scope.signForm.currencyNo = $rootScope.getCurrency[0].currencyNo;
            }
        }
    }, true);

    $scope.$watch($rootScope.getUserCountryNo,function () {
        if (!angular.equals({}, $rootScope.getCountries) && !angular.equals({}, $rootScope.getUserCountryNo) ) {
            angular.forEach($rootScope.getCountries, function (val) {
                if (val.countryNo == $rootScope.getUserCountryNo) {
                    $scope.signForm.countryNo = $rootScope.getUserCountryNo;
                }
            });

            if ($scope.signForm.countryNo) {

            } else {
                $scope.signForm.countryNo = $rootScope.getCurrency[0].countryNo;
            }
        }
    }, true);

    $scope.$watch($rootScope.getCurrency,function () {
        if (!angular.equals({}, $rootScope.getCurrency) && !angular.equals({}, $rootScope.getUserCountryNo) ) {
            angular.forEach($rootScope.getCurrency, function (val) {
                if (val.currencyNo == $rootScope.getUserCountryNo) {
                    $scope.signForm.currencyNo = $rootScope.getUserCountryNo;
                }
            });

            if ($scope.signForm.currencyNo) {

            } else {
                $scope.signForm.currencyNo = $rootScope.getCurrency[0].currencyNo;
            }
        }
    }, true);

});

