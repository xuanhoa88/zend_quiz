jQuery(document).ready(function() {
	
	/**
	 * Printing score
	 */
	LumiaJS.admin.score.printing = function(examID) {
		BootstrapDialog.show({
			title: LumiaJS.i18n.translate('PageHeader:@Printing score'),
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
                LumiaJS.ajaxRequest(window.location.base + '/admin/printing/score', {
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
	
});