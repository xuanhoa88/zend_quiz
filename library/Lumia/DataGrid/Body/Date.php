<?php

class Lumia_DataGrid_Body_Date extends Lumia_DataGrid_Body
{
	
    /**
     * Render form element
     *
     * @return string
     */
    public function render()
    {
    	if (!($value = $this->getValue()))
    	{
    		return '';
    	}
    	
    	if ($this->hasOption('dateFormat'))
    	{
    		return Lumia_Utility_DateTime::getInstance($value, null)->toString($this->getOption('dateFormat'));
    	}
    	
    	return $value;
    }
}