<?php

class Admin_DataGrid_Department_Body_Action_Subject extends Admin_DataGrid_Subject_Body_Action
{
    /**
     * Render form element
     *
     * @return string
     */
    public function render()
    {
    	$this->getView()->assign($this->getData());
        return $this->getView()->render('department/datagrid/action/subject.phtml');
    }
}