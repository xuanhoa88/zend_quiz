<?php

class Lumia_Auth_Identity implements Countable, IteratorAggregate 
{
	/**
	 * @var array
	 */
	protected $_data = array();
	
	/**
	 * Constructor
	 * 
	 * @param  array $data
	 */
	public function __construct(array $data = array())
	{
		$this->_data = $data;
	}

    /**
     * Transform a key from the user-specified
     *
     * @param 	string $key
     * @return 	string
     * @throws 	Lumia_Auth_Exception if the $key is not a string.
     */
    protected function _transform($key)
    {
        if (!is_string($key)) 
        {
            throw new Lumia_Auth_Exception('Specified column is not a string');
        }
        
        // Perform no transformation by default
        return $key;
    }

    /**
     * Retrieve row field value
     *
     * @param  	string $key
     * @return 	mixed
     */
    public function __get($key)
    {
        if ($this->__isset($key)) 
        {
            return $this->_data[$this->_transform($key)];
        }
        
        return null;
    }

    /**
     * Test existence of row field
     *
     * @param  string $key
     * @return boolean
     */
    public function __isset($key)
    {
        return array_key_exists($this->_transform($key), $this->_data);
    }
    
    /**
     * Count elements of an data
     * 
     * @return int
     */
    public function count() 
    {
    	return count($this->_data);
    }
    
    /**
     * (non-PHPdoc)
     * @see IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
    	return new ArrayIterator((array) $this->_data);
    }

    /**
     * Returns the column/value data as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return (array)$this->_data;
    }
}