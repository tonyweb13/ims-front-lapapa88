var app = angular.module('casinoApp', ['ngSweetAlert', 'ngCurrencySymbol', 'ngRoute', 'ngCookies', 'ui.bootstrap', 'ngDialog', 'internationalPhoneNumber', 'pascalprecht.translate', 'ngCookies', 'validation', 'validation.rule'])
    .config(function($translateProvider,$routeProvider) {
        //for translate
        $translateProvider.useStaticFilesLoader({
            prefix: 'common/js/resources/locale-',
            suffix: '.json'
        });

        //default load when user already selected language from dropdown
        var jsCookieLang = document.cookie;
        var arrayLang = ["th_TH","ko_KR", "zh_CN","zh_TW", "ja_JP", "mm_MY", "mn_MO", "en_US", "km_CA"];

        var i;
        for (i = 0; i < arrayLang .length; i++) {
            if(jsCookieLang.search(arrayLang[i]) > 0 ){
                var setLang = arrayLang[i];
            }
        }

        if(setLang){
            //console.log(setLang);
            $translateProvider.preferredLanguage(setLang);

            if(setLang == "zh_TW"){
                $translateProvider.useLocalStorage(angular.lowercase(setLang.substring(3,5)));
                $('#language-flag').html('<i class="icon-lang language-tw"></i>');
                var font="taiwan.css";
            }else{
                $translateProvider.useLocalStorage(setLang.substring(0, 2));
                $('#language-flag').html('<i class=\"icon-lang language-'+setLang.substring(0, 2)+'\"></i>');

                if(setLang.substring(0,2) == "ko"){ var font="nanumgothic.css"; }
                else if(setLang.substring(0,2) == "ja"){ var font="japan.css"; }
                else if(setLang.substring(0,2) == "mm"){ var font="zawgyi.css"; }
                else if(setLang.substring(0,2) == "mn"){ var font="mongolian.css"; }
                else { var font="roboto.css"; }
            }

        }else {
            //user default browser language
            var userLang = navigator.language || navigator.userLanguage; //for IE8 = navigator.userLanguage
            var u;
            for (u = 0; u < arrayLang.length; u++) {
                if(arrayLang[u].search(userLang.replace("-","_")) == 0){
                    var browserLang = arrayLang[u].replace("-","_");
                }
            }

            if(browserLang == undefined){

                if(userLang.substring(0,2) == "ko"){ var font="nanumgothic.css"; }
                else if(userLang.substring(0,2) == "ja"){ var font="japan.css"; }
                else if(userLang.substring(0,2) == "mm"){ var font="zawgyi.css"; }
                else if(userLang.substring(0,2) == "mn"){ var font="mongolian.css"; }
                else { var font="roboto.css"; }

                $translateProvider.preferredLanguage(userLang.substring(0,2)+"_"+userLang.substring(3,5).toUpperCase());
                $('#language-flag').html('<i class="icon-lang language-'+userLang.substring(0,2)+'"></i>');
            }else{
                $translateProvider.preferredLanguage(browserLang);

                if(browserLang == "zh_TW"){
                    $('#language-flag').html('<i class="icon-lang language-tw"></i>');
                    var font="taiwan.css";

                }else{
                    $('#language-flag').html('<i class=\"icon-lang language-'+browserLang.substring(0, 2)+'\"></i>');

                    if(browserLang.substring(0,2) == "ko"){ var font="nanumgothic.css"; }
                    else if(browserLang.substring(0,2) == "ja"){ var font="japan.css"; }
                    else if(browserLang.substring(0,2) == "mm"){ var font="zawgyi.css"; }
                    else if(browserLang.substring(0,2) == "mn"){ var font="mongolian.css"; }
                    else { var font="roboto.css"; }
                }

            }

        }

        var fileref=document.createElement("link");
        fileref.setAttribute("rel", "stylesheet");
        fileref.setAttribute("href", "/common/css/fonts/"+font);

        if (typeof fileref!="undefined"){
            document.getElementsByTagName("head")[0].appendChild(fileref);
        }

        $translateProvider.useLocalStorage();
        $translateProvider.useSanitizeValueStrategy('escaped');

        //for route
        $routeProvider
            .when('/', {
                templateUrl: '/pages/main.php',
                controller: 'MainController'
            })
            .when('/mobile', {
                templateUrl: '/pages/mobile.php'
                //controller: 'MobileController'
            })
            .when('/slot', {
                templateUrl: '/pages/slot.php',
                controller: 'SlotController'
            })
            .when('/sports', {
                templateUrl: '/pages/sports.php',
                controller: 'SportsController'
            })
            .when('/others', {
                templateUrl: '/pages/others.php',
                controller: 'SportsController'
            })
            .when('/promotion', {
                templateUrl: '/pages/promo.php',
                controller: 'PromoController'
            })
            .otherwise({
                redirectTo: '/'
            });
    });


