<?php

class Lumia_Db_Table_Permission extends Lumia_Db_Table
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
    protected $_name = 'core_permission';

    /**
     * Get permissions by role code
     *
     * @param string $roleCode            
     * @return object
     */
    public function getByRoleCode($roleCode)
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->where('permission_role = ?', (string) $roleCode);
        
        return $this->fetchAll($select);
    }
}
