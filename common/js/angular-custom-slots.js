app.controller("TabController", function() {
    this.tab = 1;

    this.isSet = function(checkTab) {
        return this.tab === checkTab;
    };

    this.setTab = function(setTab) {
        this.tab = setTab;
    };
});

app.controller('SlotController', function($scope,$http,SweetAlert,$translate,$rootScope) {

    $scope.gspNo =$rootScope.getAgentProductSlotList[0]["gspNo"];
    $scope.slotItems ="";

    $scope.loadSlot = function(gspNo,category,isFun){
        if($rootScope.getAgentProductSlotList == undefined){

        }else{
            $scope.slotItems ="";
            $scope.gspNo=gspNo;
            if(category == undefined){
                if(gspNo==102){
                    category = "Slots_3d";
                    $('.slot-102-first').addClass('active');
                }else if(gspNo==901){
                    category = "Slots";
                    $('.slot-901-first').addClass('active');
                }else if(gspNo==902){
                    category = "Arcades";
                    $('.slot-902-first').addClass('active');
                }else if(gspNo==104){
                    category = "Advanced_Slot";
                    $('.slot-104-first').addClass('active');
                }else if(gspNo==112){
                    category = "Slots";
                    $('.slot-112-first').addClass('active');
                }else if(gspNo==106){
                    category = "Slots";
                    $('.slot-106-first').addClass('active');
                }else if(gspNo==109){
                    category = "Video_Slots";
                    $('.slot-109-first').addClass('active');
                }
            }

            if(isFun == undefined) {
                isFun=false;
            }
            var url="/api/system/GetGspGameList";
            $http({
                method: 'POST',
                url: url,
                data: $.param({
                    gspNo: gspNo,
                    category: category,
                    isFun: isFun
                }),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                } // set the headers so angular passing info as form data (not request payload)
            }).success(function(data) {
                if (data.status == 200) {
                    //console.log(data);
                    $scope.slotItems = data.result.gspGameList;
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
                $('.slot-game-button, .slot-container ul li').click(function(){
                    $(this).siblings('.active').removeClass('active');
                    $(this).addClass('active');
                });
            });

        }

    };
});
