<?php

abstract class Lumia_DataGrid_Header extends Lumia_DataGrid_Column_Abstract
{
	/**
	 * @var string
	 */
	protected $_label;
	
	/**
	 * Constructor
	 *
	 * @param string $label
	 * @param array $attributes
	 */
	public function __construct($label = null, array $attributes = null)
	{
		// Set label
		$this->setLabel($label);
		
		// Set attributes
		if ($attributes)
		{
			$this->setAttributes($attributes);
		}
	}

    /**
     * Set element label
     *
     * @param 	string $label            
     * @return 	Lumia_DataGrid_Header
     */
    public function setLabel($label)
    {
        $this->_label = (string) $label;
        
        return $this;
    }

    /**
     * Return element label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->_label;
    }
    
    /**
     * Render form element
     *
     * @return string
     */
    public function render()
    {
        return $this->getView()->translate($this->getLabel());
    }
}