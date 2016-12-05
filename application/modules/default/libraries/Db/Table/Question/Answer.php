<?php

class Default_Db_Table_Question_Answer extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'answer_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_answer';

    /**
     * Get all questions by id
     *
     * @param array $questions            
     * @return Zend_Db_Table_Row_Abstract
     */
    public function getByQuestion(array $questions) 
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->where('answer_question IN (?)', $questions);
        $select->order('answer_question ASC');
        $select->order(new Zend_Db_Expr('RAND()'));
        
        return $this->fetchAll($select);
    }
    
    /**
     * Get all answers correct by question id
     *
     * @param array $questions
     * @return Zend_Db_Table_Row_Abstract
     */
    public function getCorrectlyAnswers(array $questions) 
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
    	$select->where('answer_question IN (?)', $questions);
    	$select->where('answer_is_correct = ?', 1);
    	$select->order('answer_question ASC');
    
    	return $this->fetchAll($select);
    }
    
}
