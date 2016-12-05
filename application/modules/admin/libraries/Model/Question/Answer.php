<?php
class Admin_Model_Question_Answer extends Lumia_Model 
{
	
	/**
	 * Constructor
	 */
	public function __construct() 
	{
		$this->setDbTable('Admin_Db_Table_Question_Answer');
	}
}