app.isUndefinedOrNull = function(val) {
    return angular.isUndefined(val) || val === null
};

app.run(['$rootScope', '$route','$location', function($rootScope, $routeChangeSuccess,$location ) {
    $rootScope.$on('$routeChangeSuccess', function() {
        $rootScope.gspNo = "";
        if($location.path() == "/sports"){
            $(".box-balance-container").css('top','-2px');
        }else{
            $(".box-balance-container").css('top','-12px');
        }
    });

    $rootScope.$on('ngDialog.closed', function (e, $dialog) {
        $rootScope.isNotngDialogOpened = true;
        //console.log('ngDialog closed: ' + $dialog.attr('id'));
    });
}]);

app.service("Balance", function($rootScope, $http, $window, SweetAlert, loggedInStatus) {
    return {
        getBalance: function(type) {
            if (type == "all") {
                $http.get("/api/finance/GetBalance")
                    .success(function(data) {
                        if (data.status == 200) {
                            $rootScope.mainBalance = data.result.mainBalance;
                            $rootScope.totalBalance = data.result.totalBalance;
                            $rootScope.gspBalanceList = data.result.orderedGspBalance;
                            $rootScope.gspBalanceListLength = data.result.orderedGspBalance.length;
                        } else {
                            if(data.status == 400){
                                if (data.alert) {
                                    $http.get("/api/player/Logout")
                                        .success(function() {
                                            loggedInStatus.setLoggedOutStatus();
                                        })["finally"](function() {
                                        $window.location.reload();
                                    });
                                }
                            }
                        }
                    }).error(function(data, status) {
                        console.error('Repos error', status, data);
                    })["finally"](function() {

                });
            } else if (type == "single") {
                $http.get("/api/finance/GetMainBalance")
                    .success(function(data) {
                        if (data.status == 200) {
                            $rootScope.mainBalance = data.result.mainBalance;
                        } else {
                            if(data.status == 400){
                                if (data.alert) {
                                    $http.get("/api/player/Logout")
                                        .success(function() {
                                            loggedInStatus.setLoggedOutStatus();
                                        })["finally"](function() {
                                        $window.location.reload();
                                    });
                                }
                            }
                        }
                    }).error(function(data, status) {
                        console.error('Repos error', status, data);
                    })["finally"](function() {

                });
            }
        }
    }
});

app.service('browser', ['$window', function($window) {
    return function() {
        var userAgent = $window.navigator.userAgent;
        var browsers = {chrome: /chrome/i, safari: /safari/i, firefox: /firefox/i, ie: /internet explorer/i};
        for(var key in browsers) {
            if (browsers[key].test(userAgent)) {
                return key;
            }
        }
        return 'unknown';
    }
}]);

app.service('loggedInStatus', function($rootScope) {
    return {
        setLoggedInStatus: function() {
            $rootScope.loggedIn = true;
            $rootScope.loggedOut = false;
        },
        setLoggedOutStatus: function() {
            $rootScope.loggedIn = false;
            $rootScope.loggedOut = true;
        }
    };
});

app.service('AmountService', function() {
    return {
        sumAmount: function(amount, amountSum) {
            //console.log(amountSum);
            if (amount == "NaN" || amount == "") {
                return parseFloat(amountSum);
            }
            amount = parseFloat(amount) + parseFloat(amountSum);
            return amount;
        },
        resetAmount: function() {
            return 0;
        }
    };
});

app.directive('format', ['$filter', function($filter) {
    return {
        require: '?ngModel',
        link: function(scope, elem, attrs, ctrl) {
            if (!ctrl) return;

            ctrl.$formatters.unshift(function(a) {
                if(attrs.format=="numberDecimal" || attrs.format=="number") {
                    return $filter("number")(ctrl.$modelValue)
                }

            });

            ctrl.$parsers.unshift(function(viewValue) {
                if (viewValue == "NaN") return 0;
                if(attrs.format=="numberDecimal"){
                    var plainNumber = viewValue.replace(/[^\d|\-+|\d\.\d|\d\.+]/g,'');
                    if(viewValue.slice(-1)!="."){
                        elem.val($filter("number")(plainNumber));
                    }
                }else if(attrs.format=="number"){
                    var plainNumber = viewValue.replace(/[^\d|\-+|\.+]/g,'');
                    elem.val($filter("number")(plainNumber));
                }
                return plainNumber;
            });
        }
    };
}]);

