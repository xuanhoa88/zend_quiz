<?php

class Admin_Db_Table_Teacher_Subject extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'teacher_subject_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_teacher_subject';
    
    /**
     * Get all subjects by user
     *
     * @param	array $users
     * @return 	array|false
     */
    public function getByUser(array $users)
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
    	$select->joinInner('core_subject', 'subject_id = teacher_subject_subject');
    	$select->joinInner('core_teacher', 'teacher_id = teacher_subject_teacher', null);
    	$select->joinInner('core_user', 'user_id = teacher_user', null);
//    	$select->where('user_id IN (?)', $users);
   
    	return $this->fetchAll($select);
    }
}
