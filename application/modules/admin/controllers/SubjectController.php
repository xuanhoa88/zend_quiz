<?php

class Admin_SubjectController extends Admin_Controller
{
	/**
	 * All subjects
	 */
	public function indexAction()
	{
		$subjectDataGrid = new Admin_DataGrid_Subject();
		$this->view->grid = $subjectDataGrid->deploy();
	}
	
	/**
	 * Add new
	 */
	public function addAction()
	{
		// Get deparment id
		$deparment = (int) $this->getRequest()->getParam('department', 0);
		
		// Get form for this action
		$form = new Admin_Form_Subject_Add();
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				// Init model
				$departmentModel = new Admin_Model_Subject();
				$departmentModel->save(Application_Const::FORM_SAVE_MODE_ADD, $form->getValues());
				$this->redirect('/admin/subject');
			}
		} else
		{
			$form->populate(array(
					'subject_status' => Admin_Const::DEFAULT_STATUS_CODE,
					'subject_department' => array($deparment)
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
		$subjectModel = new Admin_Model_Subject();
		$populate = $subjectModel->getById($id);
		$populate->subject_department = explode(',', $populate->subject_department);
		
		if (!$populate)
		{
			$this->redirect('/admin/subject');
		}

		// Get form for this action
		$form = new Admin_Form_Subject_Edit();
		$form->setAction($this->view->baseUrl('admin/subject/edit/id/' . $id));
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				$subjectModel->save(Application_Const::FORM_SAVE_MODE_EDIT, $form->getValues());
				$this->redirect('/admin/subject');
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
		
		if ($selectRows)
		{
			$messageHandler->setSuccess();
			$subjectModel = new Admin_Model_Subject();
			if ($subjectModel->deleteSelectedRows($selectRows))
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
		
		$messageHandler->addContext($this->view->baseUrl('admin/subject'), 'redirect');
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
			$subjectModel = new Admin_Model_Subject();
			if ($subjectModel->deleteSelectedRows(array($id)))
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
		
		$this->_redirect('/admin/subject');
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
			$subjectModel = new Admin_Model_Subject();
			if ($subjectModel->updateStatus($selectRows, $status))
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
		
		$messageHandler->addContext($this->view->baseUrl('admin/subject'), 'redirect');
		$this->getResponse()->setBody($messageHandler);
	}
	
	/**
	 * Get chapter by subject
	 */
	public function getChapterAction()
    {
    	$this->_helper->viewRenderer->setNoRender(true);
    	$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
    	$messageHandler->setError();
    	
    	// Get subject
    	$subjectId = (int) $this->getRequest()->getParam('subject-id', 0);
    	
    	$chapterModel = new Admin_Model_Subject_Chapter();
    	$chapterRows = $chapterModel->getBySubject(array($subjectId));
    	if ($chapterRows->count())
    	{
    		$messageHandler->setSuccess();
    		$chapterOptions = array();
    		foreach ($chapterRows as $chapterRow)
    		{
    			$chapterOptions[$chapterRow->chapter_id] = $chapterRow->chapter_name;
    		}
    		$messageHandler->addContext($chapterOptions, 'CHAPTER_OPTIONS');
    	}
    	
    	$this->getResponse()->setBody($messageHandler);
    }    
}