(function ($) {
    "use strict";

    /*--------------------------
     Tooltip
     ---------------------------- */
    $('[data-toggle="tooltip"]').tooltip();

    /*----------------------------
     jQuery MeanMenu
     ------------------------------ */
    jQuery('header nav').meanmenu();

    /*----------------------------
     For Search Toggle
     ------------------------------ */
    $(".search-toggler").on('click', function(){
        $(".search-area").fadeToggle(1000);
    });
    $(".search-close").on('click', function(){
        $(".search-area").css("display","none");
    });


    /*----------------------------
     owl active
     ------------------------------ */
    $("#main-carousel").owlCarousel({
        autoPlay: true,
        slideSpeed:1000,
        pagination:false,
        navigation:true,
        singleItem:true,
        /* transitionStyle : "fade", */    /* [This code for animation ] */
    });

    $("#top-carousel").owlCarousel({
        autoPlay: false,
        slideSpeed:1000,
        pagination:false,
        nav:true,
        items : 3,
        /* transitionStyle : "fade", */    /* [This code for animation ] */
        navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [980,3],
        itemsTablet: [768,2],
        itemsMobile : [479,1],
        afterAction: function(el){
            //remove class active
            //this.$owlItems.removeClass('active')
            //add class active
            /*this.$owlItems //owl internal $ object containing items
                .eq(this.currentItem + 1).addClass('active')*/
        }
    });

    /*--------------------------
     scrollUp
     ---------------------------- */
    /*$.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade',
        animationSpeed: 500
    });*/

    new WOW({ mobile: false	}).init();

    $(window).scroll( function() {

        if($(window).scrollTop()>50){
            $(".header-bottom").addClass('stick');
        }
        else{
            $(".header-bottom").removeClass('stick');
        }

        if( $(window).scrollTop() > 350 ) {
            $('.move-top').css('bottom', '30px');
        } else {
            $('.move-top').css('bottom', '-100px');
        }
    });

    $('.scroll-section').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });


    $(window).load(function(){
        $('.preloader').fadeOut('slow',function(){
            $(this).remove();
        });
    });

})(jQuery);



$(document).ready(function() {

    $("#owl-demo").owlCarousel({

        autoPlay: 3000, //Set AutoPlay to 3 seconds

        items : 4,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3]

    });

});

