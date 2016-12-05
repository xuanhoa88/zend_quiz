<?php

class Admin_ErrorController extends Lumia_Controller_Action
{

    /**
     * Initialize object
     *
     * @return void
     */
    public function init()
    {
        parent::init();
        
        // Set layout
        $this->isAjaxRequest() || ($this->_helper->hasHelper('layout') && $this->_helper->layout()->setLayout('layout/error'));
    }

    /**
     * Error action
     */
    public function errorAction()
    {
    	$errors = $this->_getParam('error_handler');
    	$messages = array();
    	if ($this->isAjaxRequest())
    	{
    		// Auto disable layout
			$this->_helper->hasHelper('layout') && $this->_helper->layout()->disableLayout();
    		$this->_helper->viewRenderer->setNoRender(true);
    		
    		$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
			$messageHandler->setError();
			
    		if (!$errors || !$errors instanceof ArrayObject) 
	        {
	        	$messages = array($this->view->translate('You have reached the error page'));
	        } else 
	        {
		        switch ($errors->type) 
		        {
		            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
		            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
		            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
		                // 404 error -- controller or action not found
		                $this->getResponse()->setHttpResponseCode(404);
		                $priority = Zend_Log::NOTICE;
		                $messages = array($this->view->translate('Page not found'));
		                break;
		            default:
		                // application error
		                $this->getResponse()->setHttpResponseCode(500);
		                $priority = Zend_Log::CRIT;
		                $messages = array($this->view->translate('Application error'));
		                break;
		        }
		        
		        // conditionally display exceptions
		        if ($this->getInvokeArg('displayExceptions') == true) 
		        {
		            $messageHandler->addContext($errors->exception->getTraceAsString(), 'exception');
		        }
	        }
	        
            $messageHandler->setMessages($messages);
            $this->getResponse()->setBody($messageHandler);
    	} else 
    	{
        	$this->view->headTitle()->append('An error occurred');
	    	if (!$errors || !$errors instanceof ArrayObject) 
	        {
	        	$messages = array($this->view->translate('You have reached the error page'));
	            $this->view->message = $this->view->translate('You have reached the error page');
	        } else 
	        {
		        switch ($errors->type) 
		        {
		            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
		            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
		            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
		                // 404 error -- controller or action not found
		                $this->getResponse()->setHttpResponseCode(404);
		                $priority = Zend_Log::NOTICE;
		                $messages = array($this->view->translate('Page not found'));
		                $this->view->message = $this->view->translate('Page not found');
		                break;
		            default:
		                // application error
		                $this->getResponse()->setHttpResponseCode(500);
		                $priority = Zend_Log::CRIT;
		                $messages = array($this->view->translate('Application error'));
		                $this->view->message = $this->view->translate('Application error');
		                break;
		        }
        
		        // conditionally display exceptions
		        if ($this->getInvokeArg('displayExceptions') == true) 
		        {
		            $this->view->exception = $errors->exception;
		        }
		        
		        $this->view->request = $errors->request;
	        }
    	}
    	
    	// Log exception, if logger available
        if (isset($priority) && ($log = $this->getLog())) 
        {
            $log->log(implode(PHP_EOL, $messages), $priority, $errors->exception);
            $log->log('Request Parameters', $priority, $errors->request->getParams());
        }
    }
	
    /**
     * Get log manager
     * 
     * @return false|Zend_Log
     */
    public function getLog()
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) 
        {
            return false;
        }
        
        return $bootstrap->getResource('Log');
    }
}
