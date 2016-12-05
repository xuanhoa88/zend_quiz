<?php

class Default_Model_Student extends Lumia_Model
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Default_Db_Table_Student');
	}
}