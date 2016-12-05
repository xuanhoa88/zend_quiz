<?php
class Admin_Form_Teacher_Add extends Admin_Form_Teacher
{
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'teacher/form/add.phtml';
	
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		$this->setAction($this->getView()->baseUrl('admin/teacher/add'));
		
		parent::init();
		
		// Code
		$this->getElement('teacher_code')->addValidator('Db_NoRecordExists', false, array('core_teacher', 'teacher_code'));
		
		// Email
		$email = new Zend_Form_Element_Text('user_email');
		$email->setOptions(array(
				'label' => 'TeacherForm:@Email address',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array(
					'EmailAddress',
					array('Db_NoRecordExists', false, array('core_user', 'user_email'))
				),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($email);
		
		// Username
		$username = new Zend_Form_Element_Text('account_username');
		$username->setOptions(array(
				'label' => 'TeacherForm:@Username',
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'decorators' => array('ViewHelper'),
				'validators' => array(
					array('Db_NoUserExists', false, array('core_user', 'user_name'))
				),
				'autocomplete' => 'off',
				'readonly' => 'true'
		));
		$this->addElement($username);
		
		// Password
		$password = new Zend_Form_Element_Password('account_password');
		$password->setOptions(array(
				'label' => 'TeacherForm:@Password',
				'required' => true,
				'filters' => array(
						'StripTags'
				),
				'validators' => array(
						array('StringLength', false, array('min' => 6, 'max' => 64))
				),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$password->setRenderPassword(true);
		$this->addElement($password);
		
		// Confirm password
		$verifyPassword = new Zend_Form_Element_Password('account_verify_password');
		$verifyPassword->setOptions(array(
				'label' => 'TeacherForm:@Verify password',
				'required' => true,
				'filters' => array(
						'StripTags'
				),
				'validators' => array(
						array('VerifyPassword', false, array('token' => 'account_password'))
				),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$verifyPassword->setRenderPassword(true);
		$this->addElement($verifyPassword);
	}
}
