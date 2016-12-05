<?php

class Admin_Db_Table_Exam_Management extends Lumia_Db_Table
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
     * Get exam management information by exam id
     * 
     * @param	int $id
     * @return	false|object
     */
    public function getByExamId($id) 
    {
    	$id = (int) $id;
    	if (!$id)
    	{
    		return false;
    	}
    	
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
    	$select->where('exam_management_exam = ?', $id);
    	
    	return $this->fetchRow($select);
    }
}
