<?php

class Lumia_Db_Table_User_Permission extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'permission_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_permission_inheritance';

    /**
     * Get permissions by user id
     *
     * @param 	int $userId            
     * @return	false|object
     */
    public function getByUser($userId)
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->where('permission_user = ?', (int) $userId);
        
        return $this->fetchRow($select);
    }
}
