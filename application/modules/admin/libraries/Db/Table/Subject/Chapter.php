<?php

class Admin_Db_Table_Subject_Chapter extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'chapter_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_chapter';

    /**
     * Get all chapters activate
     *
     * @return Zend_Db_Table_Row_Abstract
     */
    public function allActivate() 
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->where('chapter_status = ?', 1);
        
        return $this->fetchAll($select);
    }

    /**
     * Get all chapters by subject id
     *
     * @param	array $subjects
     * @return Zend_Db_Table_Row_Abstract
     */
    public function dataGridBySubject(array $subjects)
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
    	$select->joinInner('core_subject', 'subject_id = chapter_subject');
    	$select->where('subject_id IN (?)', $subjects);
    	$select->order('chapter_order ASC');
    	$select->order('chapter_id ASC');
    	$select->order('chapter_name ASC');
    	
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
        $select->joinInner('core_subject', 'subject_id = chapter_subject');
        $select->where('chapter_id = ?', $id);
        
        return $this->fetchRow($select);
	}

    /**
     * Get all chapters by subject id
     *
     * @param	array $subjects
     * @return false|array
     */
    public function getBySubject(array $subjects)
    {
    	$select = $this->dataGridBySubject($subjects)->order(array('chapter_order ASC', 'chapter_name ASC'));
    	
    	return $this->fetchAll($select);
    }
    
}
