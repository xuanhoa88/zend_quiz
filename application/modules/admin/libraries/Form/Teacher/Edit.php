<?php
class Admin_Form_Teacher_Edit extends Admin_Form_Teacher
{
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'teacher/form/edit.phtml';
	
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
		
		// Code
		$this->getElement('teacher_code')->addValidator('Db_NoRecordExists', false, array(
				'table' => 'core_teacher',
				'field' => 'teacher_code',
				'exclude' => array(
						'field' => 'teacher_id',
						'value' => $this->getValue('teacher_id')
				)
		));
		
		return parent::isValid($data);
	}
}
