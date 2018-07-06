app.controller("MainController", function($rootScope, $scope, $http, $q, ngDialog) {
    $scope.contactEmailList = {};
    $scope.contactPhoneList = {};
    $scope.contactSnsList = {};
    $scope.alwaysDisplayOn = "";
    $scope.includePage = "";
    $scope.page = {};
    $scope.gspLiveGameList = {
        "101":{"liveGameList":"Blackjack | Roulette | Baccarat  | Knockout Baccarat | Live Lottery"},  //ezugi
        "102":{"liveGameList":"Baccarat | Super98 Baccarat | 7UP Baccarat | Dragon Tiger | Sicbo"},  //gameplay
        "103":{"liveGameList":"Baccarat | Super98 | Dragon Tiger | Sicbo | Blackjack"},  //golddeluxe
        "104":{"liveGameList":"Traditional Baccarat | Parlay Baccarat | Multigame Baccarat"},  //microgaming
        "105":{"liveGameList":"Blackjack | Roulette | Baccarat | Dragon Tiger | Sicbo"},  //xprogaming
        "107":{"liveGameList":"Baccarat | Super98 | Dragon Tiger | Sicbo | Blackjack"},  //bbtech
        "109":{"liveGameList":"Baccarat | Super98 | Dragon Tiger | Sicbo | Blackjack"},  //interplay
        "110":{"liveGameList":"Baccarat | Roulette | Craps | Tiger Dragon | Caribbean Poker"}   //vivo game
    };

    $scope.init = function() {
        $q.all([
            $http.get("/api/agent/GetAgentContactInfo", {
                cache: true
            })
                .success(function(data) {
                    if (data.status == 200) {
                        if (!data.result.alwaysDisplayOn && !$rootScope.loggedIn) {
                            $scope.includePage = "/pages/contractDisable.php";
                        } else {
                            $scope.contactEmailList = data.result.contactEmailList;
                            $scope.contactPhoneList = data.result.contactPhoneList;
                            $scope.contactSnsList = data.result.contactSnsList;
                            $scope.includePage = "/pages/contractInfo.php"
                        }
                    }
                }).error(function(data, status) {
                    console.error('Repos error', status, data);
                }),
            $http.get("/api/finance/GetPaymentTransactionHistory?count=5", {
                cache: true
            })
            .success(function(data) {
                if (data.status == 200) {
                    $scope.topWithdrawalList = data.result.topWithdrawalList;
                    $scope.currentDepositList = data.result.currentDepositList;
                    $scope.currentWithdrawalList = data.result.currentWithdrawalList;
                }
            }).error(function(data, status) {
                console.error('Repos error', status, data);
            })["finally"](function() {
                $("#transaction-slider").owlCarousel({
                    autoPlay: true,
                    pagination: true,
                    navigation: false,
                    slideSpeed: 300,
                    paginationSpeed: 400,
                    singleItem: true
                });

                //deposit withdrawal progress bar
                function progressBar(percent, $element) {
                    var progressBarWidth = percent * $element.width() / 100;
                    $element.find('div').animate({
                        width: progressBarWidth
                    }, 500).html(percent + "%&nbsp;");
                }
                progressBar(20, $('#depositBar'));
                progressBar(50, $('#withdrawBar'));

                $('.game-button').hover(function() {
                    $(this).find('.game-button-overlay').fadeIn('fast');
                }, function() {
                    $(this).find('.game-button-overlay').fadeOut('fast');
                });

            })
        ]);
    };

    $scope.$on('$viewContentLoaded', function() {
        $('#promo-slider').owlCarousel({
            autoPlay: true,
            pagination: true,
            navigation: false,
            slideSpeed: 600,
            paginationSpeed: 400,
            singleItem: true
        });


        $http.get("/lib/jackpot.php").success(function (data) {
            if (data.length <= 1) {
            } else {
                function number_change(num) {
                    num = String(num);
                    num = num.replace(",", "");
                    num = num.replace(".", "");
                    num = num.substring(0, num.length - 2) + "." + num.substring(num.length - 2, num.length);
                    return num;
                }

                var jackpotTotalMoney = data.split('|');
                var jackpotValue = number_change(jackpotTotalMoney[0]);
                var plusCnt=parseFloat("0."+jackpotTotalMoney[1]);
                $('.pjackpot').jOdometer({
                    increment:plusCnt,
                    counterStart:jackpotValue,
                    counterEnd:false,
                    numbersImage: '/common/images/jodometer-numbers-gold.png',
                    spaceNumbers: 0,
                    formatNumber: true,
                    widthNumber: 38,
                    heightNumber: 60
                });
            }
        });
    });
});
