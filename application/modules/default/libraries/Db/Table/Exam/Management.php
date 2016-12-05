<?php

class Default_Db_Table_Exam_Management extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'exam_management_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_exam_management';

    /**
     * Get exam management by exam id
     *
     * @param int $examId            
     * @return Zend_Db_Table_Row_Abstract
     */
    public function getByExam($examId) 
    {
    	$examId = (int) $examId;
    	$studentId = (int) Default_Auth::getInstance()->getStudent()->student_id;
    	if ($examId <= 0 || $studentId <= 0)
    	{
    		return null;
    	}
    	
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->joinInner('core_exam', 'core_exam.exam_id = core_exam_management.exam_management_exam');
        $select->joinInner('core_exam_student', 'core_exam_student.exam_student_exam_management = core_exam_management.exam_management_id');
        $select->joinInner('core_student', 'core_student.student_id = core_exam_student.exam_student_student');
        $select->joinInner('core_classes', 'core_classes.class_id = core_student.student_class');
        $select->joinInner('core_subject', 'core_subject.subject_id = core_exam.exam_subject');
        $select->joinInner('core_department', 'core_department.department_id = core_classes.class_department');
        $select->where('core_exam_management.exam_management_exam = ?', $examId);
        $select->where('core_exam_student.exam_student_student = ?', $studentId);
        $select->limit(1);
       
        return $this->fetchRow($select);
    }
    
}
