<?php

class Lumia_JQueryValidateForm_Validate_CreditCard extends Lumia_JQueryValidateForm_Validate
{
    protected $_usesValidationMethods = array('creditcard');
    
    /**
     * simply renders creditcard: true
     * @return string
     */
    public function render()
    {
        return array('creditcard:true');
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