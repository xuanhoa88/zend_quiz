<?php
class Admin_Form_Classes_Add extends Admin_Form_Classes
{
	/**
	 * View script path
	 * 
	 * @var	string
	 */	
	protected $_viewScript = 'classes/form/add.phtml';
	
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		$this->setAction($this->getView()->baseUrl('admin/classes/add'));
		
		parent::init();
		
		// Code
		$this->getElement('class_code')->addValidator('Db_NoRecordExists', false, array('core_classes', 'class_code'));
	}
}
