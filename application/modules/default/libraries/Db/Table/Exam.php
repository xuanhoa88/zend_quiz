<?php

class Default_Db_Table_Exam extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'exam_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_exam';
    
    /**
     * Get exam active by id
     *
     * @param int $examId
     * @return Zend_Db_Table_Row_Abstract
     */
    public function getActiveById($examId)
    {
    	$examId = (int) $examId;
        if (!$examId) 
        {
            return false;
        }
    
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->where('exam_status = ?', 1);
        $select->where('exam_id = ?', $examId);
    
        return $this->fetchRow($select);
    }
}
