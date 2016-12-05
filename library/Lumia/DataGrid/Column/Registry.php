<?php
class Lumia_DataGrid_Column_Registry implements ArrayAccess, IteratorAggregate, Countable 
{
	/**
	 * Temporary storage
	 * 
	 * @var array
	 */
	protected $_container = array();
    
    /**
     * Row data
     * 
     * @var array
     */
    protected $_rowData = array();
	
	/**
	 * (non-PHPdoc)
	 * @see ArrayAccess::offsetSet()
	 */
	public function offsetSet($offset, $value) 
	{
		if (is_scalar($offset)) 
		{
			$this->_container[$offset] = $value;
		} else 
		{
			$this->_container[] = $value;
		}
	}
	
	/**
	 * (non-PHPdoc)
	 * @see ArrayAccess::offsetExists()
	 */
	public function offsetExists($offset) 
	{
		return isset($this->_container[$offset]);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see ArrayAccess::offsetUnset()
	 */
	public function offsetUnset($offset) 
	{
		if (is_int($offset))
		{
			array_splice($this->_container, $offset);
		} else 
		{
			unset($this->_container[$offset]);
		}
	}
	
	/**
	 * (non-PHPdoc)
	 * @see ArrayAccess::offsetGet()
	 */
	public function offsetGet($offset) 
	{
		if ($this->offsetExists($offset))
		{
			$column = clone $this->_container[$offset];
			$column->getBody()->setData($this->_rowData);
			
			return $column;
		}
		
		throw new Lumia_DataGrid_Exception('Invalid column specified');
	}
	
	/**
	 * (non-PHPdoc)
	 * @see IteratorAggregate::getIterator()
	 */
    public function getIterator()
    {
    	$arrayIterator = new Lumia_DataGrid_Column_ArrayIterator((array) $this->_container);
    	$arrayIterator->setData($this->_rowData);
    	
        return $arrayIterator;
    }
    
    /**
     * (non-PHPdoc)
     * @see ArrayIterator::count()
     */
    public function count()
    {
    	return count($this->_container);
    }
    
    /**
     * Set row data
     * 
     * @param 	array $rowData
     * @return 	Lumia_DataGrid_Column_Registry
     */
    public function setData(array $rowData)
    {
        $this->_rowData = $rowData;
        
        return $this;
    }
}