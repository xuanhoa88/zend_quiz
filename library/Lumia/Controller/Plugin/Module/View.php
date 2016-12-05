<?php

class Lumia_Controller_Plugin_Module_View extends Lumia_Controller_Plugin_Abstract 
{
	/**
	 * Called after Zend_Controller_Router exits.
	 *
	 * Called after Zend_Controller_Front exits from the router.
	 *
	 * @param  Zend_Controller_Request_Abstract $request
	 * @return void
	 */
	public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request) 
	{
		// Set response header content type
		$this->getResponse()->setHeader('Content-Type', 'text/html; charset=utf-8');
		
		// Get front controller
		$front = Zend_Controller_Front::getInstance();
		
		// Get dispatcher
		$dispatcher = $front->getDispatcher();
		
		// Get view
		$view = $front->getParam('bootstrap')->getResource('view');
		
		// Get module name
		$module = $request->getModuleName();
		
        // Get module directory
        $moduleDir = $front->getModuleDirectory($module);
        
        // Add helper
        $view->addHelperPath($moduleDir . '/views/helpers/', $dispatcher->formatModuleName($module) . '_View_Helper');
        
        // Add view paths
        $view->addScriptPath($moduleDir . '/views/partials');
        $view->addScriptPath($moduleDir . '/views/scripts');
        $view->addScriptPath($moduleDir . '/views/scripts/' . $request->getControllerName());
        
        // Set default layout
        Zend_Layout::startMvc()->setLayout('/layout/default');
	}
}