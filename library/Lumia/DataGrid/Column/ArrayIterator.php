<?php

class Lumia_DataGrid_Column_ArrayIterator extends ArrayIterator
{
	/**
	 * Row data
	 *
	 * @var array
	 */
	protected $_rowData = array();
    
    /**
     * Set row data
     * 
     * @param 	array $rowData
     * @return 	Lumia_DataGrid_Column_ArrayIterator
     */
    public function setData(array $rowData)
    {
        $this->_rowData = $rowData;
        
        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see ArrayIterator::current()
     */
    public function current()
    {
    	$current = parent::current();
    	$current->getBody()->setData($this->_rowData);
    	
        return $current;
    }
}