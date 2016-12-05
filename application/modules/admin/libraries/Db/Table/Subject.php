<?php

class Admin_Db_Table_Subject extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'subject_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_subject';

    /**
     * Get all subjects activate
     *
     * @return Zend_Db_Table_Row_Abstract
     */
    public function allActivate() 
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->where('subject_status = ?', 1);
        
        return $this->fetchAll($select);
    }
    
    /**
     * Get all subjects by department id
     *
     * @param	int $department
     * @return Zend_Db_Table_Row_Abstract
     */
    public function dataGridByDepartment($department)
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
    	$select->joinInner('core_department_subject', 'department_subject_subject = subject_id');
    	$select->joinInner('core_department', 'department_id = department_subject_department');
    	$select->where('department_id = ?', $department);
    
    	return $select;
    }

    /**
     * Get all subjects
     *
     * @param	int $department
     * @return Zend_Db_Table_Row_Abstract
     */
    public function dataGrid()
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
    
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
        $select->joinLeft('core_department_subject', 'department_subject_subject = subject_id', new Zend_Db_Expr('GROUP_CONCAT(DISTINCT department_subject_department ORDER BY department_subject_department) AS subject_department'));
        $select->where('subject_id = ?', $id);
        $select->group('subject_id');
        
        return $this->fetchRow($select);
	}
    
}
