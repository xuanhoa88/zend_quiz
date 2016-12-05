<?php

class Admin_Db_Table_Role extends Lumia_Db_Table_Role
{
    /**
     * Get all modules activate
     */
    public function allActivate()
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
    	$select->where('role_status = ?', 1);
    	
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
        $select->where('role_id = ?', $id);
        
        return $this->fetchRow($select);
	}
}
