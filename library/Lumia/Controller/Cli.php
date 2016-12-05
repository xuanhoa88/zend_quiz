<?php
/**
 * Cli Controller default actions
 */
abstract class Lumia_Controller_Cli extends Zend_Controller_Action
{
	/**
	 * Override parent method
	 *
	 * @return void
	 */
    function init ()
	{
		$this->_helper->hasHelper('layout') && $this->_helper->layout()->disableLayout();
		$this->_helper->ViewRenderer->setNoRender ();
		$this->adjustErrorHandler ();
	}
	
	/**
	 * Override parent method
	 *
	 * @return void
	 */
	function preDispatch ()
	{
		while (ob_get_level())
		{
			ob_end_flush ();
		}
	}
}