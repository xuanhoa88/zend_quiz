<?php

/**
 * Lumia_View_Helper_UserSession
 *
 * @category   Lumia
 * @package    Lumia_View_Helper
 */
class Lumia_View_Helper_UserSession extends Zend_View_Helper_Abstract
{
	/**
	 * User information
	 *
	 * @var array
	 */
	protected $_userSession;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->_userSession = Lumia_Auth::getInstance()->getUser();
	}
	
	/**
	 * Get user session
	 * 
	 * @return Lumia_View_Helper_UserSession
	 */
	public function userSession()
	{
		return $this;
	}
	
	/**
	 * Are you logged ?
	 * 
	 * @return boolean
	 */
	public function isLogged()
	{
		return Lumia_Auth::getInstance()->isLogged();
	}
	
	/**
	 * Are you admin?
	 * 
	 * @return boolean
	 */
	public function isAdmin()
	{
		return Lumia_Auth::getInstance()->isAdmin();
	}
	
	/**
	 * Are you guest?
	 * 
	 * @return boolean
	 */
	public function isGuest()
	{
		return Lumia_Auth::getInstance()->isGuest();
	}
	
	/**
	 * Prevent E_NOTICE for nonexistent values
	 *
	 * @param  string $key
	 * @return null
	 */
	public function __get($key)
	{
		return $this->_userSession->{$key};
	}
}
