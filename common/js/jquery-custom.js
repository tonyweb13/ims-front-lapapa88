$(document).ready(function(){
    //Balance Main & Sports Toggle
    $(".balanceContent").click(function() {
        if($('.navSports').hasClass('active')){
            $(".box-balance-container").css('top','-2px').slideToggle('slow', 'easeInOutBack');
        }else{
            $(".box-balance-container").css('top','-12px').slideToggle('slow', 'easeInOutBack');
        }
    });

    //Language Option
    $(".lang-option, #lang-list li").click(function(){
        $("#lang-list").stop().slideToggle('slow', 'easeInOutBack');
    });

    //Tooltip
    $('.tooltip').hide();
    $('.btn-forgotpass').hover(function(){ $('.tooltipForgot').show();}, function() {$('.tooltipForgot').hide(); });
    $('.icon-tip-currency').hover(function(){ $('.tooltipCurrency').show();}, function() {$('.tooltipCurrency').hide(); });
    $('.icon-tip-wallet').hover(function(){ $('.tooltipWallet').show();}, function() {$('.tooltipWallet').hide(); });
    $('.icon-tip-mainwallet').hover(function(){ $('.tooltipMainWallet').show();}, function() {$('.tooltipMainWallet').hide(); });
    $('.icon-tip-sms').hover(function(){ $('.tooltipSMS').show();}, function() {$('.tooltipSMS').hide(); });

    //Placeholder
    $("input, input:password, textarea").placeholder({customClass:'placeholder'});

    //Scrollbar Custom
    $(".notice-content, .terms-content").mCustomScrollbar({scrollInertia:200});
    $("#popup-wallet div.popup-content").mCustomScrollbar({scrollInertia:200});
    $("#popup-customer div.popup-content").mCustomScrollbar({scrollInertia:200});
});