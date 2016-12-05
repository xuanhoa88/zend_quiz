jQuery(document).ready(function() {

    jQuery('[name=teacher_code]').autoFill({
        'fieldId': jQuery('[name=account_username]'),
        'overrideFieldEverytime': true
    });
    
    // Load subject dependency with deparment
    /*
    function fnLoadSubjectDependency (e)
    {
    	LumiaJS.ajaxRequest(
			window.location.base + '/admin/department/get-subjects',
			{
				'department': jQuery(e.currentTarget).val()
			}
    	).done(function (response){
    		jQuery('[teacher_subject]').html(response.contexts.htmlSubjects);
    	});
    }
    
    jQuery('[name=teacher_department]').unbind('change', fnLoadSubjectDependency).bind('change', fnLoadSubjectDependency);
	*/
});