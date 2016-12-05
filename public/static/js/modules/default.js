jQuery(function() {
	// Set page min height
    jQuery(window).bind('load resize', function() {
    	var navHeight = jQuery('body > #navigation').height(),
    		footerHeight = jQuery('body > #footer').height(),
    		pageHeight = jQuery('body > #page-wrapper').height(),
    		windowHeight = this.clientHeight ? this.clientHeight : this.innerHeight;
    	
    	if (jQuery(document).width() < 768) {
    		jQuery('body > #navigation ul.navbar-nav').css('margin-top', 0);
            jQuery('body > #navigation').removeClass('navbar-fixed-top').addClass('navbar-static-top');
        } else {
            jQuery('body > #navigation').removeClass('navbar-static-top').addClass('navbar-fixed-top');
        }
    	
        if ((navHeight + footerHeight + pageHeight) < windowHeight) {
        	var minHeight = windowHeight - footerHeight;
            jQuery('body > #page-wrapper').css({
            	'min-height': minHeight + 'px',
            	'height': minHeight + 'px'
            });
        }
    });
});