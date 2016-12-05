(function(global, $, undefined) {
    "use strict";

    /**
     * DATATABLE
     */
    var $initDataTable = {};
    var $initBaseUrl = {};
    var $jForm, $urlForm;

    /**
     * Error popup
     */
    function throwError() {
        BootstrapDialog.show({
            type: BootstrapDialog.TYPE_DANGER,
            closable: false,
            title: LumiaJS.i18n.translate('DataTable:@Error'),
            message: LumiaJS.i18n.translate('DataTable:@An error occurred in process generate a list of records in current page'),
            buttons: [{
                label: LumiaJS.i18n.translate('Form:@Button cancel'),
                cssClass: 'btn-danger',
                action: function(dialogItself) {
                    dialogItself.close();
                }
            }]
        });
    }

    /**
     * Provide events & method for data grid module
     */
    function jsDataTable() {
        // Init check all event
        this.checkAll('input[data-toggle=checkAll]', 'input[data-target=row]');

        // Init filter form
        this.filterForm = new jFilter(this);
    }

    jsDataTable.prototype = {
        /**
         * Constructor
         */
        constructor: jsDataTable,

        /**
         * Get base url of list view
         *
         * @return string
         */
        baseUrl: function() {
            return $urlForm;
        },

        /**
         * Perform active with all selected rows
         *
         * @param string actionURL
         * @return	void
         */
        performAction: function(actionURL, options) {
            if ($jForm === undefined) {
                return throwError();
            }

            var x  = BootstrapDialog.show(jQuery.extend({}, {
                type: BootstrapDialog.TYPE_PRIMARY,
                closable: false,
                title: LumiaJS.i18n.translate('DataTable:@Notice'),
                message: LumiaJS.i18n.translate('DataTable:@Are you sure you want to perform this action ?'),
                buttons: [{
                    label: LumiaJS.i18n.translate('Form:@Button continue'),
                    cssClass: 'btn-primary',
                    action: function(dialogItself) {
                        var $params = {};
                        var $button = this;

                        // Create params
                        if (jQuery.isFunction(dialogItself.getData('callback'))) {
                            $params = dialogItself.getData('callback').call($button, dialogItself);
                        } else {
                            var $rowChecked = $jForm.find('input[type=checkbox][data-target=row]:checked');
                            if ($rowChecked.length === 0) {
                                // Set popup title
                                dialogItself.setTitle(LumiaJS.i18n.translate('DataTable:@Error'));

                                // Set popup type
                                dialogItself.setType(BootstrapDialog.TYPE_DANGER);

                                // Set popup message
                                dialogItself.setMessage(LumiaJS.i18n.translate('DataTable:@You must select at least one record'));

                                // Remove button
                                $button.remove();

                                return false;
                            }

                            $params['selected-rows'] = $rowChecked.map(function() {
                                return jQuery(this).val();
                            }).get();
                        }

                        if (!jQuery.isPlainObject($params) || jQuery.isEmptyObject($params)) {
                            // Set popup title
                            dialogItself.setTitle(LumiaJS.i18n.translate('DataTable:@Error'));

                            // Set popup type
                            dialogItself.setType(BootstrapDialog.TYPE_DANGER);

                            // Set popup message
                            dialogItself.setMessage(LumiaJS.i18n.translate('DataTable:@Requested parameters does not exist'));

                            // Remove button
                            $button.remove();

                            return false;
                        }

                        $button.disable();
                        $button.spin();
                        dialogItself.setClosable(false);

                        // Send request to remote server
                        var xhr = LumiaJS.ajaxRequest(actionURL, jQuery.extend({}, $params)).done(function(response) {
                            if (response.status == 'ERROR') {
                                // Set popup title
                                dialogItself.setTitle(LumiaJS.i18n.translate('DataTable:@Error'));

                                // Set popup type
                                dialogItself.setType(BootstrapDialog.TYPE_DANGER);

                                // Set popup message
                                dialogItself.setMessage(response.message);

                                // Remove button
                                $button.remove();

                                return false;
                            }

                            // Auto redirect to new url is response from server
                            if (response.contexts.redirect) {
                                global.location.href = response.contexts.redirect;
                            }
                        }).always(function() {
                            $button.enable();
                            $button.stopSpin();
                            dialogItself.setClosable(true);
                            dialogItself.close();
                        });
                        
                        if (dialogItself.getData('deferred')) {
                            $params = dialogItself.getData('deferred').call($button, dialogItself, xhr);
                        }
                    }
                }, {
                    label: LumiaJS.i18n.translate('Form:@Button cancel'),
                    cssClass: 'btn-danger',
                    action: function(dialogItself) {
                        dialogItself.close();
                    }
                }]
            }, options));
        },

        /**
         * Perform action with input url
         *
         * @param string actionURL
         * @return	void
         */
        submitAction: function(actionURL, callback) {
            if ($jForm === undefined) {
                return throwError();
            }

            BootstrapDialog.show({
                type: BootstrapDialog.TYPE_PRIMARY,
                closable: false,
                title: LumiaJS.i18n.translate('DataTable:@Notice'),
                message: LumiaJS.i18n.translate('DataTable:@Are you sure you want to perform this action ?'),
                data: {
                    'callback': jQuery.isFunction(callback) ? callback : null
                },
                buttons: [{
                    label: LumiaJS.i18n.translate('Form:@Button continue'),
                    cssClass: 'btn-primary',
                    action: function(dialogItself) {
                        // Disable all buttons in dialog footer
                        dialogItself.enableButtons(false);

                        // Add icon spin to this button
                        this.spin();

                        // Add form url
                        $jForm.attr('action', actionURL);

                        // Execute callback function
                        dialogItself.getData('callback') && dialogItself.getData('callback').apply(this);

                        // Submit form
                        $jForm.submit();
                    }
                }, {
                    label: LumiaJS.i18n.translate('Form:@Button cancel'),
                    cssClass: 'btn-danger',
                    action: function(dialogItself) {
                        dialogItself.close();
                    }
                }]
            });
        },

        /**
         * Ajax request
         */
        loadPage: function(urlRequest, params) {
            var $self = this;
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

                    // Load page
                    LumiaJS.ajaxRequest(urlRequest, jQuery.extend({}, $self.filterForm.params(), params), {
                        'type': 'POST',
                        'dataType': 'html'
                    }).done(function(data) {
                        jQuery($jForm).parent().html(data);
                    }).always(function() {
                        dialogItself.close();
                    });

                    return $message;
                }
            });
        },

        /**
         * Selected rows
         *
         * @param	string parent
         * @param	string group
         * @param	object options
         * @return	void
         */
        checkAll: function(parent, group, options) {
            if ($jForm === undefined) {
                return throwError();
            }

            var selector, groupSize;
            var opts = jQuery.extend({
                    sync: true
                }, options),
                $master = $jForm.find(parent),
                $slaves = $jForm.find(group),
                onClick = (jQuery.isFunction(opts.onClick) ? opts.onClick : null),
                onMasterClick = (jQuery.isFunction(opts.onMasterClick) ? opts.onMasterClick : null),
                reportTo = (jQuery.isFunction(opts.reportTo) ? jQuery.proxy(opts.reportTo, $master) : null),
                // for compatibility with 1.4.2 through 1.6
                propFn = (jQuery.isFunction(jQuery.fn.prop) ? 'prop' : 'attr'),
                onFn = (jQuery.isFunction(jQuery.fn.on) ? 'on' : 'live'),
                offFn = (jQuery.isFunction(jQuery.fn.off) ? 'off' : 'die');

            // Resize width for first checkbox element
            $master.closest('th').width(0);

            // omit the master if it was accidentally selected with the slaves
            if ($slaves.index($master) === -1) {
                selector = $slaves.selector;
            } else {
                $slaves = $slaves.not($master.selector);
                selector = $slaves.selector.replace('.not(', ':not(');
            }

            groupSize = $slaves.length;
            if (groupSize === 0) {
                // this is kind of a problem
                groupSize = -1;
            } else {
                var $fnTrCallback = function(e) {
                    var $target = jQuery(e.target);
                    if ($target.is(':input') || $target.is('a[href]') || $target.prop('onclick') || ($target.data('events') && $target.data('events').click)) {
                        return;
                    }

                    // Trigger event click
                    jQuery(e.data.checkbox).trigger('click');
                };

                var $fnCheckboxCallback = function(e) {
                    var $target = jQuery(e.target),
                        $trTag = $target.closest('tr');

                    if ($target.is(':checked')) {
                        $trTag.addClass('warning');
                    } else {
                        $trTag.removeClass('warning');
                    }
                }

                $slaves.each(function(i, item) {
                    var $item = jQuery(item),
                        $trTag = $item.closest('tr');

                    $item.unbind('click checked', $fnCheckboxCallback).bind('click checked', $fnCheckboxCallback);
                    $trTag.unbind('click', { 'checkbox': $item }, $fnTrCallback).bind('click', { 'checkbox': $item }, $fnTrCallback);
                });
            }

            function _countChecked() {
                return $slaves.filter(':checked').length;
            }

            function _autoEnable() {
                var numChecked = _countChecked();
                $master[propFn]('checked', groupSize === numChecked);
                if (reportTo) {
                    reportTo(numChecked);
                }
            }

            function _autoDisable() {
                $master[propFn]('checked', false);
                if (reportTo) {
                    reportTo(_countChecked());
                }
            }

            function _fnCheckAll(e) {
                var checkVal = e.target.checked;
                $slaves.add($master)[propFn]('checked', checkVal).trigger('checked');

                if (onMasterClick) {
                    onMasterClick.apply(this);
                }

                if (reportTo) {
                    reportTo(checkVal ? _countChecked() : 0);
                }
            }

            $master.unbind('click.checkAll', _fnCheckAll).bind('click.checkAll', _fnCheckAll);

            if (opts.sync) {
                jQuery(selector)[offFn]('click.checkAll')[onFn]('click.checkAll', function() {
                    this.checked ? _autoEnable() : _autoDisable();

                    if (onClick) {
                        onClick.apply(this);
                    }
                });
            }

            _autoEnable();
        }
    };

    /**
     * Filter form
     */
    function jFilter($jGrid) {
        var $jElement;
        var $self = this;
        var $formData = {};
        var $inputFilter = function() {
            return $jForm.find(':input[name^=' + $jForm.prop('name') + '\\[filter\\]]').not(':button');
        };

        /**
         * Prevent event of enter key
         */
        (function() {
            var $fnKeypress = function(e) {
                var $keyCode = (e.which ? e.which : e.keyCode);
                if ($keyCode == 13 && (e.target.name + '').indexOf(e.currentTarget.name + '[filter]') === 0) {
                    e.preventDefault();
                    $self.perform();
                }
            };

            $jForm.unbind("keypress", $fnKeypress).bind("keypress", $fnKeypress);
        })();

        /**
         * Process form data
         *
         * @return	object
         */
        this.params = function() {
            var $params = {};
            $inputFilter().each(function(index, element) {
                $jElement = jQuery(element);
                var $elName = $jElement.prop('name');
                if ($elName === undefined) {
                    return;
                }

                $params[$elName] = $jElement.val();
            });

            return $params;
        };

        /**
         * Perform search
         *
         * @param	object
         * @return	void
         */
        this.perform = function() {
            if ($urlForm === undefined) {
                return throwError();
            }

            $formData = $self.params();
            $formData['page'] = 1;
            $jGrid.loadPage($urlForm, $formData);
        };

        /**
         * Reset filter form
         *
         * @return	void
         */
        this.reset = function() {
            if ($urlForm === undefined) {
                return throwError();
            }

            $jForm.get(0).reset();
        };

        /**
         * Clear filter form
         *
         * @return	void
         */
        this.clear = function() {
            if ($urlForm === undefined) {
                return throwError();
            }

            $inputFilter().each(function(i, element) {
                var $el = jQuery(element);

                switch ($el.prop('type')) {
                    case "radio":
                    case "checkbox":
                        $el.prop('checked', false);
                        break;
                    case "select":
                        $el.prop('selected', -1);
                        break;
                    default:
                        $el.val('');
                        break;
                }
            });

            $self.perform($urlForm);
        };
    }

    LumiaJS.dataTable = {
        /**
         * Redirect to new page
         *
         * @param string redirectUrl
         * @return	void
         */
        redirect: function(redirectUrl) {
            window.location.href = redirectUrl;
        },

        /**
         * Set table grid into private cache
         *
         * @param string listViewId
         * @param string listViewUrl
         * @return void
         */
        set: function(listViewId, listViewUrl) {
            $jForm = jQuery('form[name=' + listViewId + ']');
            $urlForm = listViewUrl;
            if ($jForm.length > 0) {
                $initDataTable[listViewId] = new jsDataTable();
                $initBaseUrl[listViewId] = listViewUrl;
            } else {
                throwError();
            }
        },

        /**
         * Get table grid from private cache
         *
         * @param string listViewId
         * @return object
         */
        get: function(listViewId) {
            $jForm = jQuery('form[name=' + listViewId + ']');
            if ($jForm.length > 0 && ($initDataTable[listViewId] instanceof jsDataTable)) {
                $urlForm = $initBaseUrl[listViewId];
                return $initDataTable[listViewId];
            }

            throwError();
        }
    };

})(window, jQuery);