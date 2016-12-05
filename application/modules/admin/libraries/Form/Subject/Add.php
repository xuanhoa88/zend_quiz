<?php
class Admin_Form_Subject_Add extends Admin_Form_Subject
{
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'subject/form/add.phtml';
	
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		$this->setAction($this->getView()->baseUrl('admin/subject/add'));
		
		parent::init();
		
		// Name
		$this->getElement('subject_name')->addValidator('Db_NoRecordExists', false, array('core_subject', 'subject_name'));
		
		// Code
		$this->getElement('subject_code')->addValidator('Db_NoRecordExists', false, array('core_subject', 'subject_code'));
	}
}
