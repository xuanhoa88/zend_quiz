<?php

class Lumia_DataGrid_ViewHelper extends Zend_View_Helper_Abstract
{
	/**
	 * Container name
	 * 
	 * @var	string
	 */
	protected $_container = 'LUMIA.DATAGRID';
	
	/**
     * Url params
     *
     * @var array
     */
    protected $_urlParams = array();
	
    /**
     * @var Zend_View_Helper_Placeholder_Registry
     */
    protected $_registry;
    
    /**
     * Constructor
     *
     * Retrieve container registry from Zend_Registry, or create new one and register it.
     *
     * @return void
     */
    public function __construct(array $urlParams)
    {
    	$this->_registry = Zend_View_Helper_Placeholder_Registry::getRegistry();
    	if (null === $this->_registry->containerExists($this->_container))
    	{
    		$this->_registry->createContainer($this->_container);
    	}
    	
    	$this->_urlParams = $urlParams;
    }

    /**
     * Returns view of data grid
     *
     * @return Zend_View_Interface
     */
    public function dataGrid()
    {
        return $this;
    }

    /**
     * Prevent E_NOTICE for nonexistent values
     *
     * If {@link strictVars()} is on, raises a notice.
     *
     * @param  string $key
     * @return null
     */
    public function __get($key)
    {
        return $this->_registry->getContainer($this->_container)->offsetGet($key);
    }

    /**
     * Allows testing with empty() and isset() to work inside
     * templates.
     *
     * @param  string $key
     * @return boolean
     */
    public function __isset($key)
    {
        return array_key_exists($key, $this->_registry->getContainer($this->_container));
    }

    /**
     * Directly assigns a variable to the view script.
     *
     * Checks first to ensure that the caller is not attempting to set a
     * protected or private member (by checking for a prefixed underscore); if
     * not, the public member is set; otherwise, an exception is raised.
     *
     * @param string $key The variable name.
     * @param mixed $val The variable value.
     * @return void
     * @throws Zend_View_Exception if an attempt to set a private or protected
     * member is detected
     */
    public function __set($key, $val)
    {
    	$this->_registry->getContainer($this->_container)->offsetSet($key, $val);
    }

    /**
     * Allows unset() on object properties to work
     *
     * @param string $key
     * @return void
     */
    public function __unset($key)
    {
        $this->_registry->getContainer($this->_container)->offsetUnset($key);
    }
    
    /**
     * Generate sorting url
     * 
     * @param	array $replaceParams
     * @return	string
     */
    public function sortUrl(array $replaceParams = array())
    {
    	$urlParams = array_merge($this->_urlParams, $replaceParams);
    	if (array_key_exists('sort', $urlParams))
    	{
    		$urlParams['sort'] = ($urlParams['sort'] == Lumia_DataGrid::SORT_DESC ? Lumia_DataGrid::SORT_ASC : Lumia_DataGrid::SORT_DESC);
    	}
    	
    	return addslashes($this->view->url($urlParams));
    }

    /**
     * Get the View object
     *
     * @return Zend_View_Helper_Abstract
     */
    public function getView()
    {
        return $this->view;
    }
}
