(function() {
	"use strict";
	
	var $objUploader;
	var $objFiles = {};
	var $errorMessage = [];
	
	LumiaJS.admin.media = {
		add: function(options) {
			return BootstrapDialog.show(jQuery.extend({
                type: BootstrapDialog.TYPE_PRIMARY,
                size: BootstrapDialog.SIZE_WIDE,
                closable: false,
                title: LumiaJS.i18n.translate('MediaForm:@Add new'),
                message:  function(dialogItself) {
					var $self = this;
                    var $message = $('<div></div>');
                    
                    // Add loading text
                    $message.html('<i class="fa fa-refresh fa-spin"></i> ' + LumiaJS.i18n.translate('DataTable:@Please wait a moment'));
                    
                    // Call to web servcer
					LumiaJS.ajaxRequest(window.location.base + '/admin/media/add', jQuery.extend({
						'reloadPage': 1
					}, dialogItself.getData('requestParams')), {
						'dataType': 'html',
        				'type': 'POST'
        			}).done(function (pageHtml){
        				var $fnCallback = dialogItself.getData('messageCallback');
                		if (jQuery.isFunction($fnCallback)) {
                			$fnCallback.call($self, dialogItself);
                		}
                		
                		// Append into view
                		$message.html(pageHtml);
        			});
					
                    return $message;
                },
                buttons: [{
                    label: LumiaJS.i18n.translate('Form:@Button close'),
                    id: 'media-add-btn-close',
                    action: function(dialogItself) {
                		var $fnCallback = dialogItself.getData('btnCloseCallback');
                		if (jQuery.isFunction($fnCallback)) {
                			$fnCallback.call(this, dialogItself);
                		}
                		
                        dialogItself.close();
                    }
                }]
            }, options));
		},
		
		/**
		 * Upload files
		 */
		upload: function() {
			$objUploader.uploadify('upload', '*');
		},
		
		/**
		 * Stop upload files
		 */
		stop: function() {
			$objUploader.uploadify('stop');
		},
		
		/**
		 * Init uploadify
		 */
		initUploadify: function(element) {
			$objUploader = jQuery(element);

    		// Create remove callback
			var $fnRemoveCallback = function(event, fnYesCallback) {
				return BootstrapDialog.show({
		            type: BootstrapDialog.TYPE_WARNING,
		            closable: false,
		            title: LumiaJS.i18n.translate('Uploadify:@Title warning'),
		            message: LumiaJS.i18n.translate('Uploadify:@Are you sure you want to remove this item ?'),
		            buttons: [{
		                label: LumiaJS.i18n.translate('Uploadify:@Button yes'),
		                action: function(dialogItself) {
		                	$objUploader.uploadify('cancel', event.data.queueId);
		                    dialogItself.close();
		                    jQuery.isFunction(fnYesCallback) && fnYesCallback(dialogItself);
		                }
		            },{
		                label: LumiaJS.i18n.translate('Uploadify:@Button no'),
		                cssClass: 'btn-warning',
		                action: function(dialogItself) {
		                    dialogItself.close();
		                }
		            }]
		        });
			};
			
			var defaults = {
				'buttonText': LumiaJS.i18n.translate('Uploadify:@Select files'),
				'onFallback' : function() {
					var $jForm = jQuery('[name=mediaForm]');
					
					// Remove buttons
					$jForm.find('#btnUpload, #btnStop, #btnCancel').remove();
					$objUploader.remove();
					
					return BootstrapDialog.show({
			            type: BootstrapDialog.TYPE_DANGER,
			            closable: false,
			            title: LumiaJS.i18n.translate('Uploadify:@Title error'),
			            message: LumiaJS.i18n.translate('Uploadify:@Flash was not detected'),
			            buttons: [{
			                label: LumiaJS.i18n.translate('Uploadify:@Button cancel'),
			                cssClass: 'btn-danger',
			                action: function(dialogItself) {
			                    dialogItself.close();
			                }
			            }]
			        });
		        },
		        'onDialogClose' : function(queueData) {
		        	$objFiles = {};
		        	if (queueData.filesSelected > 0) {
		        		var $j, $item, $btnRemove;
		        		
		        		// Inject to static cache
		        		$objFiles = queueData.files;
		        		
		        		for ($j in queueData.files) {
		        			$item = queueData.files[$j];
		        			
		        			// Init queue's cancel
		        			$btnRemove = jQuery('#' + $j).find('.cancel');

		        			// Remove attribute href
		        			$btnRemove.find('a').attr('href', 'javascript:void(0)');
		        			
		        			// Bind event
		        			$btnRemove.off('click', 'a').on('click', 'a', {'queueId' : $j}, $fnRemoveCallback);
		        		}
		        		
		        		jQuery('[name=mediaForm]').off('click', '#btnCancel').on('click', '#btnCancel', function() {
		        			if (jQuery.isPlainObject($objFiles)) {
		        				BootstrapDialog.show({
		    			            type: BootstrapDialog.TYPE_WARNING,
		    			            closable: false,
		    			            title: LumiaJS.i18n.translate('Uploadify:@Title warning'),
		    			            message: LumiaJS.i18n.translate('Uploadify:@Are you sure you want to perform this action ?'),
		    			            buttons: [{
		    			                label: LumiaJS.i18n.translate('Uploadify:@Button yes'),
		    			                action: function(dialogItself) {
		    			                	for ($j in $objFiles) {
		    		        					$objUploader.uploadify('cancel', $j);
		    		        				}
		    			                	
		    			                	dialogItself.close();
		    			                }
		    			            },{
		    			                label: LumiaJS.i18n.translate('Uploadify:@Button no'),
		    			                cssClass: 'btn-warning',
		    			                action: function(dialogItself) {
		    			                    dialogItself.close();
		    			                }
		    			            }]
		    			        });
		        			}
		        		});
		        	}
		        },
		        'onUploadError' : function () {
		        	$errorMessage.push(LumiaJS.i18n.translate('Uploadify:@Unknown error while uploading process'));
		        },
		        'onUploadSuccess' : function(file, data, response) {
		        	try {
		        		data = eval('(' + data + ')');
		        	} catch (e) {
		        		data = {
		        				'code': 0,
		        				'status': 'ERROR',
		        				'contexts': {},
		        				'message': LumiaJS.i18n.translate('Uploadify:@Unknown error while uploading process')
		        		};
					}
		        	
		        	if (jQuery.isPlainObject(data)) {
		        		if (data.status === 'ERROR') {
		        			// Set default message
		        			if (!data.message) {
		        				LumiaJS.i18n.translate('Uploadify:@Unknown error while uploading process')
		        			}
		        			
		        			$errorMessage.push(data.message);
		        		} else {
			        		delete $objFiles[file.id];
			        		
			        		// Show thumbnail
			        		if (jQuery.isPlainObject(data.contexts) && data.contexts.thumb) {
			        			jQuery('#thumb-' + file.id).attr('src', data.contexts.thumb);
			        			
			        			// Bind event
			        			jQuery('#' + file.id).find('.cancel').off('click', 'a').on('click', 'a', {'queueId' : file.id}, function(e) {
			        				$fnRemoveCallback(e, function() {
			        					BootstrapDialog.show({
			        		                title: LumiaJS.i18n.translate('Uploadify:@Warning'),
			        		                size: BootstrapDialog.SIZE_NORMAL,
			        		                nl2br: false,
			        		                closable: false,
			        		                message: function(dialogItself) {
			        		                    // Set dialog message
			        		                    var $message = jQuery('<div class="text-center"></div>');
	
			        		                    // Remove header
			        		                    dialogItself.getModalHeader().remove();
	
			        		                    // Reset modal width
			        		                    dialogItself.getModalDialog().css('width', '300px');
	
			        		                    // Add loading text
			        		                    $message.html('<i class="fa fa-refresh fa-spin"></i> ' + LumiaJS.i18n.translate('Uploadify:@Please wait a moment'));
	
			        		                    // Call to web servcer
					        					LumiaJS.ajaxRequest(window.location.base + '/admin/media/delete', {
							        				'id': data.contexts.id
							        			}, {
							        				'type': 'POST'
							        			}).always(function() {
							                        dialogItself.close();
							                    });
	
			        		                    return $message;
			        		                }
			        		            });
			        				});
			        			});
			        		}
		        		}
		        	} else {
		        		$errorMessage.push(LumiaJS.i18n.translate('Uploadify:@Unknown error while uploading process'));
		        	}
		        },
		        'onUploadProgress' : function(file, bytesUploaded, bytesTotal, totalBytesUploaded, totalBytesTotal) {
		            jQuery('#' + file.id).find('.progress-bar').css('width', Math.ceil(bytesUploaded * 100 / bytesTotal) + '%');
		        },
		        'onQueueComplete' : function(file) {
		        	var $errorLength = $errorMessage.length;
		        	if ($errorLength > 0) {
			        	BootstrapDialog.show({
				            type: BootstrapDialog.TYPE_WARNING,
				            closable: false,
				            title: LumiaJS.i18n.translate('Uploadify:@Title warning'),
				            message: function(dialog) {
				                var $content = jQuery('<ul/>');
				                for (var j = 0; j < $errorLength; j++) {
				                	$content.append(jQuery('<li/>').html($errorMessage[j]));
				                }
				                
				                return $content;
				            },
				            buttons: [{
				                label: LumiaJS.i18n.translate('Uploadify:@Button cancel'),
				                action: function(dialogItself) {
				                	dialogItself.close();
				                }
				            }]
				        });
		        	}
		        	
	        		// Reset error message
	        		$errorMessage = [];
		        }
			};
			
			$objUploader.uploadify(jQuery.extend(LumiaJS.uploadify.defaults, defaults, LumiaJS.uploadify.overrides));
		}
	};
	
})(jQuery);