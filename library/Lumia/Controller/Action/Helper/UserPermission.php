<?php

/**
 * Lumia_Controller_Action_Helper_UserPermission
 *
 * @category   Lumia
 * @package    Lumia_Controller_Action_Helper
 */
class Lumia_Controller_Action_Helper_UserPermission extends Zend_Controller_Action_Helper_Abstract
{
	/**
	 * Permission session
	 *
	 * @var array
	 */
	protected $_permissionSession;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->_permissionSession = Lumia_Auth::getInstance()->getPermissions();
	}
	
	/**
	 * Get permission session
	 *
	 * @return Lumia_Controller_Action_Helper_UserPermission
	 */
	public function userPermission()
	{
		return $this;
	}
	
	/**
	 * Prevent E_NOTICE for nonexistent values
	 *
	 * @param  string $key
	 * @return null
	 */
	public function __get($key)
	{
		return $this->_permissionSession->{$key};
	}
	
	/**
	 * Test whether for session user have permission
	 * 
	 * @return Lumia_Controller_Action_Helper_UserPermission
	 */
	public function hasPermission()
	{
		if ($this->getActionController()->view->userSession()->isAdmin() || $this->_permissionSession->count() > 0) 
		{
			return true;
		}
		
		return false;
	}
	
	/**
	 * Strategy pattern: proxy to userPermission()
	 *
	 * @return 	Lumia_Auth_Identity
	 */
	public function direct()
	{
		return $this->userPermission();
	}
}
