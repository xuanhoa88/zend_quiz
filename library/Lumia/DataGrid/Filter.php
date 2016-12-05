<?php

abstract class Lumia_DataGrid_Filter
{
	/**
	 * @var	Lumia_DataGrid_Abstract
	 */
	protected $_dataGrid;
	
	/**
	 * Valid datas
	 * 
	 * @param array
	 */
	protected $_validDatas = array();
	
	/**
	 * Constructor
	 * 
	 * @param Lumia_DataGrid_Abstract $dataGrid
	 */
	public function __construct(Lumia_DataGrid_Abstract $dataGrid)
	{
		$this->_dataGrid = $dataGrid;
	}

    /**
     * Initialize filter (used by extending classes)
     *
     * @return void
     */
    public function init()
    {
    	// Get filter form
    	$filters = $this->_dataGrid->getFilter();
    	
    	// If send post request, inject into session
    	if ($this->_dataGrid->getRequest()->isPost())
    	{
    		$this->_dataGrid->getSession()->filters = $this->_dataGrid->getRequest()->getPost();
    	}
    	 
    	// Get valid datas
    	if ($this->_dataGrid->getSession()->filters)
    	{
    		$validDatas = $filters->getValidValues((array) $this->_dataGrid->getSession()->filters);
    		$validDatas = isset($validDatas[$this->_dataGrid->getGridId()]['filter']) ? $validDatas[$this->_dataGrid->getGridId()]['filter'] : array();
    		$this->_validDatas = array_filter($validDatas, 'count');
    	}
    }
}