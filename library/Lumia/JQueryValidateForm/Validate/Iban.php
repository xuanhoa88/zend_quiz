<?php

class Lumia_JQueryValidateForm_Validate_Iban extends Lumia_JQueryValidateForm_Validate
{
    protected $_usesValidationMethods = array('iban');
    
    /**
     * simply renders iban true (requires additional-methods.min.js)
     * @return string
     */
    public function render()
    {
        return array('iban:true');
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