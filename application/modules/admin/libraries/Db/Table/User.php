<?php

class Admin_Db_Table_User extends Lumia_Db_Table_User
{
    /**
     * Get all teachers
     *
     * @return Zend_Db_Table_Row_Abstract
     */
    public function dataGrid()
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
    	$select->joinLeft('core_role', 'user_role = role_code');
    	
    	return $select;
    }    
}
