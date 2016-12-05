jQuery(document).ready(function() {
	
	// Init datepicker
	jQuery('form .form-datetime').datetimepicker({
		format: LumiaJS.dateTime.format,
		language: LumiaJS.dateTime.locale,
		todayBtn: true,
		autoclose: true
	});
	
	/**
	 * Printing exam
	 */
	LumiaJS.admin.exam.printingExam = function(examID) {
		BootstrapDialog.show({
			title: LumiaJS.i18n.translate('PageHeader:@Printing exam'),
			size: 'modal-fs',
			nl2br: false,
			closable: false,
            message:  function(dialogItself) {
                var $message = $('<div></div>');
                
                // Add loading text
                $message.html('<i class="fa fa-refresh fa-spin"></i> ' + LumiaJS.i18n.translate('DataTable:@Please wait a moment'));
               
                // Disable confirm button
                dialogItself.getButton('btn-confirm').disable();
                
                // Load page
                LumiaJS.ajaxRequest(window.location.base + '/admin/printing/exam', {
                    'exam-id': examID
                }, {
                	dataType: 'html'
                }).done(function(response) {
                	dialogItself.getButton('btn-confirm').enable();
                	dialogItself.setMessage(response);
                });
                
                return $message;
            },
            buttons: [{
            	id: 'btn-confirm',
                label: LumiaJS.i18n.translate('Form:@Button printing'),
                cssClass: 'btn-primary',
                action: function(dialogItself) {
                	jQuery(dialogItself.getModalBody().find('form')).printThis({ 
                	    debug: false,              
                	    importCSS: false,             
                	    importStyle: false,         
                	    printContainer: true,       
                	    loadCSS: [
                	        window.location.base + '/static/bootstrap/css/bootstrap.min.css',
                	        window.location.base + '/static/css/admin-print-custom.css'
                	    ], 
                	    pageTitle: dialogItself.getTitle(),             
                	    removeInline: false,        
                	    printDelay: 333,            
                	    header: null,             
                	    formValues: false          
                	}); 
                	dialogItself.close();
                }
            }, {
            	id: 'btn-cancel',
                label: LumiaJS.i18n.translate('Form:@Button cancel'),
                cssClass: 'btn-danger',
                action: function(dialogItself) {
                    dialogItself.close();
                }
            }]
        });
	};
	
	/**
	 * Printing participant
	 */
	LumiaJS.admin.exam.printingParticipant = function(examID) {
		BootstrapDialog.show({
			title: LumiaJS.i18n.translate('PageHeader:@Printing participant'),
			size: 'modal-fs',
			nl2br: false,
			closable: false,
            message:  function(dialogItself) {
                var $message = $('<div></div>');
                
                // Add loading text
                $message.html('<i class="fa fa-refresh fa-spin"></i> ' + LumiaJS.i18n.translate('DataTable:@Please wait a moment'));
               
                // Disable confirm button
                dialogItself.getButton('btn-confirm').disable();
                
                // Load page
                LumiaJS.ajaxRequest(window.location.base + '/admin/printing/participant', {
                    'exam-id': examID
                }, {
                	dataType: 'html'
                }).done(function(response) {
                	dialogItself.getButton('btn-confirm').enable();
                	dialogItself.setMessage(response);
                });
                
                return $message;
            },
            buttons: [{
            	id: 'btn-confirm',
                label: LumiaJS.i18n.translate('Form:@Button printing'),
                cssClass: 'btn-primary',
                action: function(dialogItself) {
                	jQuery(dialogItself.getModalBody().find('form')).printThis({ 
                	    debug: false,              
                	    importCSS: false,             
                	    importStyle: false,         
                	    printContainer: true,       
                	    loadCSS: [
                	        window.location.base + '/static/bootstrap/css/bootstrap.min.css',
                	        window.location.base + '/static/css/admin-print-custom.css'
                	    ], 
                	    pageTitle: dialogItself.getTitle(),             
                	    removeInline: false,        
                	    printDelay: 333,            
                	    header: null,             
                	    formValues: false          
                	}); 
                	dialogItself.close();
                }
            }, {
            	id: 'btn-cancel',
                label: LumiaJS.i18n.translate('Form:@Button cancel'),
                cssClass: 'btn-danger',
                action: function(dialogItself) {
                    dialogItself.close();
                }
            }]
        });
	};
	
	/**
	 * Default vars
	 */
	if (!jQuery.isPlainObject(LumiaJS.admin.exam.studentsByClasses)) {
		LumiaJS.admin.exam.studentsByClasses = {};
	}
	
	if (!jQuery.isPlainObject(LumiaJS.admin.exam.calcNumberInputQuestionsBySubject)) {
		LumiaJS.admin.exam.calcNumberInputQuestionsBySubject = {};
	}
	
	/**
	 * Calculate number of questions corresponding with question level & question type
	 * 
	 * @param	object self
	 */
	LumiaJS.admin.exam.calcNumberInputQuestions = function(self, targetSuffix) {
		var $itSelf = jQuery(self),
			$populate = jQuery('#exam-questions'),
			$numberOfQuestions = 0;
		
		$populate.find('input[id$=' + targetSuffix + ']').each(function(index, el){
			$numberOfQuestions += jQuery.isNumeric(jQuery(el).val()) ? parseInt(jQuery(el).val()) : 0;
		});
		
		$populate.find('#' + targetSuffix + '-number-input-questions').html($numberOfQuestions);
	}
	
	/**
	 * Get list students allowed
	 * 
	 * @param	object self
	 * @return 	void
	 */
	LumiaJS.admin.exam.injectStudentsAllowed = function (self) {
		var $itSelf = jQuery(self),
			$classesId = $itSelf.val(),
			$populate = jQuery('form #exam-classes');
		
		// Remove all students of this classes
		$populate.find('input[type=hidden][name^=exam_student\\[' + $classesId + '\\]]').remove();
		
		// Append into html
		if (jQuery.isPlainObject(LumiaJS.admin.exam.studentsByClasses[$classesId])) {
			if ($itSelf.is(':checked')) {
				jQuery.each(LumiaJS.admin.exam.studentsByClasses[$classesId], function(index, val) {
					$populate.append(val);
				});
			}
		}
	}
	
	/**
	 * Manage students by class
	 * 
	 * @param	int $classesId
	 * @return	void
	 */
	LumiaJS.admin.exam.manageStudentsByClasses = function ($classesId) {
		BootstrapDialog.show({
			title: LumiaJS.i18n.translate('PageHeader:@Manage students'),
			size: BootstrapDialog.SIZE_WIDE,
			nl2br: false,
			closable: false,
            message:  function(dialogItself) {
                var $message = $('<div></div>');
                
                // Add loading text
                $message.html('<i class="fa fa-refresh fa-spin"></i> ' + LumiaJS.i18n.translate('DataTable:@Please wait a moment'));
               
                // Disable confirm button
                dialogItself.getButton('btn-confirm').disable();
                
                // Load page
                LumiaJS.ajaxRequest(window.location.base + '/admin/exam/get-students-by-classes', {
                    'class-id': $classesId
                }, {
                	dataType: 'html'
                }).done(function(response) {
                	dialogItself.getButton('btn-confirm').enable();
                	dialogItself.setMessage(response);
                }).always(function(){
                	jQuery('form #exam-classes').find('input[type=hidden][name^=exam_student\\[' + $classesId + '\\]]').each(function(index, el) {
                		dialogItself.getModalBody().find('form input[type=checkbox][data-target=row][value=' + jQuery(el).val() + ']').trigger('click');
                	});
                });
                
                return $message;
            },
            buttons: [{
            	id: 'btn-confirm',
                label: LumiaJS.i18n.translate('Form:@Button confirm'),
                cssClass: 'btn-primary',
                action: function(dialogItself) {
                	if (jQuery.isPlainObject(LumiaJS.admin.exam.studentsByClasses[$classesId])) {
                		var $populate = jQuery('form #exam-classes');
                		var $checkedRows = dialogItself.getModalBody().find('form input[type=checkbox][data-target=row]:checked');
                		var $elementClasses = jQuery('form input[type=checkbox][name=exam_classes\\[' + $classesId + '\\]]');

                		// Remove all students of this classes
                		$populate.find('input[type=hidden][name^=exam_student\\[' + $classesId + '\\]]').remove();
                		
                		// Append checked students into html
                		$checkedRows.each(function(index, el){
                			// Get student id
	                		var $studentId = jQuery(el).val();
	                		
	                		// Append to html view
	                		if (jQuery(LumiaJS.admin.exam.studentsByClasses[$classesId][$studentId]).length) {
                				$populate.append(LumiaJS.admin.exam.studentsByClasses[$classesId][$studentId]);
	                		}
	                	});
                		
                		// Fire event click
                		switch ($checkedRows.length > 0) {
                			case true:
                				if (!$elementClasses.is(':checked')) {
                        			$elementClasses.trigger('click');
                        		}
                				break;
                			case false:
                				if ($elementClasses.is(':checked')) {
                        			$elementClasses.trigger('click');
                        		}
                				break;
                		}
                	}
                	
                	dialogItself.close();
                }
            }, {
            	id: 'btn-cancel',
                label: LumiaJS.i18n.translate('Form:@Button cancel'),
                cssClass: 'btn-danger',
                action: function(dialogItself) {
                    dialogItself.close();
                }
            }]
        });
	}
	
	/**
	 * Get questions, students, classes dependency with subject
	 * 
	 * @param	object
	 * @return	void
	 */
	function getChapterBySubject(e) {
		var $examClasses = jQuery('#exam-classes'),
			$examQuestions = jQuery('#exam-questions'),
			$spinIcon = jQuery(e.target).parent('div').find('span.input-group-addon'),
			$subjectId = parseInt(jQuery(e.target).find('option:selected').val());
		
		// Remove elements
		$examClasses.empty();
		$examQuestions.empty();
		
		// If subject not is number, stop now
		if (!jQuery.isNumeric($subjectId)) {
			return false;
		}
		
		// Show spin icon
		$spinIcon.html('<i class="fa fa-refresh fa-spin"></i>');
		
		// Send request
		LumiaJS.ajaxRequest(window.location.base + '/admin/exam/get-classes-and-questions-by-subject', {
			'subject-id': $subjectId
		}).done(function(dataResponse){
			
			if (dataResponse.status == 'SUCCESS') {
				
				// Append classes
				if (typeof dataResponse.contexts.CLASSES === 'string') {
					$examClasses.html(dataResponse.contexts.CLASSES);
				}
				
				// Append students into cache
				if (jQuery.isPlainObject(dataResponse.contexts.STUDENTS)) {
					LumiaJS.admin.exam.studentsByClasses = dataResponse.contexts.STUDENTS;
				}
				
				// Append questions
				if (typeof dataResponse.contexts.QUESTIONS === 'string') {
					$examQuestions.html(dataResponse.contexts.QUESTIONS);
				}
			} else {
				BootstrapDialog.show({
					title: LumiaJS.i18n.translate('Dialog:@Error'),
					message: function() {
						jQuery('select[name=exam_subject] option:first-child').attr('selected', 'selected');
						return dataResponse.message;
					},
					closable: false,
					type: BootstrapDialog.TYPE_DANGER,
					buttons: [{
		                label: LumiaJS.i18n.translate('Form:@Button cancel'),
		                cssClass: 'btn-danger',
		                action: function(dialogItself) {
		                    dialogItself.close();
		                }
		            }]
				});
			}
			
		}).always(function(){
			// Show mandatory icon
			$spinIcon.html('<i class="fa fa-caret-right icon-mandatory"></i>');
		});
	}
	
	// Attach event
	jQuery('form').off('change', 'select[name=exam_subject]', getChapterBySubject)
				.on('change', 'select[name=exam_subject]', getChapterBySubject);
	
});