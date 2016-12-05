jQuery(document).ready(function() {
	
	/**
	 * Read more plugin
	 */
	jQuery('form[name=Admin_DataGrid_Question] span.expander').expander({
	  widow: 2,
	  expandEffect: 'show',
	  userCollapseText: '[-]',
	  expandText: '[+]'
	});
	
	/**
	 * Add wysiwyg
	 */
	var wysiwygCallback = function(editor, options) {
		return jQuery(editor || '[data-wysiwyg]').summernote(jQuery.extend({
			toolbar: [
				['style', ['style']],
				['fontsize', ['fontsize']],
				['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
				['fontname', ['fontname']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['height', ['height']],
				['table', ['table']],
				['insert', ['link', 'picture', 'video', 'hr']],
				['view', ['fullscreen', 'codeview']],
				['help', ['help']]
			],
		    codemirror: {
		      mode: 'text/html',
		      htmlMode: true,
		      lineNumbers: true,
		      theme: 'monokai'
		    },
		    lang: 'vi-VN',
		    onSelectFromFiles: function(editor, welEditable, type) {
		    	return BootstrapDialog.show({
	                type: BootstrapDialog.TYPE_PRIMARY,
	                size: BootstrapDialog.SIZE_WIDE,
	                closable: false,
	                title: LumiaJS.i18n.translate('PageHeader:@Manage media files'),
	                message:  function(dialogItself) {
	                    var $message = $('<div></div>');
	                    
	                    // Add loading text
	                    $message.html('<i class="fa fa-refresh fa-spin"></i> ' + LumiaJS.i18n.translate('DataTable:@Please wait a moment'));
	                   
	                    // Call to web servcer
						LumiaJS.ajaxRequest(window.location.base + '/admin/media', {'__fromWysiwyg': 'summernote', 'fileTypeExts': type}, {
							'dataType': 'html'
	        			}).done(function (pageHtml){
	        				$message.html(pageHtml);
	        			});
						
	                    return $message;
	                },
	                buttons: [{
	                    label: LumiaJS.i18n.translate('QuestionForm:@Insert file(s)'),
	                    action: function(dialogItself) {
	                		jQuery(dialogItself.$modal).find('form input[type=checkbox][id^=wysiwyg]:checked').each(function(i, element) {
	                			if (element.value) {
	                				switch (type.toUpperCase()) {
	                					case 'IMAGE':
	                						editor.insertImage(welEditable, element.value);
	                						break;
	                					case 'MEDIA':
	                						editor.insertVideo(welEditable, element.value);
	                						break;
	                				}
	                			} 
	                		});
	                		
	                        dialogItself.close();
	                    }
	                },{
	                    label: LumiaJS.i18n.translate('Form:@Button close'),
	                    cssClass: 'btn-danger',
	                    action: function(dialogItself) {
	                        dialogItself.close();
	                    }
	                }]
	            });
		    }
		}, options));
	};
	wysiwygCallback.call(null);
	
	/**
	 * Get chapter dependency with subject
	 */
	function getChapterBySubject(e) {
		var $dependencyObj = jQuery('select[name=question_chapter]'),
			$spinIcon = $dependencyObj.parent('div').find('span.input-group-addon');
		
		// Show spin icon
		$spinIcon.html('<i class="fa fa-refresh fa-spin"></i>');
		
		LumiaJS.ajaxRequest(window.location.base + '/admin/subject/get-chapter', {
			'subject-id': jQuery(e.target).find('option:selected').val()
		}).done(function(dataResponse){
			$dependencyObj.find('option:gt(0)').remove();
			if (dataResponse.status == 'SUCCESS' && jQuery.isPlainObject(dataResponse.contexts.CHAPTER_OPTIONS)) {
				jQuery.each(dataResponse.contexts.CHAPTER_OPTIONS, function(chapterId, chapterName){
					$dependencyObj.append(jQuery("<option/>").attr("value", chapterId).text(chapterName));
				});
			}
		}).always(function(){
			// Show mandatory icon
			$spinIcon.html('<i class="fa fa-caret-right icon-mandatory"></i>');
		});
	}
	
	jQuery('form').off('change', 'select[name=question_subject]', getChapterBySubject)
				.on('change', 'select[name=question_subject]', getChapterBySubject);
	
	/**
	 * Question form
	 */
	LumiaJS.admin.question.form = {
			
		/**
		 * Remove per answer in question form
		 */
		btnRemovePerAnswer: function(btnOrder) {
			var btnRemovePerAnswer = jQuery('#answer-form-' + btnOrder);
			if (btnRemovePerAnswer.length) {
				btnRemovePerAnswer.remove();
			}
			
			// If error message exists, remove it when form answers not exists
			if (jQuery('#list-answers').find('[id^=answer-form-]').length == 0) {
				jQuery('#list-answers-error-messages').remove();
			}
		},
		
		/**
		 * Add new answer in question form
		 */
		btnAddNewAnswer: function(btnSelf) {
			var $listOfAnswers = jQuery('#list-answers'),
				$answerOrder = 'A'.charCodeAt(0),
				$tmpAnswer = LumiaJS.admin.question.tmpSubForm;
			
			if (jQuery($tmpAnswer).length == 0)
			{
				BootstrapDialog.danger(LumiaJS.i18n.translate('Error:@An error occurred in process generate answer form'));
				throw new Error(LumiaJS.i18n.translate('Error:@An error occurred in process generate answer form'));
			}
			
			// Append answer template
			$tmpAnswer = jQuery($tmpAnswer.replace(new RegExp('__tmp__', 'g'), (new Date()).getTime()));
			$tmpAnswer.find('label.control-label-answer_content').append(String.fromCharCode($answerOrder + $listOfAnswers.find('[id^=answer-form-]').length));
			$tmpAnswer.appendTo($listOfAnswers);
			
			var $timeout = 0;
			$timeout = setTimeout(function(){
				jQuery('body').stop().scrollTo('#btnAddNewAnswer', 800);
				wysiwygCallback.call(null);
				clearTimeout($timeout);
			}, 100);
			
		}
	};
});