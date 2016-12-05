<?php

class Lumia_Model_User extends Lumia_Model
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Lumia_Db_Table_User');
	}
}
