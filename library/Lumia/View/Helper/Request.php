<?php

/**
 * Lumia_View_Helper_Request
 *
 * @category   Lumia
 * @package    Lumia_View_Helper
 */
class Lumia_View_Helper_Request extends Zend_View_Helper_Abstract
{

	public function request()
	{
		return Zend_Controller_Front::getInstance()->getRequest();
	}
}
