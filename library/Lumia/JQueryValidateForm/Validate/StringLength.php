<?php

class Lumia_JQueryValidateForm_Validate_StringLength extends Lumia_JQueryValidateForm_Validate
{
    protected $_usesValidationMethods = array('stringlength');
    
    /**
     * renders min and max length
     * @return string
     */
    public function render()
    {
		return array('minlength:' . $this->_validator->getMin() . ',maxlength:' . $this->_validator->getMax());
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