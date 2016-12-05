<?php

class Lumia_JQueryValidateForm_Validate_Dependency extends Lumia_JQueryValidateForm_Validate
{
    protected $_usesValidationMethods = array('require');
    
    /**
     * Error messages
     *
     * @var array
     */
    protected $_messages = array(
    		'required' => "Validate:@Value is required and can't be empty"
    );
    
    /**
     * simply renders number true
     * @return string
     */
    public function render()
    {
    	$elementName = $this->_form->getElement($this->_validator->getContextKey());
    	$elementClass = explode('_', get_class($elementName));
    	$elementType = array_pop($elementClass);
    	$condition = (in_array(strtolower($elementType), array('radio', 'checkbox')) ? ':checked' : '');
    	
    	$rule = $this->_validator->getJsRule() ? $this->_validator->getJsRule() : "'[name=" . addslashes($elementName->getName()) . "]" . $condition . "'";
        return array("required:" . $rule);
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