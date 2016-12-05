<?php

class Lumia_JQueryValidateForm_Validate_Hex extends Lumia_JQueryValidateForm_Validate
{
    protected $_usesValidationMethods = array('pattern');
    
    /**
     * Uses a pattern to check if value is a valid hex value
     * @return string
     */
    public function render()
    {
        return array('pattern:"[A-Fa-f0-9]*"');
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