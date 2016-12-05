<?php
/**
 * RESTful ErrorController
 *
 **/
class Api_ErrorController extends Lumia_Controller_REST
{
    public function errorAction()
    {
        if ($this->_request->hasError()) 
        {
            $error = $this->_request->getError();
            $this->view->message = $error->message;
            $this->getResponse()->setHttpResponseCode($error->code);
            return;
        }

        $errors = $this->_getParam('error_handler');
        if (!$errors || !$errors instanceof ArrayObject) 
        {
            $this->view->message = $this->view->translate('You have reached the error page');
            return;
        }

        switch ($errors->type) 
        {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $this->view->message = 'Page not found';
                $this->getResponse()->setHttpResponseCode(404);
                break;

            default:
                // application error
            	$httpCode = 500;
            	$message = 'Application error';
            	if (($exception = $this->getResponse()->getException()) && ($exception[0] instanceof Lumia_Exception_REST)) {
            		$message = $exception[0]->getMessage();
            		$httpCode = $exception[0]->getHttpCode();
            	}
            	
                $this->view->message = $message;
                $this->getResponse()->setHttpResponseCode($httpCode);
                break;
        }

        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) 
        {
            $this->view->exception = $errors->exception->getMessage();
        }
    }

    /**
     * Catch-All
     * useful for custom HTTP Methods
     *
     **/
    public function __callAction()
    {
    }

    /**
     * Index Action
     *
     * @return void
     */
    public function indexAction()
    {
    }

    /**
     * GET Action
     *
     * @return void
     */
    public function getAction()
    {
    }

    /**
     * POST Action
     *
     * @return void
     */
    public function postAction()
    {
    }

    /**
     * PUT Action
     *
     * @return void
     */
    public function putAction()
    {
    }

    /**
     * DELETE Action
     *
     * @return void
     */
    public function deleteAction()
    {
    }
}