<?php

class Lumia_Controller_Plugin_Module_Translate extends Lumia_Controller_Plugin_Abstract
{

    /**
     * Called after Zend_Controller_Router exits.
     *
     * Called after Zend_Controller_Front exits from the router.
     *
     * @param  Zend_Controller_Request_Abstract $request
     * @return void
     */
    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
        // Get language directory
        $languageDirectory = Zend_Controller_Front::getInstance()->getModuleDirectory() . '/languages';
        
        // Check dir exists?
        if (!is_dir($languageDirectory))
        {
            return false;
        }
        
        // Check translate is init?
        if (!Lumia_Translator::alreadyExists())
        {
            return false;
        }
        
        // Register translate for each module
        Lumia_Translator::get()->addTranslation(array('content' => $languageDirectory));
    }

}
