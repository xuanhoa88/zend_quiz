<?php

class Lumia_JQueryValidateForm_Validate_Digits extends Lumia_JQueryValidateForm_Validate
{
    protected $_usesValidationMethods = array('digits');
    
    /**
     * simply renders digits true
     * @return string
     */
    public function render()
    {
        return array('digits:true');
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