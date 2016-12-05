<?php
class Admin_SessionController extends Lumia_Controller_Action {
	
	/**
	 * Index action
	 */
	public function indexAction() {
		// If logged, auto redirect to homepage
		if ($this->view->userSession ()->isLogged ()) {
			$this->_redirect ( '/admin/session/login' );
		}
		
		// Forward to logout action
		$this->_forward ( 'logout', 'session', 'admin' );
	}
	
	/**
	 * Logout action
	 */
	public function logoutAction() {
		// Layout disabled
		$this->_helper->hasHelper ( 'layout' ) && $this->_helper->layout ()->disableLayout ();
		
		// Set the view script does not rendering
		$this->_helper->viewRenderer->setNoRender ( true );
		
		// Remove authentication
		Admin_Auth::getInstance ()->clearIdentity ();
		
		// Destroy the session
		Zend_Session::destroy ();
		
		// Redirect the user to the index
		$this->_redirect ( '/admin/session/login' );
	}
	
	/**
	 * Login action
	 */
	public function loginAction() {
		// If logged, auto redirect to homepage
		if ($this->view->userSession ()->isLogged ()) {
			$this->_redirect ( '/admin/index' );
		}
		
		// Set layout for this action
		$this->_helper->hasHelper ( 'layout' ) && $this->_helper->layout ()->setLayout ( 'layout/login' );
		
		// Get form for this action
		$form = new Admin_Form_Session_Login ();
		
		// Validate when submit form
		if ($this->getRequest ()->isPost ()) {
			if ($form->isValid ( $this->getRequest ()->getPost () )) {
				$authResult = Admin_Auth::getInstance ()->login ( $form );
				if ($authResult->isValid ()) {
					$this->_redirect ( '/admin' );
				}
				
				$messages = $authResult->getMessages ();
			} else {
				$messages = $this->view->translate ( 'Authentication:@Username or password could not be empty' );
			}
			
			$this->_helper->messenger ( 'danger' )->addMessage ( $messages );
		}
		
		// Render form
		$this->view->form = $form;
	}
}
