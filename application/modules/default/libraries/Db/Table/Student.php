<?php

class Default_Db_Table_Student extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'student_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_student';

    /**
     * Get user by id
     *
     * @param int $userId            
     * @return Zend_Db_Table_Row_Abstract
     */
    public function getByUser($userId)
    {
    	$userId = (int) $userId;
		if (!$userId)
		{
			return false;
		}
        
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->joinInner('core_user', 'user_id = student_user', null);
        $select->joinInner('core_classes', 'class_id = student_class');
        $select->where('user_id = ?', $userId);
        $select->where('user_status = ?', 1);
        
        return $this->fetchRow($select);
    }
}
