<?php

class Lumia_Db_Table_User extends Lumia_Db_Table
{
    /**
     * Column for the primary key
     *
     * @var string
     */
    protected $_primary = 'user_id';

    /**
     * Holds the table's name
     *
     * @var string
     */
    protected $_name = 'core_user';

    /**
     * Get user by id
     *
     * @param int $userId            
     * @return Ambigous <Zend_Db_Table_Row_Abstract, NULL, unknown>
     */
    public function getById($userId)
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->joinLeft('core_role', 'core_role.role_code = core_user.user_role', 'role_code');
        $select->where('core_user.user_id = ?', (int) $userId);
        
        return $this->fetchRow($select);
    }

    /**
     * Get user by email
     *
     * @param string $userEmail            
     * @return object
     */
    public function getByEmail($userEmail)
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->joinInner('core_role', 'core_role.role_code = core_user.user_role', 'role_code');
        $select->where('core_user.user_email = ?', (string) $userEmail);
        
        return $this->fetchRow($select);
    }

    /**
     * Get user by name
     *
     * @param string $username            
     * @return object
     */
    public function getByName($username)
    {
        $select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->joinInner('core_role', 'core_role.role_code = core_user.user_role', 'role_code');
        $select->where('core_user.user_name = ?', (string) $username);
        
        return $this->fetchRow($select);
    }
    
    /**
     * Attempt an authentication
     * 
     * @param	string $username
     * @param	string $password
     */
    public function authenticate($username, $password)
    {
    	$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->where('core_user.user_name = ?', (string) $username);
        $select->where('MD5(CONCAT(?, MD5(core_user.user_salt))) = core_user.user_password', (string) $password);
        $select->where('core_user.user_status = ?', 1);
        $select->limit(1);
        
    	return $this->fetchRow($select);
    }
}
