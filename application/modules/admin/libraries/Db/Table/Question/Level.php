<?php

class Admin_Db_Table_Question_Level extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'question_level_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_question_level';

    /**
     * Get all classes activate
     *
     * @return Zend_Db_Table_Row_Abstract
     */
    public function allActivate() 
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->where('question_level_status = ? ', 1);
        
        return $this->fetchAll($select);
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
        $select->where('question_level_id = ?', $id);
        
        return $this->fetchRow($select);
	}
    
}
