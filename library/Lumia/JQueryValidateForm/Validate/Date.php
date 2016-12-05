<?php

class Lumia_JQueryValidateForm_Validate_Date extends Lumia_JQueryValidateForm_Validate
{
    protected $_usesValidationMethods = array('dateISO');
    
    /**
     * Currently uses dateISO to check if a date is valid. Should be extend to support locals.
     * @return string
     */
    public function render()
    {
        return array('dateISO:true');
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