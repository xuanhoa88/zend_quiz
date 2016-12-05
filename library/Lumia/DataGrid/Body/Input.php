<?php

class Lumia_DataGrid_Body_Input extends Lumia_DataGrid_Body
{

    /**
     * Render form element
     *
     * @return string
     */
    public function render()
    {
        return $this->getView()->formText($this->getName(), $this->getValue(), $this->getAttributes());
    }
}