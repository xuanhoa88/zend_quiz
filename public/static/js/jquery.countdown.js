(function ($) {
	"use strict";
	
    $.fn.countdown = function (opts, callback) {
    	var defaults = {
    		'toDate': null,
    		'fromDate': new Date()
    	};
        var handlers = ['seconds', 'minutes', 'hours', 'days', 'weeks', 'secondsLeft', 'daysLeft'];

        function delegate(scope, method) {
            return function () {
                return method.call(scope);
            };
        }
        
        try {
        	defaults = $.extend(defaults, opts);
        } catch (e) {
			
		}

        return this.each(function () {
            // Convert
            if (!(defaults.toDate instanceof Date)) {
                if (String(defaults.toDate).match(/^[0-9]*$/)) {
                    defaults.toDate = new Date(defaults.toDate);
                } else if (defaults.toDate.match(/([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{2,4})\s([0-9]{1,2})\:([0-9]{2})\:([0-9]{2})/) ||
                    defaults.toDate.match(/([0-9]{2,4})\/([0-9]{1,2})\/([0-9]{1,2})\s([0-9]{1,2})\:([0-9]{2})\:([0-9]{2})/)
                ) {
                    defaults.toDate = new Date(defaults.toDate);
                } else if (defaults.toDate.match(/([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{2,4})/) ||
                    defaults.toDate.match(/([0-9]{2,4})\/([0-9]{1,2})\/([0-9]{1,2})/)
                ) {
                    defaults.toDate = new Date(defaults.toDate);
                } else {
                    throw new Error("Doesn't seen to be a valid date object or string");
                }
            } else {
            	if (isNaN(defaults.toDate.getTime())) {
            		throw new Error("Doesn't seen to be a valid date object or string");
            	}
            }

            var $this = $(this),
                values = {},
                lasting = {},
                interval = $this.data('countdownInterval'),
                secondsLeft = Math.floor((defaults.toDate.valueOf() - defaults.fromDate.valueOf()) / 1000);

            function triggerEvents() {

                // Evaluate if this node is included in the html
                if ($this.closest('html').length === 0) {
                    stop(); // Release the memory
                    dispatchEvent('removed');
                    return;
                }

                // Calculate the time offset
                secondsLeft--;
                if (secondsLeft < 0) {
                    secondsLeft = 0;
                }

                lasting = {
                    seconds: secondsLeft % 60,
                    minutes: Math.floor(secondsLeft / 60) % 60,
                    hours: Math.floor(secondsLeft / 60 / 60) % 24,
                    days: Math.floor(secondsLeft / 60 / 60 / 24),
                    weeks: Math.floor(secondsLeft / 60 / 60 / 24 / 7),
                    secondsLeft: secondsLeft,
                    daysLeft: Math.floor(secondsLeft / 60 / 60 / 24) % 7
                };

                for (var i = 0; i < handlers.length; i++) {
                    var eventName = handlers[i];
                    if (values[eventName] != lasting[eventName]) {
                        values[eventName] = lasting[eventName];
                        dispatchEvent(eventName);
                    }
                }

                if (secondsLeft == 0) {
                    stop();
                    dispatchEvent('finished');
                }
            }

            triggerEvents();

            function dispatchEvent(eventName) {
                var event = $.Event(eventName);
                event.date = new Date(new Date().valueOf() + secondsLeft);
                event.value = values[eventName] || "0";
                event.toDate = defaults.toDate;
                event.lasting = lasting;
                switch (eventName) {
	                case "seconds":
	                case "minutes":
	                case "hours":
	                    event.value = (event.value < 10 ? '0' + event.value.toString() : event.value.toString());
	                    break;
	                default:
	                    if (event.value) {
	                        event.value = event.value.toString();
	                    }
	                    break;
                }
                callback.call($this, event);
            }

            function stop() {
                clearInterval(interval);
            }

            function start() {
                $this.data('countdownInterval', setInterval(delegate($this, triggerEvents), 1000));
                interval = $this.data('countdownInterval');
            }

            if (interval) {
                stop();
            }

            start();
        });
    };
})(jQuery);