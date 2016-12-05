<?php

class Default_View_Helper_StudentSession extends Zend_View_Helper_Abstract
{

    /**
     * Student information
     *
     * @var Default_Db_Table_Row_Student
     */
    protected $_studentSession;
    
    /**
     * Constructor
     */
    public function __construct()
    {
    	$this->_studentSession = Default_Auth::getInstance()->getStudent();
    }
    
    /**
     * Get student information
     * 
     * @return null|Default_Db_Table_Row_Student
     */
    public function studentSession()
    {
        return $this;
    }
    
    /**
     * Returns true if student exists
     *
     * @return boolean
     */
    public function hasStudent()
    {
    	return $this->_studentSession->count();
    }
    
    /**
     * Prevent E_NOTICE for nonexistent values
     *
     * @param  string $key
     * @return null
     */
    public function __get($key)
    {
    	return $this->_studentSession->{$key};
    }
}
