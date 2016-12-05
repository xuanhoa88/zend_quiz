<?php

class Admin_DataGrid_User_Body_Role extends Lumia_DataGrid_Body_Text
{
	protected $_roleLabel = array(
		'administrator' => 'RoleLabel:@Admin',
		'guest' => 'RoleLabel:@Guest'
	);
	
	/**
     * Render form element
     *
     * @return string
     */
    public function render()
    {
    	$val = (string) $this->getValue();
    	if ($val === '')
    	{
    		$rowData = $this->getData();
    		$val = array_key_exists($rowData['user_role'], $this->_roleLabel) ? $this->getView()->translate($this->_roleLabel[$rowData['user_role']]) : $rowData['user_role'];
    	}
    	
        return $val;
    }
}