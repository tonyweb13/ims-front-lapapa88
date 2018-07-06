<div class="mobile-container">
    <div class="container">
        <div class="pageTitleImage titleMobile">
            <h1 ng-bind="'Mobile' | translate"></h1>
            <h2>
                <span ng-bind="'An exciting journey awaits on our mobile platform' | translate"></span><span>!</span>
                <span ng-bind="'Many awesome games will be on your hand' | translate"></span><span>!</span>
            </h2>

            <ul>
                <li ng-bind="'Fully Supports iOS and Android' | translate"></li>
                <li><label ng-bind="'Over' | translate"></label>  <label>4,000</label> <label ng-bind="'matches on' | translate"></label> <label ng-bind="'Sports Betting' | translate"></label><label>,</label> <label ng-bind="'Variety Casinos' | translate"></label> <label>&</label> <label ng-bind="'Slot Games' | translate"></label></li>
                <li><label ng-bind="'Play Interactive Games right on your hand' | translate"></label>!</li>
                <li><label ng-bind="'Instant Deposit' | translate"></label><label>,</label> <label ng-bind="'Withdraw' | translate"></label> <label>&</label> <label ng-bind="'Transfer' | translate"></li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="mobile-banner">
        <ul>
            <li class="mobile-thumb-sports">
                <span ng-bind="'Sportsbook' | translate"></span>
            </li>
            <li class="mobile-thumb-casino">
                <span ng-bind="'Live Casino' | translate"></span>
            </li>
            <li class="mobile-thumb-slot">
                <span ng-bind="'Slot Games' | translate"></span>
            </li>
            <li class="mobile-thumb-poker">
                <span ng-bind="'Online Poker' | translate"></span>
            </li>
            <li class="mobile-thumb-keno">
                <span><label ng-bind="'Keno' | translate"></label> <label>&</label> <label ng-bind="'Lottery' | translate"></label></span>
            </li>
        </ul>

        <div class="mobile-banner-main">
            <img src="common/images/mobile-banner.png" />
        </div>
    </div>

    <!--<div id="mobile-banner">
        <ul class="mobile-banner-main">
            <li><img src="common/images/mobile-banner-sports.png" /></li>
            <li><img src="common/images/mobile-banner-casino.png" /></li>
            <li><img src="common/images/mobile-banner-slot.png" /></li>
            <li><img src="common/images/mobile-banner-poker.png" /></li>
            <li><img src="common/images/mobile-banner-sports.png" /></li>
        </ul>
        <ul class="mobile-thumb">
            <li index='1' class="mobile-thumb-sports current"><span>Sportbook</span></li>
            <li index='2' class="mobile-thumb-casino"><span>Live Casino</span></li>
            <li index='3' class="mobile-thumb-slot"><span>Slot Games</span></li>
            <li index='4' class="mobile-thumb-poker"><span>Online Poker</span></li>
            <li index='5' class="mobile-thumb-keno"><span>Keno & Lottery</span></li>
        </ul>
    </div>-->

    <!--<script>
        var myTimer;
        var currentIndex = -1;
        var $big = $('.mobile-banner-main li');
        var $small = $('.mobile-thumb li');
        function show(){
            var next = currentIndex < ($big.length -1)? currentIndex+1:0;
            showImg(next);
        }

        function showImg(index){
            $($big[index]).stop().fadeIn('slow').siblings().stop().fadeOut('fast');
            $($small[index]).addClass('current').siblings().removeClass('current');
            currentIndex = index;
        }

        $(function(){
            myTimer = setInterval("show()",6000);
            $big.hover(function(){clearInterval(myTimer);},function(){myTimer = setInterval("show()",6000);});
            $small.hover(function(){
                var index = $(this).attr('index');
                clearInterval(myTimer);
                showImg(index-1);
            },function(){
                myTimer = setInterval("show()",6000);
            });
            show();
        });
    </script>-->
    <div class="clear"></div>
</div>