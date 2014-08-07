/* 
 * This file contains calls to various javascript files
 * 
 * Editing this file might lead to some broken theme features.
 * 
 */


/* Trigger home page slider and testimonial slider */
/* Both home page and testimonial slider are powered by FlexSlider by WooThemes */

 
/* Add a custom back to top button */
jQuery(document).ready(function() {
    var offset = 220;
    var duration = 500;
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.back-to-top').fadeIn(duration);
        } else {
            jQuery('.back-to-top').fadeOut(duration);
        }
    });


    jQuery('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    });
});

/* Trigger mobile responsive navigation powered by slicknav.js */
jQuery(document).ready(function($) {
      
	jQuery("#toggle-button").click(function(e){
            e.preventDefault();
            var div = jQuery("#headercontainer");
            console.log(div.css("left"));
            if (div.css("left") === "-380px") {
                jQuery("#headercontainer").animate({
                    left: "0px"
                });
            } else {
                jQuery("#headercontainer").animate({
                    left: "-380px"
                });
            }
        });
  
        
        $(".header-wrap").mCustomScrollbar({
            axis:"y",
        });
   
});

/* Trigger mobile responsive navigation powered by slicknav.js */
jQuery(document).ready(function($) {

    $('#site-navigation .menu>ul').slicknav({prependTo: '#mobile-menu'});
    $('#top-navigation .menu>ul').slicknav({prependTo: '#mobile-top-menu'});
});