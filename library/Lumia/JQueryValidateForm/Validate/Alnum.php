<?php

class Lumia_JQueryValidateForm_Validate_Alnum extends Lumia_JQueryValidateForm_Validate
{
    protected $_usesValidationMethods = array('pattern');
    
    /**
     * renders approriate regex that corresponds to Alnum (requires additional-methods.min.js)
     * @return string
     */
    public function render()
    {
    	if (Zend_Registry::isRegistered('Zend_Locale'))
    	{
    		$this->_locale = Zend_Registry::get('Zend_Locale');
    	} else 
    	{
    		$this->_locale = new Zend_Locale('auto');
    	}
        
        $additionalChars = '';
        if ($this->_locale->getLanguage() == 'de') 
        {
        	$additionalChars = '\xC4\xD6\xDC\xE4\xF6\xFC\xDF'; // see for instance http://www.utf8-chartable.de/
        }
            
        $whitespace = ($this->_validator->allowWhiteSpace ? '\s' : '');
        
        return array('pattern:/^[\d\w' . $whitespace . $additionalChars . ']*$/');
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