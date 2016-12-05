<?php

class Api_Bootstrap extends Lumia_Application_Module
{
	/**
	 * Init the generic router
	 *
	 * @return void
	 */
	public function _initREST()
	{
		$this->bootstrap('FrontController');
		$front = $this->getResource('FrontController');
	  
		// Set custom request object
		$front->setRequest(new Lumia_Controller_Request_REST());
		$front->setResponse(new Lumia_Controller_Response_REST());
	  
		// Add the REST route for the API module only
		$restRoute = new Zend_Rest_Route($front, array(), array('api'));
		$front->getRouter()->addRoute('rest', $restRoute);
	}
	
	/**
	 * Init the generic core
	 *
	 * @return void
	 */
	public function _initCore()
	{
		$this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
	
		// Register the RestHandler plugin
		$front->registerPlugin(new Lumia_Controller_Plugin_RestHandler($front));
	
		// Add REST contextSwitch helper
		Zend_Controller_Action_HelperBroker::addHelper(new Lumia_Controller_Action_Helper_ContextSwitch());
	
		// Add restContexts helper
		Zend_Controller_Action_HelperBroker::addHelper(new Lumia_Controller_Action_Helper_RESTContext());
	}
}
