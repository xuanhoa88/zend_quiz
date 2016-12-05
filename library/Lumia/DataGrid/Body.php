<?php

abstract class Lumia_DataGrid_Body extends Lumia_DataGrid_Column_Abstract
{
	/**
	 * Field name
	 *
	 * @var string
	 */
	protected $_name;

    /**
     * Field id
     * 
     * @var string
     */
    protected $_id;
    
    /**
     * @var bool
     */
    protected $_enabledSort;
    
    /**
     * Row data
     */
    protected $_rowData = array();
    
	/**
	 * Display format
	 * 
	 * @var mixed
	 */
	protected $_format;

    /**
     * Constructor
     *
     * @param 	string $name
     * @param	array $attributes            
     */
    public function __construct($name, array $attributes = null)
    {
        $this->setName($name);
        
        // Auto enable sorting
        $this->enableSort();
        
        // Sets attributes
        if ($attributes)
        {
        	// Determine sorting is defined
        	if (array_key_exists('sort', $attributes))
        	{
        		(bool) $attributes['sort'] ? $this->enableSort() : $this->disableSort();
        		unset($attributes['sort']);
        	}
        	
        	$this->setAttributes($attributes);
        } 
    }
    
    /**
     * Set row data
     * 
     * @param 	array $dataSource
     * @return 	Lumia_DataGrid_Body
     */
    public function setData(array $dataSource)
    {
        $this->_rowData = $dataSource;
        
        return $this;
    }
    
    /**
     * Get row data
     * 
     * @return array
     */
    public function getData()
    {
        return $this->_rowData;
    }

    /**
     * Disable field sorting
     *
     * @return Lumia_DataGrid_Body
     */
    public function disableSort()
    {
        $this->_enabledSort = false;
        
        return $this;
    }

    /**
     * Enable field sorting
     *
     * @return Lumia_DataGrid_Body
     */
    public function enableSort()
    {
        $this->_enabledSort = true;
        
        return $this;
    }

    /**
     * Is field sorting enabled?
     *
     * @return bool
     */
    public function isSortEnabled()
    {
        return ($this->_enabledSort === true);
    }

    /**
     * Sets the field name
     *
     * @param 	string $name            
     * @return 	Lumia_DataGrid_Body
     */
    public function setName($name)
    {
        $name = $this->_filter($name);
        if ('' === $name) 
        {
            throw new Lumia_DataGrid_Exception('Invalid name provided; must contain only valid variable characters and be non-empty');
        }
        
        $this->_name = $name;
        
        return $this;
    }

    /**
     * Gets the field name
     *
     * @return 	mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Retrieve field value
     *
     * @return mixed
     */
    public function getValue()
    {
    	return isset($this->_rowData[$this->_name]) ? $this->_rowData[$this->_name] : null;
    }

    /**
     * Set element attribute named id
     *
     * @param 	string $id
     * @return	Lumia_DataGrid_Body            
     */
    public function setId($id)
    {
        $id = $this->_filter($id);
        if ('' === $id) 
        {
            throw new Lumia_DataGrid_Exception('Invalid id provided; must contain only valid variable characters and be non-empty');
        }
        
        $this->_id = $this->_normalizeId($id);
        
        return $this;
    }

    /**
     * Retrieve element attribute named id
     *
     * @return string
     */
    public function getId()
    {
        if (null === $this->_id) 
        {
        	$this->_id = $this->_normalizeId($this->getName());
        } 
        
        return $this->_id;
    }
    
    /**
     * Converts an associative array to a string of tag attributes.
     *
     * @see attributesToHtml()
     */
    public function attributesToHtml()
    {
    	// Create id attribute
    	if (null === $this->getValue())
    	{
    		$this->removeAttribute('id');
    	} else
    	{
    		$this->setAttribute('id', $this->getId() . md5(uniqid($this->getValue(), true)));
    	}
    	
    	return parent::attributesToHtml();
    }
}