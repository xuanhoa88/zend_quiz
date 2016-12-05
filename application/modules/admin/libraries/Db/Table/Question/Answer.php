<?php

class Admin_Db_Table_Question_Answer extends Lumia_Db_Table
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
	 * Get by question id
	 * 
	 * @param	array $questions
	 * @return	false|array
	 */
	public function getByQuestion(array $questions)
	{
		$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
		$select->joinInner('core_question', 'question_id = answer_question', null);
        $select->where('question_id IN (?)', $questions);
        
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
