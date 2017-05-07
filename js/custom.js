
$(document).ready(function () {
    "use strict";
    function amend() {
        "use strict";
        var height;
        height = jQuery(window).height();
        jQuery('#homepage').css('height', "100vh");

        /******** setting dynamic font sizs to titles ******************************/
        jQuery(".slogan").fitText(1.2, { minFontSize: '10px', maxFontSize: '45px' });
        jQuery(".site-name").fitText(1.2, { minFontSize: '10px', maxFontSize: '45px' });
        jQuery(".desc").fitText(1.2, { minFontSize: '10px', maxFontSize: '18px' });
        jQuery(".bread-headder").fitText(1.2, { minFontSize: '10px', maxFontSize: '28px' });
        jQuery("#whatWeDo").fitText(1.2, { minFontSize: '10px', maxFontSize: '32px' });
        jQuery("#comingEvents").fitText(1.2, { minFontSize: '10px', maxFontSize: '32px' });
    }

    amend();
    // if user resizes the screen
    jQuery(window).resize(function () {
        amend();
    });
    jQuery(window).ready(function () {
        jQuery.backstretch([
            "./gallery/images/algeria/home-bg.jpg",
            "./gallery/images/michigan/5.jpg",
            "./gallery/images/algeria/1.jpg",
            "./gallery/images/michigan/3.jpg",
            "./gallery/images/algeria/2.jpg",
            "./gallery/images/michigan/4.jpg",
            "./gallery/images/algeria/donations.jpg",
        ], {duration: 4000, fade: 'slow'});
    });
});
