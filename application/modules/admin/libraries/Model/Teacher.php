<?php

class Admin_Model_Teacher extends Lumia_Model
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Admin_Db_Table_Teacher');
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
		
		$teacherSubjectDbTable = new Admin_Model_Teacher_Subject();
		$teacherSubjectDbTable->delete(array('teacher_subject_teacher IN (?)' => $selectRows));
		
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
		
		$allTeachers = $this->getDbTable()->fetchAll(array(
				'teacher_id IN (?)' => $selectRows
		));
		
		if ($allTeachers->count())
		{
			$selectRows = array();
			foreach ($allTeachers as $rowTeacher)
			{
				$selectRows[] = $rowTeacher->teacher_user;
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
	 * @return	int
	 */
	protected function _add(array $formValues)
	{
		$this->getAdapter()->beginTransaction();
		try 
		{
			$teacherId = $this->insert(array(
					'teacher_name' => $formValues['teacher_name'],
					'teacher_code' => $formValues['teacher_code'],
					'teacher_birth' => $formValues['teacher_birth'],
					'teacher_department' => $formValues['teacher_department'],
					'teacher_identification' => $formValues['teacher_identification'],
					'teacher_gender' => $formValues['teacher_gender'],
					'teacher_date_created' => Lumia_Utility_DateTime::getInstance()->toMysql()
			));
			
			// Generate user password
			$cryptography = Lumia_Cryptography::factory('Password');
			$salt = $cryptography->random();
			$password = $cryptography->hash($formValues['account_password'], $salt);
			
			$userDbTable = new Admin_Db_Table_User();
			$userId = $userDbTable->insert(array(
					'user_name' => $formValues['teacher_code'],
					'user_password' => $password,
					'user_salt' => $salt,
					'user_role' => Application_Const::ROLE_CODE_TEACHER,
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
				'teacher_address' => $addressId,
				'teacher_user' => $userId
			), array(
				'teacher_id = ?' => $teacherId
			));
			
			if (!empty($formValues['teacher_subject']) && is_array($formValues['teacher_subject']))
			{
				$departmentSubjectDbTable = new Admin_Model_Teacher_Subject();
				foreach ($formValues['teacher_subject'] as $subjectId)
				{
					$departmentSubjectDbTable->insert(array(
							'teacher_subject_teacher' => $teacherId,
							'teacher_subject_subject' => $subjectId
					));
				}
			}
			
			// Add permissions
			if ($userId)
			{
				$permissionModel = new Lumia_Model_Permission();
				$permissionRows = $permissionModel->getByRoleCode(Application_Const::ROLE_CODE_TEACHER);
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
		
		return $teacherId;
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
			$teacherId = isset($formValues['teacher_id']) ? $formValues['teacher_id'] : 0;
			$this->update(array(
					'teacher_name' => $formValues['teacher_name'],
					'teacher_code' => $formValues['teacher_code'],
					'teacher_birth' => $formValues['teacher_birth'],
					'teacher_department' => $formValues['teacher_department'],
					'teacher_identification' => $formValues['teacher_identification'],
					'teacher_gender' => $formValues['teacher_gender']
			), array(
				'teacher_id = ?' => $teacherId
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
					'teacher_address' => $addressId
			), array(
					'teacher_id = ?' => $teacherId
			));
			
			if (!empty($formValues['teacher_subject']) && is_array($formValues['teacher_subject']))
			{
				$departmentSubjectDbTable = new Admin_Model_Teacher_Subject();
				$departmentSubjectDbTable->delete(array(
						'teacher_subject_teacher = ?' => $teacherId
				));
			
				foreach ($formValues['teacher_subject'] as $subjectId)
				{
					$departmentSubjectDbTable->insert(array(
							'teacher_subject_teacher' => $teacherId,
							'teacher_subject_subject' => $subjectId
					));
				}
			}
			
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
		
		return $teacherId;
	}
}