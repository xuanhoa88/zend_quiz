<?php

class Default_IndexController extends Default_Controller
{
    /**
     * Initialize object
     */
    public function init()
    {
        parent::init();
    }
    
    /**
     * Alias of welcome action
     */
    public function indexAction()
    {
    	// Add js translate
    	$this->view->jsTranslate(array(
    			'ExamListView:@You may be able to do the exam within %d minute(s) %d second(s)',
    			'ExamListView:@You have %d minute(s) %d second(s) to complete the exam',
    			'ExamListView:@The exam was locked',
    			'ExamListView:@Do an exam'
    	));
    	
        $this->_forward('welcome');
    }
    
    /**
     * My Quiz
     */
    public function welcomeAction()
    {
    	$examDataGrid = new Default_DataGrid_Exam();
    	$examDataGrid->getPaginator()->setItemCountPerPage(8);
        $this->view->grid = $examDataGrid->deploy();
    }
    
    /**
     * Alias of welcome action
     */
    public function myQuizAction()
    {
        $this->_forward('welcome');
    }
}
