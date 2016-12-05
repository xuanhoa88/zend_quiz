<?php

class Admin_Db_Table_Department_Classes extends Admin_Db_Table_Department
{
    /**
     * Get by department id
     *
     * @param	array $departments
     * @return	object
     */
    public function getByDepartment(array $departments)
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false)->reset(self::COLUMNS);
    	$select->joinInner('core_classes', 'class_department = department_id');
    	$select->where('class_status = ?', 1);
    	$select->where('department_id IN (?)', $departments);
    	
    	return $this->fetchAll($select);
    }
}
