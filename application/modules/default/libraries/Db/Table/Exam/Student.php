<?php

class Default_Db_Table_Exam_Student extends Lumia_Db_Table
{
	/**
	 * Column for the primary key
	 *
	 * @var string
	 */
	protected $_primary = 'exam_student_id';

	/**
	 * Holds the table's name
	 *
	 * @var string
	 */
	protected $_name = 'core_exam_student';

	/**
	 * Get exam management by student id
	 *
	 * @param array $students      	
	 * @return Zend_Db_Table_Row_Abstract
	 */
	public function dataGrid(array $students)
	{
		$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
		$select->joinInner('core_exam_management', 'exam_management_id = exam_student_exam_management');
		$select->joinInner('core_exam', 'exam_id = exam_management_exam');
		$select->joinInner('core_subject', 'exam_subject = subject_id');
		$select->where('exam_status = ?', 1);
		$select->where('exam_student_student IN (?)', $students);
		$select->order(array('exam_student_executed ASC'));
		
		return $select;
	}

	/**
	 * Add flag to check exam has been completed
	 * 
	 * @param array $where
	 * @return number
	 */
	public function finishExam(array $where)
	{
		return $this->update(array(
			'exam_student_executed' => 1,
			'exam_student_end_time' => Lumia_Utility_DateTime::getInstance()->toMysql()
		), array(
			'exam_student_exam_management IN ?' => $this->getAdapter()->select()->from('core_exam_management', 'exam_management_id')->where('exam_management_exam = ?', isset($where['examId']) ? (int) $where['examId'] : 0), 
			'exam_student_student = ?' => (int) Default_Auth::getInstance()->getStudent()->student_id
		));
	}
}
