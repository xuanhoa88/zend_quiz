(function(global, undefined) {
    "use strict";

    //    	LumiaJS.i18n.translations('en', {
    //            'datePicker': {
    //                'Month': 'Month',
    //                'Year': 'Year',
    //                'Day': 'Day'
    //            }
    //        });
    //
    //        LumiaJS.i18n.translations('fr', {
    //            'datePicker': {
    //                'Month': 'Mois',
    //                'Year': 'Année',
    //                'Day': 'Jour {{0}}'
    //            }
    //        });
    //
    //        LumiaJS.i18n.use('fr');
    //
    //        alert(LumiaJS.i18n.translate('datePicker.Day', 1));

    var $uses;
    var NESTED_OBJECT_DELIMITER = '.';
    var configs = {};
    var $translationTable = {};

    /**
     * Is a given variable an object?
     */
    function isObject(obj) {
        var type = typeof obj;
        return type === 'function' || type === 'object' && !!obj;
    };

    /**
     * Extend a given object with all the properties in passed-in object(s).
     */
    function extendObject(obj) {
        if (!isObject(obj)) {
            return obj;
        }

        var source, prop;
        for (var i = 1, length = arguments.length; i < length; i++) {
            source = arguments[i];
            for (prop in source) {
                if (Object.prototype.hasOwnProperty.call(source, prop)) {
                    obj[prop] = source[prop];
                }
            }
        }
        return obj;
    }

    /**
     * Flats an object. This function is used to flatten given translation data with
     * namespaces, so they are later accessible via dot notation.
     */
    function flatObject(data, path, result, prevKey) {
        var key, keyWithPath, keyWithShortPath, val;
        if (!path) {
            path = [];
        }

        if (!result) {
            result = {};
        }

        for (key in data) {
        	if (!Object.prototype.hasOwnProperty.call(data, key)) {
                continue;
            }

            val = data[key];

            if (isObject(val)) {
                flatObject(val, path.concat(key), result, key);
            } else {
                keyWithPath = path.length ? ('' + path.join(NESTED_OBJECT_DELIMITER) + NESTED_OBJECT_DELIMITER + key) : key;
                if (path.length && key === prevKey) {
                    // Create shortcut path (foo.bar == foo.bar.bar)
                    keyWithShortPath = '' + path.join(NESTED_OBJECT_DELIMITER);
                    // Link it to original path
                    result[keyWithShortPath] = '@:' + keyWithPath;
                }

                result[keyWithPath] = val;
            }
        }
        return result;
    };

    function i18n() {
        this.setConfig();
        $uses = configs['default'];
    }

    i18n.prototype = {

        /**
         * Set configuration
         *
         * @param object options
         * @return	void
         */
        setConfig: function(options) {
            configs = extendObject({
                'default': 'en_US'
            }, options);
        },

        /**
         * Set which translation table to use for translation by given language key. When
         * trying to 'use' a language which isn't provided, it'll throw an error.
         *
         * You actually don't have to use this method since `$translateProvider#preferredLanguage`
         * does the job too.
         *
         * @param string langKey A language key.
         * @return mixed
         */
        use: function(langKey) {
            if (langKey) {
                if (!$translationTable[langKey]) {
                    // only throw an error, when not loading translation data asynchronously
                    throw new Error("LumiaJS.i18n couldn't find translationTable for langKey: '" + langKey + "'");
                }

                $uses = langKey;
                return this;
            }

            return $uses;
        },

        /**
         * Registers a new translation table for specific language key.
         *
         * To register a translation table for specific language, pass a defined language
         * key as first parameter.
         *
         * <pre>
         *  // register translation table for language: 'de_DE'
         *  translations('de_DE', {
         *    'GREETING': 'Hallo Welt!'
         *  });
         *
         *  // register another one
         *  translations('en_US', {
         *    'GREETING': 'Hello world!'
         *  });
         * </pre>
         *
         * When registering multiple translation tables for for the same language key,
         * the actual translation table gets extended. This allows you to define module
         * specific translation which only get added, once a specific module is loaded in
         * your app.
         *
         * Invoking this method with no arguments returns the translation table which was
         * registered with no language key. Invoking it with a language key returns the
         * related translation table.
         *
         * @param {string} key A language key.
         * @param {object} translationTable A plain old JavaScript object that represents a translation table.
         *
         */
        translations: function(langKey, translationTable) {
            if (!langKey && !translationTable) {
                return $translationTable;
            }

            if (langKey && !translationTable) {
                if (typeof(langKey) === 'string') {
                    return $translationTable[langKey];
                }
            } else {
                if (!isObject($translationTable[langKey])) {
                    $translationTable[langKey] = {};
                }

                extendObject($translationTable[langKey], flatObject(translationTable));
            }

            return this;
        },

        /**
         * Translate a message
         * You can give multiple params or an array of params.
         * If you want to output another locale just set it as last single parameter
         * Example 1: translate('%1\$s + %2\$s', $value1, $value2, $locale);
         * Example 2: translate('%1\$s + %2\$s', array($value1, $value2), $locale);
         *
         * @param  string $messageid Id of the message to be translated
         * @return string|Zend_View_Helper_Translate Translated message
         */
        translate: function(translationId, interpolateParams) {
            var langKey = $uses;
            if (arguments.length > 2) {
                langKey = arguments[0];
                translationId = arguments[1];
                interpolateParams = arguments[2];
            }
            
            // Get translations table by language key
            var table = langKey ? $translationTable[langKey] : $translationTable[configs['default']];

            // check if string exists in translation
            if (isObject(table) && table[translationId]) {
                translationId = table[translationId];
            }

            if (interpolateParams) {
                return this.vsprintf(translationId, interpolateParams);
            }

            return translationId;
        },

        format: function() {
            var args = Array.prototype.slice.call(arguments);
            
            // The string containing the format items (e.g. "{0}")
            // will and always has to be the first argument.
            var source = args.shift();
            for (var i = 0; i < args.length; i++) {
                // "gm" = RegEx options for Global search (more than one instance)
                // and for Multiline search
                var regEx = new RegExp("\\{{" + i + "\\}}", "gm");
                source = source.replace(regEx, args[i]);
            }

            return source;
        },
        
        vsprintf: function (format, args) {
            function sprintf() {
                //  discuss at: http://phpjs.org/functions/sprintf/
                // original by: Ash Searle (http://hexmen.com/blog/)
                // improved by: Michael White (http://getsprink.com)
                // improved by: Jack
                // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
                // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
                // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
                // improved by: Dj
                // improved by: Allidylls
                //    input by: Paulo Freitas
                //    input by: Brett Zamir (http://brett-zamir.me)
                //   example 1: sprintf("%01.2f", 123.1);
                //   returns 1: 123.10
                //   example 2: sprintf("[%10s]", 'monkey');
                //   returns 2: '[    monkey]'
                //   example 3: sprintf("[%'#10s]", 'monkey');
                //   returns 3: '[####monkey]'
                //   example 4: sprintf("%d", 123456789012345);
                //   returns 4: '123456789012345'
                //   example 5: sprintf('%-03s', 'E');
                //   returns 5: 'E00'

                var regex = /%%|%(\d+\$)?([-+\'#0 ]*)(\*\d+\$|\*|\d+)?(\.(\*\d+\$|\*|\d+))?([scboxXuideEfFgG])/g;
                var a = arguments;
                var i = 0;
                var format = a[i++];

                // pad()
                var pad = function(str, len, chr, leftJustify) {
                    if (!chr) {
                        chr = ' ';
                    }
                    var padding = (str.length >= len) ? '' : new Array(1 + len - str.length >>> 0)
                        .join(chr);
                    return leftJustify ? str + padding : padding + str;
                };

                // justify()
                var justify = function(value, prefix, leftJustify, minWidth, zeroPad, customPadChar) {
                    var diff = minWidth - value.length;
                    if (diff > 0) {
                        if (leftJustify || !zeroPad) {
                            value = pad(value, minWidth, customPadChar, leftJustify);
                        } else {
                            value = value.slice(0, prefix.length) + pad('', diff, '0', true) + value.slice(prefix.length);
                        }
                    }
                    return value;
                };

                // formatBaseX()
                var formatBaseX = function(value, base, prefix, leftJustify, minWidth, precision, zeroPad) {
                    // Note: casts negative numbers to positive ones
                    var number = value >>> 0;
                    prefix = prefix && number && {
                        '2': '0b',
                        '8': '0',
                        '16': '0x'
                    }[base] || '';
                    value = prefix + pad(number.toString(base), precision || 0, '0', false);
                    return justify(value, prefix, leftJustify, minWidth, zeroPad);
                };

                // formatString()
                var formatString = function(value, leftJustify, minWidth, precision, zeroPad, customPadChar) {
                    if (precision != null) {
                        value = value.slice(0, precision);
                    }
                    return justify(value, '', leftJustify, minWidth, zeroPad, customPadChar);
                };

                // doFormat()
                var doFormat = function(substring, valueIndex, flags, minWidth, _, precision, type) {
                    var number, prefix, method, textTransform, value;

                    if (substring === '%%') {
                        return '%';
                    }

                    // parse flags
                    var leftJustify = false;
                    var positivePrefix = '';
                    var zeroPad = false;
                    var prefixBaseX = false;
                    var customPadChar = ' ';
                    var flagsl = flags.length;
                    for (var j = 0; flags && j < flagsl; j++) {
                        switch (flags.charAt(j)) {
                            case ' ':
                                positivePrefix = ' ';
                                break;
                            case '+':
                                positivePrefix = '+';
                                break;
                            case '-':
                                leftJustify = true;
                                break;
                            case "'":
                                customPadChar = flags.charAt(j + 1);
                                break;
                            case '0':
                                zeroPad = true;
                                customPadChar = '0';
                                break;
                            case '#':
                                prefixBaseX = true;
                                break;
                        }
                    }

                    // parameters may be null, undefined, empty-string or real valued
                    // we want to ignore null, undefined and empty-string values
                    if (!minWidth) {
                        minWidth = 0;
                    } else if (minWidth === '*') {
                        minWidth = +a[i++];
                    } else if (minWidth.charAt(0) == '*') {
                        minWidth = +a[minWidth.slice(1, -1)];
                    } else {
                        minWidth = +minWidth;
                    }

                    // Note: undocumented perl feature:
                    if (minWidth < 0) {
                        minWidth = -minWidth;
                        leftJustify = true;
                    }

                    if (!isFinite(minWidth)) {
                        throw new Error('sprintf: (minimum-)width must be finite');
                    }

                    if (!precision) {
                        precision = 'fFeE'.indexOf(type) > -1 ? 6 : (type === 'd') ? 0 : undefined;
                    } else if (precision === '*') {
                        precision = +a[i++];
                    } else if (precision.charAt(0) == '*') {
                        precision = +a[precision.slice(1, -1)];
                    } else {
                        precision = +precision;
                    }

                    // grab value using valueIndex if required?
                    value = valueIndex ? a[valueIndex.slice(0, -1)] : a[i++];

                    switch (type) {
                        case 's':
                            return formatString(String(value), leftJustify, minWidth, precision, zeroPad, customPadChar);
                        case 'c':
                            return formatString(String.fromCharCode(+value), leftJustify, minWidth, precision, zeroPad);
                        case 'b':
                            return formatBaseX(value, 2, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
                        case 'o':
                            return formatBaseX(value, 8, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
                        case 'x':
                            return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
                        case 'X':
                            return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad)
                                .toUpperCase();
                        case 'u':
                            return formatBaseX(value, 10, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
                        case 'i':
                        case 'd':
                            number = +value || 0;
                            // Plain Math.round doesn't just truncate
                            number = Math.round(number - number % 1);
                            prefix = number < 0 ? '-' : positivePrefix;
                            value = prefix + pad(String(Math.abs(number)), precision, '0', false);
                            return justify(value, prefix, leftJustify, minWidth, zeroPad);
                        case 'e':
                        case 'E':
                        case 'f': // Should handle locales (as per setlocale)
                        case 'F':
                        case 'g':
                        case 'G':
                            number = +value;
                            prefix = number < 0 ? '-' : positivePrefix;
                            method = ['toExponential', 'toFixed', 'toPrecision']['efg'.indexOf(type.toLowerCase())];
                            textTransform = ['toString', 'toUpperCase']['eEfFgG'.indexOf(type) % 2];
                            value = prefix + Math.abs(number)[method](precision);
                            return justify(value, prefix, leftJustify, minWidth, zeroPad)[textTransform]();
                        default:
                            return substring;
                    }
                };

                return format.replace(regex, doFormat);
            };
            
            //  discuss at: http://phpjs.org/functions/vsprintf/
            // original by: ejsanders
            //  depends on: sprintf
            //   example 1: vsprintf('%04d-%02d-%02d', [1988, 8, 1]);
            //   returns 1: '1988-08-01'
            return sprintf.apply(this, [format].concat(args));
        }
    };

    LumiaJS.i18n = new i18n();
    
})(window);