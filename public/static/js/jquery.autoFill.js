(function($, undefined) {

    $.fn.autoFill = function(options) {
    	
        //Giving default value for fieldId option.
        return this.each(function() {
        	var $this = $(this);
        	
        	var opts = $.extend({}, $.fn.autoFill.defaults, options);
            opts.fieldId = $(opts.fieldId);
            opts.overrideFieldEverytime = !!(opts.overrideFieldEverytime);

            $this.blur(function() {
            	
            	if (opts.fieldId.length == 0) {
                    return false;
                }
            	
                if (opts.overrideFieldEverytime) {
                    opts.fieldId.val($this.val());
                } else {
                    if (opts.fieldId.val() == '') {
                        opts.fieldId.val($this.val());
                    }
                }
                
            });
            
            $this.trigger('blur');
        });
    };
    
    //Giving default value for overrideFieldEverytime option. 
    $.fn.autoFill.defaults = {
        fieldId: undefined,
        overrideFieldEverytime: false
    };

}(jQuery));