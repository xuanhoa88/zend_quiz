<?php

class Bootstrap extends Lumia_Application_Bootstrap
{

    /**
     * Init the generic autoloader
     *
     * @return void
     */
    protected function _initAutoloader()
    {
        Lumia_Loader_Autoloader::getInstance()->setFallbackAutoloader(true);
        
        // Get controller front
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        
        // Get module namespace
        $moduleNS = ucfirst($front->getRequest()->getModuleName());
        
        // Init common resources
        $autoloaderCommon = new Lumia_Loader_Autoloader_Resource(array(
            'namespace' => '',
            'basePath' => APPLICATION_PATH,
        ));
        
        $autoloaderCommon->clearResourceTypes();
        $autoloaderCommon->addResourceType('libraries', 'libraries', 'Application');
      
        // Init specific module resources
        $autoloaderModule = new Lumia_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath' => $front->getModuleDirectory(),
        ));
        
        $autoloaderModule->clearResourceTypes();
        $autoloaderModule->addResourceType('libraries', 'libraries', $moduleNS);
        
        // Set upload dir path
        defined('LUMIA_UPLOAD_DIR') || define('LUMIA_UPLOAD_DIR', BASE_PATH . DIRECTORY_SEPARATOR . 'uploads');
    }

    /**
     * Init the generic config
     *
     * @return void
     */
    protected function _initConfig()
    {
        $config = new Zend_Config($this->getOptions(), TRUE);

        // Inject into registry
        Zend_Registry::set('Zend_Config', $config);
        
        return $config;
    }
    
    /**
     * Init the generic db adapter
     *
     * @return void
     */
    public function _initDbAdapter()
    {
    	$this->bootstrap('Db');
        $dbApdater = $this->getResource('Db');
        $dbApdater->setFetchMode(Zend_Db::FETCH_OBJ);
    }
    
    /**
     * Init the generic session
     * 
     * @return void
     */
    protected function _initCoreSession()
    {
    	$this->bootstrap('db');
    	$this->bootstrap('session');
    	
   		// Restore session
        if (isset($_POST['LUMIASID'], $_SERVER['REQUEST_METHOD'], $_SERVER['HTTP_USER_AGENT']) && (!defined('IS_CLI_REQUEST') || !IS_CLI_REQUEST) && strstr(strtolower($_SERVER['HTTP_USER_AGENT']), ' flash') && (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST')) 
	    {
			Zend_Session::setId($_POST['LUMIASID']);
		}

    	Zend_Session::start();
//    		Zend_Session::regenerateId();
    }

    /**
     * Init the generic locale
     *
     * @return void
     */
    protected function _initLocale()
    {
    	defined('LUMIA_CFG_LOCALE') || define('LUMIA_CFG_LOCALE', 'vi_VN');
        Zend_Registry::set('Zend_Locale', new Zend_Locale(LUMIA_CFG_LOCALE));
    }

    /**
     * Init the generic translate
     *
     * @return void
     */
    protected function _initTranslate()
    {
        $this->bootstrap('Locale');
    	
    	$translate = new Zend_Translate(array(
    		'adapter' => 'array',
    		'content' => APPLICATION_PATH . '/languages',
    		'locale' => Zend_Registry::get('Zend_Locale')->toString(),
            'scan' => Zend_Translate::LOCALE_FILENAME,
            'disableNotices' => true,
            'logUntranslated' => false
        ));
    	
        Zend_Registry::set('Zend_Translate', $translate);
        Lumia_Translator::set($translate);
    }

    /**
     * Init the generic view
     *
     * @return void
     */
    protected function _initViewHelpers()
    {
        $this->bootstrap('view');
        
	    // Get bootstrapped view
	    $view = $this->getResource('view');
        
        // Add doctype
        $view->doctype('XHTML1_STRICT');
        
        // Add title
        $view->headTitle('Quiz')->setSeparator(' - ');
        
        // Add helper
        $view->addHelperPath('Lumia/View/Helper', 'Lumia_View_Helper');
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Application_View_Helper');

        // Add filter
        $view->addFilterPath('Lumia/View/Filter', 'Lumia_View_Filter');
        $view->addHelperPath(APPLICATION_PATH . '/views/filters', 'Application_View_Filter');
    }

    /**
     * Init the generic controller
     *
     * @return void
     */
    protected function _initController()
    {
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        
        // Init controller action helper
        Zend_Controller_Action_HelperBroker::addPath('Lumia/Controller/Action/Helper', 'Lumia_Controller_Action_Helper');
        
        // Init error handler
        $front->registerPlugin(new Lumia_Controller_Plugin_ErrorHandler());
        
        // Init Csrf Protection
        // $front->registerPlugin(new Lumia_Controller_Plugin_Security_Csrf());
        
        // Init Translate
        $front->registerPlugin(new Lumia_Controller_Plugin_Module_Translate());
        
        // Init View
        $front->registerPlugin(new Lumia_Controller_Plugin_Module_View());
        
        // Init StyleSheet
        $front->registerPlugin(new Lumia_Controller_Plugin_Module_Stylesheet());
        
        // Init Javascript
        $front->registerPlugin(new Lumia_Controller_Plugin_Module_Javascript());
    }
}
