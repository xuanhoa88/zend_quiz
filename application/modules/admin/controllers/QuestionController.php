<?php

class Admin_QuestionController extends Admin_Controller
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
			'PageHeader:@Manage media files',
			'QuestionForm:@An error occurred in process generate answer form',
			'QuestionForm:@Insert file(s)'
		));
		
		$this->view->jsTranslate(array(
				'Uploadify:@Title error',
				'Uploadify:@The number of files selected exceeds the queue size limit (%d)',
				'Uploadify:@Button cancel',
				'Uploadify:@Flash was not detected',
				'Uploadify:@Select files',
				'Uploadify:@Are you sure you want to remove this item ?',
				'Uploadify:@Button yes',
				'Uploadify:@Button no',
				'Uploadify:@Title warning',
				'Uploadify:@Are you sure you want to perform this action ?',
				'Uploadify:@Please wait a moment'
		));
		
		$this->view->jsTranslate(array(
				'MediaForm:@Add new',
				'MediaForm:@Button upload'
		));
	}
	
	/**
	 * All questions
	 */
	public function indexAction()
	{
		$questionDataGrid = new Admin_DataGrid_Question();
		$this->view->grid = $questionDataGrid->deploy();
	}

	/**
	 * Add new
	 */
	public function addAction()
	{
		// Get form for this action
		$form = new Admin_Form_Question_Add();
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				// Init model
				$questionModel = new Admin_Model_Question();
				$questionModel->save(Application_Const::FORM_SAVE_MODE_ADD, $form->getValues());
				$this->redirect('/admin/question');
			}
		} else
		{
			$form->populate(array(
					'question_status' => Admin_Const::DEFAULT_STATUS_CODE
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
		
		// Init question model
		$questionModel = new Admin_Model_Question();
		$populate = $questionModel->getById($id);
		if (!$populate)
		{
			$this->redirect('/admin/question');
		}
		
		// Cast question data to array
		$questionRows = $populate->toArray();
		
		// Init answer model
		$answerModel = new Admin_Model_Question_Answer();
		$answerRows = $answerModel->getByQuestion(array($id));
		if ($answerRows->count())
		{
			$questionRows['answer'] = $answerRows->toArray();
		}
		
		// Get form for this action
		$form = new Admin_Form_Question_Edit();
		$form->setAction($this->view->baseUrl('admin/question/edit/id/' . $id));
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				$questionModel->save(Application_Const::FORM_SAVE_MODE_EDIT, $form->getValues());
				$this->redirect('/admin/question');
			}
		} else 
		{
			$form->populate($questionRows);
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
			$questionModel = new Admin_Model_Question();
			if ($questionModel->deleteSelectedRows($selectRows))
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
		
		$messageHandler->addContext($this->view->baseUrl('admin/question'), 'redirect');
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
			$questionModel = new Admin_Model_Question();
			if ($questionModel->deleteSelectedRows(array($id)))
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
		
		$this->_redirect('/admin/question');
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
			$questionModel = new Admin_Model_Question();
			if ($questionModel->updateStatus($selectRows, $status))
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
		
		$messageHandler->addContext($this->view->baseUrl('admin/question'), 'redirect');
		$this->getResponse()->setBody($messageHandler);
	}
}