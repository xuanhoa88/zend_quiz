<?php

class Admin_Db_Table_Exam_Question extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'exam_question_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_exam_question';
	
    /**
     * Get questions by exam id
     * 
     * @param	array $exams
     * @return	false|array
     */
    public function getByExamAndSubject($examId, $subjectId)
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)->reset(self::COLUMNS);
    	$select->joinInner('core_question', 'question_id = exam_question_question', array('question_chapter', 'question_level', 'question_type'));
    	$select->joinInner('core_question_level', 'question_level_code = question_level', null);
    	$select->joinInner('core_subject', 'subject_id = question_subject', null);
    	$select->joinInner('core_chapter', 'chapter_id = question_chapter', null);
    	$select->where('exam_question_exam = ?', (int) $examId);
    	$select->where('question_subject = ?', (int) $subjectId);
    	$select->group(array('question_chapter', 'question_level', 'question_type'));
    	$select->columns(new Zend_Db_Expr('COUNT(question_id) AS total_number_question'));
    	
    	return $this->fetchAll($select);
    }

    /**
     * Get all questions by exam id
     *
     * @param int $examId            
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getByExam($examId) 
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->joinInner('core_question', 'question_id = exam_question_question');
        $select->where('exam_question_exam = ?', (int) $examId);
        $select->where('question_status = ?', 1);
        $select->where('question_type = ?', Application_Const::QUESTION_TYPE_TEST);
        
        return $this->fetchAll($select);
    }
    
}
