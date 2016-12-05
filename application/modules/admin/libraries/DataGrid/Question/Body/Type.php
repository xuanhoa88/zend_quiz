<?php

class Admin_DataGrid_Question_Body_Type extends Admin_DataGrid_Body_Status
{
	protected $_status = array(
		'ESSAY' => 'QuestionListView:@Essay',
		'TEST' => 'QuestionListView:@Test',
	);
}