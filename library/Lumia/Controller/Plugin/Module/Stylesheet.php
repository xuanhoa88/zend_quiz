<?php

/*
 * Created on May 15, 2014 To change the template for this generated file go to Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class Lumia_Controller_Plugin_Module_Stylesheet extends Lumia_Controller_Plugin_Module_Asset {
	
	/**
	 * Called after Zend_Controller_Router exits.
	 *
	 * Called after Zend_Controller_Front exits from the router.
	 *
	 * @param Zend_Controller_Request_Abstract $request        	
	 * @return void
	 */
	public function routeShutdown(Zend_Controller_Request_Abstract $request) {
		// Get front controller
		$front = Zend_Controller_Front::getInstance ();
		
		// Get bootstrap
		$bootstrap = $front->getParam ( 'bootstrap' );
		
		// Get view
		$view = $bootstrap->getResource ( 'view' );
		
		// Get module config
		$config = $bootstrap->getResource ( 'config' );
		
		// Get base url
		$baseUrl = $request->getBaseUrl ();
		
		if (empty ( $config->assets )) {
			return;
		}
		
		$assets = $config->assets;
		$stylesheet = array ();
		
		// Get stylesheet common
		if (! empty ( $assets->stylesheet->__construct )) {
			$this->_findAssociative ( $stylesheet, $assets->stylesheet->__construct instanceof Zend_Config ? $assets->stylesheet->__construct->toArray () : array () );
		}
		
		// Get stylesheet config for each module
		$moduleName = $request->getModuleName ();
		$cssModule = empty ( $assets->stylesheet->{$moduleName} ) ? null : $assets->stylesheet->{$moduleName};
		
		// Get css common for module
		$cssCommon = empty ( $cssModule->__construct ) ? null : $cssModule->__construct;
		if (null !== $cssCommon) {
			$this->_findAssociative ( $stylesheet, $cssCommon instanceof Zend_Config ? $cssCommon->toArray () : array () );
		}
		
		// Get stylesheet by each controller
		$controllerName = $request->getControllerName ();
		$cssController = empty ( $cssModule->{$controllerName} ) ? null : $cssModule->{$controllerName};
		$cssCommon = empty ( $cssController->__construct ) ? null : $cssController->__construct;
		if (null !== $cssCommon) {
			$this->_findAssociative ( $stylesheet, $cssCommon instanceof Zend_Config ? $cssCommon->toArray () : array () );
		}
		
		// Get stylesheet by each action
		$actionName = $request->getActionName ();
		$cssCommon = empty ( $cssController->{$actionName} ) ? null : $cssController->{$actionName};
		
		if (null !== $cssCommon) {
			$this->_findAssociative ( $stylesheet, $cssCommon instanceof Zend_Config ? $cssCommon->toArray () : array () );
		}
		
		// Inject into header :)
		foreach ( $stylesheet as $css ) {
			$attrs = null;
			$conditionalStylesheet = null;
			
			if (is_array($css) && isset ( $css ['conditional'] )) {
				$conditionalStylesheet = $css ['conditional'];
				unset ( $css ['conditional'] );
			} elseif (is_array($css) && isset ( $css ['conditionalStylesheet'] )) {
				$conditionalStylesheet = $css ['conditionalStylesheet'];
				unset ( $css ['conditionalStylesheet'] );
			}
			
			if (is_array($css) && isset ( $css ['href'] )) {
				$href = $css ['href'];
				unset ( $css ['href'] );
				
				$attrs = $css;
			} elseif (is_string ( $css ) && !preg_match('/' . PHP_EOL . '/m', $css )) {
				$href = $css;
			}
			
			if (isset ( $href )) {
				// Determine whether css is external link
				$host = parse_url ( $href, PHP_URL_HOST );
				if (empty ( $host )) {
					$href = str_replace ( DIRECTORY_SEPARATOR, '/', $href );
					$href = $baseUrl . '/' . ltrim ( $href, '/' );
				}
				
				$view->headLink ()->appendStylesheet ( $href, null, $conditionalStylesheet, $attrs );
			} else {
				$view->headStyle ()->appendStyle ( $css, null, $conditionalStylesheet );
			}
		}
	}
}
