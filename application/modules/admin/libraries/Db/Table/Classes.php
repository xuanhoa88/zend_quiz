<?php

class Admin_Db_Table_Classes extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'class_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_classes';

    /**
     * Get all classes activate
     *
     * @return Zend_Db_Table_Row_Abstract
     */
    public function allActivate() 
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->where('class_status = ? ', 1);
        
        return $this->fetchAll($select);
    }
    
    /**
     * Get all classes
     *
     * @return Zend_Db_Table_Row_Abstract
     */
    public function dataGrid()
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
    	$select->joinInner('core_teacher', 'class_teacher = teacher_id');
    	$select->joinInner('core_department', 'class_department = department_id');
    	
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
        $select->joinInner('core_teacher', 'class_teacher = teacher_id');
    	$select->joinInner('core_department', 'class_department = department_id');
        $select->where('class_id = ?', $id);
        
        return $this->fetchRow($select);
	}
	
	/**
	 * Get all by department id
	 * 
	 * @param	array $departments
	 * @return	Zend_Db_Table_Rowset_Abstract
	 */
	public function getByDepartment(array $departments)
	{
		$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->joinInner('core_department', 'department_id = class_department', null);
        $select->where('department_id IN (?)', $departments);
        
        return $this->fetchAll($select);
	}
	
	/**
	 * Get all by subject id
	 *
	 * @param	array $subjects
	 * @return	Zend_Db_Table_Rowset_Abstract
	 */
	public function getBySubject(array $subjects)
	{
		$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
		$select->joinInner('core_department', 'department_id = class_department', null);
		$select->joinInner('core_department_subject', 'department_subject_department = department_id', null);
		$select->where('department_subject_subject IN (?)', $subjects);
	
		return $this->fetchAll($select);
	}
	
	/**
	 * Return array association with key = class_code, value=class_id
	 */
	public function getAssocClass()
	{
		$o_Select = $this->_db->select()
		->from(array('de' => $this->_name), array('class_id','class_code'));
			
		$aData =  $this->_db->fetchAll( $o_Select );
	
		$returnData = array();
		foreach($aData as $val)
		{
			$returnData["{$val->class_code}"] = $val->class_id;
		}
	
		return $returnData;
	}
    
}
