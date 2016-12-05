<?php
class Admin_Form_Role extends Lumia_Form
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
		$this->setName('roleForm');
		$this->setMethod(self::METHOD_POST);
		
		// Id
		$id = new Zend_Form_Element_Hidden('role_id');
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
		$name = new Zend_Form_Element_Text('role_name');
		$name->setOptions(array(
				'label' => 'RoleForm:@Name',
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
		$email = new Zend_Form_Element_Text('role_code');
		$email->setOptions(array(
				'label' => 'RoleForm:@Code',
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
		$status = new Zend_Form_Element_Radio('role_status');
		$status->setOptions(array(
				'label' => 'RoleForm:@Status',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						1 => 'RoleForm:@Status active',
						0 => 'RoleForm:@Status inactive'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($status);
		
		// Privileges
		$this->_privilegesForm = new Zend_Form_SubForm();
		$this->addSubForm($this->_privilegesForm, 'dependencyPrivileges');
		$this->_privilegesForm();
				
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
		if ($privilegeRows->count())
		{
			foreach ($privilegeRows as $privilegeRow)
			{
				$privilegeForm = new Zend_Form_SubForm();
				$privilegeForm->setElementsBelongTo('role_privileges[' . $privilegeRow->privilege_module . '][' . $privilegeRow->privilege_controller . ']');
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
		}
		
		$this->getView()->headScript()->appendScript(PHP_EOL . 'jQuery(document).ready(function(){'
        . PHP_EOL . '	LumiaJS.dataTable.set(\'' . $this->getName() . '\');'
       	. PHP_EOL . '});');
	}

    /**
     * Validate the form
     *
     * @param  array $data
     * @throws Zend_Form_Exception
     * @return bool
     */
    public function isValid($data)
    {
    	$isValid = parent::isValid($data);
    	if ($isValid && isset($data['role_code']) && in_array($data['role_code'], array(Lumia_Const::ROLE_CODE_ADMIN)))
    	{
    		$this->getElement('role_code')->addError('Validate:@A record matching \'%value%\' was found');
    		$isValid = false;
    	}
    	
    	return $isValid;
    }
}
