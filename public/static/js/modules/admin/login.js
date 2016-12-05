jQuery(document).ready(function() {
	// Modal vertical position center
    jQuery('form[name=loginForm]').find('div.modal-dialog').css({
        'margin': 0,
        'position': 'absolute',
        'top': '50%',
        'left': '50%',
        'margin-top': function() {
            return -($(this).outerHeight() / 2);
        },
        'margin-left': function() {
            return -($(this).outerWidth() / 2);
        }
    });
});