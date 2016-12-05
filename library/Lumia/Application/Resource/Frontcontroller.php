<?php 

class Lumia_Application_Resource_Frontcontroller extends Zend_Application_Resource_Frontcontroller
{
	/**
	 * Retrieve front controller instance
	 *
	 * @return Zend_Controller_Front
	 */
	public function getFrontController()
	{
		if (null === $this->_front) 
		{
			$this->_front = Zend_Controller_Front::getInstance();
		}
		
		return $this->_front;
	}
}