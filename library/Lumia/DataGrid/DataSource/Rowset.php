<?php

class Lumia_DataGrid_DataSource_Rowset extends Lumia_DataGrid_DataSource
{
	protected function _processDataSource()
	{
		$order = $this->_dataGrid->getOrder();
		$sort = (strtoupper($this->_dataGrid->getSort()) == Lumia_DataGrid_Abstract::SORT_DESC ? SORT_ASC : SORT_DESC);
		$this->_dataSource = $this->_arraySortByColumn($this->_dataSource->toArray(), $order, $sort);
	}
}