
//WalletPopup
app.controller("PromoController", function($scope, $rootScope, $http, SweetAlert) {

});


app.controller("PromoDetailsController", function($scope) {
    $scope.isSetPromo = function(checkTab) {
        return $scope.promoDetailsTab === checkTab;
    };

    $scope.setTabPromo = function(setTabPromo) {
        $scope.promoDetailsTab = setTabPromo;
    };
});