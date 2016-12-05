<?php

class Lumia_JQueryValidateForm_Validate_Identical extends Lumia_JQueryValidateForm_Validate
{
    protected $_usesValidationMethods = array('equalTo', 'pattern');
    
    /**
     * renders approriate regex that corresponds to Identical (requires additional-methods.min.js)
     * @return string
     */
    public function render()
    {
        $token = $this->_validator->getToken();
        
        // check if token is a form element or a constant
        $isElem = null;
        foreach ($this->_form->getElements() as $elem) 
        {
            if ($elem->getName() == $token) 
            {
                $isElem = $elem;
                break;
            }
        }
        
        if ($isElem != null) 
        {
            $id = (string) $isElem->getName();
            if (trim($id) === '') 
            {
                throw new Lumia_JQueryValidateForm_Exception('Lumia_JQueryValidateForm_Validate_Identical requires an ID to be set for the attribute referenced.');
            }
            
            return array('equalTo:"[name=' . addslashes($id) . ']"');
        }
        
        return array('pattern:"' . $token . '"');
    }
    
    /**
     * (non-PHPdoc)
     * @see Lumia_JQueryValidateForm_Validate::getRulesUsed()
     */
    public function getRulesUsed()
    {
        $result = $this->render();
        if (is_string($result))
        {
        	return array(substr($result, 0, strpos($result, ':')));
        }
        
        return array();
    }
}