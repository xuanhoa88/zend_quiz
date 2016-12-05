<?php
class Lumia_Controller_Plugin_Security_Csrf extends Lumia_Controller_Plugin_Abstract {
	/**
	 * Session storage
	 *
	 * @var Zend_Session_Namespace
	 */
	protected $_session = null;
	
	/**
	 * The name of the form element which contains the key
	 *
	 * @var string
	 */
	protected $_keyName = '__csrf__';
	
	/**
	 * How long until the csrf key expires (in seconds)
	 *
	 * @var int
	 */
	protected $_expiryTime = 300;
	
	/**
	 * The previous request's token, set by _initializeToken
	 *
	 * @var string
	 */
	protected $_previousToken = '';
	
	/**
	 * The current request's token, set by _initializeToken
	 *
	 * @var string
	 */
	protected $_currentToken = '';
	
	/**
	 * Constructor
	 */
	public function __construct(array $params = array()) {
		if (isset ( $params ['expiryTime'] )) {
			$this->_setExpiryTime ( $params ['expiryTime'] );
		}
		
		if (isset ( $params ['keyName'] )) {
			$this->_setKeyName ( $params ['keyName'] );
		}
		
		$this->_session = new Zend_Session_Namespace ( __CLASS__ );
	}
	
	/**
	 * Set the expiry time of the csrf key
	 *
	 * @param int $seconds
	 *        	expiry time in seconds. Set 0 for no expiration
	 * @return Lumia_Controller_Plugin_Security_Csrf implements fluent interface
	 */
	protected function _setExpiryTime($seconds) {
		$this->_expiryTime = ( int ) $seconds;
		
		return $this;
	}
	
	/**
	 * Set the name of the csrf form element
	 *
	 * @param string $name        	
	 * @return Lumia_Controller_Plugin_Security_Csrf implements fluent interface
	 */
	protected function _setKeyName($name) {
		$this->_keyName = ( string ) $name;
		
		return $this;
	}
	
	/**
	 * Performs CSRF protection checks before dispatching occurs
	 *
	 * @param Zend_Controller_Request_Abstract $request        	
	 */
	public function preDispatch(Zend_Controller_Request_Abstract $request) {
		if (! Lumia_Auth::getInstance ()->isLogged ()) {
			return;
		}
		
		$this->_initializeTokens ();
		if ($request->isPost ()) {
			
			$messenger = Zend_Controller_Action_HelperBroker::getStaticHelper ( 'Messenger' );
			if (empty ( $this->_previousToken )) {
				$messenger->messenger ( 'danger' )->clearMessages ();
				$messenger->messenger ( 'danger' )->addMessage ( Lumia_Translator::get ()->translate ( 'Security:@A possible CSRF attack detected - no token received' ) );
			}
			
			if (! $this->_isValidToken ( $request->getPost ( $this->_keyName ) )) {
				$messenger->messenger ( 'danger' )->clearMessages ();
				$messenger->messenger ( 'danger' )->addMessage ( Lumia_Translator::get ()->translate ( 'Security:@A possible CSRF attack detected - token do not match' ) );
			}
			
		}
	}
	
	/**
	 * Adds protection to forms
	 *
	 * @param Zend_Controller_Request_Abstract $request        	
	 */
	public function dispatchLoopShutdown() {
		if (! Lumia_Auth::getInstance ()->isLogged ()) {
			return;
		}
		
		$response = $this->getResponse ();
		$headers = $response->getHeaders ();
		foreach ( $headers as $header ) {
			// Do not proceed if content-type is not html/xhtml or such
			if ($header ['name'] == 'Content-Type' && strpos ( $header ['value'], 'html' ) === false) {
				return;
			}
		}
		
		// Find all forms and add the csrf protection element to them
		$element = sprintf ( '<input type="hidden" name="%s" value="%s" />', $this->_keyName, $this->_currentToken );
		$body = preg_replace ( '/<form[^>]*>/i', '$0' . PHP_EOL . $element, $response->getBody () );
		$response->setBody ( $body );
	}
	
	/**
	 * Check if a token is valid for the previous request
	 *
	 * @param string $value        	
	 * @return bool
	 */
	protected function _isValidToken($value) {
		if ($value === $this->_previousToken) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Initializes a new token
	 *
	 * @return null
	 */
	protected function _initializeTokens() {
		$this->_previousToken = $this->_session->key;
		$newKey = sha1 ( uniqid ( microtime () ) . mt_rand () );
		$this->_session->setExpirationSeconds ( $this->_expiryTime );
		$this->_session->key = $newKey;
		$this->_currentToken = $newKey;
	}
}
