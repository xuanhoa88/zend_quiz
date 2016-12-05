<?php

class Lumia_DataGrid_Header_Checkbox extends Lumia_DataGrid_Header
{
    /**
     * Render form element
     *
     * @return string
     */
    public function render()
    {
        return $this->getView()->formCheckbox('checkAll', null, array('data-toggle' => 'checkAll'));
    }
}