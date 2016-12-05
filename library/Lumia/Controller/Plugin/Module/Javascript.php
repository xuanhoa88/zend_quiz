<?php
class Lumia_Controller_Plugin_Module_Javascript extends Lumia_Controller_Plugin_Module_Asset {
	
	/**
	 * Called after Zend_Controller_Router exits.
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
		defined ( 'LUMIA_BASE_URL' ) || define ( 'LUMIA_BASE_URL', addcslashes ( $request->getScheme () . '://' . $request->getHttpHost () . $request->getBaseUrl (), "\000\n\r\\'\"\032" ) );
		
		// Get name
		$moduleName = $request->getModuleName ();
		$actionName = $request->getActionName ();
		$controllerName = $request->getControllerName ();
		
		// Add javascript
		$view->headScript ()->appendScript ( "window.location.base = '" . LUMIA_BASE_URL . "';" );
		$view->headScript ()->appendFile ( LUMIA_BASE_URL . '/static/lumia/namespace.js' );
		$view->headScript ()->appendScript ( "'LumiaJS." . addcslashes ( $moduleName . '.' . $controllerName . '.' . $actionName, "\000\n\r\\'\"\032" ) . "'.namespace('.', window);" );
		$view->headScript ()->appendScript ( "LumiaJS.dateTime = { 
        		format: '" . addcslashes ( defined ( 'JS_DATETIME_FORMAT' ) ? ( string ) JS_DATETIME_FORMAT : 'dd/mm/yyyy hh:ii', "\000\n\r\\'\"\032" ) . "', 
        		locale: '" . addcslashes ( defined ( 'JS_LOCALE' ) ? ( string ) JS_LOCALE : Zend_Registry::get ( 'Zend_Locale' )->toString (), "\000\n\r\\'\"\032" ) . "' 
    	}" );
		$view->headScript ()->appendFile ( LUMIA_BASE_URL . '/static/lumia/i18n.js' );
		
		if (Lumia_Translator::alreadyExists ()) {
			$translate = Lumia_Translator::get ();
			if ($locales = $translate->getList ()) {
				$phrases = array (
						'DataTable:@Are you sure you want to perform this action ?',
						'DataTable:@Error',
						'DataTable:@An error occurred in process generate a list of records in current page',
						'DataTable:@You must select at least one record',
						'DataTable:@Requested parameters does not exist',
						'DataTable:@Notice',
						'DataTable:@Please wait a moment',
						'Form:@Button printing',
						'Form:@Button continue',
						'Form:@Button cancel',
						'Form:@Button confirm',
						'Form:@Button yes',
						'Form:@Button no',
						'Form:@Button save',
						'Form:@Button reset',
						'Form:@Button close',
						'Form:@Bulk import',
						'Dialog:@Error',
						'Dialog:@Warning',
						'Dialog:@Alert',
						'Dialog:@Success',
						'Dialog:@Confirm' 
				);
				foreach ( $locales as $langKey ) {
					$translationTable = array ();
					foreach ( $phrases as $phrase ) {
						$translationTable [$phrase] = $translate->_ ( $phrase );
					}
					
					$view->headScript ()->appendScript ( "LumiaJS.i18n.translations('" . addslashes ( $langKey ) . "', " . Zend_Json::encode ( $translationTable ) . ");" );
				}
			}
			
			$view->headScript ()->appendScript ( "LumiaJS.i18n.use('" . addslashes ( $translate->getLocale () ) . "');" );
		}
		
		if (empty ( $config->assets )) {
			return;
		}
		
		$assets = $config->assets;
		$javascript = array ();
		
		// Get javascript common
		if (! empty ( $assets->javascript->__construct )) {
			$this->_findAssociative ( $javascript, $assets->javascript->__construct instanceof Zend_Config ? $assets->javascript->__construct->toArray () : array () );
		}
		
		// Get javascript config for each module
		$jsModule = empty ( $assets->javascript->{$moduleName} ) ? null : $assets->javascript->{$moduleName};
		
		// Get javascript common for module
		$jsCommon = empty ( $jsModule->__construct ) ? null : $jsModule->__construct;
		if (null !== $jsCommon) {
			$this->_findAssociative ( $javascript, $jsCommon instanceof Zend_Config ? $jsCommon->toArray () : array () );
		}
		
		// Get javascript by each controller
		$jsController = empty ( $jsModule->{$controllerName} ) ? null : $jsModule->{$controllerName};
		$jsCommon = empty ( $jsController->__construct ) ? null : $jsController->__construct;
		if (null !== $jsCommon) {
			$this->_findAssociative ( $javascript, $jsCommon instanceof Zend_Config ? $jsCommon->toArray () : array () );
		}
		
		// Get javascript by each action
		$jsCommon = empty ( $jsController->{$actionName} ) ? null : $jsController->{$actionName};
		$this->_findAssociative ( $javascript, $jsCommon instanceof Zend_Config ? $jsCommon->toArray () : array () );
		
		// Inject into header :)
		foreach ( $javascript as $js ) {
			$attrs = null;
			if (is_array($js) && isset ( $js ['src'] )) {
				$src = $js ['src'];
				unset ( $js ['src'] );
				
				$attrs = $js;
			} elseif (is_string ( $js ) && ! preg_match ( '/' . PHP_EOL . '/m', $js )) {
				$src = $js;
			}
			
			if (isset ( $src )) {
				// Determine whether javascript is external link
				$host = parse_url ( $src, PHP_URL_HOST );
				if (empty ( $host )) {
					$src = str_replace ( DIRECTORY_SEPARATOR, '/', $src );
					$src = LUMIA_BASE_URL . '/' . ltrim ( $src, '/' );
				}
				
				$view->headScript ()->appendFile ( $src, null, $attrs );
			} else {
				$view->headScript ()->appendScript ( $js, null, $attrs );
			}
		}
	}
}
