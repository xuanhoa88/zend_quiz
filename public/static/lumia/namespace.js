/**
 * Allow using namespace.
 * http://blogger.ziesemer.com/2008/05/javascript-namespace-function.html
 */
(function(undefined){
	"use strict";
	
	String.prototype.namespace = function(separator, container) {
		var i, len;
		var ns = this.split(separator || '.'),
	    	o = container || window;
		
		for (i = 0, len = ns.length; i < len; i++) {
			o = o[ns[i]] = o[ns[i]] || {};
		}
		
		return o;
	};
	
})();