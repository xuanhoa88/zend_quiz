<?php
class Admin_Model_Export extends Lumia_Model
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Admin_Db_Table_Imex');
	}
}