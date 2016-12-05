<?php

/**
 * Lumia_View_Helper_JsTranslate
 *
 * @category   Lumia
 * @package    Lumia_View_Helper
 */
class Lumia_View_Helper_JsTranslate extends Zend_View_Helper_Abstract
{
	/**
	 * Inject translate into javascript object
	 * 
	 * @param 	mixed $phrases
	 * @param 	string $langKey
	 * @return	void
	 */
    public function jsTranslate($phrases, $langKey = null)
    {
    	if (!Lumia_Translator::alreadyExists())
    	{
    		return;
    	}
    	
        $translate = Lumia_Translator::get();
    	$langKey = (string) $langKey;
    	$phrases = !is_array($phrases) ? (array) $phrases : $phrases;
        
    	// Set language default if empty
    	if ($langKey === '')
    	{
    		$langKey = $translate->getLocale();
    	}
    	
    	$translationTable = array();
   		foreach ($phrases as $phrase)
        {
        	$translationTable[$phrase] = $translate->_($phrase);
        }
    	
        $this->view->headScript()->appendScript("LumiaJS.i18n.translations('" . $this->view->escape($langKey) . "', " . Zend_Json::encode($translationTable) . ");");
    }
}
