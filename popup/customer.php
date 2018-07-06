<?include_once $_SERVER["DOCUMENT_ROOT"] . "/lib/setCasinoName.php";?>
<?session_start()?>
<div id="popup-customer" ng-class="customerPopup()" ng-init="setTab(selectCustomerTab)">
    <div class="popup-tabs">
        <ul class="popTabs">
            <li id="customerNotice"         ng-class="{ active:isSet(1) }" ng-click="setTab(1)" ng-bind="'Notice' | translate"></li>
            <li id="customerEvent"          ng-class="{ active:isSet(2) }" ng-click="setTab(2)" ng-bind="'Event' | translate"></li>
            <li id="customerFAQ"            ng-class="{ active:isSet(3) }" ng-click="setTab(3)" ng-bind="'FAQ' | translate"></li>
            <li id="customer1on1"           ng-show="loggedIn" ng-class="{ active:isSet(4) }" ng-click="setTab(4)" ><label>1:1</label> <label ng-bind="'Customer Service' | translate"></label></li>
            <li id="customerPartnership"    ng-class="{ active:isSet(5) }" ng-click="setTab(5)" ng-bind="'Affiliate' | translate"></li>
        </ul>
        <div class="clear"></div>
        <div ng-show="isSet(1)" class="popup-content">
            <div ng-show="isRead">
                <div class="header-row-box header-read">
                    <div class="header-title width70"><p class="text-left" ><span  ng-bind="readTitle | translate"></span></p></div>
                    <div class="header-title width30 text-right"><span ng-bind="'Time' | translate"></span> : <strong ng-bind="readDate | userDate"></strong></div>
                    <div class="clear"></div>
                </div>
                <div class="preview-box" ng-bind-html="readContents | nl2br">
                </div>
            </div>
            <div>
                <div class="header-row-box">
                    <div class="header-title width70 text-center" ng-bind="'Title' | translate"></div>
                    <div class="header-title width30 text-center" ng-bind="'Update Date' | translate"></div>
                    <div class="clear"></div>
                </div>
                <div class="pagination-items margin-bottom">
                    <div ng-repeat="notice in filteredPage">
                        <div class="list-row-box">
                            <div class="row-col width70 text-left paddingL10" ng-bind="notice.title | translate" ng-click="readBoardContent(notice.title,notice.startDate,notice.announceNo)"></div>
                            <div class="row-col width30 text-center" ng-bind="notice.startDate | userDate"></div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <pagination boundary-links="true" total-items="totalItems" ng-model="currentPage" items-per-page="numPerPage" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></pagination>
                <div class="clear"></div>
            </div>
        </div>
        <div ng-show="isSet(2)" class="popup-content">
            <div ng-show="isRead">
                <div class="header-row-box header-read">
                    <div class="header-title width70"><p class="text-left" ><span  ng-bind="readTitle | translate"></span></p></div>
                    <div class="header-title width30 text-right"><span ng-bind="'Time' | translate"></span> : <strong ng-bind="readDate | userDate"></strong></div>
                    <div class="clear"></div>
                </div>
                <div class="preview-box" ng-bind-html="readContents | nl2br">
                </div>
            </div>
            <div>
                <div class="header-row-box">
                    <div class="header-title width70 text-center" ng-bind="'Title' | translate"></div>
                    <div class="header-title width30 text-center" ng-bind="'Update Date' | translate"></div>
                    <div class="clear"></div>
                </div>
                <div class="pagination-items margin-bottom">
                    <div ng-repeat="event in filteredPage">
                        <div class="list-row-box">
                            <div class="row-col width70 text-left paddingL10" ng-bind="event.title | translate" ng-click="readBoardContent(event.title,event.startDate,event.announceNo)"></div>
                            <div class="row-col width30 text-center" ng-bind="event.startDate | userDate"></div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <pagination boundary-links="true" total-items="totalItems" ng-model="currentPage" items-per-page="numPerPage" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></pagination>
                <div class="clear"></div>
            </div>
        </div>
        <div ng-show="isSet(3)" class="popup-content">
            <div ng-show="isRead">
                <div class="header-row-box header-read">
                    <div class="header-title width70"><p class="text-left" ><span  ng-bind="readTitle | translate"></span></p></div>
                    <div class="header-title width30 text-right"><span ng-bind="'Time' | translate"></span> : <strong ng-bind="readDate | userDate"></strong></div>
                    <div class="clear"></div>
                </div>
                <div class="preview-box" ng-bind-html="readContents | nl2br">
                </div>
            </div>
            <div>
                <div class="header-row-box">
                    <div class="header-title width70 text-center" ng-bind="'Title' | translate"></div>
                    <div class="header-title width30 text-center" ng-bind="'Update Date' | translate"></div>
                    <div class="clear"></div>
                </div>
                <div class="pagination-items margin-bottom">
                    <div ng-repeat="faq in filteredPage">
                        <div class="list-row-box">
                            <div class="row-col width70 text-left paddingL10" ng-bind="faq.title | translate" ng-click="readBoardContent(faq.title,faq.startDate,faq.announceNo)"></div>
                            <div class="row-col width30 text-center" ng-bind="faq.startDate | userDate"></div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <pagination boundary-links="true" total-items="totalItems" ng-model="currentPage" items-per-page="numPerPage" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></pagination>
                <div class="clear"></div>
            </div>
        </div>
        <div ng-show="isSet(4)" class="popup-content">
            <div ng-show="isRead" ng-if="isRead">
                <div class="header-row-box header-read">
                    <div class="header-title width70"><p class="text-left" ><span  ng-bind="readTitle | translate"></span></p></div>
                    <div class="header-title width30 text-right"><span ng-bind="'Time' | translate"></span> : <strong ng-bind="readDate | userDateTime"></strong></div>
                    <div class="clear"></div>
                </div>
                <div class="preview-box" ng-bind-html="readContents | nl2br">
                </div>
                <div>
                    <div class="message-box margin-bottom" ng-repeat="adminAnswer in customerAnswerList | filter:getAnswerList(readQstAnsSeqNo)">
                        <div class="admin-message" >
                            <div class="message-name text-left"><strong ng-bind="'Admin' | translate"></strong></div>
                            <div class="message-time text-right"><em ng-bind="adminAnswer.updDt | userDateTime"></em></div>
                            <div class="clear"></div>
                            <div class="admin-message-box" >
                                <p ng-bind-html="adminAnswer.contents | nl2br"></p>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <!--Write Message-->
            <div class="margin-bottom" ng-show="isWrite">
                <div class="header-row-box header-read" ng-bind="'Write Message Here' | translate">
                </div>
                <form name="writeForm" novalidate ng-submit="processForm(1)">
                    <div class="header-title-box">
                        <div class="row-box">
                            <label ng-bind="'Subject' | translate"></label>
                            <input type="text" ng-model="writeQuestion.title" class="inputField" placeholder="{{ 'Enter Subject Here' | translate }}" />
                        </div>
                        <div class="row-box">
                            <label ng-bind="'Message' | translate"></label>
                            <textarea rows="5" id="textarea" ng-model="writeQuestion.contents" placeholder="{{ 'Type Your Message Here' | translate }}"></textarea>
                        </div>
                        <div class="row-box">
                            <label>&nbsp;</label>
                            <div class="text-count">
                                <span class="input-textcount" >{{1000 - writeQuestion.contents.length}}</span>
                                <span ng-bind="'Remaining Characters' | translate"></span>
                            </div>
                            <div class="btn-send"><button class="btn btn-send ng-binding" ng-disabled="isProcessing" ng-bind="'Write' | translate"></button></div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </form>
            </div>
            <!--Write Message-->
            <div>
                <div class="clear"></div>
                <div class="header-row-box">
                    <div class="header-title width70 text-center" ng-bind="'Title' | translate"></div>
                    <div class="header-title width30 text-center" ng-bind="'Update Date' | translate"></div>
                    <div class="clear"></div>
                </div>
                <div class="pagination-items margin-bottom">
                    <div ng-repeat="faq in filteredPage">
                        <div class="list-row-box">
                            <div class="row-col width70 text-left paddingL10" ng-bind="faq.title | translate" ng-click="readQuestionContent(faq.title,faq.updDt,faq.contents,faq.boardQstAnsSeqNo)"></div>
                            <div class="row-col width30 text-center" ng-bind="faq.updDt | userDateTime"></div>
                        </div>
                    </div>
                </div>

                <div class="clear"></div>
                <button class="btn btn-submit btn-compose" ng-bind="'Compose Message' | translate" ng-click="btnWrite()"></button>
                <pagination boundary-links="true" total-items="totalItems" ng-model="currentPage" items-per-page="numPerPage" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></pagination>
                <div class="clear"></div>
            </div>
        </div>
        <div ng-show="isSet(5)" class="popup-content">
            <div ng-controller="AffiliateController">
            <ul class="popTabPills" ng-show="loggedIn">
                <li id="customerNotice" ng-class="{ active:isSetCustomer(1) }" ng-click="setTabCustomer(1,false)" ng-bind="'Introduction' | translate"></li>
                <li id="customerEvent"  ng-class="{ active:isSetCustomer(2) }" ng-click="setTabCustomer(2,false)" ng-bind="'Affiliate Board' | translate"></li>
            </ul>
            <div class="clear"></div>

            <div ng-show="isSetCustomer(1)">
                <div class="partnership-banner" class="owl-carousel owl-theme">
                    <div class="item">
                        <h1><span ng-bind="'You can earn up to' | translate"></span> 40%!</h1>
                        <p>40% <span ng-bind="'flat without tier, applicable to all products, Sportsbook, Live Casino' | translate"></span>,<br /><span ng-bind="'Slots, Lottery & Poker' | translate"></span></p>
                        <p>*<span ng-bind="'Limited time only, Terms & Conditions apply' | translate"></span>.</p>
                        <img src="common/images/banner-partnership1.png" />
                    </div>
                    <div class="item">
                        <h1><span ng-bind="'Fair & Transparent Revenue Sharing' | translate"></span>,<br /><span ng-bind="'No Hidden Charges'| translate"></span>!</h1>
                        <p><span ng-bind="'We share all earning fairly, only payment fee and promotion bonus/rebate' | translate"></span> <br /><span ng-bind="'are shared in proportionate cost with affiliate' | translate"></span>.</p>
                        <img src="common/images/banner-partnership1.png" />
                    </div>
                </div>
                <div class="partnership-box box-default container-box width30 float-left">
                    <h3><span>1</span> <span ng-bind="'SUBMIT APPLICATION' | translate"></span></h3>
                    <p><span ng-bind="'Start by filling the Affiliate Programme application form with your details today As soon as you submit it, you become part of the most rewarding affiliate program around' | translate"></span> <span ng-bind="'Join Now' | translate"></span>!</p>

                    <h3><span>2</span> <span ng-bind="'START PROMOTING' | translate"></span></h3>
                    <p><span><?=$casinoName?></span> <span ng-bind="'Affiliate Program offers you a vast array of advanced marketing tools to attract new Members and start promoting' | translate"></span></p>

                    <h3><span>3</span> <span ng-bind="'START MAKING MONEY' | translate"></span></h3>
                    <p class="no-margin" ng-bind="'You profit from every player that you refer Make the most of your potential to attract as many players as you can The more you keep them coming, the higher your revenue' | translate"></p>
                </div>
                <div class="partnership-box box-default container-box width68 float-right">
                    <h2 ng-bind="'WHY JOIN OUR AFFILIATE PROGRAMME?' | translate"></h2>
                    <p ng-bind="'By becoming an affiliate, you can:' | translate"></p>
                    <ol>
                        <li>1.  <span ng-bind="'Earn up to 40% commission on your Revenue Share' | translate"></span></li>
                        <li>2.  <span ng-bind="'Earn Lifetime revenue on referred players' | translate"></span></li>
                        <li>3.  <span ng-bind="'Full cross product earnings' | translate"></span></li>
                        <li>4.  <span ng-bind="'Be part of the next generation of online Sports Betting' | translate"></span></li>
                        <li>5.  <span ng-bind="'Wide range of greate products' | translate"></span></li>
                        <li>6.  <span ng-bind="'Full support from our dedicated affiliate managers' | translate"></span></li>
                    </ol>
                            <span class="text-center">
                                <button ng-show="!loggedIn" class="btn btn-submit"  ng-bind="'Join Now' | translate" ng-click="displaySignUp()"></button>
                                <button ng-show="loggedIn" class="btn btn-submit" ng-bind="'CLICK HERE' | translate" ng-click="setTabCustomer(2,true)"></button>
                            </span>
                </div>
                <div class="clear"></div>
            </div>
            <div ng-show="isSetCustomer(2)">
                <div ng-show="isRead" ng-if="isRead">
                    <div class="header-row-box header-read">
                        <div class="header-title width70"><p class="text-left" ><span  ng-bind="readTitle | translate"></span></p></div>
                        <div class="header-title width30 text-right"><span ng-bind="'Time' | translate"></span> : <strong ng-bind="readDate | userDateTime"></strong></div>
                        <div class="clear"></div>
                    </div>
                    <div class="preview-box" ng-bind-html="readContents | nl2br">
                    </div>
                    <div>
                        <div class="message-box margin-bottom" ng-repeat="adminAnswer in customerAnswerList | filter:getAnswerList(readQstAnsSeqNo)">
                            <div class="admin-message" >
                                <div class="message-name text-left"><strong ng-bind="'Admin' | translate"></strong></div>
                                <div class="message-time text-right"><em ng-bind="adminAnswer.updDt | userDateTime"></em></div>
                                <div class="clear"></div>
                                <div class="admin-message-box" >
                                    <p ng-bind-html="adminAnswer.contents | nl2br"></p>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <!--Write Message-->
                <div class="margin-bottom" ng-show="isWrite">
                    <div class="header-row-box header-read" ng-bind="'Write Message Here' | translate">

                    </div>
                    <form name="writeForm" novalidate ng-submit="processForm(2)">
                    <div class="header-title-box">
                            <div class="row-box">
                                <label ng-bind="'Subject' | translate"></label>
                                <input type="text" ng-model="writeQuestion.title" class="inputField" placeholder="{{ 'Enter Subject Here' | translate }}" />
                            </div>
                            <div class="row-box">
                                <label ng-bind="'Message' | translate"></label>
                                <textarea rows="5" id="textarea" ng-model="writeQuestion.contents" placeholder="{{ 'Type Your Message Here' | translate }}"></textarea>

                            </div>
                            <div class="row-box">
                                <label>&nbsp;</label>
                                <div class="text-count">
                                    <span class="input-textcount" >{{1000 - writeQuestion.contents.length}}</span>
                                    <span ng-bind="'Remaining Characters' | translate"></span>
                                </div>
                                <div class="btn-send"><button class="btn btn-send ng-binding" ng-disabled="isProcessing" ng-bind="'Write' | translate"></button></div>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                    </form>
                    </div>
                </div>
                <!--Write Message-->
                <div>
                    <div class="clear"></div>
                    <div class="header-row-box">
                        <div class="header-title width70 text-center" ng-bind="'Title' | translate"></div>
                        <div class="header-title width30 text-center" ng-bind="'Update Date' | translate"></div>
                        <div class="clear"></div>
                    </div>
                    <div class="pagination-items margin-bottom">
                        <div ng-repeat="faq in filteredPage">
                            <div class="list-row-box">
                                <div class="row-col width70 text-left paddingL10" ng-bind="faq.title | translate" ng-click="readQuestionContent(faq.title,faq.updDt,faq.contents,faq.boardQstAnsSeqNo)"></div>
                                <div class="row-col width30 text-center" ng-bind="faq.updDt | userDateTime"></div>
                            </div>
                        </div>
                    </div>

                    <div class="clear"></div>
                    <button class="btn btn-submit btn-compose" ng-bind="'Compose Message' | translate" ng-click="btnWrite()"></button>
                    <pagination boundary-links="true" total-items="totalItems" ng-model="currentPage" items-per-page="numPerPage" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></pagination>
                    <div class="clear"></div>
                </div>
           </div>
        </div>
    </div>
</div>