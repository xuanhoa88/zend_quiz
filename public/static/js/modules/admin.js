jQuery(function() {
	
    // jQuery left menu
    jQuery('#navbar-left > ul').metisMenu();
    
    // Add scollable for left menu
    jQuery(window).bind('load resize', function() {
    	var windowHeight = jQuery(window).height(),
    	    pageHeight = jQuery('#page-wrapper').height(),
    	    navHeight = jQuery('#navbar-top').height(),
    	    footerHeight = jQuery('#navbar-bottom').height();
    	
        if (jQuery(window).width() < 768) {
            jQuery('#navbar-top').removeClass('navbar-fixed-top').addClass('navbar-static-top');
            jQuery('#navbar-left').addClass('collapse');
        } else {
            jQuery('#navbar-top').removeClass('navbar-static-top').addClass('navbar-fixed-top');
            jQuery('#navbar-left').removeClass('collapse');
        }
        
        jQuery('#navbar-left').css({
        	'height': (windowHeight - navHeight - footerHeight) + 'px',
        	'max-height': (windowHeight - navHeight - footerHeight) + 'px'
        });

        if ((navHeight + footerHeight + pageHeight) < windowHeight) {
            jQuery('#page-wrapper').css({
            	'height': (windowHeight - footerHeight) + 'px',
            	'min-height': (windowHeight - footerHeight) + 'px'
            });
        }
    });
});