<?php

class Lumia_Application_Resource_Modules extends Zend_Application_Resource_Modules
{
	/**
	 * Initialize modules
	 *
	 * @return array
	 * @throws Zend_Application_Resource_Exception When bootstrap class was not found
	 */
	public function init()
	{
		$bootstrap = $this->getBootstrap();
		$bootstrap->bootstrap('FrontController');
		
		// Get front controller
		$front = $bootstrap->getResource('FrontController');
		
		// Get current module name
		$curModule = $front->getRequest()->getModuleName();
		
		// Get current module directory
		$moduleDirectory = $front->getModuleDirectory($curModule);
		
		// Get default module name
		$default = $front->getDefaultModule();
		
		// Get current bootstrap class
		$curBootstrapClass = get_class($bootstrap);
		
		// Current module bootstrap
		$bootstrapClass = $this->_formatModuleName($curModule) . '_Bootstrap';
		if (!class_exists($bootstrapClass, false)) 
		{
			$bootstrapPath  = $moduleDirectory . DIRECTORY_SEPARATOR . 'Bootstrap.php';
			if (file_exists($bootstrapPath)) 
			{
				$eMsgTpl = 'Bootstrap file found for module "%s" but bootstrap class "%s" not found';
				include_once $bootstrapPath;
				if (($default != $curModule) && !class_exists($bootstrapClass, false)) 
				{
					throw new Zend_Application_Resource_Exception(sprintf($eMsgTpl, $curModule, $bootstrapClass));
				} elseif ($default == $curModule) 
				{
					if (!class_exists($bootstrapClass, false)) 
					{
						$bootstrapClass = 'Bootstrap';
						if (!class_exists($bootstrapClass, false)) 
						{
							throw new Zend_Application_Resource_Exception(sprintf($eMsgTpl, $curModule, $bootstrapClass));
						}
					}
				}
			}
		}

		if (!class_exists($bootstrapClass, false) || $bootstrapClass == $curBootstrapClass) 
		{
			return;
		}

		$moduleBootstrap = new $bootstrapClass($bootstrap);
		$moduleBootstrap->bootstrap();
		$this->_bootstraps[$curModule] = $moduleBootstrap;

		return $this->_bootstraps;
	}
}
