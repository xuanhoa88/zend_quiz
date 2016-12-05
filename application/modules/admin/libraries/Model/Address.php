<?php

class Admin_Model_Address extends Lumia_Model
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Admin_Db_Table_Address');
	}
}