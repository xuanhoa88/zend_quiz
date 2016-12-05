<?php
class Admin_Form_User_Profile extends Lumia_Form
{
	/**
	 * User Id
	 * 
	 * @var int
	 */
	protected $_userId = 0;
	
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'user/form/profile.phtml';
	
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		parent::init();

		// Set the form's attributes
		$this->setName('userProfileForm');
		$this->setMethod(self::METHOD_POST);
		
		// Name
		$name = new Zend_Form_Element_Text('user_name');
		$name->setOptions(array(
				'label' => 'UserForm:@Name',
				'required' => false,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'readonly' => 'readonly'
		));
		$this->addElement($name);
		
		// Fullname
		$name = new Zend_Form_Element_Text('user_fullname');
		$name->setOptions(array(
				'label' => 'UserForm:@Full name',
				'required' => false,
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
	 * Validate the form
	 *
	 * @param  array $data
	 * @throws Zend_Form_Exception
	 * @return bool
	 */
	public function isValid($data)
	{
		$this->populate($data);
		
		// Name
		$this->getElement('user_name')->addValidator('Db_NoRecordExists', false, array(
				'table' => 'core_user',
				'field' => 'user_name',
				'exclude' => array(
						'field' => 'user_id',
						'value' => $this->_userId
				)
		));
		
		// Email
		$this->getElement('user_email')->addValidator('Db_NoRecordExists', false, array(
				'table' => 'core_user',
				'field' => 'user_email',
				'exclude' => array(
						'field' => 'user_id',
						'value' => $this->_userId
				)
		));
		
		return parent::isValid($data);
	}
	
	/**
	 * Sets user id
	 * 
	 * @param	int $userId
	 * @return	Admin_Form_Profile
	 */
	public function setUserId($userId) 
	{
		$this->_userId = (int) $userId;
		
		return $this;
	}
}
