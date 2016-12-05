<?php

class Admin_Db_Table_Student extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'student_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_student';

    /**
     * Get all students activate
     *
     * @return Zend_Db_Table_Row_Abstract
     */
    public function allActivate() 
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->joinInner('core_user', 'user_id = student_user');
        $select->where('user_status = ?', 1);
        
        return $this->fetchAll($select);
    }
    
    /**
     * Get all students
     *
     * @return Zend_Db_Table_Row_Abstract
     */
    public function dataGrid()
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
    	$select->joinInner('core_classes', 'class_id = student_class', null);
    	$select->joinInner('core_department', 'department_id = class_department', null);
    	$select->columns(new Zend_Db_Expr('CONCAT_WS(\' / \', class_name, department_name) AS class_department'));
    	$select->joinInner('core_user', 'user_id = student_user', null);
    	
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
        $select->joinInner('core_user', 'user_id = student_user');
        $select->joinLeft('core_address', 'address_id = student_address');
        $select->where('student_id = ?', $id);
        
        return $this->fetchRow($select);
	}
	
	/**
	 * Get by class id
	 * 
	 * @param	array $classes
	 * @return	false|array
	 */
	public function getByClasses(array $classes)
	{
		$select = $this->dataGrid()->columns(array('core_classes.class_id'))->where('class_id IN (?)', $classes)->where('user_status = ?', 1);
		
        return $this->fetchAll($select);
	}
	
	/**
	 * Get all students by id
	 *
	 * @param	array $students
	 * @return Zend_Db_Table_Row_Abstract
	 */
	public function getByStudent(array $students)
	{
		$select = $this->dataGrid()->where('student_id IN (?)', $students)->columns(array('core_classes.class_id'));
	
		return $this->fetchAll($select);
	}
    
}
