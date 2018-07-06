app.controller("SportsController", function($scope, $http, $sce, $rootScope, SweetAlert, ngDialog, $translate,browser, $window) {

    $scope.isAlreadyOepnIBC=false;
    $scope.isProcessing=false;

    $scope.getSportsURL = function(gspNo) {

        if($rootScope.gspNo!=gspNo){
            if(!$scope.isProcessing){
                $rootScope.gspNo=gspNo;
                $scope.isProcessing = true;
                if ($rootScope.loggedIn) {
                    if(gspNo==209 && $rootScope.isAlreadyOepnIBC){
                        $scope.isProcessing = false;
                        $('.gamebutton').removeClass('active');
                        $('.gamebutton'+gspNo).addClass('active');
                    }else{
                        if(browser() == "safari" && !navigator.userAgent.match('CriOS') && ($rootScope.gspNo == 208 || $rootScope.gspNo == 201 || $rootScope.gspNo == 202))
                        {
                            $scope.isProcessing = false;
                            ngDialog.open({
                                template: '/mobile/popup/sportsSafariDisable.php',
                                className: 'ngdialog-safari',
                                showClose: false,
                                scope: $scope,
                                closeByEscape: false
                            });

                        }else {
                            var url = "../api/player/LoginToGsp";
                            $http({
                                method: "POST",
                                url: url,
                                data: $.param({
                                    "gspNo": $scope.gspNo
                                }), // pass in data as strings
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                } // set the headers so angular passing info as form data (not request payload)

                            }).success(function (data) {
                                $scope.isProcessing = false;
                                if (data.status == 200) {
                                   angular.forEach($rootScope.gspBalanceList, function(val) {
                                        if (val.GspNo == $rootScope.gspNo) {
                                            if ($rootScope.mainBalance.amount <=0) {
                                                ngDialog.open({
                                                    template: '/mobile/popup/deposit.php',
                                                    className: 'ngdialog-deposit',
                                                    controller: 'DepositController',
                                                    showClose: false,
                                                    closeByEscape: false
                                                });
                                            }else if (val.currencyAmount.amount <= 0) {
                                                ngDialog.open({
                                                    template: '/mobile/popup/transfer.php',
                                                    className: 'ngdialog-transfer',
                                                    controller: 'TransferController',
                                                    showClose: false,
                                                    closeByEscape: false
                                                });
                                            }
                                            if ($rootScope.gspNo == 209) {
                                                if (browser() == "safari" && !navigator.userAgent.match('CriOS')) {
                                                    var open = $window.open(data.result.gameURL, '_blank');
                                                     if (open == null || typeof(open) == 'undefined') {
                                                         ngDialog.open({
                                                             template: '/mobile/popup/sportsSafariPopupBlocker.php',
                                                             className: 'ngdialog-safari',
                                                             showClose: false,
                                                             scope: $scope,
                                                             closeByEscape: false
                                                         });
                                                     }
                                                }else{
                                                     if (data.result.gspToken != undefined) {
                                                         $rootScope.isAlreadyOepnIBC = true;
                                                         $window.open(data.result.gameURL, '_blank');
                                                     }
                                                }
                                            }else if ($rootScope.gspNo == 208) {
                                                $window.open(data.result.gameURL, '_blank');
                                                $('.gamebutton').removeClass('active');
                                                $('.gamebutton'+gspNo).addClass('active');
                                            }else {
                                                if(browser() == "safari" && !navigator.userAgent.match('CriOS') && $rootScope.gspNo == 203 ){
                                                     var open = $window.open(data.result.gameURL, '_blank');
                                                     if (open == null || typeof(open)=='undefined'){
                                                         ngDialog.open({
                                                             template: '/mobile/popup/sportsSafariPopupBlocker.php',
                                                             className: 'ngdialog-safari',
                                                             showClose: false,
                                                             scope: $scope,
                                                             closeByEscape: false
                                                         });
                                                     }
                                                }else{
                                                 $window.open(data.result.gameURL, '_blank');
                                                }
                                            }

                                        }
                                   });

                                }else{
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
                                $('.gamebutton').removeClass('active');
                                $('.gamebutton'+gspNo).addClass('active');
                            });

                        }

                    }
                } else {
                    $scope.isProcessing = false;
                    slideLoginOpen();
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

    $(".langSelection").css("display","none");

});