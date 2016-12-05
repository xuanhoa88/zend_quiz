<?php

/**
 * @category   Lumia
 * @package    Lumia_Controller
 * @author    xuan.0211@gmail.com
 */

/** Zend_Application */
require_once 'Zend/Controller/Router/Abstract.php';

class Lumia_Controller_Router_Cli extends Zend_Controller_Router_Abstract
{
	/**
	 * Find a matching route to the current PATH_INFO and inject
	 * returning values to the Request object.
	 *
	 * @throws Zend_Controller_Router_Exception
	 * @return Zend_Controller_Request_Abstract Request object
	 */
	public function route(Zend_Controller_Request_Abstract $request)
	{
		$getopt = new Zend_Console_Getopt(array());
		$arguments = $getopt->getRemainingArgs();
		
		// Set default routes
		$routes = array(
			'controller' => 'index',
			'action' => 'index'
		);
		
		if ($arguments)
		{
			foreach ($arguments as $parameter) 
			{
				$parse = explode('=', $parameter);
				$routes[$parse[0]] = $parse[1];
			}
		}
		
		$patternValidAction = '~^\w+[\-\w\d]+$~';
		
		// Validate module
		if (isset($routes['module']))
		{
			$module = $routes['module'];
			if (false == preg_match($patternValidAction, $module))
			{
				throw new Lumia_Controller_Router_Exception("Invalid module {$module}");
			}
			$request->setModuleName($module);
			unset($routes['module']);
		}
		
		// Validate controller
		$controller = $routes['controller'];
		if (false == preg_match($patternValidAction, $controller))
		{
			throw new Lumia_Controller_Router_Exception("Invalid controller {$controller}");
		}
		$request->setControllerName($controller);
		unset($routes['controller']);
		
		// Validate action
		$action = $routes['action'];
		if (false == preg_match($patternValidAction, $action))
		{
			throw new Lumia_Controller_Router_Exception("Invalid action {$action}");
		}
		$request->setActionName($action);
		unset($routes['action']);
		
		if ($routes)
		{
			foreach ($routes as $index => $parameter)
			{
				$segments = explode ('=', $parameter, 2);
				if (!isset($segments[1]))
				{
					continue;
				}
		
				$request->setParam($parameter[0], $parameter[1]);
			}
		}
		

		return $request;
	}
	
	/**
	 * Assembles user submitted parameters forming a URL path defined by this route
	 *
	 * @param  array $data An array of variable and value pairs used as parameters
	 * @param  boolean $reset Whether or not to set route defaults with those provided in $data
	 * @throws Zend_Controller_Router_Exception
	 * @return string Route path with user submitted parameters
	 */
	public function assemble($userParams, $name = null, $reset = false, $encode = true)
	{
		throw new Lumia_Controller_Router_Exception('Assemble isnt implemented');
	}
}