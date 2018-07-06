app.controller("WalletController", function($scope, $rootScope, $http, $q, SweetAlert, $translate) {

    $rootScope.addAmountUSD = [{
        price: 100
        //currency: 'USD'
    }, {
        price: 500
        //currency: 'USD'
    }, {
        price: 1000
        //currency: 'USD'
    }, {
        price: 5000
        //currency: 'USD'
    }, {
        price: 10000
        //currency: 'USD'
    }];

    $rootScope.addAmountKRW = [{
        price: 1000
        //currency: 'KRW'
    }, {
        price: 10000
        //currency: 'KRW'
    }, {
        price: 500000
        //currency: 'KRW'
    }, {
        price: 1000000
        //currency: 'KRW'
    }, {
        price: 10000000
        //currency: 'KRW'
    }];

    $rootScope.addAmountTHB = [{
        price: 100
        //currency: 'THB'
    }, {
        price: 500
        //currency: 'THB'
    }, {
        price: 1000
        //currency: 'THB'
    }, {
        price: 5000
        //currency: 'THB'
    }, {
        price: 10000
        //currency: 'THB'
    }];

    $rootScope.addAmountCNY = [{
        price: 100
        //currency: 'CNY'
    }, {
        price: 500
        //currency: 'CNY'
    }, {
        price: 1000
        //currency: 'CNY'
    }, {
        price: 5000
        //currency: 'CNY'
    }, {
        price: 10000
        //currency: 'CNY'
    }];

    $scope.getAgentBankList = function(){
        var url = "../api/system/GetAgentBankList";
        $http.get(url).success(function(data) {
            if (data.status == 200) {
                $rootScope.depositBankList = data.result.bankAccountList;
                //console.log($rootScope.depositBankList);
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
                $http.get("../api/finance/GetBalance")
                    .success(function(data) {
                        if (data.status == 200) {
                            $rootScope.mainBalance = data.result.mainBalance;
                            $rootScope.totalBalance = data.result.totalBalance;
                            $rootScope.gspBalanceList = data.result.orderedGspBalance;
                            $rootScope.gspBalanceListLength = data.result.orderedGspBalance.length;
                        } else {
                            if(data.status == 400){
                                if (data.alert) {
                                    $http.get("../api/player/Logout")
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

app.controller("TransferController", function($scope, $rootScope, $http, AmountService, SweetAlert, Balance, $translate, $window) {
    $scope.gspTransfer = {};
    $scope.gspTransfer.amount = 0;
    $scope.error={};
    $scope.isProcessing=false;
    $scope.loadGsp = function() {
        $scope.gspWalletList = $rootScope.getAgentGspWalletList;
        $scope.filteredGspWalletList = $rootScope.getAgentGspWalletList;
        $scope.gspTransfer.fromGspWallet = $scope.gspWalletList[0]
    };

    $scope.addAmount = function(sumAmount) {
        $scope.gspTransfer.amount = AmountService.sumAmount($scope.gspTransfer.amount, sumAmount);
    };

    $scope.resetAmount = function() {
        $scope.gspTransfer.amount = AmountService.resetAmount();
    };

    $scope.$watch('gspTransfer.fromGspWallet', function() {
        $scope.filteredGspWalletList = [];
        var keepGoing = true;
        angular.forEach($scope.gspWalletList, function(val) {
            //if (val.gspNo != $scope.gspTransfer.toGspWallet) {
            //    this.push(val);
            //}
            if(keepGoing){
                if (val.gspNo != $scope.gspTransfer.fromGspWallet) {
                    if($scope.gspTransfer.fromGspWallet==999){
                        keepGoing = true;
                        this.push(val);
                    }else{
                        keepGoing = false;
                        this.push({gspNo: 999, gspName: "MainWallet", $$hashKey: "object:99"});

                    }

                }
            }
        }, $scope.filteredGspWalletList);
    });

    $scope.processForm = function() {
        if(!$scope.isProcessing){
            $scope.isProcessing = true;
            $scope.isIBC=false;
            if($scope.gspTransfer.fromGspWallet==209 || $scope.gspTransfer.toGspWallet==209){
                $scope.isIBC=true;
            }
            var url = "../api/finance/WalletTransfer";
            $http({
                method: 'POST',
                url: url,
                data: $.param($scope.gspTransfer), // pass in data as strings
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                } // set the headers so angular passing info as form data (not request payload)
            }).success(function(data) {
                $scope.error.status=false;
                if (data.status == 200) {
                    if (bowser.msie && bowser.version <= 8) {
                        Balance.getBalance("all");
                        alert(data.message);
                    } else {
                        Balance.getBalance("all");
                        $translate([data.message]).then(function (translations) {
                            SweetAlert.swal(translations[data.message],"","success");
                        });

                        if($("#popup-transfer").html() != undefined){
                            $scope.closeThisDialog();
                        }else{
                            slideTransferClose();
                        }

                    }
                    if($scope.isIBC){
                        $rootScope.isAlreadyOepnIBC=false;
                        $scope.isIBC=false;
                    }
                } else {
                    if (data.alert) {
                        if (bowser.msie && bowser.version <= 8) {
                            alert(data.message);
                        } else {
                            $scope.error.status=true;
                            $translate([data.message]).then(function (translations) {
                                if(data.amount != undefined){
                                    $scope.error.message=translations[data.message]+" "+data.amount;
                                }else{
                                    $scope.error.message=translations[data.message];
                                }
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
});

app.controller("DepositController", function($scope, $http, AmountService, SweetAlert, $injector, $translate, $rootScope, $filter) {
    $scope.isProcessing=false;
    $scope.isSelectedBank=false;
    $scope.deposit = {};
    $scope.deposit.amount = 0;
    $scope.deposit.phone = $rootScope.playerDetail.phone;
    $scope.deposit.depositDate =  $filter('userDateTime')(new Date(),'yyyy-MM-dd HH:mm:ss Z'); //"2015-09-22 14:56"
    $scope.error={};

    $scope.addAmount = function(sumAmount) {
        $scope.deposit.amount = AmountService.sumAmount($scope.deposit.amount, sumAmount);
    };

    $scope.resetAmount = function() {
        $scope.deposit.amount = AmountService.resetAmount();
    };

    $scope.depositTypes = {"ATM":"ATM","Counter":"Counter","CDM":"CDM","Mobile Banking":"Mobile Banking","Internet Banking":"Internet Banking"};
    $scope.getAgentBankList();

    $scope.processForm = function() {
        if(!$scope.isProcessing){
            $scope.isProcessing = true;
            var countryData = $("#depositPhone").intlTelInput("getSelectedCountryData");
            //console.log(countryData.dialCode);
            $scope.deposit.dialCode=countryData.dialCode;
            var _timezone = jstz.determine();
            $scope.deposit.BankNm =$rootScope.depositBankList[$scope.deposit.bankIndex].BankNm;
            $scope.deposit.BankHolder=$rootScope.depositBankList[$scope.deposit.bankIndex].BankHolder;
            $scope.deposit.BankAcctNo=$rootScope.depositBankList[$scope.deposit.bankIndex].BankAcctNo;
            $scope.deposit.agBankNo=$rootScope.depositBankList[$scope.deposit.bankIndex].BankNo;
            $scope.deposit.agBankAcctSeqNo=$rootScope.depositBankList[$scope.deposit.bankIndex].AgentBankAcctSeqNo;

            $scope.deposit.depositDate =  moment.tz($scope.deposit.depositDate,_timezone.name()).format("YYYY-MM-DD HH:mm:ss Z");
            var url = "../api/finance/RequestDeposit";
            $http({
                method: 'POST',
                url: url,
                data: $.param($scope.deposit), // pass in data as strings
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                } // set the headers so angular passing info as form data (not request payload)
            }).success(function(data) {
                $scope.error.status=false;
                if (data.status == 200) {
                    if (bowser.msie && bowser.version <= 8) {
                        alert(data.message);
                    } else {
                        $translate([data.message]).then(function (translations) {
                            SweetAlert.swal(translations[data.message],"","success");
                        });
                    }

                    var defaultForm = {
                        amount : 0,
                        bankHolder : "",
                        depositDate : "",
                        depositType : "",
                        phone : $rootScope.playerDetail.phone
                    };
                    $scope.depositForm.$setUntouched();
                    $scope.isSelectedBank = false;
                    $(".depositBank_radio").removeClass('bank_on');
                    $scope.deposit=defaultForm;
                } else {
                    if (data.alert) {
                        if (bowser.msie && bowser.version <= 8) {
                            alert(data.message);
                        } else {
                            $translate([data.message, "PleaseTryAgain"]).then(function (translations) {
                                SweetAlert.swal(translations[data.message], translations.PleaseTryAgain, "error");
                            });
                        }
                    }else{
                        $scope.error.status=true;
                        $translate([data.message]).then(function (translations) {
                            if(data.amount != undefined){
                                $scope.error.message=translations[data.message]+" "+data.amount;
                            }else{
                                $scope.error.message=translations[data.message];
                            }
                        });
                    }
                }
            }).error(function(data, status) {
                console.error('Repos error', status, data);
            })["finally"](function() {
                $scope.isProcessing = false;
            });
        }
    };

    function depositBankRadio() {
        $('.depositBank_radio').click(function(){
            $(this).siblings('.bank_on').removeClass('bank_on');
            $(this).addClass('bank_on');
        });
    }

    $scope.selectDepositAccount = function() {
        $scope.isSelectedBank=true;
        depositBankRadio();
    };

    this.tab = 1;

    this.isSet = function(checkTab) {
        return this.tab === checkTab;
    };

    this.setTab = function(setTab) {
        this.tab = setTab;
    };

});

app.controller("WithdrawalController", function($scope, $http, AmountService, SweetAlert, $injector, $translate, $rootScope) {
    $scope.isProcessing=false;
    $scope.withdrawal = {};
    $scope.error={};
    $scope.withdrawal.amount = 0;
    $scope.withdrawal.phone = $rootScope.playerDetail.phone;

    $scope.getAgentBankList = {};
    $http.get("../api/system/GetPlayerBankList")
        .success(function(data) {
            if (data.status == 200) {
                $scope.getAgentBankList = data.result.bankList;
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

    $scope.addAmount = function(sumAmount) {
        $scope.withdrawal.amount = AmountService.sumAmount($scope.withdrawal.amount, sumAmount);
    };
    $scope.resetAmount = function() {
        $scope.withdrawal.amount = AmountService.resetAmount();
    };

    $scope.processForm = function() {
        if (!$scope.isProcessing) {
            $scope.isProcessing = true;
            var countryData = $("#withdrawalPhone").intlTelInput("getSelectedCountryData");
            //console.log(countryData.dialCode);
            $scope.withdrawal.dialCode=countryData.dialCode;
            var url = "../api/finance/RequestWithdrawal";
            $http({
                method: 'POST',
                url: url,
                data: $.param($scope.withdrawal), // pass in data as strings
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                } // set the headers so angular passing info as form data (not request payload)
            }).success(function (data) {
                $scope.error.status = false;
                if (data.status == 200) {
                    if (bowser.msie && bowser.version <= 8) {
                        alert(data.message);
                    } else {
                        $translate([data.message]).then(function (translations) {
                            SweetAlert.swal(translations[data.message], "", "success");
                        });
                    }

                    var defaultForm = {
                        amount : 0,
                        bankNo : "",
                        bankAccountNo : "",
                        bankHolder : "",
                        bankAccountType : "",
                        bankPlace : "",
                        bankOffice : "",
                        phone : $rootScope.playerDetail.phone,
                        memo : ""
                    };

                    $scope.withdrawalForm.$setUntouched();
                    $scope.withdrawal=defaultForm;

                } else {
                    if (data.alert) {
                        if (bowser.msie && bowser.version <= 8) {
                            alert(data.message);
                        } else {
                            $translate([data.message, "PleaseTryAgain"]).then(function (translations) {
                                SweetAlert.swal(translations[data.message], translations.PleaseTryAgain, "error");
                            });
                        }
                    } else {
                        $scope.error.status = true;
                        $translate([data.message]).then(function (translations) {
                            if (data.amount != undefined) {
                                $scope.error.message = translations[data.message] + " " + data.amount;
                            } else {
                                $scope.error.message = translations[data.message];
                            }
                        });
                    }
                }
            }).error(function (data, status) {
                alert("withdraw" + data);
                console.error('Repos error', status, data);
            })["finally"](function () {
                $scope.isProcessing = false;
            });
        }
    };

});

app.controller("TransactionHistoryController", function($scope, $http, $rootScope, SweetAlert, $translate) {
    $scope.transactionList = {};
    $scope.filteredPage = [];
    $scope.totalItems = 0;
    $scope.currentPage = 1;
    $scope.maxSize = 5;
    $scope.numPerPage = 10;

    $scope.loadTransactionHistory = function() {
        var url = "/api/finance/GetPlayerTransactionHistory";
        $http.get(url).success(function(data) {
            if (data.status == 200) {
                $scope.transactionList = data.result.transactionList;
                $scope.totalItems = data.result.transactionList.length;

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
            $scope.numPagesCal = function() {
                return Math.ceil($scope.transactionList.length / $scope.numPerPage);
            };

            $scope.numPages = $scope.numPagesCal();

            $scope.$watch('currentPage + numPerPage', function() {
                var begin = (($scope.currentPage - 1) * $scope.numPerPage),
                    end = begin + $scope.numPerPage;
                $scope.filteredPage = $scope.transactionList.slice(begin, end);

            });
        });
    };

    $scope.$watch(function() {
        return $rootScope.walletTab;
    }, function() {
        if($rootScope.walletTab == 5){
            $scope.loadTransactionHistory();
        }
    }, true);
});

app.controller("CouponController", function($scope, $http, $rootScope, AmountService, SweetAlert, $translate) {
    $scope.coupone = {};
    $scope.couponList = {};
    $scope.filteredPage = [];
    $scope.totalItems = 0;
    $scope.currentPage = 1;
    $scope.maxSize = 5;
    $scope.numPerPage = 10;
    $rootScope.couponCount = 0;

    var url = "../api/marketing/GetPlayerCouponHistory";
    $http.get(url).success(function(data) {
        if (data.status == 200) {
            $scope.couponList = data.result.CouponList;
            angular.forEach($scope.couponList, function(value, key) {
                if (value.Status == "Issued") {
                    $rootScope.couponCount += 1;
                }
            });
            $scope.totalItems = $scope.couponList.length;
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
        $scope.numPagesCal = function() {
            return Math.ceil($scope.couponList.length / $scope.numPerPage);
        };

        $scope.numPages = $scope.numPagesCal();

        $scope.$watch('currentPage + numPerPage', function() {
            var begin = (($scope.currentPage - 1) * $scope.numPerPage),
                end = begin + $scope.numPerPage;
            $scope.filteredPage = $scope.couponList.slice(begin, end);
        });
    });

    $scope.useCoupon = function(couponCode) {
        var url = "../api/marketing/UseCoupon";
        console.log(couponCode);
        $http({
            method: 'POST',
            url: url,
            data: $.param({
                "couponCode": couponCode
            }), // pass in data as strings
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            } // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            console.log(data);
            if (data.status == 200) {
                if (data.alert) {
                    if (bowser.msie && bowser.version <= 8) {
                        alert(data.message);
                    } else {
                        $translate([data.message]).then(function (translations) {
                            SweetAlert.swal(translations[data.message], "", "success");
                        });
                    }
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
        }).error(function(data, status) {
            console.error('Repos error', status, data);
        })["finally"](function() {});
    }
});
