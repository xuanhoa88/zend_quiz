<?php
class Admin_Model_Exam_Student extends Lumia_Model
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Admin_Db_Table_Exam_Student');
	}
}