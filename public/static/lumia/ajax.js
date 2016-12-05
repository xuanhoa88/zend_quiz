(function(global, $, undefined) {
    "use strict";
    
    /**
     * AJAX REQUEST
     */
    function ajaxRequest(requestUrl, data, options) {
        options = $.extend({}, {
            async: true,
            cache: false,
            dataType: 'jsonp',
            type: 'GET',
            data: {
                'format': 'jsonp'
            }
        }, options);
        options.url = requestUrl;
        options.data = $.extend({}, options.data, data);

        return $.ajax(options);
    };

    LumiaJS.ajaxRequest = ajaxRequest;
    
})(window, jQuery);