app.directive("addAmountList", function() {
    return {
        link: function(scope, element, attrs) {
            scope.data = scope[attrs["addAmountList"]];
        },
        restrict: "A",
        template: "<button type='button' class='btn btn-drkgray btn-option' ng-repeat='item in data' ng-click='addAmount(item.price)'>{{item.price | number}} {{item.currency}}</button>"
    }
});

//Email Validation
app.directive('validateEmail', function() {
    var EMAIL_REGEXP = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
    return {
        require: 'ngModel',
        restrict: '',
        link: function(scope, elm, attrs, ctrl) {
            if (ctrl && ctrl.$validators.email) {

                ctrl.$validators.email = function(modelValue) {
                    return ctrl.$isEmpty(modelValue) || EMAIL_REGEXP.test(modelValue);
                };
            }
        }
    };
});

//Matched Password Filter
app.directive('validPasswordC', function() {
    return {
        require: 'ngModel',
        link: function(scope, elm, attrs, ctrl) {
            var original;
            ctrl.$formatters.unshift(function(modelValue) {
                original = modelValue;
                return modelValue;
            });

            ctrl.$parsers.push(function(viewValue) {
                var noMatch = viewValue != scope.signUpContinue.password.$viewValue;
                ctrl.$setValidity('noMatch', !noMatch);
                return viewValue;
            });
        }
    }
});

//Duplicated Id Filter
app.directive('userNameDuplicated', function($http) {
    return {
        require: 'ngModel',
        link: function(scope, elm, attrs, ctrl) {
            var original;
            ctrl.$formatters.unshift(function(modelValue) {
                original = modelValue;
                return modelValue;
            });

            ctrl.$parsers.push(function(viewValue) {
                if (viewValue != undefined) {
                    if (viewValue.length >= 4) {
                        var url = "/api/player/CheckDuplicateData";
                        $http({
                            method: 'POST',
                            url: url,
                            data: $.param({
                                infoValue: viewValue,
                                infoType: 1
                            }),
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            }
                        }).success(function(data) {
                            if (data.result.isDuplicate) {
                                ctrl.$setValidity('duplicated', false);
                            } else {
                                ctrl.$setValidity('duplicated', true);
                            }
                            ctrl.$setValidity('minlength', true);

                        });

                        return viewValue;
                    } else {
                        ctrl.$setValidity('minlength', false);
                        return viewValue;
                    }
                } else {
                    ctrl.$setValidity('minlength', false);
                    return viewValue;
                }
            })
        }
    };
});


app.directive('referrerCheck', function($http) {
    return {
        require: 'ngModel',
        link: function(scope, elm, attrs, ctrl) {
            var original;
            ctrl.$formatters.unshift(function(modelValue) {
                original = modelValue;
                return modelValue;
            });

            ctrl.$parsers.push(function(viewValue) {
                if (viewValue != "") {
                    if (viewValue.length >= 4) {
                        var url = "/api/player/CheckDuplicateData";
                        $http({
                            method: 'POST',
                            url: url,
                            data: $.param({
                                infoValue: viewValue,
                                infoType: 1
                            }),
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            }
                        }).success(function(data) {
                            if (data.result.isDuplicate) {
                                ctrl.$setValidity('duplicated', true);
                            } else {
                                ctrl.$setValidity('duplicated', false);
                            }
                        });
                        return viewValue;
                    } else {
                        ctrl.$setValidity('duplicated', false);
                        return viewValue;
                    }
                } else {
                    ctrl.$setValidity('duplicated', true);
                    ctrl.$setPristine();
                    return viewValue;
                }
            })
        }
    };
});

app.filter('nl2br', ['$sce', function ($sce) {
    return function (text) {
        return text ? $sce.trustAsHtml(text.replace(/\n/g, '<br/>')) : '';
    };
}]);

app.filter('customCurrency', ["$filter", function ($filter) {
    return function(amount, currencySymbol){
        //console.log(amount);
        var number = $filter('number');
        if(String(amount).charAt(0) === "-"){
            return number(amount).replace("-", "-"+currencySymbol);
        }
        if(amount==undefined){
            return "Loading";
        }else{
            return currencySymbol+number(amount);
        }

    };

}]);

app.filter('userDateTimeTimeZone', function($filter) {
    return function(input, format, offset) {
        if (input == null) {
            return "";
        }
        var timeFromUTC = moment.utc(input);
        var tzName = jstz.determine().name();
        var _date = moment(timeFromUTC, tzName).format("YYYY-MM-DD HH:mm:ss Z");
        return _date.toString();
    }
});

