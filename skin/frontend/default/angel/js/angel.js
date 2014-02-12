/*
 *  Common js
 */
var visited = readCookie('cookiesBanner');
document.observe('dom:loaded', function () {
    // Toggle cart
    $("cart-content").observe('mouseover', function () {
        $("cart-btn-checkout").addClassName('active');
        $("cart-items").show();
    });

    $("cart-content").observe('mouseout', function () {
        $("cart-btn-checkout").removeClassName('active');
        $("cart-items").hide();
    });

    /* Show cookies banner at the first visit */
    if (!visited) {
        showCookiesBanner();
        createCookie('cookiesBanner', 'no', 0);
    } else {
        hideCookiesBanner();
    }
    /* Hide cookies banner */
    $("btn-cookies-banner").observe("click", function () {
        hideCookiesBanner();
    });

    /* Carousel on homepage */
    if (jQuery('.home-bxslider').length > 0) {
        carouselItemInit(".home-manufacturers");
    }
});

/* Show Cookies Banner */
function showCookiesBanner() {
    $("header-cookies-banner").show();
}

/* Show Cookies Banner */
function hideCookiesBanner() {
    $("header-cookies-banner").hide();
}

/* Create Cookies */
function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}

/* Read Cookies */
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

/* Init Carousel */
function carouselItemInit(el){

    var carouselItems;
    var itemMaxWidth = 500;
    var moveSlides = 1;

    // Get item size
    var firstLoadGetItem;

    if(jQuery(window).width() > 959) {
        firstLoadGetItem = 4;
    }
    if(jQuery(window).width() < 960) {
        firstLoadGetItem = 3;
    }
    if(jQuery(window).width() < 640){
        firstLoadGetItem = 2;
    }

    carouselItems = jQuery(el).bxSlider({
        adaptiveHeight: true,
        touchEnabled:   true,
        controls:       true,
        pager:          false,
        auto:           false,
        autoHover:      false,
        maxSlides:      firstLoadGetItem,
        minSlides:      firstLoadGetItem,
        moveSlides:     moveSlides,
        slideWidth:     itemMaxWidth
    });

    jQuery(window).resize(function() {

        carouselItems.destroySlider();

        var itemReload;
        if(jQuery(window).width() > 959){
            itemReload = 4;
        }
        if(jQuery(window).width() < 960){
            itemReload = 3;
        }
        if(jQuery(window).width() < 640){
            itemReload = 2;
        }

        jQuery(el).parents().siblings(".bx-controls").remove();
        carouselItems.bxSlider({
            adaptiveHeight: true,
            touchEnabled:   true,
            controls:       true,
            pager:          false,
            auto:           false,
            autoHover:      false,
            maxSlides:      itemReload,
            minSlides:      itemReload,
            moveSlides:     moveSlides,
            slideWidth:     itemMaxWidth,
            onSliderLoad:   function(){
                jQuery(".bx-viewport .bx-viewport").unwrap();
                jQuery(".bx-wrapper .bx-viewport .bx-viewport").unwrap();
            }
        });

    });
}
