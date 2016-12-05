<?php

class Admin_DataGrid_Body_Status extends Lumia_DataGrid_Body_Text
{
	protected $_status = array(
		0 => 'ListView:@Deactivate',
		1 => 'ListView:@Activate',
	);
	
    /**
     * Render form element
     *
     * @return string
     */
    public function render()
    {
        return $this->getView()->translate(isset($this->_status[$this->getValue()]) ? $this->_status[$this->getValue()] : 'ListView:@Unknow');
    }
}