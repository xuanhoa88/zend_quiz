<?php

class Lumia_JQueryValidateForm_Validate_Float extends Lumia_JQueryValidateForm_Validate
{
    protected $_usesValidationMethods = array('number');
    
    /**
     * simply renders number true
     * @return string
     */
    public function render()
    {
        return array('number:true');
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