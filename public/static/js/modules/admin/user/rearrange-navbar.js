jQuery(function() {

    var sortable = jQuery('ol.sortable');

    // Init sortable
    sortable.nestedSortable({
        forcePlaceholderSize: true,
        handle: 'div',
        helper: 'clone',
        items: 'li',
        opacity: .6,
        placeholder: 'placeholder',
        revert: 250,
        tabSize: 25,
        tolerance: 'pointer',
        toleranceElement: '> div',
        maxLevels: 2,
        isTree: true,
        expandOnHover: 700,
        startCollapsed: true,
        excludeRoot: true
    });

    // collapsed/expanded events
    var discloseCallback = function() {
        jQuery(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
    };
    sortable.find('.disclose').off('click', discloseCallback).on('click', discloseCallback);

    // Save
    var saveCallback = function(e) {
        var jLoading = jQuery('.btnLoading');

        jLoading.removeClass('hide');
        jLoading.show();

        LumiaJS.ajaxRequest(window.location.base + '/admin/user/rearrange-navbar', {
            'sortable': jQuery('ol.sortable').nestedSortable('toArray', { 'startDepthCount': 0 })
        }, { 'type': 'POST' })
        .done(function(dataResponse) {
        	if (dataResponse.contexts.redirect){
				window.location.href = dataResponse.contexts.redirect;
			};
        })
        .always(function() {
            jLoading.addClass('hide');
            jLoading.hide();
        });
    };
    jQuery('#btnSave').unbind('click', saveCallback).bind('click', saveCallback);
    
});