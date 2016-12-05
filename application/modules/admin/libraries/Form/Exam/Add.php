<?php
class Admin_Form_Exam_Add extends Admin_Form_Exam
{
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'exam/form/add.phtml';
	
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		$this->setAction($this->getView()->baseUrl('admin/exam/add'));
		
		parent::init();
		
		// Code
		$this->getElement('exam_code')->addValidator('Db_NoRecordExists', false, array('core_exam', 'exam_code'));
	}
}
