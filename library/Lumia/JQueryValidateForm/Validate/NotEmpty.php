<?php

class Lumia_JQueryValidateForm_Validate_NotEmpty extends Lumia_JQueryValidateForm_Validate
{
    protected $_usesValidationMethods = array('required');
    
    /**
     * Error messages
     * 
     * @var array
     */
    protected $_messages = array(
        'required' => "Validate:@Value is required and can't be empty"
    );
    
    /**
     * "Translates" the php regex to a pattern (requires additional-methods.min.js)
     * @todo currently, transformation is done by copy&paste, i.e. there is no real translation between a PHP and a JS regex. Has to be improved in order to support for instance lookbehind assertions or recursion.
     * @return string
     */
    public function render()
    {
		return array('required:true');
    }
    
    /**
     * (non-PHPdoc)
     * @see Lumia_JQueryValidateForm_Validate::getRulesUsed()
     */
    public function getRulesUsed()
    {
        return $this->_usesValidationMethods;
    }
}