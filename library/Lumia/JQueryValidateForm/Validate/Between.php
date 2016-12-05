<?php

class Lumia_JQueryValidateForm_Validate_Between extends Lumia_JQueryValidateForm_Validate
{
    protected $_usesValidationMethods = array('range');
    
    /**
     * renders min and max length
     * @return string
     */
    public function render()
    {
        return array('range:[' . $this->_validator->getMin() . ',' . $this->_validator->getMax() . ']');
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