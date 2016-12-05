<?php

class Admin_DataGrid_Media_Body_Action extends Lumia_DataGrid_Body_Action
{
    /**
     * Render form element
     *
     * @return string
     */
    public function render()
    {
    	$this->getView()->assign($this->getData());
        return $this->getView()->render('media/datagrid/action.phtml');
    }
}