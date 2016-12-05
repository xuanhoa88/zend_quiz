<?php

class Admin_Db_Table_Imex extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'imex_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_imex';

    /**
     * Get all classes activate
     *
     * @param	string $type
     * @return 	Zend_Db_Table_Row_Abstract
     */
    public function allActivate($type) 
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->where('imex_status = ? ', 1);
        $select->where('imex_type = ?', (string) $type);
        
        return $this->fetchAll($select);
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
        $select->where('imex_id = ?', $id);
        
        return $this->fetchRow($select);
	}
	
	/**
	 * Get by code
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
        $select->where('imex_code = ?', $code);
        
        return $this->fetchRow($select);
	}
    
}
