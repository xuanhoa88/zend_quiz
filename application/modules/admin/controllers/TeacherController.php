<?php

class Admin_TeacherController extends Admin_Controller
{
	/**
	 * All teachers
	 */
	public function indexAction()
	{
		$teacherDataGrid = new Admin_DataGrid_Teacher();
		$this->view->grid = $teacherDataGrid->deploy();
	}

	/**
	 * Add new
	 */
	public function addAction()
	{
		// Get form for this action
		$form = new Admin_Form_Teacher_Add();
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				// Init model
				$teacherModel = new Admin_Model_Teacher();
				$teacherModel->save(Application_Const::FORM_SAVE_MODE_ADD, $form->getValues());
				$this->redirect('/admin/teacher');
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
		$teacherModel = new Admin_Model_Teacher();
		$populate = $teacherModel->getById($id);
		$populate->teacher_subject = explode(',', $populate->teacher_subject);
		
		if (!$populate)
		{
			$this->redirect('/admin/teacher');
		}

		// Get form for this action
		$form = new Admin_Form_Teacher_Edit();
		$form->setAction($this->view->baseUrl('admin/teacher/edit/id/' . $id));
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				$teacherModel->save(Application_Const::FORM_SAVE_MODE_EDIT, $form->getValues());
				$this->redirect('/admin/teacher');
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
			$teacherModel = new Admin_Model_Teacher();
			if ($teacherModel->deleteSelectedRows($selectRows))
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
		
		$messageHandler->addContext($this->view->baseUrl('admin/teacher'), 'redirect');
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
			$teacherModel = new Admin_Model_Teacher();
			if ($teacherModel->deleteSelectedRows(array($id)))
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
		
		$this->_redirect('/admin/teacher');
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
			$teacherModel = new Admin_Model_Teacher();
			if ($teacherModel->updateStatus($selectRows, $status))
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
		
		$messageHandler->addContext($this->view->baseUrl('admin/teacher'), 'redirect');
		$this->getResponse()->setBody($messageHandler);
	}
}