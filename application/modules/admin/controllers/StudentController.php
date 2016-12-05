<?php

class Admin_StudentController extends Admin_Controller
{

	/**
	 * All students
	 */
	public function indexAction()
	{
		$studentDataGrid = new Admin_DataGrid_Student();
		$this->view->grid = $studentDataGrid->deploy();
	}

	/**
	 * Add new
	 */
	public function addAction()
	{
		// Get form for this action
		$form = new Admin_Form_Student_Add();
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				// Init model
				$studentModel = new Admin_Model_Student();
				$studentModel->save(Application_Const::FORM_SAVE_MODE_ADD, $form->getValues());
				$this->redirect('/admin/student');
			}
		} else 
		{
			$form->populate(array(
					'address_country' => Application_Const::DEFAULT_COUNTRY_CODE,
					'user_status' => Admin_Const::DEFAULT_STATUS_CODE
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
		$studentModel = new Admin_Model_Student();
		$populate = $studentModel->getById($id);
		if (!$populate)
		{
			$this->redirect('/admin/student');
		}

		// Get form for this action
		$form = new Admin_Form_Student_Edit();
		$form->setAction($this->view->baseUrl('admin/student/edit/id/' . $id));
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				$studentModel->save(Application_Const::FORM_SAVE_MODE_EDIT, $form->getValues());
				$this->redirect('/admin/student');
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
			$studentModel = new Admin_Model_Student();
			if ($studentModel->deleteSelectedRows($selectRows))
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
		
		$messageHandler->addContext($this->view->baseUrl('admin/student'), 'redirect');
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
			$studentModel = new Admin_Model_Student();
			if ($studentModel->deleteSelectedRows(array($id)))
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
		
		$this->_redirect('/admin/student');
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
			$studentModel = new Admin_Model_Student();
			if ($studentModel->updateStatus($selectRows, $status))
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
		
		$messageHandler->addContext($this->view->baseUrl('admin/student'), 'redirect');
		$this->getResponse()->setBody($messageHandler);
	}
}