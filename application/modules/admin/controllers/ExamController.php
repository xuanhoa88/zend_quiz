<?php
class Admin_ExamController extends Admin_Controller
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
			'PageHeader:@Manage students',
			'PageHeader:@Printing exam',
		    'PageHeader:@Printing participant'
		));
	}
	
	/**
	 * All examinations
	 */
	public function indexAction()
	{
		$examDataGrid = new Admin_DataGrid_Exam();
		$this->view->grid = $examDataGrid->deploy();
	}
	
	/**
	 * Add new exam
	 */
	public function addAction()
	{
		// Get form for this action
		$form = new Admin_Form_Exam_Add();
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				// Init model
				$examModel = new Admin_Model_Exam();
				$examModel->save(Application_Const::FORM_SAVE_MODE_ADD, $form->getValues());
				$this->redirect('/admin/exam');
			}
		} else
		{
			$form->populate(array(
				'exam_status' => Admin_Const::DEFAULT_STATUS_CODE
			));
		}
		
		// Render form
		$this->view->form = $form;
	}
	
	/**
	 * Edit
	 */
	public function editAction()
	{
		// Get id
		$id = (int) $this->getRequest()->getParam('id', 0);
	
		// Init exam model
		$examModel = new Admin_Model_Exam();
		$populate = $examModel->getById($id);
		if (!$populate)
		{
			return $this->redirect('/admin/exam');
		}
	
		// Force exam data to array
		$examRows = $populate->toArray();
		
		// Get exam management
		$examManagementModel = new Admin_Model_Exam_Management();
		$populate = $examManagementModel->getByExamId($id);
		if (!$populate)
		{
			return $this->redirect('/admin/exam');
		}
		
		// Verify the start time greater than or equal current time
		if ($populate->exam_management_start_time <= Lumia_Utility_DateTime::getInstance()->now())
		{
			return $this->redirect('/admin/exam');
		}
		
		$populate->exam_management_start_time = Lumia_Utility_DateTime::getInstance($populate->exam_management_start_time, Zend_Date::ISO_8601)->toString('dd-MM-yyyy HH:mm'); 
		
		// Merge to populate data
		$examRows = array_merge($examRows, $populate->toArray());
		
		// Get students allowed join to this exam
		$studentModel = new Admin_Model_Exam_Student();
		$populate = $studentModel->getByExamManagement(array($populate->exam_management_id));
		$examStudents = array();
		$examClassess = array();
		if ($populate->count())
		{
			foreach ($populate as $studentRow)
			{
				if (array_key_exists($studentRow->student_class, $examStudents)) 
				{
					$examStudents[$studentRow->student_class] = array();
				}
				$examClassess[$studentRow->student_class] = (int) $studentRow->student_class;
				$examStudents[$studentRow->student_class][$studentRow->student_id] = (int) $studentRow->student_id;
			}
		}

		// Merge to populate data
		$examRows['exam_classes'] = $examClassess;
		$examRows['exam_student'] = $examStudents;
		
		// Get exam questions
		$examQuestionModel = new Admin_Model_Exam_Question();
		$examQuestionRows = $examQuestionModel->getByExamAndSubject($id, isset($examRows['exam_subject']) ? (int) $examRows['exam_subject'] : 0);
		
		$examQuestion = array();
		$calcNumberInputQuestions = array();
		if ($examQuestionRows->count()) 
		{
			foreach ($examQuestionRows as $questionRow)
			{
				$questionLevel = $questionRow->question_level;
				$questionType = $questionRow->question_type;
				$numberQuestions = (int) $questionRow->total_number_question;
				
				$examQuestion[$questionRow->question_chapter][$questionLevel][$questionType] = $numberQuestions;
				
				if (!isset($calcNumberInputQuestions[$questionLevel][$questionType]))
				{
					$calcNumberInputQuestions[$questionLevel][$questionType] = 0;
				}
					
				$calcNumberInputQuestions[$questionLevel][$questionType] += $numberQuestions;
			}	
		}
		$examRows['exam_question'] = $examQuestion;

		// Assign into view
		$this->view->calcNumberInputQuestions = $calcNumberInputQuestions;
	
		// Get form for this action
		$form = new Admin_Form_Exam_Edit();
		$form->setAction($this->view->baseUrl('admin/exam/edit/id/' . $id));
	
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				$examModel->save(Application_Const::FORM_SAVE_MODE_EDIT, $form->getValues());
				$this->redirect('/admin/exam');
			}
		} else
		{
			$form->populate($examRows);
		}
	
		// Render form
		$this->view->form = $form;
	}
    
    /**
     * Get classes and questions by subject
     */
    public function getClassesAndQuestionsBySubjectAction()
    {
    	$this->_helper->viewRenderer->setNoRender(true);
    	$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
    	
    	// Get subject
    	$subjectId = (int) $this->getRequest()->getParam('subject-id');
    	
    	$subjectModel = new Admin_Model_Subject();
    	if (!$subjectRow = $subjectModel->getById($subjectId))
    	{
    		$messageHandler->setError();
    		$messageHandler->appendMessage($this->view->translate('ExamForm:@This subject does not exist in the database'));
    	} else
    	{
    		$form = new Admin_Form_Exam();
    		
    		// Assign into view
    		$this->view->element = $form;
    		
    		// Create form classes
    		$form->createFormClassesBySubject($subjectId);
    		
    		if ($this->view->classesRows)
    		{
    			$messageHandler->setSuccess();
    			
    			// Create form classes
    			$messageHandlerClasses = $this->view->render('form/list-classes.phtml');
    			$messageHandler->addContext($messageHandlerClasses, 'CLASSES');
    		
	    		// Create student classes
	    		$messageHandler->addContext($this->view->examStudentsByClasses, 'STUDENTS');
	    		
	    		// Create form question
		    	$form->createFormQuestionsBySubject($subjectId);
		    	$messageHandlerQuestions = $this->view->render('form/list-questions.phtml');
		    	$messageHandler->addContext($messageHandlerQuestions, 'QUESTIONS');
		    	
    		} else
    		{
    			$messageHandler->setError();
    			$messageHandler->appendMessage($this->view->translate('ExamForm:@The classes were not found corresponding subject selected'));
    		}
    	}
    	
    	$this->getResponse()->setBody($messageHandler);
    }
    
    /**
     * Delete via row(s) selected
     */
    public function deleteViaSelectedAction()
    {
    	$this->_helper->viewRenderer->setNoRender(true);
    	$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
    
    	// Get selected rows
    	$selectRows = (array) $this->getRequest()->getParam('selected-rows', null);
    
    	if ($selectRows)
    	{
    		$messageHandler->setSuccess();
    		$examModel = new Admin_Model_Exam();
    		if ($examModel->deleteSelectedRows($selectRows))
    		{
    			$messageHandler->appendMessage($this->view->translate('Message:@The records that you selected has been deleted'));
    		} else
    		{
    			$messageHandler->setError();
    			$messageHandler->appendMessage($this->view->translate('Message:@An error occurred while deleting the records that you selected'));
    		}
    	} else
    	{
    		$messageHandler->appendMessage($this->view->translate('Message:@You must select at least one record'));
    	}
    
    	$messageHandler->addContext($this->view->baseUrl('admin/exam'), 'redirect');
    	$this->getResponse()->setBody($messageHandler);
    }
    
    /**
     * Delete by id
     */
    public function deleteAction()
    {
    	$this->_helper->viewRenderer->setNoRender(true);
    
    	// Get id
    	$id = (int) $this->getRequest()->getParam('id', 0);
    
    	if ($id)
    	{
    		$examModel = new Admin_Model_Exam();
    		if ($examModel->deleteSelectedRows(array($id)))
    		{
    			$this->_helper->messenger('danger')->addMessage($this->view->translate('Message:@The records that you selected has been deleted'));
    		} else
    		{
    			$this->_helper->messenger('danger')->addMessage($this->view->translate('Message:@An error occurred while deleting the records that you selected'));
    		}
    	} else
    	{
    		$this->_helper->messenger('danger')->addMessage($this->view->translate('Message:@You must select at least one record'));
    	}
    
    	$this->_redirect('/admin/exam');
    }
    
    /**
     * Update status deactive
     */
    public function deactiveAction()
    {
    	$this->getRequest()->setParam('status', 0);
    	$this->_forward('status');
    }
    
    /**
     * Update status active
     */
    public function activeAction()
    {
    	$this->getRequest()->setParam('status', 1);
    	$this->_forward('status');
    }
    
    /**
     * Update status
     */
    public function statusAction()
    {
    	$this->_helper->viewRenderer->setNoRender(true);
    	$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
    
    	// Get selected rows
    	$selectRows = (array) $this->getRequest()->getParam('selected-rows', null);
    	$status = (int) $this->getRequest()->getParam('status', 0);
    
    	if ($selectRows)
    	{
    		$messageHandler->setSuccess();
    		$examModel = new Admin_Model_Exam();
    		if ($examModel->updateStatus($selectRows, $status))
    		{
    			$messageHandler->appendMessage($this->view->translate('Message:@The records that you selected has been updated'));
    		} else
    		{
    			$messageHandler->setError();
    			$messageHandler->appendMessage($this->view->translate('Message:@An error occurred while updating the records that you selected'));
    		}
    	} else
    	{
    		$messageHandler->appendMessage($this->view->translate('Message:@You must select at least one record'));
    	}
    
    	$messageHandler->addContext($this->view->baseUrl('admin/exam'), 'redirect');
    	$this->getResponse()->setBody($messageHandler);
    }
    
    /**
     * Get students by classes
     */
    public function getStudentsByClassesAction()
    {
    	// Get class id
    	$classesId = (int) $this->getRequest()->getParam('class-id', 0);
    	if (!$classesId)
    	{
    		throw new Zend_Controller_Action_Exception($this->view->translate('Error:@The parameter is incorrect on this page'));
    	}
    	
    	// Init model
    	$classesModel = new Admin_Model_Classes();
    	if (!($this->view->classesRow = $classesModel->getById($classesId)))
    	{
    		throw new Zend_Controller_Action_Exception($this->view->translate('ExamForm:@This class does not exist in the database'));
    	}
		
    	// Init grid
    	$grid = new Admin_DataGrid_Exam_Student(array('classesId' => $classesId));
    	$this->view->grid = $grid->deploy();
    }
}