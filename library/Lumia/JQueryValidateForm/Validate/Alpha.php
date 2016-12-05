<?php

class Lumia_JQueryValidateForm_Validate_Alpha extends Lumia_JQueryValidateForm_Validate
{
    protected $_usesValidationMethods = array('pattern');
    
    /**
     * renders approriate regex that corresponds to Alpha (requires additional-methods.min.js)
     * @return string
     */
    public function render()
    {
        if ($this->_validator->allowWhiteSpace)
        {
        	return array('pattern:"[\\\\w\\\\s]*"');
        }
        
        return array('pattern:"\\\\w*"');
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