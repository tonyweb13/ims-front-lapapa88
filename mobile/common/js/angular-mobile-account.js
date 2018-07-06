app.controller("SettingsController", function($scope, $rootScope, $http, $q) {
 this.tab = 1;
 this.isSet = function(checkTab) {
        return this.tab === checkTab;
    };

    this.setTab = function(setTab) {
        this.tab = setTab;
    };

    $scope.alreadyLoadCountryAndLangue=false;
    $scope.getCountryAndLanguage = function(){
        if(!$scope.alreadyLoadCountryAndLangue){
            $q.all([
                $http.get("../api/system/GetLanguageList", {
                    cache: true
                })
                    .success(function(data) {
                        if (data.status == 200) {
                            $rootScope.getLanguages = data.result.languageList;
                        }
                    }).error(function(data, status) {
                        console.error('Repos error', status, data);
                    })
            ]);
            $scope.alreadyLoadCountryAndLangue=true;
        }
    };

});

app.controller("AccountDetailsController", function($scope, $http, $rootScope,SweetAlert,$translate) {
    $scope.editPlayerForm =  $rootScope.playerDetail;
    $scope.error={};

    $scope.loadPlayerDetail = function() {
        var url = "../api/player/GetPlayerDetail";
        $http.get(url).success(function(data) {
            if (data.status == 200) {

                $scope.editPlayerForm = data.result;
                $rootScope.playerDetail = data.result;
                $("#editPlayerFormPhone").intlTelInput("setNumber", $rootScope.playerDetail.phone);
                $scope.getCountryAndLanguage();

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
        }).error(function(data, status) {
            console.error('Repos error', status, data);
        })["finally"](function() {

        });
    };

    $scope.processForm = function(){
        $scope.isProcessing = true;
        var url = "../api/player/EditPlayerDetail";
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.editPlayerForm), // pass in data as strings
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            } // set the headers so angular passing info as form data (not request payload)
        }).success(function (data) {
            $scope.error.status = false;
            if (data.status == 200) {
                if (bowser.msie && bowser.version <= 8) {
                    alert(data.message);
                    $scope.loadPlayerDetail();
                } else {
                    $translate([data.message]).then(function (translations) {
                        SweetAlert.swal(translations[data.message],"", "success");
                    });
                    $scope.loadPlayerDetail();
                    slideSettingsClose();
                    slideAccountClose();
                }
            } else {
                if (data.alert) {
                    if (bowser.msie && bowser.version <= 8) {
                        alert(data.message);
                    } else {
                        $scope.error.status = true;
                        slideSettingsOpen();
                        $translate([data.message, "PleaseTryAgain"]).then(function (translations) {
                            $scope.error.message = translations[data.message];
                        });
                    }
                }
            }
        }).error(function (data, status) {
            console.error('Repos error', status, data);
        })["finally"](function () {
            $scope.isProcessing = false;
        });

    };
});

app.controller("ChangePasswordController", function($scope, $http, SweetAlert, ngDialog, $translate) {
    $scope.changePwd = {};
    $scope.error={};

    $scope.processForm = function() {
        $scope.isProcessing = true;
        var url = "../api/player/ChangePassword";
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.changePwd), // pass in data as strings
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            } // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            $scope.error.status = false;
            if (data.status == 200) {
                if (bowser.msie && bowser.version <= 8) {
                    alert(data.message);
                } else {
                    $translate([data.message]).then(function (translations) {
                        SweetAlert.swal(translations[data.message],"","success");
                    });

                    slideSettingsClose();
                    slideAccountClose();
                }
                $scope.changePasswordForm.$setUntouched();
                $scope.changePwd ={};
            } else {
                if (data.alert) {
                    if (bowser.msie && bowser.version <= 8) {
                        alert(data.message);
                    } else {
                        $scope.error.status = true;
                        slideSettingsOpen();
                        $translate([data.message, "PleaseTryAgain"]).then(function (translations) {
                            $scope.error.message = translations[data.message];
                        });
                    }
                }
            }
        }).error(function(data, status) {
            console.error('Repos error', status, data);
        })["finally"](function() {
            $scope.isProcessing = false;
        });
    };
});

app.controller("ForgotController", function() {
    this.tab = 1;

    this.isSet = function(checkTab) {
        return this.tab === checkTab;
    };

    this.setTab = function(setTab) {
        this.tab = setTab;
    };
});

app.controller("ForgotPasswordController", function($scope, $http, SweetAlert, $translate) {
    $scope.getQuestion = {};
    $scope.forgotPwd = {};
    $scope.getTempPwd = {};
    $scope.correctInfo = false;
    $scope.isProcessing = false;
    $scope.error={};

    $http.get("../api/system/GetSecurityQuestionList", {
        cache: true
    })
        .success(function(data) {
            if (data.status == 200) {
                $scope.getQuestion = data.result.securityQstList;
            }
        }).error(function(data, status) {
            console.error('Repos error', status, data);
        });


    $scope.processForm = function() {
        $scope.isProcessing = true;
        var url = "../api/player/ForgotPassword";
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.forgotPwd), // pass in data as strings
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            } // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            $scope.error.status = false;
            if (data.status == 200) {
                $scope.getTempPwd = data.result.tempPassword;
                $scope.correctInfo = true;
            } else {
                if (data.alert) {
                    if (bowser.msie && bowser.version <= 8) {
                        alert(data.message);
                    } else {
                        $scope.error.status = true;
                        $translate([data.message, "PleaseTryAgain"]).then(function (translations) {
                            $scope.error.message = translations[data.message];
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

});

app.controller("ForgotNicknameController", function($scope, $http, SweetAlert, $translate) {
    $scope.forgotNick = {};
    $scope.correctInfo = false;
    $scope.isProcessing = false;

    $scope.processForm = function() {
        $scope.isProcessing = true;
        var url = "../api/player/ForgotNickname";
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.forgotNick), // pass in data as strings
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            } // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            if (data.status == 200) {
                $scope.getNickNameList = data.result.nicknameList;
                $scope.correctInfo = true;
            } else {
                if (data.alert) {
                    if (bowser.msie && bowser.version <= 8) {
                        alert(data.message);
                    } else {
                        slideForgotClose();
                        slideLoginClose();
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
});
