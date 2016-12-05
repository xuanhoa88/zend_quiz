<?php

class Lumia_DataGrid_Body_Checkbox extends Lumia_DataGrid_Body
{
	/**
	 * Constructor
	 *
	 * @param string $name
	 */
	public function __construct($name)
	{
		parent::__construct($name);
		
		// Auto disable sorting
		$this->disableSort();
	}
	
    /**
     * Render form element
     *
     * @return string
     */
    public function render()
    {
    	return $this->getView()->formCheckbox('checkRow[]', $this->getValue(), array('data-target' => 'row', 'id' => 'checkRow-' . $this->getValue()));
    }
}