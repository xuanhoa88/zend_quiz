<?php

class Admin_ChapterController extends Admin_Controller
{
	
	/**
	 * Initialize object
	 */
	public function init()
	{
		parent::init();
		
		// Get current subject id
		$subjectId = (int) $this->getRequest()->getParam('subject', 0);
		
		// Get subject information
		$subjectModel = new Admin_Model_Subject();
		$subjectRow = $subjectModel->getById($subjectId);

		if (empty($subjectRow->subject_id))
		{
			$this->_redirect('/admin/subject');
		}
		
		// Assign to view
		$this->view->subjectRow = $subjectRow;
	}
	
	/**
	 * All chapters according to subject id
	 */
	public function indexAction()
	{
		$chapterDataGrid = new Admin_DataGrid_Subject_Chapter(array(
			'subjectId' => $this->view->subjectRow->subject_id
		));
		$this->view->grid = $chapterDataGrid->deploy();
	}
	
	/**
	 * Add new
	 */
	public function addAction()
	{
		// Get form for this action
		$form = new Admin_Form_Subject_Chapter_Add();
		$form->setAction($this->view->baseUrl('admin/chapter/add/subject/' . $this->view->subjectRow->subject_id));
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				// Init model
				$departmentModel = new Admin_Model_Subject_Chapter();
				$departmentModel->save(Application_Const::FORM_SAVE_MODE_ADD, $form->getValues());
				$this->redirect('/admin/chapter/index/subject/' . $this->view->subjectRow->subject_id);
			}
		} else
		{
			$form->populate(array(
					'chapter_order' => 0,
					'chapter_subject' => $this->view->subjectRow->subject_id,
					'chapter_status' => Admin_Const::DEFAULT_STATUS_CODE,
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
		$chapterModel = new Admin_Model_Subject_Chapter();
		$populate = $chapterModel->getById($id);
		if (!$populate)
		{
			$this->redirect('/admin/chapter/index/subject/' . $this->view->subjectRow->subject_id);
		}

		// Get form for this action
		$form = new Admin_Form_Subject_Chapter_Edit();
		$form->setAction($this->view->baseUrl('admin/chapter/edit/subject/' . $this->view->subjectRow->subject_id . '/id/' . $id));
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				$chapterModel->save(Application_Const::FORM_SAVE_MODE_EDIT, $form->getValues());
				$this->redirect('/admin/chapter/index/subject/' . $this->view->subjectRow->subject_id);
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
			$chapterModel = new Admin_Model_Subject_Chapter();
			if ($chapterModel->deleteSelectedRows($selectRows))
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
		
		$messageHandler->addContext($this->view->baseUrl('admin/chapter/index/subject/' . $this->view->subjectRow->subject_id), 'redirect');
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
			$chapterModel = new Admin_Model_Subject_Chapter();
			if ($chapterModel->deleteSelectedRows(array($id)))
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
		
		$this->_redirect('/admin/chapter/index/subject/' . $this->view->subjectRow->subject_id);
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
			$chapterModel = new Admin_Model_Subject_Chapter();
			if ($chapterModel->updateStatus($selectRows, $status))
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
		
		$messageHandler->addContext($this->view->baseUrl('admin/chapter/index/subject/' . $this->view->subjectRow->subject_id), 'redirect');
		$this->getResponse()->setBody($messageHandler);
	}
	
	/**
	 * Update order
	 */
	public function orderAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
	
		// Get selected rows
		$selectRows = (array) $this->getRequest()->getParam('chapter_order', null);
	
		if ($selectRows)
		{
			$chapterModel = new Admin_Model_Subject_Chapter();
			$chapterModel->updateOrder($selectRows);
		} 
	
		$this->_redirect('/admin/chapter/index/subject/' . $this->view->subjectRow->subject_id);
	}
}