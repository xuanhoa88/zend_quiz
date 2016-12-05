<?php

class Application_Model_Configuration extends Lumia_Model
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Application_Db_Table_Configuration');
	}
}
