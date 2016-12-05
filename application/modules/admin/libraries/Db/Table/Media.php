<?php

class Admin_Db_Table_Media extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'media_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_media';
    
    /**
     * Get all teachers
     *
     * @param	array $options
     * @return Zend_Db_Table_Row_Abstract
     */
    public function dataGrid(array $options)
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
    	if (!empty($options['media_type']) && is_array($options['media_type']))
    	{
    		$select->where('media_type IN (?)', $options['media_type']);
    	}
    	
    	return $select;
    }    
}
