<?php

class Lumia_Controller_Plugin_ErrorHandler extends Zend_Controller_Plugin_Abstract
{
    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
        $front = Zend_Controller_Front::getInstance();
        
        // If the ErrorHandler plugin is not registered, bail out
        if (!(($error = $front->getPlugin('Zend_Controller_Plugin_ErrorHandler')) instanceof Zend_Controller_Plugin_ErrorHandler))
        {
            return;
        }


        $request = clone $request;
        $request->setModuleName($request->getModuleName());
        $request->setControllerName($error->getErrorHandlerController());
        $request->setActionName($error->getErrorHandlerAction());

        // Does the controller even exist?
        if ($front->getDispatcher()->isDispatchable($request))
        {
            $error->setErrorHandlerModule($request->getModuleName());
        }
    }
}
