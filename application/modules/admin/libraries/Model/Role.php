<?php

class Admin_Model_Role extends Lumia_Model
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Admin_Db_Table_Role');
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
				array('role_status' => (int) $status),
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
			$roleId = $this->insert(array(
					'role_name' => $formValues['role_name'],
					'role_code' => $formValues['role_code'],
					'role_status' => $formValues['role_status'],
					'role_date_created' => Lumia_Utility_DateTime::getInstance()->toMysql()
			));
			
			// Collect privileges
			if ($roleId)
			{
				$privileges = isset($formValues['dependencyPrivileges']['role_privileges']) && is_array($formValues['dependencyPrivileges']['role_privileges']) ? $formValues['dependencyPrivileges']['role_privileges'] : array();
				$this->_collectPrivileges($privileges, $formValues['role_code']);
			}
			
			$this->getAdapter()->commit();
		} catch (Application_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;	
		}
		
		return $roleId;
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
			$roleId = isset($formValues['role_id']) ? $formValues['role_id'] : 0;
			$this->update(array(
					'role_name' => $formValues['role_name'],
					'role_code' => $formValues['role_code'],
					'role_status' => $formValues['role_status']
			), array('role_id = ?' => $roleId));
			
			// Collect privileges
			if ($roleId)
			{
				$privileges = isset($formValues['dependencyPrivileges']['role_privileges']) && is_array($formValues['dependencyPrivileges']['role_privileges']) ? $formValues['dependencyPrivileges']['role_privileges'] : array();
				$this->_collectPrivileges($privileges, $formValues['role_code']);
			}
			
			$this->getAdapter()->commit();
		} catch (Application_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;
		}
		
		return $roleId;
	}
	
	/**
	 * Collect privileges
	 * 
	 * @param	array $privileges
	 * @param	string $roleCode
	 */
	protected function _collectPrivileges(array $privileges, $roleCode)
	{
		// Cast to string
		$roleCode = (string) $roleCode;
		if ($roleCode === '')
		{
			return false;
		}
		
		// Init model
		$privilegeModel = new Lumia_Model_Permission();
		
		// Delete permission according to role id
		$privilegeModel->delete(array(
			'permission_role = ?' => $roleCode
		));
		
		$privileges = Lumia_Model_Permission::filter($privileges, true);
		foreach ($privileges as $resource => $val)
		{
			$privilegeModel->insert(array(
				'permission_role' => $roleCode,
				'permission_resource' => $resource
			));
		}
	}
}