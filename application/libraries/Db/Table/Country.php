<?php

class Application_Db_Table_Country extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'country_code';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_country';

    /**
     * Get all countries activate
     *
     * @return Zend_Db_Table_Row_Abstract
     */
    public function allActivate() 
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART);
        $select->setIntegrityCheck(false);
        
        return $this->fetchAll($select);
    }
    
}
