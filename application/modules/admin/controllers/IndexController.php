<?php

/**
 * Controller default
 */

class Admin_IndexController extends Admin_Controller
{
	protected $_messageHandler;
	
    /**
     * Index
     */
    public function indexAction()
    {
    }
    
    /**
     * Pre-dispatch routines
     *
     * Called before action method. If using class with
     * {@link Zend_Controller_Front}, it may modify the
     * {@link $_request Request object} and reset its dispatched flag in order
     * to skip processing the current action.
     *
     * @return void
     */
    public function preDispatch()
    {
    	$this->_messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
    }

    /**
     * Post-dispatch routines
     *
     * Called after action method execution. If using class with
     * {@link Zend_Controller_Front}, it may modify the
     * {@link $_request Request object} and reset its dispatched flag in order
     * to process an additional action.
     *
     * Common usages for postDispatch() include rendering content in a sitewide
     * template, link url correction, setting headers, etc.
     *
     * @return void
     */
    public function postDispatch()
    {
    	$this->getResponse()->setBody($this->_messageHandler);
    }
}
