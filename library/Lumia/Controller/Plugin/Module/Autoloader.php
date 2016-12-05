<?php

/*
 * Created on May 15, 2014
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class Lumia_Controller_Plugin_Module_Autoloader extends Zend_Controller_Plugin_Abstract 
{
	/**
	 * Called after Zend_Controller_Router exits.
	 * Called after Zend_Controller_Front exits from the router.
	 *
	 * @param  Zend_Controller_Request_Abstract $request
	 * @return void
	 */
	public function routeShutdown(Zend_Controller_Request_Abstract $request) 
	{
        // Init common resources
        $autoloaderCommon = new Zend_Loader_Autoloader_Resource(array(
            'namespace' => '',
            'basePath' => APPLICATION_PATH . '/libraries',
        ));
        
        $autoloaderCommon->addResourceTypes(array(
            'libraries' => array(
                'path' => '',
                'namespace' => 'Application'
            ),
            'dbtables' => array(
                'namespace' => 'Application_Model_DbTable',
                'path'      => 'Models/DbTable',
            ),
            'mappers' => array(
                'namespace' => 'Application_Model_Mapper',
                'path'      => 'Models/Mappers',
            ),
            'forms'    => array(
                'namespace' => 'Application_Form',
                'path'      => 'Forms',
            ),
            'models'   => array(
                'namespace' => 'Application_Model',
                'path'      => 'Models',
            ),
            'plugins'  => array(
                'namespace' => 'Application_Plugin',
                'path'      => 'Plugins',
            ),
            'services' => array(
                'namespace' => 'Application_Service',
                'path'      => 'Services',
            ),
            'viewhelpers' => array(
                'namespace' => 'Application_View_Helper',
                'path'      => 'Views/helpers',
            ),
            'viewfilters' => array(
                'namespace' => 'Application_View_Filter',
                'path'      => 'Views/filters',
            ),
        ));
                
        // Init specific module resources        
        $autoloaderModule = new Zend_Application_Module_Autoloader(array(
            'namespace' => '', 
            'basePath' => Zend_Controller_Front::getInstance()->getModuleDirectory() . '/libraries',
        ));
        
        $moduleNS = ucfirst($request->getModuleName());
        $autoloaderModule->addResourceTypes(array(
            'libraries' => array(
                'path' => '',
                'namespace' => $moduleNS
            ),
            'dbtables' => array(
                'namespace' => $moduleNS . '_Model_DbTable',
                'path'      => 'Models/DbTable',
            ),
            'mappers' => array(
                'namespace' => $moduleNS . '_Model_Mapper',
                'path'      => 'Models/Mappers',
            ),
            'forms'    => array(
                'namespace' => $moduleNS . '_Form',
                'path'      => 'Forms',
            ),
            'models'   => array(
                'namespace' => $moduleNS . '_Model',
                'path'      => 'Models',
            ),
            'plugins'  => array(
                'namespace' => $moduleNS . '_Plugin',
                'path'      => 'Plugins',
            ),
            'services' => array(
                'namespace' => $moduleNS . '_Service',
                'path'      => 'Services',
            ),
            'viewhelpers' => array(
                'namespace' => $moduleNS . '_View_Helper',
                'path'      => 'Views/helpers',
            ),
            'viewfilters' => array(
                'namespace' => $moduleNS . '_View_Filter',
                'path'      => 'Views/filters',
            ),
        ));
	}
}