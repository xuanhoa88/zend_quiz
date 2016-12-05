<?php
class Admin_PrintingController extends Admin_Controller
{
	/**
	 * Initialize object
	 *
	 * @return void
	 */
	public function init()
	{
		parent::init();
	}
	
	/**
	 * Printing score
	 */
	public function scoreAction()
	{
		// Set new layout
		if ($this->_helper->hasHelper('layout'))
		{
			$this->_helper->layout()->setLayout('layout/iframe');
		}
		
		// Get params
		$examID = (int) $this->getRequest()->getParam('exam-id', 0);
		
		// Init data grid
		$scorePrintingGrid = new Admin_DataGrid_Printing_Score();
		$scorePrintingGrid->setOptions(array('examID' => $examID));
		
		// Assign into view
		$this->view->grid = $scorePrintingGrid->deploy();
	}
	
	/**
	 * Printing exam
	 */
	public function examAction()
	{
		// Set new layout
		if ($this->_helper->hasHelper('layout'))
		{
			$this->_helper->layout()->setLayout('layout/iframe');
		}
		
		// Get params
		$examID = (int) $this->getRequest()->getParam('exam-id', 0);
		
		// Init data grid
		$examPrintingGrid = new Admin_DataGrid_Printing_Exam();
		$examPrintingGrid->setOptions(array('examID' => $examID));
		
		// Assign into view
		$this->view->grid = $examPrintingGrid->deploy();
	}
	
	/**
	 * Printing participant
	 */
	public function participantAction()
	{
		// Set new layout
		if ($this->_helper->hasHelper('layout'))
		{
			$this->_helper->layout()->setLayout('layout/iframe');
		}
		
		// Get params
		$examID = (int) $this->getRequest()->getParam('exam-id', 0);
		
		// Init data grid
		$participantExamPrintingGrid = new Admin_DataGrid_Printing_Exam_Participant();
		$participantExamPrintingGrid->setOptions(array('examID' => $examID));
		
		// Assign into view
		$this->view->grid = $participantExamPrintingGrid->deploy();
		$this->render('exam/participant.phtml');
	}
}