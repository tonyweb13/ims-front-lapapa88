app.controller("CustomerController", function($scope,$http,$rootScope,SweetAlert, $translate, loggedInStatus) {
    $rootScope.isRead=false;
    $rootScope.boardList = {};
    $rootScope.filteredPage = [];
    $rootScope.totalItems = 0;
    $rootScope.currentPage = 1;
    $rootScope.maxSize = 5;
    $rootScope.numPerPage = 10;
    $rootScope.readTitle="";
    $rootScope.readDate="";
    $rootScope.readContents="";
    $rootScope.readQstAnsSeqNo="";
    $rootScope.writeQuestion={};
    $rootScope.isProcessing=false;

    $scope.isSet = function(checkTab) {
        return $scope.tab === checkTab;
    };

    $scope.setTab = function(setTab) {
        $rootScope.filteredPage={};
        $rootScope.isRead=false;
        $rootScope.isWrite=false;
        $rootScope.writeQuestion={};
        $scope.tab = setTab;

        var page="";
        if(setTab==1){
            page="GetAnnouncements?announceTypeCd=1";
            $rootScope.loadBoardList(page)
        }else if(setTab==2){
            page="GetAnnouncements?announceTypeCd=2";
            $rootScope.loadBoardList(page)
        }else if(setTab==3){
            page="GetAnnouncements?announceTypeCd=3";
            $rootScope.loadBoardList(page)
        }else if(setTab==4){
            page="GetQuestionAnswerList?qstAnsTypeCd=1";
            $rootScope.loadQAList(page)
        }else if(setTab==5){
            if(loggedInStatus.loggedIn){
                page="GetQuestionAnswerList?qstAnsTypeCd=2";
                $rootScope.loadQAList(page)
            }
        }
    };

    $rootScope.loadBoardList = function(page) {
        var url = "/api/operation/"+page;
        $http.get(url).success(function (data) {
            if (data.status == 200) {
                $rootScope.boardList = data.result.announcementList;
                $rootScope.totalItems = $rootScope.boardList.length;
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
            $rootScope.numPagesCal = function () {
                return Math.ceil($rootScope.boardList.length / $rootScope.numPerPage);
            };

            $rootScope.numPages = $rootScope.numPagesCal();

            $rootScope.$watch('currentPage + numPerPage', function () {
                var begin = (($rootScope.currentPage - 1) * $rootScope.numPerPage),
                    end = begin + $rootScope.numPerPage;
                $rootScope.filteredPage = $rootScope.boardList.slice(begin, end);
                if($rootScope.indexAnnounce != undefined){
                    $rootScope.readBoardContent($rootScope.indexAnnounce.title,$rootScope.indexAnnounce.startDate,$rootScope.indexAnnounce.announceNo);
                    $rootScope.indexAnnounce=undefined;
                }
            });
        });
    };

    $rootScope.readBoardContent = function(title,date,announceNo){
        var url="/api/operation/GetAnnounceContents";
        $http({
            method: "POST",
            url: url,
            data: $.param({
                "announceNo": announceNo
            }), // pass in data as strings
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            } // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            if (data.status == 200) {
                $rootScope.readTitle=title;
                $rootScope.readDate=date;
                $rootScope.readContents=data.result.contents;
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
            $rootScope.isRead=true;
        });
    };

    $rootScope.loadQAList = function(page){
        var url = "/api/operation/"+page;
        $http.get(url).success(function(data) {
            if (data.status == 200) {
                $rootScope.customerQuestionList = data.result.QuestionList;
                $rootScope.customerAnswerList = data.result.AnswerList;
                $rootScope.totalItems = $scope.customerQuestionList.length;
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
            $rootScope.numPagesCal = function() {
                return Math.ceil($rootScope.customerQuestionList.length / $rootScope.numPerPage);
            };

            $rootScope.numPages = $rootScope.numPagesCal();

            $rootScope.$watch('currentPage + numPerPage', function() {
                var begin = (($rootScope.currentPage - 1) * $rootScope.numPerPage),
                    end = begin + $rootScope.numPerPage;
                $rootScope.filteredPage = $rootScope.customerQuestionList.slice(begin, end);
                $rootScope.isRead=false;
            });
        });
    };

    $rootScope.getAnswerList = function(readQstAnsSeqNo){
        return function(adminAnswer){
            return adminAnswer.parentBoardQstAnsSeqNo === readQstAnsSeqNo;
        };
    };

    $rootScope.readQuestionContent = function(title,date,contents,boardQstAnsSeqNo){
        $rootScope.readTitle=title;
        $rootScope.readDate=date;
        $rootScope.readContents=contents;
        $rootScope.readQstAnsSeqNo=boardQstAnsSeqNo;
        $rootScope.isRead=true;
        $rootScope.isWrite=false;
    };

    $rootScope.btnWrite = function(){
        $rootScope.isRead=false;
        $rootScope.isWrite=true;

    };

    $rootScope.processForm = function(qstAnsTypeCd) {
        $rootScope.writeQuestion.qstAnsTypeCd=qstAnsTypeCd;
        $rootScope.isProcessing = true;
        var url = "/api/operation/LeaveQuestion";
        $http({
            method: 'POST',
            url: url,
            data: $.param($rootScope.writeQuestion), // pass in data as strings
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            } // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            if (data.status == 200) {
                if (bowser.msie && bowser.version <= 8) {
                    alert(data.message);
                } else {
                    $translate([data.message]).then(function (translations) {
                        SweetAlert.swal(translations[data.message], "", "success");
                    });
                }
                $rootScope.writeQuestion={};
                $rootScope.isWrite=false;
                var page="GetQuestionAnswerList?qstAnsTypeCd="+qstAnsTypeCd;
                $rootScope.loadQAList(page)

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
            $rootScope.isProcessing = false;
        });
    }
});

app.controller("NoticePopupController",function($scope, $http, $rootScope,$cookies, SweetAlert, $translate){
    $scope.readBoardContent = function(){
        var url="/api/operation/GetAnnounceContents";
        $http({
            method: "POST",
            url: url,
            data: $.param({
                "announceNo": $rootScope.anouncementPopup.announceNo
            }), // pass in data as strings
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            } // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            if (data.status == 200) {
                $rootScope.anouncementPopup.readContents=data.result.contents;
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


     $scope.notToday = function(){
        var expireDate = new Date();
        expireDate.setDate(expireDate.getDate() + 1);
        $cookies.put('notToday','true', {'expires': expireDate});
        $scope.closeThisDialog();
    };
});


app.controller("AffiliateController", function($scope,$rootScope) {
    $rootScope.isRead=false;
    $scope.tab = 1;

    $scope.isSetCustomer = function(checkTab) {
        return this.tab === checkTab;
    };

    $scope.setTabCustomer = function(setTabCustomer,isWrite) {
        this.tab = setTabCustomer;
        $rootScope.isRead=false;
        $rootScope.isWrite=isWrite
    };
});

