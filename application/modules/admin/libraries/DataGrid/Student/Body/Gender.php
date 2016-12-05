<?php

class Admin_DataGrid_Student_Body_Gender extends Lumia_DataGrid_Body_Text
{
	protected $_status = array(
		'male' => 'StudentListView:@Male',
		'female' => 'StudentListView:@Female',
	);
	
    /**
     * Render form element
     *
     * @return string
     */
    public function render()
    {
        return isset($this->_status[$this->getValue()]) ? $this->getView()->translate($this->_status[$this->getValue()]) : 'UNKNOW';
    }
}