;(function(){
	"use strict";
	
	/**
	 * Default configurations
	 */
	LumiaJS.uploadify = {
		'defaults': {
			'method' : 'post',
			'swf': window.location.base + '/static/jquery-uploadify/uploadify.swf',
			'uploader': window.location.base + '/admin/media/upload',
			'multiple': true,
			'cancelImg': window.location.base + '/static/jquery-uploadify/uploadify-cancel.png',
			'auto': false,
			'removeCompleted': false,
			'wmode' : 'transparent'
		},
		'overrides': {}
	};
	
})();