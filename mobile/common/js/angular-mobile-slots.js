app.controller("SlotContentController", function($scope,$http,SweetAlert,$translate,$rootScope) {

    if($rootScope.slotGspNo2 == undefined || $rootScope.tabIndex2 == undefined){
        $scope.slotGspNo=102;
        $scope.tabIndex = 0;
        $(".langSelection").css("display","none");
    }else{
        $scope.slotGspNo = $rootScope.slotGspNo2;
        $scope.tabIndex = $rootScope.tabIndex2;
    }

    $scope.loadSlot = function(gspNo,category,isFun){

        if($rootScope.getAgentProductSlotList == undefined){
            //console.log($rootScope.getAgentProductSlotList);
        }else{
            $scope.slotItems ="";
            $scope.gspNo=gspNo;
            if(category == undefined){
                if(gspNo==102){
                    category = "Mobile";
                }else if(gspNo==901){
                    category = "Mobile";
                }else if(gspNo==902){
                    category = "Mobile";
                }else if(gspNo==104){
                    category = "Mobile";
                }else if(gspNo==112){
                    category = "Mobile";
                }
            }
            if(isFun == undefined) {
                isFun=false;
            }
            var url="../api/system/GetGspGameList";
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

app.controller('SlotController', function($scope,$rootScope,$window) {

    $scope.slotContent = function(tabIndex, gspNo){
        $window.location.href='#slotsContent';
        $rootScope.tabIndex2 = tabIndex;
        $rootScope.slotGspNo2 = gspNo;
    };

    $(".langSelection").css("display","none");

});
