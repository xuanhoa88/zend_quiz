jQuery(document).ready(function() {

    // Init bootstrap input file
    jQuery(':file').filestyle({
        buttonName: 'btn-warning',
        buttonBefore: false,
        buttonText: LumiaJS.i18n.translate('ImportForm:@Browser file'),
        input: true
    });
    
    // Processing student
    LumiaJS.admin.import.processingStudent = function(filePath) {
    	BootstrapDialog.show({
            title: LumiaJS.i18n.translate('Dialog:@Warning'),
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
                $message.html('<i class="fa fa-refresh fa-spin"></i> ' + LumiaJS.i18n.translate('DataTable:@Please wait a moment'));

                // Bulk insert student
                LumiaJS.ajaxRequest(window.location.base + '/admin/import/processing-student', {
                    'filePath': filePath || undefined,
                    'import_format': jQuery('#import_format option:selected').val() || undefined,
                    'import_ignore_header': jQuery('#import_ignore_header').val() || undefined
                }).done(function(dataResponse) {
                	var isSucess = (dataResponse.status == 'SUCCESS');
                    BootstrapDialog.show({
                        title: (isSucess ? LumiaJS.i18n.translate('Dialog:@Success') : LumiaJS.i18n.translate('Dialog:@Error')),
                        message: dataResponse.message,
                        type: (isSucess ? BootstrapDialog.TYPE_SUCCESS : BootstrapDialog.TYPE_DANGER),
                        onhide: function(dialog) {
                            !dialog.getData('btnClicked') && dialog.isClosable() && typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
                        },
                        data: {
                        	callback: function(result) {
                    			window.location.href = window.location.base + '/admin/import/student';
                        	}
                        }
                    });
                }).always(function() {
                    dialogItself.close();
                });

                return $message;
            }
        });
    };
    
    // Processing teacher
    LumiaJS.admin.import.processingTeacher = function(filePath) {
    	BootstrapDialog.show({
            title: LumiaJS.i18n.translate('Dialog:@Warning'),
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
                $message.html('<i class="fa fa-refresh fa-spin"></i> ' + LumiaJS.i18n.translate('DataTable:@Please wait a moment'));

                // Bulk insert teacher
                LumiaJS.ajaxRequest(window.location.base + '/admin/import/processing-teacher', {
                    'filePath': filePath || undefined,
                    'import_format': jQuery('#import_format option:selected').val() || undefined,
                    'import_ignore_header': jQuery('#import_ignore_header').val() || undefined
                }).done(function(dataResponse) {
                	var isSucess = (dataResponse.status == 'SUCCESS');
                    BootstrapDialog.show({
                        title: (isSucess ? LumiaJS.i18n.translate('Dialog:@Success') : LumiaJS.i18n.translate('Dialog:@Error')),
                        message: dataResponse.message,
                        type: (isSucess ? BootstrapDialog.TYPE_SUCCESS : BootstrapDialog.TYPE_DANGER),
                        onhide: function(dialog) {
                            !dialog.getData('btnClicked') && dialog.isClosable() && typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
                        },
                        data: {
                        	callback: function(result) {
                    			window.location.href = window.location.base + '/admin/import/teacher';
                        	}
                        }
                    });
                }).always(function() {
                    dialogItself.close();
                });

                return $message;
            }
        });
    };
    
    // Download errors
    LumiaJS.admin.import.downloadError = function(filePath) {
    	jQuery.fileDownload(
                window.location.base + '/admin/import/download-errors', {
                    'data': {
                        'filePath': filePath
                    }
                }
        )
        .done(function(res) {
            if (res.status == 'ERROR') {
                BootstrapDialog.show({
                    title: LumiaJS.i18n.translate('Dialog:@Error'),
                    message: res.message,
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
        })
        .fail(function() {
            BootstrapDialog.show({
                title: LumiaJS.i18n.translate('Dialog:@Error'),
                message: LumiaJS.i18n.translate('ImportForm:@An error occurred in processing download file'),
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
        });
    };

    // Download import format
    LumiaJS.admin.import.downloadFormat = function() {
        // Send request
        LumiaJS.ajaxRequest(window.location.base + '/admin/import/generate-format', {
            'formatID': jQuery('#import_format option:selected').val() || 0
        }).done(function(dataResponse) {
            if (dataResponse.status == 'SUCCESS') {
                jQuery.fileDownload(
                        window.location.base + '/admin/import/download-format', {
                            'data': {
                                'fileName': dataResponse.contexts.fileName
                            }
                        }
                )
                .done(function(res) {
                    if (res.status == 'ERROR') {
                        BootstrapDialog.show({
                            title: LumiaJS.i18n.translate('Dialog:@Error'),
                            message: res.message,
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
                })
                .fail(function() {
                    BootstrapDialog.show({
                        title: LumiaJS.i18n.translate('Dialog:@Error'),
                        message: LumiaJS.i18n.translate('ImportForm:@An error occurred in processing download file'),
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
                });
            } else {
                BootstrapDialog.show({
                    title: LumiaJS.i18n.translate('Dialog:@Error'),
                    message: dataResponse.message,
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
        });
    };
});