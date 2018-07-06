/*function isiPhone(){
    return (
    (navigator.platform.indexOf("iPhone") != -1) ||
    (navigator.platform.indexOf("iPod") != -1)
    );
}
if(isiPhone()){
    $(".popover-homescreen").show(); //Alert for iPhone/iPod Only
}*/

/*Standalone*/
(function() {
    var metas = document.getElementsByTagName('meta');

    for (var n in metas){
        var meta = metas[n];
        if (meta.name === 'viewport'){
            meta.remove();
        }
    }

    var meta = document.createElement('meta');
    meta.setAttribute('name', 'viewport');

    if (navigator.standalone) {
        meta.setAttribute('content', 'width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui');

        /*var height = $(window).height();
        var width = $(window).width();

        if(height>width) {
            $('body').css('border-top','20px solid #00acd6'); // Portrait
        } else {
            $('body').css('border-top','0'); // Landscape
        }

        $(window).on("orientationchange",function(){
            if(window.orientation == 0) {
                $('body').css('border-top','20px solid #00acd6'); // Portrait
            } else {
                $('body').css('border','0'); // Landscape
            }
        });*/
    }
    else{
        meta.setAttribute('content', 'initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, minimal-ui');
    }

    var head = document.getElementsByTagName('head')[0];
    head.appendChild(meta);
})();


/*Standalone Links*/
(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")

$(window).load(function() {
    //$("#preloader").delay(400).fadeOut("slow");

    /* Mobile Touchstart :active */
    if(/iP(hone|ad)/.test(window.navigator.userAgent)) {
        var elements = document.querySelectorAll('button');
        var emptyFunction = function() {};
        for(var i = 0; i < elements.length; i++) {
            elements[i].addEventListener('touchstart', emptyFunction, false);
        }
    }
});

/*Slide Menu Functions*/
function slideLoginOpen() {
    $("#slide-login").addClass('slide-menu-open');
    $("body").addClass('scrollOff');
    $('.cover').fadeIn();
}
function slideLoginClose() {
    $("#slide-login").removeClass('slide-menu-open');
    $("body").removeClass('scrollOff');
    $('.cover').fadeOut();
}

function slideCreateAccountOpen() {
    $("#slide-login").fadeOut(300);
    $("#slide-signup").addClass('slide-menu-open');
}
function slideCreateAccountClose() {
    $("#slide-login").fadeIn(300);
    $('#slide-signup').removeClass('slide-menu-open');
}

function slideTermsOpen() {
    $("#slide-signup").fadeOut(300);
    $("#slide-terms").addClass('slide-menu-open');
}
function slideTermsClose() {
    $("#slide-signup").fadeIn(300);
    $('#slide-terms').removeClass('slide-menu-open');
}

function slideForgotOpen() {
    $("#slide-login").fadeOut(300);
    $("#slide-forgot").addClass('slide-menu-open');
}
function slideForgotClose() {
    $("#slide-login").fadeIn(300);
    $('#slide-forgot').removeClass('slide-menu-open');
}

function slideAccountOpen() {
    $("#slide-account").addClass('slide-menu-open');
    $("body").addClass('scrollOff');
    $('.cover').fadeIn();
}
function slideAccountClose() {
    $("#slide-account").removeClass('slide-menu-open');
    $("body").removeClass('scrollOff');
    $('.cover').fadeOut();
}

function slideDepositOpen() {
    $("#slide-account").fadeOut(300);
    $('#slide-deposit').addClass('slide-menu-open');
}
function slideDepositClose() {
    $("#slide-account").fadeIn(300);
    $('#slide-deposit').removeClass('slide-menu-open');
}

function slideWithdrawOpen() {
    $("#slide-account").fadeOut(300);
    $('#slide-withdraw').addClass('slide-menu-open');
}
function slideWithdrawClose() {
    $("#slide-account").fadeIn(300);
    $('#slide-withdraw').removeClass('slide-menu-open');
}

function slideTransferOpen() {
    $("#slide-account").fadeOut(300);
    $('#slide-transfer').addClass('slide-menu-open');
}
function slideTransferClose() {
    $("#slide-account").fadeIn(300);
    $('#slide-transfer').removeClass('slide-menu-open');
}

function slideBonusOpen() {
    $("#slide-account").fadeOut(300);
    $('#slide-bonus').addClass('slide-menu-open');
}
function slideBonusClose() {
    $("#slide-account").fadeIn(300);
    $('#slide-bonus').removeClass('slide-menu-open');
}

function slideSettingsOpen() {
    $("#slide-account").fadeOut(300);
    $('#slide-settings').addClass('slide-menu-open');
}
function slideSettingsClose() {
    $("#slide-account").fadeIn(300);
    $('#slide-settings').removeClass('slide-menu-open');
}

//Input Number
/*function tog(v){return v?'addClass':'removeClass';}
$(document).on('input', '.clearable', function(){
    $(this)[tog(this.value)]('x');
}).on('mousemove', '.x', function( e ){
    $(this)[tog(this.offsetWidth-30 < e.clientX-this.getBoundingClientRect().left)]('onX');
}).on('touchstart click', '.onX', function( ev ){
    ev.preventDefault();
    $(this).removeClass('x onX').val('').change();
});*/

/*$(document).on('focus', 'input, textarea', function() {
    $(".navbar-fixed-bottom").hide();
});
$(document).on('blur', 'input, textarea', function() {
    $(".navbar-fixed-bottom").show();
});*/

$(document).ready(function(){
    addToHomescreen();

    $("input[data-type='number']").keyup(function(event){
        if(event.which >= 37 && event.which <= 40){
            event.preventDefault();
        }
        var $this = $(this);
        var num = $this.val().replace(/,/gi, "");
        var num2 = num.split(/(?=(?:\d{3})+$)/).join(",");
        console.log(num2);
        $this.val(num2);
    });

    $(".btn-popup-deposit").bind("click", function () {
        $('#popup-deposit .popup-close').click();
        $("#slide-account").addClass('slide-menu-open');
        $("body").addClass('scrollOff');
        $('.cover').fadeIn();
        slideDepositOpen();
    });

    /*$(".backMenuAccount").bind("click", function () {
        slideDepositClose();
        slideWithdrawClose();
        slideTransferClose();
        slideBonusClose();
        slideSettingsClose();
        slideCouponClose();
    });*/

    /*Popup*/
    /*$('.btnSports').click(function(){popupTransfer()});
    $('.btnCasino').click(function(){popupDeposit()});
    function popupTransfer(){
        $('#popup-transfer').bPopup({easing: 'easeOutBack', speed: 400, positionStyle: 'fixed'});
    }
    function popupDeposit(){
        $('#popup-deposit').bPopup({easing: 'easeOutBack', speed: 400, positionStyle: 'fixed'});
    }*/
});