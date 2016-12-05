<?php

class Lumia_DataGrid_Paginator
{
	/**
	 * Default pagination types
	 *
	 * @var array
	 */
	protected $_defaultTypes = array('All', 'Elastic', 'Jumping', 'Sliding');
	
	/**
	 * @var string
	 */
	protected $_viewScript = 'datagrid/pagination.phtml';
	
	/**
	 * @var string
	 */
	protected $_type = 'Elastic';

    /**
     * Current page number (starting from 1)
     *
     * @var integer
     */
    protected $_currentPageNumber = 1;
	
	/**
	 * @var	int
	 */
	protected $_itemCountPerPage = 25;

	/**
	 * Set view script path
	 *
	 * @param string $viewScript        	
	 * @return Lumia_DataGrid_Paginator
	 */
	public function setViewScript($viewScript)
	{
		$this->_viewScript = (string) $viewScript;
		
		return $this;
	}

	/**
	 * Set pagination type
	 *
	 * @param 	string $type        	
	 * @return 	Lumia_DataGrid_Paginator
	 */
	public function setType($type)
	{
		$this->_type = in_array($type, $this->_defaultTypes, true) ? $type : 'Elastic';
		
		return $this;
	}

	/**
	 * Set items per page
	 * 
	 * @param	int $itemCountPerPage
	 * @return 	Lumia_DataGrid_Paginator
	 */
	public function setItemCountPerPage($itemCountPerPage)
	{
		$this->_itemCountPerPage = (int) $itemCountPerPage;
		
		return $this;
	}

	/**
	 * Get pagination type
	 *
	 * @return string
	 */
	public function getType()
	{
		return (string) $this->_type;
	}

	/**
	 * Get view script path
	 *
	 * @return string
	 */
	public function getViewScript()
	{
		return (string) $this->_viewScript;
	}

	/**
	 * Get items per page
	 * 
	 * @return	int
	 */
	public function getItemCountPerPage()
	{
		return (int) $this->_itemCountPerPage;
	}

    /**
     * Returns the current page number.
     *
     * @return integer
     */
    public function getCurrentPageNumber()
    {
        return (int) $this->_currentPageNumber;
    }

    /**
     * Sets the current page number.
     *
     * @param  integer $pageNumber Page number
     * @return Lumia_DataGrid_Paginator
     */
    public function setCurrentPageNumber($pageNumber)
    {
        $this->_currentPageNumber = (int) $pageNumber;

        return $this;
    }
}