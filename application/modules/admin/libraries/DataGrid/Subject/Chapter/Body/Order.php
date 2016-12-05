<?php

class Admin_DataGrid_Subject_Chapter_Body_Order extends Lumia_DataGrid_Body_Input
{
	/**
	 * Render form element
	 *
	 * @return string
	 */
	public function render()
	{
		return $this->getView()->partial('chapter/datagrid/order.phtml', $this->getData());
	}
}