app.filter('userDateTime', function($filter) {
    return function(input, format, offset) {
        if (input == null) {
            return "";
        }
        var timeFromUTC = moment.utc(input);
        var tzName = jstz.determine().name();
        var _date = moment.tz(timeFromUTC, tzName).format("YYYY-MM-DD HH:mm");
        return _date.toString();
    }
});

app.filter('userDate', function($filter) {
    return function(input, format, offset) {
        if (input == null) {
            return "";
        }
        var timeFromUTC = moment.utc(input);
        var tzName = jstz.determine().name();
        var _date = moment.tz(timeFromUTC, tzName).format("YYYY-MM-DD");
        return _date.toString();
    }
});


app.filter('gspName', function($filter) {
    var gameName = [{
        101: "Ezugi"
    }, {
        102: "GAMEPLAY"
    }, {
        103: "Gold Deluxe"
    }];

    return function(input, format, offset) {
        if (input == null) {
            return "";
        }
        var _gspName = gameName.input;
        return _gspName.toUpperCase();
    }
});


app.controller("HeaderController", function($scope, $rootScope, ngDialog, loggedInStatus) {


});


app.controller("NavController", function($scope, $rootScope, $location, $translate, SweetAlert) {
    $scope.isActive = function(viewLocation) {
        return viewLocation === $location.path();
    };

    $scope.alertLang = function() {
        $translate(['ComingSoon']).then(function (translations) {
            SweetAlert.swal(translations.ComingSoon);
        });
    };
});

