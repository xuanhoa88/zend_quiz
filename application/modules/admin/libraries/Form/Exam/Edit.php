<?php
class Admin_Form_Exam_Edit extends Admin_Form_Exam
{
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'exam/form/edit.phtml';

	/**
	 * Validate the form
	 *
	 * @param  array $data
	 * @return boolean
	 */
	public function populate(array $data)
	{
		// Code
		$this->getElement('exam_code')->addValidator('Db_NoRecordExists', false, array(
				'table' => 'core_exam',
				'field' => 'exam_code',
				'exclude' => array(
						'field' => 'exam_id',
						'value' => isset($data['exam_id']) ? (int) $data['exam_id'] : 0
				)
		));
	
		return parent::populate($data);
	}
}
