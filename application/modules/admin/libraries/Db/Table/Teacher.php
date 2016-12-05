<?php

class Admin_Db_Table_Teacher extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'teacher_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_teacher';
    
    /**
     * Get all teachers activate
     *
     * @return Zend_Db_Table_Row_Abstract
     */
    public function allActivate() 
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->joinInner('core_user', 'user_id = teacher_user');
        $select->where('user_status = ?', 1);
        
        return $this->fetchAll($select);
    }
    
    /**
     * Get all teachers
     *
     * @return Zend_Db_Table_Row_Abstract
     */
    public function dataGrid()
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
    	$select->joinInner('core_department', 'department_id = teacher_department');
    	$select->joinInner('core_user', 'user_id = teacher_user');
    	
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
        $select->joinLeft('core_address', 'address_id = teacher_address');
        $select->joinInner('core_user', 'user_id = teacher_user');
        $select->joinLeft('core_teacher_subject', 'teacher_subject_teacher = teacher_id', new Zend_Db_Expr('GROUP_CONCAT(DISTINCT teacher_subject_subject ORDER BY teacher_subject_subject) AS teacher_subject'));
        $select->where('teacher_id = ?', $id);
        $select->group('teacher_id');
        
        return $this->fetchRow($select);
	}
	
	/**
	 * Get by user id
	 *
	 * @param	int $userId
	 * @return	false|object
	 */
	public function getByUser($userId)
	{
		$userId = (int) $userId;
		if (!$userId)
		{
			return false;
		}
	
		$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
		$select->joinInner('core_user', 'user_id = teacher_user');
		$select->where('user_id = ?', $userId);
		$select->limit(1);
	
		return $this->fetchRow($select);
	}
    
}
