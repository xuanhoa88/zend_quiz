<?php
class Admin_Form_User_Add extends Admin_Form_User
{
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'user/form/add.phtml';
	
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		$this->setAction($this->getView()->baseUrl('admin/user/add'));
		
		parent::init();
		
		// Name
		$this->getElement('user_name')->addValidator('Db_NoRecordExists', false, array('core_user', 'user_name'));
		
		// Email
		$this->getElement('user_email')->addValidator('Db_NoRecordExists', false, array('core_user', 'user_email'));
		
		// Password
		$this->getElement('user_password')->setRequired(true);
	}
}
