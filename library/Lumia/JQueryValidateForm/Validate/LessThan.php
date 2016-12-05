<?php

class Lumia_JQueryValidateForm_Validate_LessThan extends Lumia_JQueryValidateForm_Validate
{
    protected $_usesValidationMethods = array('max');
    
    /**
     * uses max: to render a corresponding jquery.validate test
     * @return string
     */
    public function render()
    {
		return array('max:' . ($this->_validator->getMax() - 1));
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