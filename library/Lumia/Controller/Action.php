<?php

/**
 * Generic application controller
 *
 * @category Lumia
 * @copyright xuan.0211@gmail.com
 */
class Lumia_Controller_Action extends Zend_Controller_Action
{

	/**
	 * Ajax request callback
	 * 
	 * @var string
	 */
	private $_ajaxCallback;

	/**
	 * Ajax request format
	 * 
	 * @var string
	 */
	private $_ajaxFormat;

    /**
     * Are ajax request enabled?
     * @var bool
     */
    private $_isAjaxRequest = false;

	/**
	 * Initialize object
	 *
	 * @return void
	 */
	public function init()
	{
		// With ajax request
		if ($this->getRequest()->isXmlHttpRequest() || $this->getRequest()->getParam('requestType') === 'ajax')
		{
			$this->enableAjaxRequest();
			
			// Auto disable layout
			$this->_helper->hasHelper('layout') && $this->_helper->layout()->disableLayout();

			// Get callback
			$this->_ajaxCallback = (string) $this->getRequest()->getParam('callback', null);
			
			// Get format
			$this->_ajaxFormat = (string) $this->getRequest()->getParam('format', 'json');
		}
		
		// Inject controller helper named 'HashID' into view
		$this->view->registerHelper($this->_helper->HashID, 'HashID');
		
		// Inject controller helper named 'Messenger' into view
		$this->view->registerHelper($this->_helper->Messenger, 'Messenger');
		
		// Inject controller helper named 'userPermission' into view
		$this->view->registerHelper($this->_helper->userPermission, 'userPermission');
	}

    /**
     * Disable ajax request
     *
     * @return Lumia_Controller_Action
     */
    public function disableAjaxRequest()
    {
        $this->_isAjaxRequest = false;
        return $this;
    }

    /**
     * Enable ajax request
     *
     * @return Lumia_Controller_Action
     */
    public function enableAjaxRequest()
    {
        $this->_isAjaxRequest = true;
        return $this;
    }

    /**
     * Is ajax request enabled?
     *
     * @return bool
     */
    public function isAjaxRequest()
    {
        return !!$this->_isAjaxRequest;
    }
    
    /**
     * Get ajax callback
     * 
     * @return  string
     */
    public function getAjaxCallback() 
    {
        return (string) $this->_ajaxCallback;
    }
    
    /**
     * Get ajax format
     * 
     * @return  string
     */
    public function getAjaxFormat() 
    {
        return (string) $this->_ajaxFormat;
    }
}
