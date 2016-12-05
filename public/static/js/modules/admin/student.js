jQuery(document).ready(function() {

    jQuery('[name=student_code]').autoFill({
        'fieldId': jQuery('[name=account_username]'),
        'overrideFieldEverytime': true
    });
    
    /**
	 * Get all classes dependency with department
	 */
	function getClassesByDepartment(e) {
		var $dependencyObj = jQuery('select[name=student_class]'),
			$spinIcon = $dependencyObj.parent('div').find('span.input-group-addon');
		
		// Show spin icon
		$spinIcon.html('<i class="fa fa-refresh fa-spin"></i>');
		
		LumiaJS.ajaxRequest(window.location.base + '/admin/department/get-classes', {
			'department-id': jQuery(e.target).find('option:selected').val()
		}).done(function(dataResponse){
			$dependencyObj.find('option:gt(0)').remove();
			if (dataResponse.status == 'SUCCESS' && jQuery.isPlainObject(dataResponse.contexts.CLASSES_OPTIONS)) {
				jQuery.each(dataResponse.contexts.CLASSES_OPTIONS, function(classesId, classesName){
					$dependencyObj.append(jQuery("<option/>").attr("value", classesId).text(classesName));
				});
			}
		}).always(function(){
			// Show mandatory icon
			$spinIcon.html('<i class="fa fa-caret-right icon-mandatory"></i>');
		});
	}
	
	jQuery('form').off('change', 'select[name=student_department]', getClassesByDepartment)
				.on('change', 'select[name=student_department]', getClassesByDepartment);
	
});