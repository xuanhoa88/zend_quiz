<?php
class Admin_Form_Role_Add extends Admin_Form_Role
{
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'role/form/add.phtml';
	
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		$this->setAction($this->getView()->baseUrl('admin/role/add'));
		
		parent::init();
		
		// Name
		$this->getElement('role_name')->addValidator('Db_NoRecordExists', false, array('core_role', 'role_name'));
		
		// Code
		$this->getElement('role_code')->addValidator('Db_NoRecordExists', false, array('core_role', 'role_email'));
	}
}
