<?php

class Lumia_Db_Table_Role extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'role_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_role';
    
    /**
     * Get by id
     *
     * @param	string $code
     * @return	false|object
     */
    public function getByCode($code)
    {
    	$code = (string) $code;
    	if ($code === '')
    	{
    		return false;
    	}
    
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
    	$select->where('role_code = ?', $code);
    
    	return $this->fetchRow($select);
    }
}
