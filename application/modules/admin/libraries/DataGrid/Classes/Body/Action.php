<?php

class Admin_DataGrid_Classes_Body_Action extends Lumia_DataGrid_Body_Action
{
    /**
     * Render form element
     *
     * @return string
     */
    public function render()
    {
    	$this->getView()->assign($this->getData());
        return $this->getView()->render('classes/datagrid/action.phtml');
    }
}