<?php

class Admin_Model_Student extends Lumia_Model
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Admin_Db_Table_Student');
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
		
		$allStudents = $this->getDbTable()->fetchAll(array(
				'student_id IN (?)' => $selectRows
		));
		
		if ($allStudents->count())
		{
			$selectRows = array();
			foreach ($allStudents as $rowStudent)
			{
				$selectRows[] = $rowStudent->student_user;
			}
			
			$userModel = new Admin_Model_User();
			return $userModel->updateStatus($selectRows, $status);
		}

		return false;
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
			$studentId = $this->insert(array(
					'student_name' => $formValues['student_name'],
					'student_code' => $formValues['student_code'],
					'student_birth' => $formValues['student_birth'],
					'student_department' => $formValues['student_department'],
					'student_class' => $formValues['student_class'],
					'student_identification' => $formValues['student_identification'],
					'student_gender' => $formValues['student_gender'],					
					'student_date_created' => Lumia_Utility_DateTime::getInstance()->toMysql()
			));
			
			// Generate user password
			$cryptography = Lumia_Cryptography::factory('Password');
			$salt = $cryptography->random();
			$password = $cryptography->hash($formValues['account_password'], $salt);
			
			$userDbTable = new Admin_Db_Table_User();
			$userId = $userDbTable->insert(array(
					'user_name' => $formValues['student_code'],
					'user_password' => $password,
					'user_salt' => $salt,
					'user_role' => Application_Const::ROLE_CODE_STUDENT,
					'user_email' => $formValues['user_email'],
					'user_status' => $formValues['user_status'],
					'user_date_created' => Lumia_Utility_DateTime::getInstance()->toMysql()
			));
			
			$addressDbTable = new Admin_Db_Table_Address();
			$addressId = $addressDbTable->insert(array(
					'address_line' => $formValues['address_line'],
					'address_line2' => $formValues['address_line2'],
					'address_postal_code' => $formValues['address_postal_code'],
					'address_phone' => $formValues['address_phone'],
					'address_district' => $formValues['address_district'],
					'address_province' => $formValues['address_province'],
					'address_country' => $formValues['address_country']
			));
			
			$this->update(array(
				'student_address' => $addressId,
				'student_user' => $userId
			), array(
				'student_id = ?' => $studentId
			));
			
			// Add permissions
			if ($userId)
			{
				$permissionModel = new Lumia_Model_Permission();
				$permissionRows = $permissionModel->getByRoleCode(Application_Const::ROLE_CODE_STUDENT);
				if ($permissionRows->count()) 
				{
					$privileges = array();
					foreach ($permissionRows as $row)
					{
						$privileges[$row->permission_resource] = 1;
					}
					
					$privilegeModel = new Lumia_Model_User_Permission();
					$privilegeModel->collectPrivileges($privileges, $userId);
				}
			}
			
			$this->getAdapter()->commit();
		} catch (Application_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;	
		}
		
		return $studentId;
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
			$studentId = isset($formValues['student_id']) ? $formValues['student_id'] : 0;
			$this->update(array(
					'student_name' => $formValues['student_name'],
					'student_code' => $formValues['student_code'],
					'student_birth' => $formValues['student_birth'],
					'student_department' => $formValues['student_department'],
					'student_class' => $formValues['student_class'],
					'student_identification' => $formValues['student_identification'],
					'student_gender' => $formValues['student_gender']
			), array(
				'student_id = ?' => $studentId
			));
				
			$addressDbTable = new Admin_Model_Address();
			$addressId = isset($formValues['address_id']) ? $formValues['address_id'] : 0;
			if ($addressId)
			{
				$addressDbTable->update(array(
						'address_line' => $formValues['address_line'],
						'address_line2' => $formValues['address_line2'],
						'address_postal_code' => $formValues['address_postal_code'],
						'address_phone' => $formValues['address_phone'],
						'address_district' => $formValues['address_district'],
						'address_province' => $formValues['address_province'],
						'address_country' => $formValues['address_country']
				), array(
					'address_id = ?' => $addressId
				));
			} else 
			{
				$addressId = $addressDbTable->insert(array(
						'address_line' => $formValues['address_line'],
						'address_line2' => $formValues['address_line2'],
						'address_postal_code' => $formValues['address_postal_code'],
						'address_phone' => $formValues['address_phone'],
						'address_district' => $formValues['address_district'],
						'address_province' => $formValues['address_province'],
						'address_country' => $formValues['address_country']
				));
			}
				
			$this->update(array(
					'student_address' => $addressId
			), array(
					'student_id = ?' => $studentId
			));
			
			$userId = isset($formValues['user_id']) ? (int) $formValues['user_id'] : 0;
			if ($userId)
			{
				$userDbTable = new Admin_Db_Table_User();
				$userDbTable->update(array(
						'user_status' => $formValues['user_status']
				), array(
						'user_id = ?' => $userId
				));
			}
				
			$this->getAdapter()->commit();
		} catch (Application_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;
		}
		
		return $studentId;
	}
}