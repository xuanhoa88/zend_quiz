<?php
class Admin_Form_Student_Edit extends Admin_Form_Student
{
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'student/form/edit.phtml';
	
	/**
	 * Validate the form
	 *
	 * @param  array $data
	 * @return boolean
	 */
	public function isValid($data)
	{
		$this->populate($data);
		
		// Code
		$this->getElement('student_code')->addValidator('Db_NoRecordExists', false, array(
				'table' => 'core_student',
				'field' => 'student_code',
				'exclude' => array(
						'field' => 'student_id',
						'value' => $this->getValue('student_id')
				)
		));
		
		return parent::isValid($data);
	}
}
