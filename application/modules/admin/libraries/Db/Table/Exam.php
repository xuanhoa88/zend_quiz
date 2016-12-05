<?php

class Admin_Db_Table_Exam extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'exam_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_exam';
    
    /**
     * Get all subjects by creator
     *
     * @param	int $creatorId
     * @return 	Zend_Db_Table_Select
     */
    public function dataGridByCreator($creatorId)
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
    	$select->joinInner('core_exam_management', 'exam_management_exam = exam_id', array('exam_management_start_time'));
    	$select->joinInner('core_subject', 'subject_id = exam_subject', array('subject_name'));
    	$select->group('exam_id');
    	Admin_Auth::getInstance()->isAdmin() || $select->where('exam_creator = ?', (int) $creatorId);
    	
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
        $select->where('exam_id = ?', $id);
        
        return $this->fetchRow($select);
	}
}
