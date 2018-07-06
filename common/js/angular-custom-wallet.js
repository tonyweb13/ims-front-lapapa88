//WalletPopup
app.controller("WalletController", function($scope, $rootScope, $http, $q, SweetAlert, $translate) {

    $rootScope.addAmountUSD = [{
        price: 100,
        currency: 'USD'
    }, {
        price: 500,
        currency: 'USD'
    }, {
        price: 1000,
        currency: 'USD'
    }, {
        price: 5000,
        currency: 'USD'
    }, {
        price: 10000,
        currency: 'USD'
    }];

    $rootScope.addAmountKRW = [{
        price: 1000,
        currency: 'KRW'
    }, {
        price: 10000,
        currency: 'KRW'
    }, {
        price: 500000,
        currency: 'KRW'
    }, {
        price: 1000000,
        currency: 'KRW'
    }, {
        price: 10000000,
        currency: 'KRW'
    }];

    $rootScope.addAmountTHB = [{
        price: 100,
        currency: 'THB'
    }, {
        price: 500,
        currency: 'THB'
    }, {
        price: 1000,
        currency: 'THB'
    }, {
        price: 5000,
        currency: 'THB'
    }, {
        price: 10000,
        currency: 'THB'
    }];

    $rootScope.addAmountCNY = [{
        price: 100,
        currency: 'CNY'
    }, {
        price: 500,
        currency: 'CNY'
    }, {
        price: 1000,
        currency: 'CNY'
    }, {
        price: 5000,
        currency: 'CNY'
    }, {
        price: 10000,
        currency: 'CNY'
    }];

    $rootScope.addAmountMYR = [{
        price: 10,
        currency: 'MYR'
    }, {
        price: 100,
        currency: 'MYR'
    }, {
        price: 500,
        currency: 'MYR'
    }, {
        price: 1000,
        currency: 'MYR'
    }, {
        price: 5000,
        currency: 'MYR'
    }];

    $scope.getAgentBankList = function(){
        var url = "/api/system/GetAgentBankList";
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

    $scope.alreadyLoadCountryAndLangue=false;
    $scope.getCountryAndLanguage = function(){
        if(!$scope.alreadyLoadCountryAndLangue){
            $q.all([
                $http.get("/api/system/GetLanguageList", {
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

    $scope.isSet = function(checkTab) {
        return $rootScope.walletTab == checkTab;
    };

    $scope.setTab = function(setTab) {
        $rootScope.walletTab = setTab;
        if(setTab == 6){
            $scope.getCountryAndLanguage();
        }else if(setTab == 2){
            $scope.getAgentBankList();
        }
    };
});

app.controller("TransferController", function($scope, $rootScope, $http, AmountService, SweetAlert, Balance, $translate) {
    $scope.gspTransfer = {};
    $scope.isProcessing=false;
    $scope.loadGsp = function() {
        $scope.gspWalletList = $rootScope.getAgentGspWalletList;
        $scope.filteredGspWalletList = $rootScope.getAgentGspWalletList;
        $scope.gspTransfer.fromGspWallet = $scope.gspWalletList[0]
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
            var url = "/api/finance/WalletTransfer";
            $http({
                method: 'POST',
                url: url,
                data: $.param($scope.gspTransfer), // pass in data as strings
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                } // set the headers so angular passing info as form data (not request payload)
            }).success(function(data) {
                if (data.status == 200) {
                    if (bowser.msie && bowser.version <= 8) {
                        Balance.getBalance("all");
                        alert(data.message);
                    } else {
                        Balance.getBalance("all");
                        $translate([data.message]).then(function (translations) {
                            SweetAlert.swal(translations[data.message],"","success");
                        });
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
});

app.controller("DepositController", function($scope) {
    $scope.paymentTab = 1;
    $scope.isSetDeposit = function(checkTab) {
        //console.log($scope.paymentTab);
        return $scope.paymentTab === checkTab;
    };
    $scope.setTabDeposit = function(setTabDeposit) {
        //console.log(setTabDeposit);
        $scope.paymentTab = setTabDeposit;
    };

});


app.controller("DepositManualController", function($scope, $http, AmountService, SweetAlert, $injector, $translate, $rootScope) {
    $scope.isProcessing=false;
    $scope.isSelectedBank=false;
    $scope.deposit = {};
    $scope.deposit.amount = 0;
    $scope.deposit.phone = $rootScope.playerDetail.phone;
    $scope.deposit.bankHolder = $rootScope.playerDetail.playerName;
    $scope.error={};

    $scope.addAmount = function(sumAmount) {
        $scope.deposit.amount = AmountService.sumAmount($scope.deposit.amount, sumAmount);
    };

    $scope.resetAmount = function() {
        $scope.deposit.amount = AmountService.resetAmount();
    };

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
            var url = "/api/finance/RequestDeposit";
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
        if ($('.depositBank_radio input').length) {
            $('.depositBank_radio').each(function () {
                $(this).removeClass('bank_on');
            });
            $('.depositBank_radio input:checked').each(function () {
                $(this).parent('label').addClass('bank_on');
            });
        }
    }

    $scope.selectDepositAccount = function() {
        $scope.isSelectedBank=true;
        depositBankRadio();
    };



    $scope.depositTypes = {"ATM":"ATM","Counter":"Counter","CDM":"CDM","Mobile Banking":"Mobile Banking","Internet Banking":"Internet Banking"};

});


app.controller("DepositVPayController", function($scope, $http, AmountService, SweetAlert, $injector, $translate, $rootScope) {
    $scope.isProcessing=false;
    $scope.depositVPay={};

    $scope.depositVPay.amount = 0;
    $scope.depositVPay.phone = $rootScope.playerDetail.phone;
    $scope.depositVPay.address = $rootScope.playerDetail.address;
    $scope.depositVPay.city = $rootScope.playerDetail.city;
    $scope.depositVPay.firstName = $rootScope.playerDetail.firstName;
    $scope.depositVPay.lastName = $rootScope.playerDetail.lastName;
    $scope.depositVPay.bankHolder = $rootScope.playerDetail.playerName;
    $scope.depositVPay.zipCode = $rootScope.playerDetail.zipCode;
    $scope.depositVPay.countryNo = $rootScope.playerDetail.countryNo;
    $scope.error={};

    $scope.depositVPay.CardTypeList = [{
        "CardTypeNo": "1",
        "CardTypeName": "visa"
    }, {
        "CardTypeNo": "2",
        "CardTypeName": "mastercard"
    }
    //{
    // "CardTypeNo": "3",
    // "CardTypeName": "unionpay"
    // }
    ];


    $scope.addAmount = function(sumAmount) {
        $scope.depositVPay.amount = AmountService.sumAmount($scope.depositVPay.amount, sumAmount);
    };

    $scope.resetAmount = function() {
        $scope.depositVPay.amount = AmountService.resetAmount();
    };

    $scope.processForm = function() {
        if(!$scope.isProcessing){
            $scope.isProcessing = true;
            var countryData = $("#depositPhone").intlTelInput("getSelectedCountryData");
            //console.log(countryData.dialCode);
            $scope.depositVPay.dialCode=countryData.dialCode;


            if ($rootScope.loggedIn) {
                var url = "/api/finance/RequestDepositPsp?pspNo=50701&amount="+$scope.depositVPay.amount+"&phone="+$scope.depositVPay.phone+"&dialCode="+$scope.depositVPay.dialCode+"&memo="+$scope.depositVPay.memo+"&address="+$scope.depositVPay.address+"&firstName="+$scope.depositVPay.firstName+"&lastName="+$scope.depositVPay.lastName+"&zipCode="+$scope.depositVPay.zipCode+"&city="+$scope.depositVPay.city+"&countryNo="+$scope.depositVPay.countryNo;
                size="width=1024, height=682";
                var target="VPay";

                var popupWindow = window.open(url,target, size).focus();
            }else {
                ngDialog.open({
                    template: '/popup/login.php',
                    controller: 'LoginController',
                    className: 'ngdialog-theme-default ngdialog-login',
                    overlay:true,
                    scope: $scope
               });
            }
        }
        $scope.isProcessing=false;
    };

    function selectCardRadio() {
        if ($('.cardType_radio input').length) {
            $('.cardType_radio').each(function () {
                $(this).removeClass('card_on');
            });
            $('.cardType_radio input:checked').each(function () {
                $(this).parent('label').addClass('card_on');
            });
        }
    }

    $scope.selectCardType = function() {
        selectCardRadio();
    };
});

app.controller("DepositWePayController", function($scope, $http, AmountService, SweetAlert, $injector, $translate, $rootScope) {
    $scope.wePayBankList =
            [{
                "Currency":"MYR",
                "BankCode":"MBB",
                "BankName":"Maybank Berhad"
            },
            {
                "Currency":"MYR",
                "BankCode":"PBB",
                "BankName":"Public Bank Berhad"
            },
            {
                "Currency":"MYR",
                "BankCode":"CIMB",
                "BankName":"CIMB Bank Berhad"
            },
            {
                "Currency":"MYR",
                "BankCode":"HLB",
                "BankName":"Hong Leong Bank Berhad"
            },
            {
                "Currency":"THB",
                "BankCode":"KKR",
                "BankName":"Karsikorn Bank (K-Bank)"
            },
            {
                "Currency":"THB",
                "BankCode":"THB",
                "BankName":"Bangkok Bank"
            },
            {
                "Currency":"THB",
                "BankCode":"SCB",
                "BankName":"Siam Commercial Bank"
            },
            {
                "Currency":"THB",
                "BankCode":"KTB",
                "BankName":"Krung Thai Bank"
            }];

    $scope.isProcessing=false;
    $scope.depositWePay={};

    $scope.depositWePay.amount = 0;
    $scope.depositWePay.phone = $rootScope.playerDetail.phone;
    $scope.depositWePay.firstName = $rootScope.playerDetail.firstName;
    $scope.depositWePay.lastName = $rootScope.playerDetail.lastName;
    $scope.depositWePay.bankHolder = $rootScope.playerDetail.playerName;
    $scope.error={};

    function depositBankRadio() {
        if ($('.depositBank_radio input').length) {
            $('.depositBank_radio').each(function () {
                $(this).removeClass('bank_on');
            });
            $('.depositBank_radio input:checked').each(function () {
                $(this).parent('label').addClass('bank_on');
            });
        }
    }

    $scope.selectDepositAccount = function() {
        $scope.isSelectedBank=true;
        depositBankRadio();
    };

    $scope.currencyFilterBankList = function(currency){
      return $scope.wePayBankList.Currency == currency;
    };

    $scope.addAmount = function(sumAmount) {
        $scope.depositWePay.amount = AmountService.sumAmount($scope.depositWePay.amount, sumAmount);
    };

    $scope.resetAmount = function() {
        $scope.depositWePay.amount = AmountService.resetAmount();
    };

    $scope.processForm = function() {
        if(!$scope.isProcessing){
            $scope.isProcessing = true;
            var countryData = $("#depositPhone").intlTelInput("getSelectedCountryData");
            //console.log(countryData.dialCode);
            $scope.depositWePay.dialCode=countryData.dialCode;

            if ($rootScope.loggedIn) {

                var url = "/api/finance/RequestDepositPsp?pspNo=50702&amount="+$scope.depositWePay.amount+"&phone="+$scope.depositWePay.phone+"&dialCode="+$scope.depositWePay.dialCode+"&memo="+$scope.depositWePay.memo+"&firstName="+$scope.depositWePay.firstName+"&lastName="+$scope.depositWePay.lastName+"&BankCode="+$scope.depositWePay.bankCode;
                size="width=1024, height=730 location=no status=0";
                var target="WePay";

                var popupWindow = window.open(url,target,size).focus();
            }else {
                ngDialog.open({
                    template: '/popup/login.php',
                    controller: 'LoginController',
                    className: 'ngdialog-theme-default ngdialog-login',
                    overlay:true,
                    scope: $scope
                });
            }
        }
        $scope.isProcessing=false;
    };

    function selectCardRadio() {
        if ($('.cardType_radio input').length) {
            $('.cardType_radio').each(function () {
                $(this).removeClass('card_on');
            });
            $('.cardType_radio input:checked').each(function () {
                $(this).parent('label').addClass('card_on');
            });
        }
    }

    $scope.selectCardType = function() {
        selectCardRadio();
    };
});

app.controller("WithdrawalController", function($scope, $http, AmountService, SweetAlert, $injector, $translate, $rootScope) {
    $scope.isProcessing=false;
    $scope.withdrawal = {};
    $scope.error={};
    $scope.withdrawal.amount = 0;
    $scope.withdrawal.phone = $rootScope.playerDetail.phone;
    $scope.withdrawal.bankHolder = $rootScope.playerDetail.playerName;

    $scope.getAgentBankList = {};
    $http.get("/api/system/GetPlayerBankList")
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
            var url = "/api/finance/RequestWithdrawal";
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

    $scope.loadCoupon = function(){
        var url = "/api/marketing/GetPlayerCouponHistory";
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
    };

    $scope.useCoupon = function(couponCode) {
        var url = "/api/marketing/UseCoupon";
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
            if (data.status == 200) {
                if (data.alert) {
                    if (bowser.msie && bowser.version <= 8) {
                        alert(data.message);
                    } else {
                        $translate([data.message]).then(function (translations) {
                            SweetAlert.swal(translations[data.message], "", "success");
                        });
                    }
                    $scope.loadCoupon();
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

app.controller("AccountDetailsController", function($scope, $http, $rootScope,SweetAlert,$translate) {
    $scope.editPlayerForm =  $rootScope.playerDetail;

    $scope.loadPlayerDetail = function() {
        var url = "/api/player/GetPlayerDetail";
        $http.get(url).success(function(data) {
            if (data.status == 200) {
                //console.log(data.result);
                $scope.editPlayerForm = data.result;
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
    };

    $scope.processForm = function(){
        $scope.isProcessing = true;
        var url = "/api/player/EditPlayerDetail";
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.editPlayerForm), // pass in data as strings
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            } // set the headers so angular passing info as form data (not request payload)
        }).success(function (data) {
            if (data.status == 200) {
                if (bowser.msie && bowser.version <= 8) {
                    alert(data.message);
                    $scope.loadPlayerDetail();
                } else {
                    $translate([data.message]).then(function (translations) {
                        SweetAlert.swal(translations[data.message],"", "success");
                    });
                    $scope.loadPlayerDetail();
                    $scope.closeThisDialog();
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
            $scope.isProcessing = false;
        });

    };

    $scope.$watch(function() {
        return $rootScope.walletTab;
    }, function() {
        if($rootScope.walletTab == 6){
            $scope.editPlayerForm =  $rootScope.playerDetail;
            $("#editPlayerFormPhone").intlTelInput("setNumber", $rootScope.playerDetail.phone);
        }
    }, true);
});

app.controller("ChangePasswordController", function($scope, $http, SweetAlert, ngDialog, $translate) {
    $scope.changePwd = {};

    $scope.processForm = function() {
        $scope.isProcessing = true;
        var url = "/api/player/ChangePassword";
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.changePwd), // pass in data as strings
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            } // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            if (data.status == 200) {
                if (bowser.msie && bowser.version <= 8) {
                    alert(data.message);
                } else {
                    $translate([data.message]).then(function (translations) {
                        SweetAlert.swal(translations[data.message],"","success");
                    });
                }
                $scope.changePasswordForm.$setUntouched();
                $scope.changePwd ={};
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
    };
});


app.controller("ChangePasswordPopupController", function($scope, $http, SweetAlert, ngDialog, $translate) {
    $scope.changePwd = {};

    $scope.processForm = function() {
        $scope.isProcessing = true;
        var url = "/api/player/ChangePassword";
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.changePwd), // pass in data as strings
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            } // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            if (data.status == 200) {
                if (bowser.msie && bowser.version <= 8) {
                    alert(data.message);
                } else {
                    $translate([data.message]).then(function (translations) {
                        SweetAlert.swal(translations[data.message],"","success");
                    });
                }
                $scope.changePwd ={};
                $scope.closeThisDialog();
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
    };
});
