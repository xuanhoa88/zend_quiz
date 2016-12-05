<?php
class Admin_ScoreController extends Admin_Controller
{
	/**
	 * Initialize object
	 *
	 * @return void
	 */
	public function init()
	{
		parent::init();
		
		// Add js translate
		$this->view->jsTranslate(array(
		    'PageHeader:@Printing score'
		));
	}
	
	/**
	 * All examinations
	 */
	public function indexAction()
	{
		$examDataGrid = new Admin_DataGrid_Score();
		$this->view->grid = $examDataGrid->deploy();
	}
}