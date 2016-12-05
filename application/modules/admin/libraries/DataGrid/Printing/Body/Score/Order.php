<?php

class Admin_DataGrid_Printing_Body_Score_Order extends Lumia_DataGrid_Body_Action
{
	/**
	 * @var int
	 */
    private static $_order = 0;
    
    /**
     * Render form element
     *
     * @return string
     */
    public function render()
    {
    	return ++self::$_order;
    }
}