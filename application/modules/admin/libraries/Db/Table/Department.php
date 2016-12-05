<?php

class Admin_Db_Table_Department extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'department_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_department';
    
    /**
     * Get all departments activate
     *
     * @return Zend_Db_Table_Row_Abstract
     */
    public function allActivate() 
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->where('department_status = ?', 1);
        
        return $this->fetchAll($select);
    }
    
    /**
     * Get all departments
     *
     * @return Zend_Db_Table_Row_Abstract
     */
    public function dataGrid()
    {
    	return $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
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
        $select->where('department_id = ?', $id);
        
        return $this->fetchRow($select);
	}
	
	/**
	 * Return array association with key = department_code, value=key
	 */
	public function getAssocDepartment()
	{
		$o_Select = $this->_db->select()
				->from(array('de' => $this->_name), array('department_id','department_code'));
			
		$aData =  $this->_db->fetchAll( $o_Select );
		
		$returnData = array();
		foreach ($aData as $val)
		{
			$returnData["{$val->department_code}"] = $val->department_id;
		}
		
		return $returnData;
	}
}
