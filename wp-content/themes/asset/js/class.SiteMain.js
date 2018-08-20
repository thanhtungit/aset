var SiteMain = (function() {
    //PARAMATER

    //INIT
    function init(){
        open_menu()
        close_menu()
        slider_detail()
    }

    //FUNCTION
    function open_menu() {
        $('.menu-icon').click(function() {
            $('.nav-right').animate({right: "0"}, 500, function() {
                $('body').addClass('menu-opening')
            })
        })
    }
    function close_menu() {
        $('.icon-close-menu').click(function() {
            $('.nav-right').animate({right: "-500px"}, 500, function() {
                $('body').removeClass('menu-opening')
            })
        })
    }
    function slider_detail() {
        $('.slick-slider').slick({
            arrows: true,
            fade: true,
            autoplay: true,
            dots: true,
            nextArrow: '<i class="fa fa-chevron-right arr-next" aria-hidden="true"></i>',
            prevArrow: '<i class="fa fa-chevron-left arr-prev" aria-hidden="true"></i>'
        })
    }
    //RETURN
    return {
        init:init
    }
})();

$(document).ready( function() {
    SiteMain.init();
});