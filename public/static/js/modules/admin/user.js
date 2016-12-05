(function($) {
	"use strict";
	
	var $permissionAccordingRole = {};
	LumiaJS.admin.user.form = {	};
	
	/**
	 * Set permissions according to role
	 * 
	 * @param	object $permissions
	 * @return 	void
	 */
	LumiaJS.admin.user.form.setPermissionAccordingRole = function($permissions) {
		$permissionAccordingRole = jQuery.isPlainObject($permissions) ? $permissions : {};
	};
	
	/**
	 * Get permissions according to role
	 * 
	 * @param	object element
	 * @return 	void
	 */
	LumiaJS.admin.user.form.getPrivilegesAccordingRole = function(element) {
		var $targetObj = jQuery(element),
			$targetVal = $targetObj.find('option:selected').val(),
			$spinIcon = $targetObj.parent('div').find('span.input-group-addon');
	
		// Show spin icon
		$spinIcon.html('<i class="fa fa-refresh fa-spin"></i>');
		
		// Uncheck all
		jQuery('input[type=checkbox][name^=user_privileges]').attr('checked', false);
		jQuery('input[type=checkbox][data-toggle=checkAll]').attr('checked', false);
		
		if (jQuery.isPlainObject($permissionAccordingRole) && jQuery.isArray($permissionAccordingRole[$targetVal])) {
			var $len = $permissionAccordingRole[$targetVal].length;
			for (var j = 0; j < $len; j++) {
				jQuery('input[type=checkbox][id=' + $permissionAccordingRole[$targetVal][j] + ']').trigger('click');
			}
		}
		
		$spinIcon.html('<i class="fa fa-caret-right icon-mandatory"></i>');
	};
	
})(jQuery);