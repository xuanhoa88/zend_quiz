<?php

class Lumia_JQueryValidateForm_Validate_EmailAddress extends Lumia_JQueryValidateForm_Validate
{
    protected $_usesValidationMethods = array('email');
    
    /**
     * Error messages
     * 
     * @var array
     */
    protected $_messages = array(
        'email' => "Validate:@This e-mail address is not valid"
    );
    
    /**
     * simply renders email true
     * @return string
     */
    public function render()
    {
        return array('email:true');
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