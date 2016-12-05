<?php

class Default_Db_Table_Exam_Question extends Lumia_Db_Table
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
        $select->order(new Zend_Db_Expr('RAND()'));
        
        return $this->fetchAll($select);
    }
    
    /**
     * Get question by id
     *
     * @param 	int $questionId
     * @return 	Zend_Db_Table_Row_Abstract
     */
    public function getById($questionId) 
    {
    	$questionId = (int) $questionId;
    	if (!$questionId)
    	{
    		return false;
    	}
    	
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->joinInner('core_question', 'question_id = exam_question_question');
        $select->where('question_id = ?', $questionId);
        $select->where('question_status = ?', 1);
        $select->limit(1);
    
        return $this->fetchRow($select);
    }
}
