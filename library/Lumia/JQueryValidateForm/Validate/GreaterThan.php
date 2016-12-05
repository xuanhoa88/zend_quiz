<?php

class Lumia_JQueryValidateForm_Validate_GreaterThan extends Lumia_JQueryValidateForm_Validate
{
    protected $_usesValidationMethods = array('min');
    
    /**
     * uses min: to render a corresponding jquery.validate test
     * @return string
     */
    public function render()
    {
        return array('min:' . ($this->_validator->getMin() + 1));
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