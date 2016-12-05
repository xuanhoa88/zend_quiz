<?php

class Admin_Db_Table_Exam_Score extends Lumia_Db_Table
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
     * Get all students by exam id
     *
     * @param	array $students
     * @return Zend_Db_Table_Row_Abstract
     */
    public function getStudentsByExam(array $examId)
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)->reset(self::COLUMNS);
    	$select->joinInner('core_student', 'student_id = exam_student_student', array('student_id', 'student_name', 'student_code', 'student_birth', 'student_gender', 'student_identification'));
    	$select->joinInner('core_exam_management', 'exam_management_id = exam_student_exam_management', null);
    	$select->joinInner('core_exam', 'exam_id = exam_management_exam', array('exam_mark'));
    	$select->joinInner('core_classes', 'class_id = student_class', null);
    	$select->joinInner('core_department', 'department_id = class_department', null);
    	$select->joinLeft('core_address', 'address_id = student_address', array('address_line'));
    	$select->where('exam_id IN (?)', $examId);
    	$select->where(new Zend_Db_Expr('DATE_ADD(exam_management_start_time, INTERVAL exam_management_execution_duration MINUTE) < NOW()'));
    	$select->columns(new Zend_Db_Expr('CONCAT_WS(\' / \', class_name, department_name) AS combine_class_department'));
    	
    	return $select;
    }
}
