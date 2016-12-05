<?php

class Lumia_DataGrid_Body_Text extends Lumia_DataGrid_Body
{

    /**
     * Render form element
     *
     * @return string
     */
    public function render()
    {
        return $this->getValue();
    }
}