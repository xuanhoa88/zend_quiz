(function(window, undefined) {
    "use strict";

    if (window.LumiaJS === undefined) {
        window.LumiaJS = {};
    }
    
    var $questionIds = [], 
    	$locationDisplay = null,
    	$tplQuestions = {},
        $examId = 0,
        $currentQuestion = 0,
        $currentPos = -1,
        $enableClick = true,
        // Determine whether button finish has been used yet? 
        $finished = false,
        // Force click to button finish
        $forceClick = false,
        // Group buttons
        $actionButtons = {
            'next': '',
            'prev': '',
            'finish': ''
        };

    function objectKeys(obj) {
        if (Object.keys) {
            return Object.keys(obj);
        }

        var hasOwnProperty = Object.prototype.hasOwnProperty,
            hasDontEnumBug = !({
                toString: null
            }).propertyIsEnumerable('toString'),
            dontEnums = [
                'toString',
                'toLocaleString',
                'valueOf',
                'hasOwnProperty',
                'isPrototypeOf',
                'propertyIsEnumerable',
                'constructor'
            ],
            dontEnumsLength = dontEnums.length;

        return function(obj) {
            if (typeof obj !== 'object' && (typeof obj !== 'function' || obj === null)) {
                throw new TypeError('Object.keys called on non-object');
            }

            var result = new Array();
            for (var prop in obj) {
                if (hasOwnProperty.call(obj, prop)) {
                    result.push(prop);
                }
            }

            if (hasDontEnumBug) {
                for (var i = 0; i < dontEnumsLength; i++) {
                    if (hasOwnProperty.call(obj, dontEnums[i])) {
                        result.push(dontEnums[i]);
                    }
                }
            }

            return result;
        };
    }
    
    function spinner(button) {
        Ladda.stopAll();
        var spinner = Ladda.create(button);
        spinner.start();

        return spinner;
    }

    function submitQuestion(url, data) {
    	// Create params
        try {
            data = jQuery.extend({'exam-id': $examId}, data);
        } catch (e) {
            data = {};
        }

        return LumiaJS.ajaxRequest(url, data, {'type': 'POST'}).always(function() {
        	// Enable event click for all buttons registered
            $enableClick = true;
        });
    }
    
    function Quiz(questions) {
    	// Set all questions template
        $tplQuestions = jQuery.extend({}, questions);
        
        // Get all questions id
        $questionIds = objectKeys($tplQuestions);
        
        // Get current question & question number
        if ($questionIds[0]) {
            $currentQuestion = $questionIds[0];
            $currentPos = 0;
        }
    }
    
    /**
     * Set button element for each action corresponding
     * 
     * @param	object buttons
     * @return	void
     */
    Quiz.prototype.actionButtons = function(buttons) {
    	var $this = this;
    	
    	// Inject config buttons into default buttons
    	try {
    		$actionButtons = jQuery.extend({}, $actionButtons, buttons);
    	} catch (e) {
			// TODO: handle exception
		}
        
        // Add event click for prev button
        jQuery(document).off('click', $actionButtons['prev']).on('click', $actionButtons['prev'], function(e) {
        	// Prevent the default event from occuring
            e.preventDefault();
            
            // Execute previous question
            $this.prevQuestion(this);
        });
        
        // Add event click for next button
        jQuery(document).off('click', $actionButtons['next']).on('click', $actionButtons['next'], function(e) {
        	// Prevent the default event from occuring
            e.preventDefault();
            
            // Execute next question
            $this.nextQuestion(this);
        });
        
        // Add event click for finish button
        jQuery(document).off('click', $actionButtons['finish']).on('click', $actionButtons['finish'], function(e) {

        	// Prevent the default event from occuring
            e.preventDefault();
            
        	// Show error message when end-user did cheat code
        	if ($finished) {
        		return BootstrapDialog.show({
                    type: BootstrapDialog.TYPE_DANGER,
                    closable: false,
                    title: LumiaJS.i18n.translate('Dialog:@Warning'),
                    message: LumiaJS.i18n.translate('QuizForm:@You are cheating to try to complete the test')
                });;
        	}
            
            var $self = this;
            
            // If current question is not lastest question, auto trigger event click on next button
            if (!$forceClick) {
            	$forceClick = true;
            	jQuery($actionButtons['next']).trigger('click');
            } else {
            	// Execute finish action
                BootstrapDialog.show({
                    type: BootstrapDialog.TYPE_DANGER,
                    closable: false,
                    title: LumiaJS.i18n.translate('Dialog:@Warning'),
                    message: LumiaJS.i18n.translate('QuizForm:@Do you want finish this test ?'),
                    buttons: [{
                        label: LumiaJS.i18n.translate('QuizForm:@Button yes'),
                        cssClass: 'btn-primary btn-lg',
                        action: function(dialog) {
                        	// Active button finish 
                        	$finished = true;
                        	
                        	// Close dialog
                            dialog.close();
                            
                            // Disable event click for all buttons registered
                            $enableClick = false;
                            
                            // Execute method finish
                            $this.finish();
                            
                            // Make sure only event on finish button executing
                            spinner($self);
                        }
                    }, {
                        label: LumiaJS.i18n.translate('QuizForm:@Button no'),
                        cssClass: 'btn-danger btn-lg',
                        action: function(dialog) {
                    		$forceClick = false;
                    		
                        	// Close dialog
                            dialog.close();
                        }
                    }]
                });
            }
        });
    };
    
    /**
     * Execute task when click next question button
     * 
     * @param button
     * @return	void
     */
    Quiz.prototype.nextQuestion = function(button) {
        var $self = this;
        
        // Create params for request
        var params = {
            'id': $questionIds[$currentPos],
            'answer': jQuery('[name=quiz-answer\\[\\]]:checked').map(function() {
                return jQuery(this).val();
            }).get(),
            'question-number': jQuery.inArray($currentQuestion, $questionIds) + 1
        };
        
        // Get current question id
        $currentQuestion = $questionIds[++$currentPos];
        
        // Disable event click on all buttons
        $enableClick = false;
        
        // Create spinner
        var s = spinner(button);
        
        // Submit answer
        submitQuestion(window.location.base + '/quiz/question', params).done(function(data) {
        	// If error occurs, show message
            if (data.ERROR) {
                return BootstrapDialog.show({
                    type: BootstrapDialog.TYPE_DANGER,
                    closable: false,
                    title: LumiaJS.i18n.translate('Dialog:@Warning'),
                    message: data.MESSAGE
                });
            }
            
            // Replace current question template
            if (jQuery.isPlainObject(data.contexts) && data.contexts.QUESTION_ID) {
                $tplQuestions[data.contexts.QUESTION_ID] = data.contexts.TEMPLATE;
            }

        }).always(function() {
        	// Remove spinner
            s.stop();
            
            // If current question is lastest question, auto trigger event click on finish button
            if ($currentPos === $questionIds.length || $forceClick) {
                jQuery($actionButtons['finish']).trigger('click');
                $currentQuestion = $questionIds[--$currentPos];
                return false;
            }
            
            // Set current question id
            if (!$self.currentQuestion()) {
                $currentQuestion = $questionIds[--$currentPos];
            }
            
        });
    };

    /**
     * Execute task when click previous question button
     * 
     * @param button
     * @return	void
     */
    Quiz.prototype.prevQuestion = function(button) {
        var $self = this;
        
        // Create params for request
        var params = {
            'id': $questionIds[$currentPos],
            'answer': jQuery('[name=quiz-answer\\[\\]]:checked').map(function() {
                return jQuery(this).val();
            }).get(),
            'question-number': jQuery.inArray($currentQuestion, $questionIds) + 1
        };
        
        // Get current question id
        $currentQuestion = $questionIds[--$currentPos];
        
        // Disable event click on all buttons
        $enableClick = false;
        
        // Create spinner
        var s = spinner(button);
        
        // Submit answer
        submitQuestion(window.location.base + '/quiz/question', params).done(function(data) {
        	// If error occurs, show message
            if (data.ERROR) {
                return BootstrapDialog.show({
                    type: BootstrapDialog.TYPE_DANGER,
                    closable: false,
                    title: LumiaJS.i18n.translate('Dialog:@Warning'),
                    message: data.MESSAGE
                });
            }
            
            // Replace current question template
            if (jQuery.isPlainObject(data.contexts) && data.contexts.QUESTION_ID) {
                $tplQuestions[data.contexts.QUESTION_ID] = data.contexts.TEMPLATE;
            }
        }).always(function() {
        	// Remove spinner
            s.stop();
            
            // Set current question id
            if (!$self.currentQuestion()) {
                $currentQuestion = $questionIds[++$currentPos];
            }
        });
    };
    
    /**
     * Execute task when click submit quiz button
     * 
     * @return	void
     */
    Quiz.prototype.finish = function() {
    	
    	// Disable event click for all buttons registered
        $enableClick = false;
        
        // Submit exam
        submitQuestion(window.location.base + '/quiz/finish').done(function(r) {
        	
        	// If error occurs, show message
        	if (r.status == 'ERROR' || !r.contexts.EXAM_ID) {
                return BootstrapDialog.show({
                    type: BootstrapDialog.TYPE_DANGER,
                    closable: false,
                    title: LumiaJS.i18n.translate('Dialog:@Error'),
                    message: r.message,
                    buttons: [{
                        label: LumiaJS.i18n.translate('QuizForm:@Go to my exams'),
                        action: function(dialog) {
                        	// Close dialog
                            dialog.close();
                            
                            // Disable event click for all buttons registered
                            $enableClick = false;
                            
                            // Redirect to my exams page
                            window.location.href = window.location.base + '/quiz/index';
                            
                            // Make sure only event on finish button executing
                            spinner($self);
                        }
                    }]
                });
            }
            
            // Redirect to result page
    		window.location.href = window.location.base + '/quiz/result/exam-id/' + r.contexts.EXAM_ID;
        });
    };
    
    /**
     * Execute task when current question loaded & appear on body
     * 
     * @return	boolean
     */
    Quiz.prototype.currentQuestion = function() {
    	
    	// If location display not exists, all questions & corresponding answers always hidden
    	if (jQuery($locationDisplay).length == 0) {
    		return false;
    	}
    	
    	// If buttons disabled event click or template of current question empty, 
    	// do not perform method
        if (!$enableClick || $tplQuestions[$currentQuestion] === undefined) {
            return false;
        }
        
        // Add template current question into view
        jQuery($locationDisplay).html($tplQuestions[$currentQuestion]);

        return true;
    };
    
    /**
     * Set location display per question and corresponding answers
     * 
     * @param	string|jQuery locationDisplay
     * @return	void
     */
    Quiz.prototype.locationDisplay = function(locationDisplay) {
    	$locationDisplay = locationDisplay;
    };
    
    /**
     * Alias of current question method
     * 
     * @returns	void
     */
    Quiz.prototype.run = function() {
    	this.currentQuestion();
    };
    
    /**
     * Set exam id
     * 
     * @oaram	int examId
     * @return	void
     */ 
    Quiz.prototype.examId = function(examId) {
        $examId = examId;
    };
    
    /**
     * Inject into global variable
     */
    window.LumiaJS.Quiz = Quiz;

})(window);