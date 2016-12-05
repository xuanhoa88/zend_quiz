<?php

abstract class Lumia_DataGrid_DataSource
{
	/**
	 * @var mixed
	 */
	protected $_dataSource;
	
	/**
	 * @var Lumia_DataGrid_Abstract
	 */
	protected $_dataGrid;
	
	/**
	 * Constructor
	 * 
	 * @param Lumia_DataGrid_Abstract $dataGrid
	 */
	public function __construct(Lumia_DataGrid_Abstract $dataGrid)
	{
		if (!$dataGrid instanceof Lumia_DataGrid_Abstract)
		{
			throw new Lumia_DataGrid_Exception('The data grid provider is not installed');
		}
		
		$this->_dataGrid = $dataGrid;
		$this->_dataSource = $dataGrid->getDataSource();
	}
	
	/**
	 * Get datasource
	 * 
	 * @return Zend_Paginator
	 */
	public function getDataSource()
	{
		$this->_processDataSource();
		$paginator = Zend_Paginator::factory($this->_dataSource);
		$paginator->setCurrentPageNumber($this->_dataGrid->getPaginator()->getCurrentPageNumber());
		$paginator->setItemCountPerPage($this->_dataGrid->getPaginator()->getItemCountPerPage());
		
		return $paginator;
	}
	
	/**
	 * Sort by column
	 * 
	 * @param array $dataSources
	 * @param string $column
	 * @param string $dir
	 * @return mixed
	 */
	protected function _arraySortByColumn(array $dataSources, $column, $dir = SORT_ASC)
	{
		$sortColumn = array();
		foreach ($dataSources as $key => $row)
		{
			$sortColumn[$key] = $row[$column];
		}
		
		array_multisort($sortColumn, $dir, $dataSources);
		
		return $dataSources;
	}
	
	/**
	 * Prepare data source abstract function
	 */
	abstract protected function _processDataSource();
}