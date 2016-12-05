<?php

class Admin_Imex_Import_Student extends Lumia_Imex_Import
{
	/**
	 * @var Lumia_Db_Table
	 */
	protected $_dbTable;
	
	/**
     * Pre-processing data
     *
     * Called before iterate over contents
     *
     * @return void
     */
    protected function _preProcessingData()
    {
    	$this->_dbTable = new Admin_Db_Table_Student();
    	$this->_dbTable->getAdapter()->beginTransaction();
    }

    /**
     * Post-processing data
     *
     * Called after iterate over contents
     *
     * @return void
     */
    protected function _postProcessingData()
    {
    	if ($this->hasErrors())
    	{
    		$this->_dbTable->getAdapter()->rollBack();
    	} else
    	{
    		$this->_dbTable->getAdapter()->commit();
    	}
    }
    
	/**
     * Called when make exception
     *
     * @return void
     */
    protected function _whenThrowException()
    {
    	$this->_dbTable->getAdapter()->rollBack();
    }
	
	/**
	 * Handle data into database
	 *
	 * @param	array $rowData
	 */
	protected function _dbHander(array $formValues)
	{
		return false;
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
	}
}
