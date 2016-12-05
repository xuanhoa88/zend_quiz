<?php

class Lumia_DataGrid_DataSource_Db_Select extends Lumia_DataGrid_DataSource
{

	protected function _processDataSource()
	{
		$order = $this->_dataGrid->getOrder();
		$sort = $this->_dataGrid->getSort();
		
		if ($order && $sort)
		{
			$this->_dataSource->order($order . ' ' . $sort);
		}
	}
}