app.controller("CommonController", function($rootScope, $scope, $http, $q, ccCurrencySymbol, $location, ngDialog, $translate, $cookies, SweetAlert,loggedInStatus) {

    $scope.displayResetPass = function() {

        ngDialog.open({
            template: '/popup/resetPassword.php',
            className: 'ngdialog-theme-default ngdialog-resetpass',
            showClose: false,
            overlay:true,
            closeByEscape: false
        });
    };

    $rootScope.cc_currency_symbol = ccCurrencySymbol;
    $rootScope.getQuestion = {};
    $rootScope.getCurrency = {};
    $rootScope.getCountries = {};
    $rootScope.getLanguages = {};
    $rootScope.getBankList = {};
    $rootScope.getUserCountryCd = {};
    $rootScope.getUserCountryNo = {};
    $rootScope.getAgentProductCasinoGameList = {};
    $rootScope.getAgentProductSportsGameList = {};
    $rootScope.getAgentProductSlotList = {};
    $rootScope.getAgentProductPokerGameList = {};
    $rootScope.getAgentProductOtherList = {};
    $rootScope.getAnouncementList = {};
    $rootScope.anouncementPopup = {};
    $rootScope.getAgentGspWalletList = {};
    $rootScope.playerDetail = {};
    $rootScope.getAgentPspList = {};
    $rootScope.countryA2List="";
    $scope.topWithdrawalList = {};
    $scope.currentDepositList = {};
    $scope.currentWithdrawalList = {};
    $scope.genderList = [{
        "genderNo": "1",
        "genderName": "Male"
    }, {
        "genderNo": "2",
        "genderName": "Female"
    }];
    $scope.hasNotice=false;
    $scope.language="";
    $scope.gspLanguage="";

    $scope.playGame=function(gspNo,productNo,gameId,isFun,playCheck){
        if ($rootScope.loggedIn) {
            var currentLang=$translate.storage().get($translate.storageKey());
            if($scope.language =="" || $scope.language != currentLang || $scope.gspLanguage==""){
                $scope.language = currentLang;
                switch (currentLang){
                    case "th_TH" : $scope.gspLanguage="th";
                        break;
                    case "ko_KR" : $scope.gspLanguage="ko-kr";
                        break;
                    case "zh_CN" : $scope.gspLanguage="zh-cn";
                        break;
                    case "zh_TW" : $scope.gspLanguage="zh-tw";
                        break;
                    case "ja_JP" : $scope.gspLanguage="ja";
                        break;
                    case "mm_MY" : $scope.gspLanguage="my";
                        break;
                    case "mn_MO" : $scope.gspLanguage="mn";
                        break;
                    case "en_US" : $scope.gspLanguage="en-us";
                        break;
                }

            }
            //console.log($scope.gspLanguage);
            var url="";
            var size="";
            if(productNo=="10"){
                if(playCheck == true){
                    if(gspNo==104) {
                        url = "/api/player/CasinoLoginToGSP?gspNo=" + gspNo + "&productNo=" + productNo + "&playCheck=" + playCheck + "&languageCd=" + $scope.gspLanguage;
                        size = "width=1024, height=768";
                    }
                }else if(gspNo==204){
                    url="/api/player/CasinoLoginToGSP?gspNo="+gspNo+"&productNo="+productNo+"&languageCd="+$scope.gspLanguage;
                    size="width=1024, height=592";

                }else if(gspNo==105){
                    url="/popup/playXpro.php";
                    size="width=1024, height=768";

                }else if(gspNo==101){
                    url="/api/player/CasinoLoginToGSP?gspNo="+gspNo+"&productNo="+productNo+"&languageCd="+$scope.gspLanguage;
                    size="width=1024, height=768,scrollbars=yes";
                }else{
                    url="/api/player/CasinoLoginToGSP?gspNo="+gspNo+"&productNo="+productNo+"&languageCd="+$scope.gspLanguage;
                    size="width=1024, height=768";
                }

            }else if(productNo=="20"){
                url="/api/player/CasinoLoginToGSP?gspNo="+gspNo+"&productNo="+productNo+"&gameId="+gameId+"&isFun="+isFun+"&languageCd="+$scope.gspLanguage;
                size="width=1024, height=768";
            }else if(productNo=="40"){
                url="/api/player/CasinoLoginToGSP?gspNo="+gspNo+"&productNo="+productNo+"&languageCd="+$scope.gspLanguage;
                size="width=1024, height=682";
            }

            var target="";

            if(productNo == 20 && gspNo != 104){
                target=gspNo+Math.random();
            }else if(playCheck == true){
                target=gspNo+"playCheck";
            }else{
                target=gspNo;
            }

            var popupWindow = window.open(url,target, size).focus();
        } else {
            ngDialog.open({
                template: '/popup/login.php',
                controller: 'LoginController',
                className: 'ngdialog-theme-default ngdialog-login',
                overlay:true,
                scope: $scope
            });
        }
    };


    $scope.getNotice=false;
    $scope.init = function(isLogin,resetPassword) {
        if(isLogin){
            if (resetPassword) {
                $scope.displayResetPass();
            }
            loggedInStatus.setLoggedInStatus();
        }

        $http.get("/api/operation/GetAnnouncements?announceTypeCd=1", {
            cache: true
        })
            .success(function(data) {
                if (data.status == 200) {
                    angular.forEach(data.result.announcementList,function(val){
                        if(val.isPopup==true && !$scope.getNotice){
                            $rootScope.anouncementPopup = val;
                            $scope.hasNotice=true;
                            $scope.getNotice=true;

                            if($scope.hasNotice && !$cookies.get('notToday') && !resetPassword){
                                ngDialog.open({
                                    template: '/popup/notice.php',
                                    className: 'ngdialog-theme-default ngdialog-notice',
                                    controller: 'NoticePopupController',
                                    overlay:true,
                                    scope: $scope
                                });
                            }
                        }
                    });
                    $rootScope.getAnouncementList = data.result.announcementList;
                }
            }).error(function(data, status) {
                console.error('Repos error', status, data);
            })["finally"](function() {
            //console.log("ksadjfkljadslkfjsakl");

        });

        $http.get("/api/system/GetAgentCountryList", {
            cache: true
        }).success(function(data) {
            if (data.status == 200) {
                $rootScope.getCountries = data.result.countryList;
                $rootScope.countryA2List = data.result.countryA2List;
            }
        }).error(function(data, status) {
            console.error('Repos error', status, data);
        });

        $http.get("/api/system/GetCurrencyList", {
            cache: true
        })
            .success(function (data) {
                if (data.status == 200) {
                    $rootScope.getCurrency = data.result.currencyList;
                }
            }).error(function (data, status) {
                console.error('Repos error', status, data);
            });

        $http.get("/api/system/GetAgentPspList", {
            cache: true
        })
            .success(function (data) {
                if (data.status == 200) {
                    $rootScope.getAgentPspList = data.result.pspList;
                }
            }).error(function (data, status) {
                console.error('Repos error', status, data);
            });

        if(!$rootScope.loggedIn){
            $http.get("/api/system/GetCountryInfoByIP", {
                cache: true
            }).success(function(data) {
                if (data.status == 200) {
                    $rootScope.getUserCountryCd = data.countryCd;
                    $rootScope.getUserCountryNo = data.countryNo;
                    //console.log($rootScope.getUserCountryCd);
                    //console.log($rootScope.getUserCountryNo);
                }
            }).error(function(data, status) {
                console.error('Repos error', status, data);
            });
        }else{
            var url = "/api/player/GetPlayerDetail";
            $http.get(url).success(function(data) {
                if (data.status == 200) {
                    //console.log(data.result);
                    $rootScope.playerDetail = data.result;
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
        }


        $http.get("/api/system/GetAgentGspList", {
            cache: true
        }).success(function(data) {
            if (data.status == 200) {
                data.result.mainWalletList=[{"gspNo":999,"gspName":"MainWallet"}];//TODO::remove this code after change the api of transfer directly gsp
                $rootScope.getAgentGspWalletList = data.result.mainWalletList.concat(data.result.orderedGspWalletList);

            }
        }).error(function(data, status) {
            console.error('Repos error', status, data);
        });

        $http.get("/api/system/GetAgentProductGspGameList", {
            cache: true
        }).success(function(data) {
            if (data.status == 200) {
                //console.log(data.result);
                $rootScope.getAgentProductCasinoGameList=data.result.AgentProductCasinoGameList[0];
                $rootScope.getAgentProductSlotList=data.result.AgentProductSlotList[0];
                $rootScope.getAgentProductSportsGameList=data.result.ProductSportsGameList;
                $rootScope.getAgentProductPokerGameList=data.result.AgentProductPokerGameList[0];
                $rootScope.getAgentProductOtherList=data.result.AgentProductOtherList[0];
            }
        }).error(function(data, status) {
            console.error('Repos error', status, data);
        });
    };
    $scope.$on('$viewContentLoaded', function() {
        $scope.displaySignUp = function () {
            ngDialog.close();
            ngDialog.open({
                template: '/popup/signup.php',
                controller: 'SignUpController',
                className: 'ngdialog-theme-default ngdialog-signup',
                scope: $scope
            });
            $q.all([
                $http.get("/api/system/GetSecurityQuestionList", {
                    cache: true
                })
                    .success(function (data) {
                        if (data.status == 200) {
                            $scope.getQuestion = data.result.securityQstList;
                        }
                    }).error(function (data, status) {
                        console.error('Repos error', status, data);
                    })
            ]);

            $scope.signup = function () {
                $('.tooltip').hide();
                $('.icon-tip-currency').hover(function () {
                    $('.tooltipCurrency').show();
                }, function () {
                    $('.tooltipCurrency').hide();
                });

                $('.terms-container').hide();
                $('.link-terms').click(function () {
                    $('.terms-container').fadeIn(20);
                });
                $('.icon-close-terms').click(function () {
                    $('.terms-container').fadeOut(20);
                });

                $(".terms-content").mCustomScrollbar({
                    scrollInertia: 200
                });
            }
        };

        $scope.displayForgotPass = function () {
            ngDialog.open({
                template: '/popup/forgotpass.php',
                className: 'ngdialog-theme-default ngdialog-forgotpass',
                overlay: true
            });
        };

        $('.news-ticker').easyTicker({
            direction: 'up',
            easing: 'easeInOutBack',
            speed: 'slow',
            interval: 2000,
            height: 'auto',
            visible: 1,
            mousePause: 1
        }).data('easyTicker');

        $scope.page = $location.search();
        if ($scope.page.redirectPage != undefined) {
            angular.element(document).ready(function () {
                if ($scope.page.redirectPage == "deposit") {
                    $scope.displayWallet(2);
                } else if ($scope.page.redirectPage == "withdrawal") {
                    $scope.displayWallet(3);
                }
            });
        }

        $scope.displayWallet = function (tabIndex) {
            $scope.selectWalletTab = tabIndex;
            if ($rootScope.loggedIn) {
                ngDialog.open({
                    template: '/popup/wallet.php',
                    controller: 'WalletController',
                    className: 'ngdialog-theme-default ngdialog-wallet',
                    scope: $scope
                });
                $scope.walletPopup = function () {
                    $('.tooltip').hide();
                    $('.icon-tip-mainwallet').hover(function () {
                        $('.tooltipMainWallet').show();
                    }, function () {
                        $('.tooltipMainWallet').hide();
                    });
                    $('.icon-tip-sms').hover(function () {
                        $('.tooltipSMS').show();
                    }, function () {
                        $('.tooltipSMS').hide();
                    });
                    $("#popup-wallet div.popup-content").mCustomScrollbar({
                        scrollInertia: 200
                    });
                    $('#datetimepicker').datetimepicker({
                        dayOfWeekStart: 1,
                        lang: 'en',
                        step: 10
                    });
                    $('#datetimepickerEdit').datetimepicker({
                        dayOfWeekStart: 1,
                        lang: 'en',
                        step: 10,
                        timepicker: false
                    });
                    $("#wallet-promo-slider").owlCarousel({
                        autoPlay: true,
                        pagination: true,
                        navigation: false,
                        slideSpeed: 600,
                        paginationSpeed: 400,
                        singleItem: true
                    });
                };

                $scope.btnPromos = function () {
                    ngDialog.close();
                }
            } else {
                ngDialog.open({
                    template: '/popup/login.php',
                    controller: 'LoginController',
                    className: 'ngdialog-theme-default ngdialog-login',
                    overlay: true,
                    scope: $scope
                });
            }
        };
        $scope.displayCustomer = function (tabIndex, announcement) {
            $scope.selectCustomerTab = tabIndex;
            if ($rootScope.loggedIn || tabIndex != 5 || tabIndex != 1) {
                $rootScope.indexAnnounce = announcement;
                ngDialog.open({
                    template: '/popup/customer.php',
                    controller: 'CustomerController',
                    className: 'ngdialog-theme-default ngdialog-customer',
                    scope: $scope
                });
                $scope.customerPopup = function () {
                    $("#popup-customer div.popup-content").mCustomScrollbar({
                        scrollInertia: 200
                    });
                    $(".partnership-banner").owlCarousel({
                        autoPlay: true,
                        pagination: true,
                        navigation: false,
                        slideSpeed: 300,
                        paginationSpeed: 400,
                        singleItem: true
                    });
                }
            } else {
                ngDialog.open({
                    template: '/popup/login.php',
                    controller: 'LoginController',
                    className: 'ngdialog-theme-default ngdialog-login',
                    overlay: true,
                    scope: $scope

                });
            }
        };
    });

    $scope.displayPromoDetails = function (tabIndex) {
        $scope.promoDetailsTab = tabIndex;
        ngDialog.close();
        ngDialog.open({
            template: '/popup/promoDetails.php',
            controller: 'PromoDetailsController',
            className: 'ngdialog-theme-default ngdialog-promodetails',
            scope: $scope
        });
    };

    $scope.setLang = function(langKey) { //selected language

        $cookies.get("selectedLanguage");
        var now = new Date(),
        // this will set the expiration to 12 months
            exp = new Date(now.getFullYear() + 100, now.getMonth(), now.getDate());

        // Setting a cookie
        $cookies.put("selectedLanguage", langKey, {expires: exp} );

        if(langKey == "zh_TW"){
            $('#language-flag').html('<i class="icon-lang language-tw"></i>');
            var font="taiwan.css";

        }else{
            $('#language-flag').html('<i class="icon-lang language-'+langKey.substring(0, 2)+'"></i>');

            if(langKey.substring(0,2) == "ko"){ var font="nanumgothic.css"; }
            else if(langKey.substring(0,2) == "ja"){ var font="japan.css"; }
            else if(langKey.substring(0,2) == "mm"){ var font="zawgyi.css"; }
            else if(langKey.substring(0,2) == "mn"){ var font="mongolian.css"; }
            else { var font="roboto.css"; }
        }

        var fileref=document.createElement("link")
        fileref.setAttribute("rel", "stylesheet")
        fileref.setAttribute("href", "/common/css/fonts/"+font);

        if (typeof fileref!="undefined"){

            if(font == "nanumgothic.css") {
                $("link[href*='/common/css/fonts/japan.css']").remove();
                $("link[href*='/common/css/fonts/mongolian.css']").remove();
                $("link[href*='/common/css/fonts/taiwan.css']").remove();

            }else if(font == "japan.css"){
                $("link[href*='/common/css/fonts/nanumgothic.css']").remove();
                $("link[href*='/common/css/fonts/mongolian.css']").remove();
                $("link[href*='/common/css/fonts/taiwan.css']").remove();

            }else if(font == "zawgyi.css"){
                $("link[href*='/common/css/fonts/nanumgothic.css']").remove();
                $("link[href*='/common/css/fonts/japan.css']").remove();
                $("link[href*='/common/css/fonts/mongolian.css']").remove();
                $("link[href*='/common/css/fonts/taiwan.css']").remove();

            }else if(font == "mongolian.css"){
                $("link[href*='/common/css/fonts/nanumgothic.css']").remove();
                $("link[href*='/common/css/fonts/japan.css']").remove();
                $("link[href*='/common/css/fonts/taiwan.css']").remove();

            }else if(font == "taiwan.css"){
                $("link[href*='/common/css/fonts/nanumgothic.css']").remove();
                $("link[href*='/common/css/fonts/japan.css']").remove();
                $("link[href*='/common/css/fonts/mongolian.css']").remove();

            }else if(font == "roboto.css"){
                $("link[href*='/common/css/fonts/nanumgothic.css']").remove();
                $("link[href*='/common/css/fonts/japan.css']").remove();
                $("link[href*='/common/css/fonts/mongolian.css']").remove();
                $("link[href*='/common/css/fonts/taiwan.css']").remove();

            }

            document.getElementsByTagName("head")[0].appendChild(fileref);

        }

        // You can change the language during runtime
        $translate.use(langKey);
    };

});

app.controller("ForgotPasswordController", function($scope, $http, SweetAlert, $translate) {
    $scope.getQuestion = {};
    $scope.forgotPwd = {};
    $scope.getTempPwd = {};
    $scope.correctInfo = false;
    $scope.isProcessing = false;

    $http.get("/api/system/GetSecurityQuestionList", {
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
        var url = "/api/player/ForgotPassword";
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.forgotPwd), // pass in data as strings
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            } // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            if (data.status == 200) {
                $scope.getTempPwd = data.result.tempPassword;
                $scope.correctInfo = true;
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
            $scope.isProcessing = false;
        });
    }

});

