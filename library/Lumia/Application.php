<?php
/**
 * Application
 *
 * @category 	Lumia
 * @package		Lumia_Application
 * @copyright 	xuan.0211@gmail.com
 */

/** Zend_Application */
require_once 'Zend/Application.php';

class Lumia_Application extends Zend_Application
{
	/**
	 * Front Controller.
	 *
	 * @var Zend_Controller_Front
	 */
	protected $_front;
	
	/**
	 * Router
	 *
	 * @var Zend_Controller_Router_Rewrite
	 */
	protected $_router;
	
	/**
	 * Request.
	 *
	 * @var Zend_Controller_Request_Http
	 */
	protected $_request;
	
	/**
	 * Response.
	 *
	 * @var Zend_Controller_Response_Http
	 */
	protected $_response;
	
	/**
	 * Modules dir path.
	 * 
	 * @var string
	 */
	protected $_moduleDir;
	
	/**
	 * Configuration filename
	 * 
	 * @var	string
	 */
	protected $_configFile;
	
	/**
     * Constructor
     *
     * Initialize application. Potentially initializes include_paths, PHP settings, and bootstrap class.
     *
     * @param  	string $environment
     * @param  	string|array|Zend_Config $options String path to configuration file, or array/Zend_Config of configuration options
     * @throws 	Zend_Application_Exception When invalid options are provided
     * @return 	void
     */
    public function __construct($environment, $options = null)
    {
    	// Get configuration filename
    	if (null !== $options) 
    	{
            if (is_string($options)) 
            {
            	$this->_configFile = pathinfo($options, PATHINFO_BASENAME);
            }
        }
        
    	// set front controller
    	require_once 'Zend/Controller/Front.php';
    	$this->_front = Zend_Controller_Front::getInstance();
    	
    	// Test to see if a request was made from the command line
    	defined('IS_CLI_REQUEST') || define('IS_CLI_REQUEST', (PHP_SAPI === 'cli') || defined('STDIN'));
    	
    	// set the environment
    	parent::__construct($environment, $options);
    	
    	// set the modules dir path
    	$this->_moduleDir = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'modules';
    	$resources = $this->getOption('resources');
    	if (!empty($resources['frontController']['moduleDirectory'])) 
    	{
    		$this->_moduleDir = (string) $resources['frontController']['moduleDirectory'];
    	}

    	// add module directory
    	$this->_front->addModuleDirectory($this->_moduleDir);
        
		if (IS_CLI_REQUEST)
		{			
			// initiate request
			require_once 'Zend/Controller/Request/Simple.php';
			$this->_request = new Zend_Controller_Request_Simple();
			
			// initiate response
			require_once 'Zend/Controller/Response/Cli.php';
			$this->_response = new Zend_Controller_Response_Cli();
		
			// initiate router
			require_once 'Lumia/Controller/Router/Cli.php';
			$this->_router = new Lumia_Controller_Router_Cli();
		} else
		{
			// initiate request
			require_once 'Zend/Controller/Request/Http.php';
			$this->_request = new Zend_Controller_Request_Http();
			
			// initiate response
			require_once 'Zend/Controller/Response/Http.php';
			$this->_response = new Zend_Controller_Response_Http();
			
			// initiate router
			require_once 'Zend/Controller/Router/Rewrite.php';
			$this->_router = new Zend_Controller_Router_Rewrite();
		}
		
        // update request with routes
        try 
        {
			// Init routes
        	$this->_router->route($this->_request);
        }  catch (Exception $e) 
        {
        	if ($this->_front->throwExceptions()) 
        	{
        		throw $e;
        	}
        }
        
        // set options
        if (is_array($options = $this->_initModuleConfig())) 
        {
        	$this->setOptions($options);
        }

		// update front controller request
		$this->_front->setRequest($this->_request);
		
		// update front controller response
		$this->_front->setResponse($this->_response);		

		// update front controller router
		$this->_front->setRouter($this->_router);
        
    }

	/**
	 * Create requested module's options from the requested module's module.ini.
	 * Router resource can only be defined in application.ini.
	 * 
	 * @return array
	 */
	private function _initModuleConfig()
	{
		$modConfig = $this->_front->getModuleDirectory($this->_request->getModuleName()) . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . $this->_configFile;
		if (!is_file($modConfig)) 
		{
			return false;
		}
		
		return $this->mergeOptions($this->getOptions(), $this->_loadConfig($modConfig));
	}

    /**
     * Load configuration file of options
     *
     * @param  string $file
     * @throws Zend_Application_Exception When invalid configuration file is provided
     * @return array
     */
    protected function _loadConfig($file)
    {
    	$suffix      = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    	
    	switch ($suffix) {
    		case 'php':
    		case 'inc':
    			require_once 'Lumia/Config/Array.php';
    			$config = new Lumia_Config_Array($file, $this->getEnvironment());
    			break;
    	
    		default:
    			$config = parent::_loadConfig($file);
    			break;
    	}
    	
    	return $config->toArray();
    }
    
}
