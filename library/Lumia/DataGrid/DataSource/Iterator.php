<?php

class Lumia_DataGrid_DataSource_Iterator extends Lumia_DataGrid_DataSource
{
    protected function _processDataSource()
    {
        $dataSource = array();
        foreach ($this->_dataSource as $_index => $value) 
        {
            if (is_array($value)) 
            {
                foreach ($value as $row) 
                {
                    $dataSource[] = $row;
                }
            }
        }
		
        $order = $this->_dataGrid->getOrder();
		$sort = (strtoupper($this->_dataGrid->getSort()) == Lumia_DataGrid_Abstract::SORT_DESC ? SORT_ASC : SORT_DESC);
		$this->_dataSource = $this->_arraySortByColumn($dataSource, $order, $sort);
    }
}