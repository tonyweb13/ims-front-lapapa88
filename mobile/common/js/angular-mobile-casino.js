app.controller('CasinoController', function($scope, $rootScope, ngDialog, SweetAlert, $location, $translate) {


    $scope.needLogin = function() {
        $translate(['PleaseLogin']).then(function (translations) {
            SweetAlert.swal(translations.PleaseLogin);
        });
    };

    $scope.downloadMicro = function(btag1,btag2) {
        console.log(btag1,btag2);
       //$location.url("http://mobile-resigner.valueactive.eu/launch88livedealer/apk?btag1="+btag1+"&btag2="+btag2);
    };

    $scope.displayDeposit = function() {
        if ($rootScope.loggedIn) {
            ngDialog.open({
                template: 'popup/deposit.php',
                className: 'ngdialog-deposit',
                controller: 'DepositDialogController',
                showClose: true,
                closeByEscape: false
            });
        } else {
            slideLoginOpen();
        }
    };

    $scope.optin = function() {
        if ($rootScope.loggedIn) {
            slideAccountOpen();
        }else{
            slideLoginOpen();
        }
    };

    $(".langSelection").css("display","none");

});