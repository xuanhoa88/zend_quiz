<?php

class Admin_Db_Table_Department_Subject extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'department_subject_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_department_subject';

    /**
     * Get by department id
     *
     * @param	array $departments
     * @return	object
     */
    public function getByDepartment(array $departments)
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
    	$select->joinInner('core_subject', 'subject_id = department_subject_subject');
    	$select->joinInner('core_department', 'department_id = department_subject_department');
    	$select->where('subject_status = ?', 1);
    	$select->where('department_id IN (?)', $departments);
    
    	return $this->fetchAll($select);
    }
}
