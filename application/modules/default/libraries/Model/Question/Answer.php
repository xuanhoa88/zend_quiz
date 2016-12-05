<?php
class Default_Model_Question_Answer extends Lumia_Model 
{
	public function __construct() 
	{
		$this->setDbTable('Default_Db_Table_Question_Answer');
	}
}