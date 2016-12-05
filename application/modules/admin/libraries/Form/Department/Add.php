<?php
class Admin_Form_Department_Add extends Admin_Form_Department
{
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'department/form/add.phtml';
	
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		$this->setAction($this->getView()->baseUrl('admin/department/add'));
		
		parent::init();
		
		// Code
		$this->getElement('department_code')->addValidator('Db_NoRecordExists', false, array('core_department', 'department_code'));
	}
}
