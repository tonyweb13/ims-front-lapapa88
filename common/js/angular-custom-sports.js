app.controller("SportsController", function($scope, $http, $sce, $rootScope, SweetAlert, ngDialog, $translate,browser) {
    $scope.sportURL = "";
    $scope.isETC = true;
    $scope.isWFT=false;
    $scope.isIBC=false;
    $scope.isAlreadyOepnIBC=false;
    $scope.isProcessing=false;
    $scope.language="";
    $scope.gspLanguage="";
    //$rootScope.gspNo=208;
    $scope.displayTransfer = function() {
        angular.forEach($rootScope.gspBalanceList, function(val) {
            if (val.GspNo == $rootScope.gspNo) {
                //console.log(val.currencyAmount.amount);
                if (val.currencyAmount.amount <= 0) {
                    if ($rootScope.mainBalance.amount <=0) {
                        ngDialog.open({
                            template: '/popup/deposit.php',
                            className: 'ngdialog-theme-default ngdialog-transfer',
                            controller: 'DepositDialogController',
                             overlay: true
                        });
                    } else {
                        ngDialog.open({
                            template: '/popup/transfer.php',
                            className: 'ngdialog-theme-default ngdialog-transfer',
                            controller: 'TransferController',
                            overlay: true

                        });
                    }
                }
            }

        });
    };

    $scope.getSportsURL = function(gspNo) {
        if($rootScope.gspNo!=gspNo){
            if(!$scope.isProcessing){
                $rootScope.gspNo=gspNo;
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
                $scope.isProcessing = true;
                if ($rootScope.loggedIn) {
                    if(gspNo==209 && $rootScope.isAlreadyOepnIBC){
                        $scope.isIBC = true;
                        $scope.isWFT=false;
                        $scope.isETC=false;
                        $scope.isProcessing = false;
                        $('.sports-game-button').removeClass('active');
                        $('.sports-game-button-'+gspNo).addClass('active');
                    }else{
                        if(browser() == "safari" && !navigator.userAgent.match('CriOS') && ($rootScope.gspNo == 208 || $rootScope.gspNo == 201 || $rootScope.gspNo == 202))
                        {
                            $scope.isWFT = false;
                            $scope.isETC = false;
                            $scope.isIBC = false;
                            $scope.isSafari = true;
                            $scope.isProcessing = false;
                            $('.sports-iframe').hide();
                            $('.pageTitleImage span').css("position", "relative");

                        }else {
                            $scope.sportURL = $sce.trustAsResourceUrl("/pages/sportsLoading");
                            $scope.sportWFTURL = $sce.trustAsResourceUrl("/pages/sportsLoading");
                            $scope.isWFT = false;
                            $scope.isETC = false;
                            $scope.isIBC = false;
                            var url = "/api/player/LoginToGsp";
                            $http({
                                method: "POST",
                                url: url,
                                data: $.param({
                                    "gspNo": $scope.gspNo,
                                    "languageCd":  $scope.gspLanguage
                                }), // pass in data as strings
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                } // set the headers so angular passing info as form data (not request payload)
                            }).success(function (data) {
                                if (data.status == 200) {
                                    if ($rootScope.gspNo == 209) {
                                        if (data.result.gspToken != undefined) {
                                            //console.log(data.result.gameURL);
                                            $scope.isIBC = true;
                                            $scope.isSafari = false;
                                            $('.sports-iframe').show();
                                            //console.log(data.result.gameURL);
                                            $scope.sportIBCURL = $sce.trustAsResourceUrl(data.result.gameURL);
                                            $rootScope.isAlreadyOepnIBC = true;
                                        }
                                    } else if ($rootScope.gspNo == 203) {
                                        $scope.isWFT = true;
                                        $scope.isSafari = false;
                                        $('.sports-iframe').show();
                                        $scope.sportWFTURL = $sce.trustAsResourceUrl(data.result.gameURL);
                                        //console.log(data.result.gameURL);
                                    } else {
                                        $scope.isETC = true;
                                        $scope.sportURL = $sce.trustAsResourceUrl(data.result.gameURL);
                                        //console.log(data.result.gameURL);
                                    }
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
                                $scope.displayTransfer();
                                $scope.isProcessing = false;
                                $('.sports-game-button').removeClass('active');
                                $('.sports-game-button-'+gspNo).addClass('active');
                            });
                        }
                    }
                } else {
                    $scope.isProcessing = false;
                    if(gspNo==208){
                        $scope.sportURL = $sce.trustAsResourceUrl("http://podds.sbsports.gsoft88.net/web-root/restricted/?lang=en&oddstyle=HK");
                        $('.sports-game-button').removeClass('active');
                        $('.sports-game-button-'+gspNo).addClass('active');
                    }else{
                        ngDialog.open({
                            template: '/popup/login.php',
                            controller: 'LoginController',
                            className: 'ngdialog-theme-default ngdialog-login',
                            overlay:true,
                            scope: $scope
                        });
                    }
                }
            }else{
                if (bowser.msie && bowser.version <= 8) {
                    alert("Loading");
                } else {
                    $translate(["Loading", "PleaseTryLater"]).then(function (translations) {
                        SweetAlert.swal(translations["Loading"], translations.PleaseTryAgain, "error");
                    });
                }
            }
        }

    };

    $scope.isSet = function(checkTab) {
        return $scope.tab === checkTab;
    };

    $scope.setTab = function(setTab) {
        $scope.tab = setTab;
    };

});

app.controller("DepositDialogController",function($scope, $http, $sce, $rootScope, SweetAlert, ngDialog){
    $scope.displayWallet = function(tabIndex) {
        $scope.selectWalletTab = tabIndex;
        if ($rootScope.loggedIn) {
            ngDialog.open({
                template: '/popup/wallet.php',
                controller: 'WalletController',
                className: 'ngdialog-theme-default ngdialog-wallet',
                scope: $scope,
                overlay: true
            });
            $scope.walletPopup = function() {
                $('.tooltip').hide();
                $('.icon-tip-mainwallet').hover(function() {
                    $('.tooltipMainWallet').show();
                }, function() {
                    $('.tooltipMainWallet').hide();
                });
                $('.icon-tip-sms').hover(function() {
                    $('.tooltipSMS').show();
                }, function() {
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
            }
        } else {
            ngDialog.open({
                template: '/popup/login.php',
                controller: 'LoginController',
                className: 'ngdialog-theme-default ngdialog-login',
                scope: $scope,
                overlay: true
            });
        }
    };

    $scope.explore = function(){
        $scope.closeAll();
    };
});