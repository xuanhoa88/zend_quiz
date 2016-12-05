<?php

class Admin_DepartmentController extends Admin_Controller
{

	/**
	 * All departments
	 */
	public function indexAction()
	{
		$departmentDataGrid = new Admin_DataGrid_Department();
		$this->view->grid = $departmentDataGrid->deploy();
	}
	
	/**
	 * List subjects by department id
	 */
	public function manageSubjectsAction()
	{
		// Get department id
		$department = (int) $this->getRequest()->getParam('id', 0);
		
		$departmentModel = new Admin_Model_Department();
		$departmentRow = $departmentModel->getById($department);
		
		if (empty($departmentRow->department_id))
		{
			$this->_redirect('/admin/department');
		}
		
		// Assign into view
		$this->view->departmentRow = $departmentRow;
		
		// Init grid
		$grid = new Admin_DataGrid_Department_Subject();
		$this->view->grid = $grid->deploy();
	}

	/**
	 * Add new
	 */
	public function addAction()
	{
		// Get form for this action
		$form = new Admin_Form_Department_Add();
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				// Init model
				$departmentModel = new Admin_Model_Department();
				$departmentModel->save(Application_Const::FORM_SAVE_MODE_ADD, $form->getValues());
				$this->redirect('/admin/department');
			}
		} else 
		{
			$form->populate(array(
				'department_status' => Admin_Const::DEFAULT_STATUS_CODE
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
		
		// Init model
		$departmentModel = new Admin_Model_Department();
		$populate = $departmentModel->getById($id);
		if (!$populate)
		{
			$this->redirect('/admin/department');
		}

		// Get form for this action
		$form = new Admin_Form_Department_Edit();
		$form->setAction($this->view->baseUrl('admin/department/edit/id/' . $id));
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				$departmentModel->save(Application_Const::FORM_SAVE_MODE_EDIT, $form->getValues());
				$this->redirect('/admin/department');
			}
		} else
		{
			$form->populate($populate->toArray());
		}
		
		// Render form
		$this->view->form = $form;
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
		
		// Get mode
		$mode = (string) $this->getRequest()->getParam('mode');
		
		switch ($mode)
		{
			case 'subject':
				if ($selectRows)
				{
					$messageHandler->setSuccess();
					$departmentModel = new Admin_Model_Department_Subject();
					if ($departmentModel->deleteSelectedRows($selectRows))
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
				
				$messageHandler->addContext($this->getRequest()->getServer('HTTP_REFERER'), 'redirect');
				break;
			default:
				if ($selectRows)
				{
					$messageHandler->setSuccess();
					$departmentModel = new Admin_Model_Department();
					if ($departmentModel->deleteSelectedRows($selectRows))
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
				
				$messageHandler->addContext($this->view->baseUrl('admin/department'), 'redirect');
			break;
		}
		
		$this->getResponse()->setBody($messageHandler);
	}

	/**
	 * Delete by id
	 */
	public function deleteAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		
		// Get mode
		$mode = (string) $this->getRequest()->getParam('mode');
		
		switch ($mode)
		{
			case 'subject':
				// Get id
				$id = (int) $this->getRequest()->getParam('subject-id', 0);
		
				if ($id)
				{
					$departmentModel = new Admin_Model_Department_Subject();
					if ($departmentModel->deleteSelectedRows(array($id)))
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
				
				$this->_redirect($this->getRequest()->getServer('HTTP_REFERER'));
				break;
			default:
				// Get id
				$id = (int) $this->getRequest()->getParam('id', 0);
				
				if ($id)
				{
					$departmentModel = new Admin_Model_Department();
					if ($departmentModel->deleteSelectedRows(array($id)))
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
				
				$this->_redirect('/admin/department');
				break;
		}
		
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
		
		if ($selectRows)
		{
			// Get status value
			$status = (int) $this->getRequest()->getParam('status', 0);
			
			$messageHandler->setSuccess();
			$departmentModel = new Admin_Model_Department();
			if ($departmentModel->updateStatus($selectRows, $status))
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
		
		$messageHandler->addContext($this->view->baseUrl('admin/department'), 'redirect');
		
		$this->getResponse()->setBody($messageHandler);
	}

	/**
	 * Get all subjects assigned for department by department id
	 */
	public function getSubjectsAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
		$messageHandler->addContext(null, 'htmlSubjects');
		
		// Get department id
		$departmentId = (int) $this->getRequest()->getParam('department', 0);
		
		// Init class department subject
		$departmentSubjectModel = new Admin_Model_Department_Subject();
		$departmentSubjectRows = $departmentSubjectModel->getByDepartment(array($departmentId));
		
		// Teacher form
		$teacherForm = new Admin_Form_Teacher();
		$teacherSubjectElement = $teacherForm->getElement('teacher_subject');
		$teacherSubjectElement->clearMultiOptions();
		
		if ($departmentSubjectRows->count())
		{
			foreach ($departmentSubjectRows as $subjectRow)
			{
				$teacherSubjectElement->addMultiOption($subjectRow->subject_id, $subjectRow->subject_name);
			}
			
			$messageHandler->setSuccess();
			$messageHandler->addContext($teacherSubjectElement->render(), 'htmlSubjects');
		}
		
		$this->getResponse()->setBody($messageHandler);
	}
	
	/**
	 * Get all classes belong to department by department id
	 */
	public function getClassesAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
		$messageHandler->addContext(null, 'htmlSubjects');
	
		// Get department id
		$departmentId = (int) $this->getRequest()->getParam('department-id', 0);
	
		// Init class department subject
		$departmentClassesModel = new Admin_Model_Department_Classes();
		$departmentClassRows = $departmentClassesModel->getByDepartment(array($departmentId));
		
		if ($departmentClassRows->count())
		{
			$messageHandler->setSuccess();
			$classesOptions = array();
			foreach ($departmentClassRows as $classRow)
			{
				$classesOptions[$classRow->class_id] = $classRow->class_name;
			}
			$messageHandler->addContext($classesOptions, 'CLASSES_OPTIONS');
		}
		 
		$this->getResponse()->setBody($messageHandler);
	}
}