<?php

class Lumia_JQueryValidateForm_Validate_Hostname extends Lumia_JQueryValidateForm_Validate
{
    protected $_usesValidationMethods = array('url');
    
    /**
     * currently this simply renders "url:true", thus not taking into account the different options Zend_Validate_Hostname supports. 
     * @todo has to be improved
     * @return string
     */
    public function render()
    {
        return array('url:true');
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