<?php

class Lumia_Db_Table_Privilege extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'privilege_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_privilege';

    /**
     * Get all privileges activate
     *
     * @return Zend_Db_Table_Row_Abstract
     */
    public function allActivate() 
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->joinInner('core_module', 'core_module.module_code = core_privilege.privilege_module');
        $select->joinInner('core_controller', 'core_controller.controller_code = core_privilege.privilege_controller');
        $select->order(array(
        	'core_module.module_code ASC',
        	'core_controller.controller_order ASC',
        	'core_controller.controller_code ASC',
        	'core_privilege.privilege_order ASC',
        	'core_privilege.privilege_code ASC'
        ));
        
        return $this->fetchAll($select);
    }
}