app.controller("LoginController",
    function($scope, $http, $window, SweetAlert, loggedInStatus, $translate) {
        $scope.loginForm = {};
        $scope.isProcessing = false;
        $scope.processForm = function() {
            $scope.isProcessing = true;
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
                screenHeight: height
            };
            angular.extend($scope.loginForm, $scope.userInfo);

            var url = "/api/player/Login";
            $http({
                method: 'POST',
                url: url,
                data: $.param($scope.loginForm), // pass in data as strings
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                } // set the headers so angular passing info as form data (not request payload)
            }).success(function(data) {
                if (data.status == 200) {
                    loggedInStatus.setLoggedInStatus();
                    $window.location.href="/#/sports";
                    $window.location.reload();
                } else {
                    if (data.alert) {
                        if (bowser.msie && bowser.version <= 8) {
                            alert(data.message);
                        } else {
                            $translate([data.message, "AccessDenied"]).then(function (translations) {
                                SweetAlert.swal(translations.AccessDenied, translations[data.message], "error");
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
    }
);

app.controller("LogoutController", function($scope, $http, $window, SweetAlert, loggedInStatus, $translate) {
    $scope.isProcessing = false;
    $scope.logout = function() {
        $scope.isProcessing = true;
        $http.get("/api/player/Logout")
            .success(function(data) {
                if (data.status == 200) {
                    if (bowser.msie && bowser.version <= 8) {
                        alert(data.message);
                    } else {
                        $translate([data.message]).then(function (translations) {
                            SweetAlert.swal(translations[data.message], "", "success");
                        });
                    }
                    loggedInStatus.setLoggedOutStatus();

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
            $scope.isProcessing = false;
            $window.location.reload();
        });
    }
});


app.controller("ForgotNicknameController", function($scope, $http, SweetAlert, $translate) {
    $scope.forgotNick = {};
    $scope.correctInfo = false;
    $scope.isProcessing = false;

    $scope.processForm = function() {
        $scope.isProcessing = true;
        var url = "/api/player/ForgotNickname";
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

app.controller("BalanceController", function($scope, $rootScope, $interval, Balance, $http) {
    $scope.isProcessing=false;
    if($rootScope.loggedIn) {
        $scope.init = function() {
            Balance.getBalance("all");
            $interval(function() {
                Balance.getBalance("single");
            }, 60000);//1min
        };

        $scope.reloadBalance = function() {
            if(!$scope.isProcessing) {
                $scope.isProcessing=true;
                $("#preloader").show();
                $http.get("/api/finance/GetBalance")
                    .success(function(data) {
                        if (data.status == 200) {
                            $rootScope.mainBalance = data.result.mainBalance;
                            $rootScope.totalBalance = data.result.totalBalance;
                            $rootScope.gspBalanceList = data.result.orderedGspBalance;
                            $rootScope.gspBalanceListLength = data.result.orderedGspBalance.length;
                        } else {
                            if(data.status == 400){
                                if (data.alert) {
                                    $http.get("/api/player/Logout")
                                        .success(function() {
                                            loggedInStatus.setLoggedOutStatus();
                                        })["finally"](function() {
                                        $window.location.reload();
                                    });
                                }
                            }
                        }
                    }).error(function(data, status) {
                        console.error('Repos error', status, data);
                    })["finally"](function() {
                    $scope.isProcessing=false;
                    $("#preloader").hide();
                });
            }
        };

        $scope.loadImsBalance = function() {
            Balance.getBalance("single");
        };
    }
});

//Tabs
app.controller("TabController", function() {
    this.tab = 1;

    this.isSet = function(checkTab) {
        return this.tab === checkTab;
    };

    this.setTab = function(setTab) {
        this.tab = setTab;
    };
});