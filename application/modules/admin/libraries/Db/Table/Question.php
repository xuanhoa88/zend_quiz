<?php

class Admin_Db_Table_Question extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'question_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_question';
    
    /**
     * Get all questions activate
     *
     * @return Zend_Db_Table_Row_Abstract
     */
    public function allActivate() 
    {
        return $this->fetchAll($this->getValidQuestions());
    }
    
    /**
     * Get all valid questions with conditions
     * 
     * @return	Zend_Db_Select
     */
    public function getValidQuestions()
    {
    	return $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)->where('question_status = ?', 1);
    }
    
    /**
     * Get all subjects by creator
     *
     * @param	int $creatorId
     * @return 	Zend_Db_Table_Row_Abstract
     */
    public function dataGridByCreator($creatorId)
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
    	$select->joinInner('core_question_level', 'question_level_code = question_level');
    	$select->joinInner('core_subject', 'subject_id = question_subject');
    	$select->joinInner('core_chapter', 'chapter_id = question_chapter');
//     	$select->where('question_creator = ?', (int) $creatorId);
    	
    	return $select;
    }
	
	/**
	 * Get by id
	 * 
	 * @param	int $id
	 * @return	false|object
	 */
	public function getById($id)
	{
		$id = (int) $id;
		if (!$id)
		{
			return false;
		}
		
		$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->where('question_id = ?', $id);
        
        return $this->fetchRow($select);
	}
    
	/**
	 * Get by chapters
	 * 
	 * @param	array $chapters
	 * @return	Zend_Db_Table_Rowset_Abstract
	 */
	public function getByChapter(array $chapters)
	{
		$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
		$select->joinInner('core_question_level', 'question_level_code = question_level', array('question_level_code'));
		$select->joinInner('core_subject', 'subject_id = question_subject', array('subject_id'));
		$select->joinInner('core_chapter', 'chapter_id = question_chapter', array('chapter_id'));
		$select->where('chapter_id IN (?)', $chapters);
		$select->where('question_status = ?', 1);
	
		return $this->fetchAll($select);
	}
}
