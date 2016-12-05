<?php

abstract class Lumia_JQueryValidateForm_Validate
{
    /**
     * Instance of a Zend_Validate_Abstract class
     * 
     * @var Zend_Validate_Abstract
     */
    protected $_validator;
    
    /**
     * Instance of a Zend_Form class
     * 
     * @var Zend_Form
     */
    protected $_form;
	
	/**
	 * @var Zend_Form_Element
	 */
	protected $_element;
    
    /**
     * Error messages
     * 
     * @var array
     */
    protected $_messages = array();
    
    /**
     * Constructor
     * 
     * @param Zend_Validate_Abstract $validator
     * @param Zend_Form $form the form the $validator belongs to
     */
    public function __construct(Zend_Validate_Abstract $validator, Zend_Form $form, Zend_Form_Element $element)
    {
        $this->_validator = $validator;
        $this->_form      = $form;
        $this->_element = $element;
    }
    
    /**
     * if this validator results in a set of pattern rules, this method return the RegEx pattern used by the last pattern. Otherwise null will be returned.
     * @return string / null 
     */
    public function getPatternUsed()
    {
        $rules = $this->getRulesUsed();
        if (count($rules) == 1 && $rules[0] == 'pattern') 
        {
            $rule = $this->render();
            return trim(substr($rule, strpos($rule, ':') + 1), ', ');
        }
        
        return null;
    }
    
    /**
     * Return messages corresponding with validator
     * 
     * @return	string
     */
    public function getMessages()
    {
    	return $this->_messages;
    }
    
    /**
     * To be implemented by all classes extending Lumia_JQueryValidateForm_Validate.
     * Render the js code used by jQueryValidation plugin
     */
    public abstract function render();
    
    /**
     * To be implemented by all classes extending Lumia_JQueryValidateForm_Validate
     * return rules actually used by jQueryValidation plugin
     */
    public abstract function getRulesUsed();
}