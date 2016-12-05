<?php

class Admin_DataGrid_Question_Body_Content extends Lumia_DataGrid_Body_Text
{
	/**
	 * Render form element
	 *
	 * @return string
	 */
	public function render()
	{
		return '<span class="expander">' . parent::render() . '</span>';
	}
}