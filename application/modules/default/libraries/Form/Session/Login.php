<?php
/**
 * Form allowing the user to log in the application
 *
 *
 * @category application
 * @package default
 * @subpackage forms
 * @copyright xuan.0211@gmail.com
 */

class Default_Form_Session_Login extends Application_Form_Login
{
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @access public
	 * @return void
	 */
	public function init()
	{
	    parent::init();
	    
	    $this->setAction($this->getView()->baseUrl('/session/login'));
	}
}
