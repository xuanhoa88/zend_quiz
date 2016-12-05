<?php

class Admin_UserController extends Admin_Controller
{
	/**
     * Initialize object
     *
     * Called from {@link __construct()} as final step of object instantiation.
     *
     * @return void
     */
    public function init()
    {
        parent::init();
        
        // Assign translate into javascript
		$this->view->jsTranslate('UserForm:@The user will have been assigned fully privileges');	
	}
	
	/**
	 * All users
	 */
	public function indexAction()
	{
		$userDataGrid = new Admin_DataGrid_User();
		$this->view->grid = $userDataGrid->deploy();
	}

	/**
	 * Add new
	 */
	public function addAction()
	{
		// Get form for this action
		$form = new Admin_Form_User_Add();
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				// Init model
				$userModel = new Admin_Model_User();
				$userModel->save(Application_Const::FORM_SAVE_MODE_ADD, $form->getValues());
				$this->redirect('/admin/user');
			}
		} else
		{
			$form->populate(array(
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
		$userModel = new Admin_Model_User();
		$userRow = $userModel->getById($id);
		if (!$userRow)
		{
			$this->redirect('/admin/user');
		}
		
		// Generate data form
		$dataForm = $userRow->toArray();
		
		// Init permission model
		$permissionModel = new Lumia_Model_User_Permission();
		$permissionRow = $permissionModel->getByUser($userRow->user_id);
		
		// Inject privilege data
		$dataForm['user_privileges'] = array();
		
		if ($permissionRow)
		{
			$userPrivileges = array();
			try 
			{
				$permissionRow->permission_resource = Zend_Json::decode((string) $permissionRow->permission_resource);
			} catch (Zend_Json_Exception $e)
			{
				$permissionRow->permission_resource = array();
			}
			
			if ($permissionRow->permission_resource)
			{
				foreach ($permissionRow->permission_resource as $resource => $val)
				{
					$matches = preg_split('/\@/i', (string) $resource, 3, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
					if (count($matches) > 2)
					{
						$dataForm['user_privileges'][(string) $matches[0]][(string) $matches[1]][(string) $matches[2]] = 1;
					}
				}
			}
		}
		
		// Get form for this action
		$form = new Admin_Form_User_Edit();
		$form->setAction($this->view->baseUrl('admin/user/edit/id/' . $id));
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				$userModel->save(Application_Const::FORM_SAVE_MODE_EDIT, $form->getValues());
				$this->redirect('/admin/user');
			}
		} else
		{
			unset($dataForm['user_password']);
			$form->populate($dataForm);
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
			$userModel = new Admin_Model_User();
			if ($userModel->deleteSelectedRows($selectRows))
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
		
		$messageHandler->addContext($this->view->baseUrl('admin/user'), 'redirect');
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
			$userModel = new Admin_Model_User();
			if ($userModel->deleteSelectedRows(array($id)))
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
		
		$this->_redirect('/admin/user');
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
			$userModel = new Admin_Model_User();
			if ($userModel->updateStatus($selectRows, $status))
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
		
		$messageHandler->addContext($this->view->baseUrl('admin/user'), 'redirect');
		$this->getResponse()->setBody($messageHandler);
	}
	
	/**
	 * Rearrange navigation
	 */
	public function rearrangeNavbarAction()
	{
		// Get form for this action
		$form = new Admin_RearrangeNavbar($this->view);
		
		// Validate when submit form
		if ($this->getRequest()->isXmlHttpRequest())
		{
			$this->_helper->viewRenderer->setNoRender(true);
			
			$messageHandler = new Lumia_Message_Rest($this->getAjaxCallback());
			$messageHandler->setError();
			
			$sortable = $this->getRequest()->getParam('sortable');
			if (is_array($sortable))
			{
				$navigationRearrange = array();
				foreach ($sortable as $item)
				{
					$id = isset($item['item_id']) ? (int) $item['item_id'] : 0;
					if ($id <= 0) 
					{
						continue;
					}
					
					$navigationRearrange[$id] = array(
						'navigation_id' => $id,
						'navigation_left' => $item['left'],
						'navigation_right' => $item['right'],
						'navigation_depth' => $item['depth'],
					);
				}
				
				if ($navigationRearrange)
				{
					$messageHandler->setSuccess();
					
					// Init model
					$userModel = new Lumia_Model_User_Permission();
					$userModel->rearrangeNavbar($navigationRearrange, $this->view->userSession()->user_id);
					
					$messageHandler->addContext($this->view->baseUrl('/admin/user/rearrange-navbar'), 'redirect');
				}
				
				$this->getResponse()->setBody($messageHandler);
			}
		} else
		{
			// Render form
			$this->view->form = $form;
		}
	}
	
	/**
	 * Profile
	 */
	public function profileAction()
	{
		// Get user from session
		$userObj = Admin_Auth::getInstance()->getUser();
		
		// User id
		$id = (int) $userObj->user_id;
		
		// Init model
		$userModel = new Admin_Model_User();
		$userRow = $userModel->getById($id);
		if (!$userRow)
		{
			$this->redirect('/admin/user');
		}
		
		// Generate data form
		$dataForm = $userRow->toArray();
		
		// Get form for this action
		$form = new Admin_Form_User_Profile();
		$form->setUserId($id);
		$form->setAction($this->view->baseUrl('admin/user/profile'));
		
		// Validate when submit form
		if ($this->getRequest()->isPost())
		{
			if ($form->isValid($this->getRequest()->getPost()))
			{
				$formData = $form->getValues();
				$formData['user_id'] = $id;
				$userModel->save(Admin_Model_User::FORM_SAVE_MODE_SELF_UPDATE, $formData);
				$this->_helper->messenger('success')->addMessage($this->view->translate('Message:@The record has been successfully updated'));
				$this->redirect('/admin/user/profile');
			}
		} else
		{
			unset($dataForm['user_password']);
			$form->populate($dataForm);
		}
		
		// Render form
		$this->view->form = $form;
	}
}