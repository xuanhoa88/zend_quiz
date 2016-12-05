<?php

class Admin_Db_Table_Exam_Question_Answer extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'exam_answer_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_exam_answer';
    
    /**
     * Get student's anwswers according to exam and student
     * 
     * @param	int $examId
     * @return	Zend_Db_Table_Rowset_Abstract
     */
    public function getByExam($examId)
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
    	$select->where('exam_answer_exam = ?', (int) $examId);
    	$select->order('exam_answer_question ASC');
    	
    	return $this->fetchAll($select);
    }
}
