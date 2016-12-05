<?php

class Admin_Model_User extends Lumia_Model
{
	const FORM_SAVE_MODE_SELF_UPDATE = 'SELF_UPDATE';
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Admin_Db_Table_User');
	}
	
	/**
	 * Delete selected rows
	 * 
	 * @param 	array $selectRows
	 * @return  int
	 */
	public function deleteSelectedRows(array $selectRows)
	{
		if (empty($selectRows)) 
		{
			return 0;	
		}
		
		return $this->delete(array($this->getDbPrimary() . ' IN (?)' => $selectRows));
	}
	
	/**
	 * Update status
	 * 
	 * @param 	array $selectRows
	 * @param	int $status
	 * @return  int
	 */
	public function updateStatus(array $selectRows, $status)
	{
		if (empty($selectRows)) 
		{
			return 0;	
		}
		
		return $this->update(
				array('user_status' => (int) $status),
				array($this->getDbPrimary() . ' IN (?)' => $selectRows)
		);
	}
	
	/**
	 * Save data
	 * 
	 * @param	string $type
	 * @param	array $formValues
	 * @return	mixed
	 */
	public function save($type, array $formValues)
	{
		switch ($type)
		{
			case Application_Const::FORM_SAVE_MODE_ADD:
				return $this->_add($formValues);
			case Application_Const::FORM_SAVE_MODE_EDIT:
				return $this->_edit($formValues);
			case self::FORM_SAVE_MODE_SELF_UPDATE:
				return $this->_selfUpdate($formValues);
			default:
				throw new Application_Exception('Your action have not been defined');
					
		}
	}
	
	/**
	 * Insert data
	 * 
	 * @param	array $formValues
	 */
	protected function _add(array $formValues)
	{
		$this->getAdapter()->beginTransaction();
		try 
		{
			// Generate user password
			$cryptography = Lumia_Cryptography::factory('Password');
			$salt = $cryptography->random();
			$password = $cryptography->hash($formValues['user_password'], $salt);
			
			$userId = $this->insert(array(
					'user_name' => $formValues['user_name'],
					'user_password' => $password,
					'user_salt' => $salt,
					'user_status' => $formValues['user_status'],
					'user_role' => $formValues['user_role'],
					'user_email' => $formValues['user_email'],
					'user_date_created' => Lumia_Utility_DateTime::getInstance()->toMysql()
			));
			
			// Collect privileges
			if ($userId)
			{
				$privilegeModel = new Lumia_Model_User_Permission();
				$privileges = isset($formValues['dependencyPrivileges']['user_privileges']) && is_array($formValues['dependencyPrivileges']['user_privileges']) ? $formValues['dependencyPrivileges']['user_privileges'] : array();
				$privileges = Lumia_Model_Permission::filter($privileges, true);
				$privilegeModel->collectPrivileges($privileges, $userId);
			}
			
			$this->getAdapter()->commit();
		} catch (Application_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;	
		}
		
		return $userId;
	}
	
	/**
	 * Modify data
	 * 
	 * @param	array $formValues
	 */
	protected function _edit(array $formValues)
	{
		$this->getAdapter()->beginTransaction();
		try
		{
			$dataUpdate = array(
					'user_name' => $formValues['user_name'],
					'user_role' => $formValues['user_role'],
					'user_email' => $formValues['user_email'],
					'user_status' => $formValues['user_status']
			);
			
			// Generate user password
			if (mb_strlen($formValues['user_password']))
			{
				$cryptography = Lumia_Cryptography::factory('Password');
				$salt = $cryptography->random();
				$password = $cryptography->hash($formValues['user_password'], $salt);
				
				$dataUpdate['user_salt'] = $salt;
				$dataUpdate['user_password'] = $password;
			}
			
			$userId = isset($formValues['user_id']) ? $formValues['user_id'] : 0;
			$this->update($dataUpdate, array('user_id = ?' => $userId));
			
			// Collect privileges
			if ($userId)
			{
				$privilegeModel = new Lumia_Model_User_Permission();
				$privileges = isset($formValues['dependencyPrivileges']['user_privileges']) && is_array($formValues['dependencyPrivileges']['user_privileges']) ? $formValues['dependencyPrivileges']['user_privileges'] : array();
				$privileges = Lumia_Model_Permission::filter($privileges, true);
				$privilegeModel->collectPrivileges($privileges, $userId);
			}
				
			$this->getAdapter()->commit();
		} catch (Application_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;
		}
		
		return $userId;
	}
	
	/**
	 * Modify data
	 *
	 * @param	array $formValues
	 */
	protected function _selfUpdate(array $formValues)
	{
		$this->getAdapter()->beginTransaction();
		try
		{
			$dataUpdate = array(
					'user_email' => $formValues['user_email'],
					'user_fullname' => $formValues['user_fullname']
			);
				
			// Generate user password
			if (mb_strlen($formValues['user_password']))
			{
				$cryptography = Lumia_Cryptography::factory('Password');
				$salt = $cryptography->random();
				$password = $cryptography->hash($formValues['user_password'], $salt);
	
				$dataUpdate['user_salt'] = $salt;
				$dataUpdate['user_password'] = $password;
			}
				
			$userId = isset($formValues['user_id']) ? $formValues['user_id'] : 0;
			$this->update($dataUpdate, array('user_id = ?' => $userId));
				
			$this->getAdapter()->commit();
		} catch (Application_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;
		}
	
		return $userId;
	}
}