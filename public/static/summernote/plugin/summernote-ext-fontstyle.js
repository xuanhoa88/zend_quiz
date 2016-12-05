(function(factory) {
    /* global define */
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else {
        // Browser globals: jQuery
        factory(window.jQuery);
    }
}(function($) {
    // template, editor
    var tmpl = $.summernote.renderer.getTemplate();
    var editor = $.summernote.eventHandler.getEditor();

    /**
     * @class plugin.fontstyle
     *
     * FontStyle Plugin
     * 
     * ### load script 
     * 
     * ```
     * < script src="plugin/summernote-ext-fontstyle.js"></script >
     * ``` 
     * 
     * ### use a plugin in toolbar
     * ```
     *    $("#editor").summernote({
     *    ...
     *    toolbar : [
     *        ['group', [ 'fontstyle' ]]
     *    ]
     *    ...    
     *    }); 
     * ```
     */
    $.summernote.addPlugin({
        /** @property {String} name name of plugin */
        name: 'fontstyle', // name of plugin
        /**
         * @property {Object} buttons 
         * @property {Function} buttons.strikethrough  
         * @property {Function} buttons.superscript   
         * @property {Function} buttons.subscript   
         * @property {Function} buttons.fontsize   dropdown button
         */
        buttons: { // buttons
            strikethrough: function(lang) {
                return tmpl.iconButton('fa fa-strikethrough', {
                    event: 'strikethrough',
                    title: lang.fontstyle.strikethrough
                });
            },
            superscript: function(lang) {
                return tmpl.iconButton('fa fa-superscript', {
                    event: 'superscript',
                    title: lang.fontstyle.superscript
                });
            },
            subscript: function(lang) {
                return tmpl.iconButton('fa fa-subscript', {
                    event: 'subscript',
                    title: lang.fontstyle.subscript
                });
            },
            fontsize: function(lang, options) {
                var items = options.fontSizes.reduce(function(memo, v) {
                    return memo + '<li><a data-event="fontsize" href="#" data-value="' + v + '">' +
                        '<i class="fa fa-check"></i> ' + v +
                        '</a></li>';
                }, '');

                var label = '<span class="note-current-fontsize">11</span>';
                return tmpl.button(label, {
                    title: lang.fontstyle.size,
                    dropdown: '<ul class="dropdown-menu">' + items + '</ul>'
                });
            }
        },

        /**
         * @property {Object} events
         * @property {Function} events.strikethrough  apply strikethrough  style to selected range
         * @property {Function} events.superscript apply superscript to selected range
         * @property {Function} events.subscript apply subscript to selected range
         * @property {Function} events.fontSize apply font size to selected range
         */
        events: {
            strikethrough: function(event, editor, layoutInfo, value) {
                editor.strikethrough(layoutInfo.editable());
            },
            superscript: function(event, editor, layoutInfo, value) {
                editor.superscript(layoutInfo.editable());
            },
            subscript: function(event, editor, layoutInfo, value) {
                editor.subscript(layoutInfo.editable());
            },
            fontsize: function(event, editor, layoutInfo, value) {
                editor.fontSize(layoutInfo.editable(), value);
            }
        },

        options: {
            fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36']
        },

        langs: {
            'en-US': {
                fontstyle: {
                    strikethrough: 'Strikethrough',
                    subscript: 'Subscript',
                    superscript: 'Superscript',
                    size: 'Font Size'
                }
            },
            'vi-VN': {
                fontstyle: {
                    strikethrough: 'Gạch Ngang',
                    size: 'Cỡ Chữ'
                }
            }
        }
    });
}));