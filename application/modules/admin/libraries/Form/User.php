<?php
class Admin_Form_User extends Lumia_Form
{
	/**
	 * @var	Zend_Form_SubForm
	 */
	protected $_privilegesForm;
	
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		parent::init();

		// Set the form's attributes
		$this->setName('userForm');
		$this->setMethod(self::METHOD_POST);
		
		// Id
		$id = new Zend_Form_Element_Hidden('user_id');
		$id->setOptions(array(
				'required' => false,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'decorators' => array('ViewHelper')
		));
		$this->addElement($id);

		// Name
		$name = new Zend_Form_Element_Text('user_name');
		$name->setOptions(array(
				'label' => 'UserForm:@Name',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($name);

		// Email
		$email = new Zend_Form_Element_Text('user_email');
		$email->setOptions(array(
				'label' => 'UserForm:@Email',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($email);

		// Status
		$status = new Zend_Form_Element_Radio('user_status');
		$status->setOptions(array(
				'label' => 'UserForm:@Status',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						1 => 'UserForm:@Status active',
						0 => 'UserForm:@Status inactive'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($status);
		
		// Role
		$userRole = new Zend_Form_Element_Select('user_role');
		$userRole->setOptions(array(
				'label' => 'UserForm:@Role',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'onChange' => 'LumiaJS.admin.user.form.getPrivilegesAccordingRole(this)',
				'multiOptions' => array(null => 'Form:@Unselected'),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper')
		));
		
		$userRoleModel = new Admin_Model_Role();
		$userRoleRows = $userRoleModel->allActivate();
		if ($userRoleRows->count())
		{
			if (Admin_Auth::getInstance()->isAdmin())
			{
				$userRole->addMultiOption(Lumia_Const::ROLE_CODE_ADMIN, $this->getTranslator()->translate('RoleLabel:@Admin'));
			}
			
			foreach ($userRoleRows as $userRoleRow)
			{
				$userRole->addMultiOption($userRoleRow->role_code, $userRoleRow->role_name);
			}
		}
		
		$this->addElement($userRole);
		
		// Password
		$password = new Zend_Form_Element_Password('user_password');
		$password->setOptions(array(
				'label' => 'UserForm:@Password',
				'required' => false,
				'filters' => array('StripTags'),
				'validators' => array(
						array('StringLength', false, array('min' => 6, 'max' => 64))
				),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$password->setRenderPassword(true);
		$this->addElement($password);
		
		// Confirm password
		$verifyPassword = new Zend_Form_Element_Password('user_verify_password');
		$verifyPassword->setOptions(array(
				'label' => 'UserForm:@Verify password',
				'required' => true,
				'filters' => array('StripTags'),
				'validators' => array(
						array('VerifyPassword', false, array('token' => 'user_password'))
				),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$verifyPassword->setAutoInsertNotEmptyValidator(false);
		$verifyPassword->setRenderPassword(true);
		$this->addElement($verifyPassword);
		
		// Privileges
		$this->_privilegesForm = new Zend_Form_SubForm();
		$this->addSubForm($this->_privilegesForm, 'dependencyPrivileges');
		$this->_privilegesForm();
		
		// Privileges according to role
		$this->_rolePrivilegesForm();
		
		// Save button
		$submit = new Zend_Form_Element_Submit('btnSave');
		$submit->setOptions(array(
				'label' => 'Form:@Button save',
				'decorators' => array('ViewHelper')
		));
		$this->addElement($submit);

		// Reset button
		$submit = new Zend_Form_Element_Button('btnReset');
		$submit->setOptions(array(
				'label' => 'Form:@Button reset',
				'type' => 'reset',
				'decorators' => array('ViewHelper')
		));

		$this->addElement($submit);
	}
	
	/**
	 * Generate privileges form
	 *
	 * @return	void
	 */
	protected function _privilegesForm()
	{
		// Init privilege model
		$privilegeModel = new Lumia_Model_Privilege();
		$privilegeRows = $privilegeModel->allActivate();
		if ($privilegeRows->count() > 0)
		{
			foreach ($privilegeRows as $privilegeRow)
			{
				$privilegeForm = new Zend_Form_SubForm();
				$privilegeForm->setElementsBelongTo('user_privileges[' . $privilegeRow->privilege_module . '][' . $privilegeRow->privilege_controller . ']');
				$this->_privilegesForm->addSubForm($privilegeForm, $privilegeRow->privilege_module . $privilegeRow->privilege_controller . $privilegeRow->privilege_code);
				
				// Add specific privilege
				$privilegeElement = new Zend_Form_Element_Checkbox($privilegeRow->privilege_code);
				$privilegeElement->setOptions(array(
						'label' => $privilegeRow->privilege_description,
						'data-target' => 'row',
						'decorators' => array('ViewHelper')
				));
				$privilegeForm->addElement($privilegeElement);
			}
			
			$this->getView()->headScript()->appendScript(PHP_EOL . 'jQuery(document).ready(function(){'
        	. PHP_EOL . '	LumiaJS.dataTable.set(\'' . $this->getName() . '\');'
       		. PHP_EOL . '});');
		}
	}
	
	/**
	 * Generate privileges according to role form
	 * 
	 * @return void
	 */
	protected function _rolePrivilegesForm()
	{
		// Init model
		$roleModel = new Admin_Model_Role();
		$permissionModel = new Lumia_Model_Permission();
		$privilegeModel = new Lumia_Model_Privilege();
		
		// Assign into view
		$jsPrivileges = array();
		
		// Get active privileges
		$privilegeRows = $privilegeModel->allActivate();
		$defaultPrivileges = array();
		if ($privilegeRows->count() > 0)
		{
			foreach ($privilegeRows as $privilegeRow)
			{
				$element = new Zend_Form_Element_Checkbox($privilegeRow->privilege_code);
				$element->setBelongsTo('user_privileges[' . $privilegeRow->privilege_module . '][' . $privilegeRow->privilege_controller . ']');
				$defaultPrivileges[] = $element->getId();
			}
		}
		
		// Get active roles
		$roleRows = $roleModel->allActivate();
		if ($roleRows->count() > 0)
		{
			foreach ($roleRows as $roleRow)
			{
				$jsPrivileges[$roleRow->role_code] = array();
				$permissionRows = $permissionModel->getByRoleCode($roleRow->role_code);
				if ($permissionRows->count() > 0)
				{
					foreach ($permissionRows as $permissionRow)
					{
						$matches = preg_split('/\@/i', (string) $permissionRow->permission_resource, 3, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
						if (count($matches) > 2)
						{
							$element = new Zend_Form_Element_Checkbox((string) $matches[2]);
							$element->setBelongsTo('user_privileges[' . (string) $matches[0] . '][' . (string) $matches[1] . ']');
							$jsPrivileges[$permissionRow->permission_role][] = $element->getId();
						}
					}
				}
			}
		}
		
		// Set admin privileges
		$jsPrivileges[Lumia_Const::ROLE_CODE_ADMIN] = $defaultPrivileges;
		
		$this->getView()->headScript()->appendScript('LumiaJS.admin.user.form.setPermissionAccordingRole(' . Zend_Json::encode($jsPrivileges) . ');');
	}
}
