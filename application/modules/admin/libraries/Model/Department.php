<?php

class Admin_Model_Department extends Lumia_Model
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Admin_Db_Table_Department');
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
		
		$departmentSubjectDbTable = new Admin_Model_Department_Subject();
		$departmentSubjectDbTable->delete(array('department_subject_department IN (?)' => $selectRows));
		
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
				array('department_status' => (int) $status),
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
			
			$departmentId = $this->insert(array(
					'department_name' => $formValues['department_name'],
					'department_code' => $formValues['department_code'],
					'department_status' => $formValues['department_status'],
					'department_date_created' => Lumia_Utility_DateTime::getInstance()->toMysql()
			));
			
			$this->getAdapter()->commit();
		} catch (Application_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;	
		}
		
		return $departmentId;
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
			
			$departmentId = isset($formValues['department_id']) ? $formValues['department_id'] : 0;
			$this->update(array(
					'department_name' => $formValues['department_name'],
					'department_code' => $formValues['department_code'],
					'department_status' => $formValues['department_status']
			), array(
					'department_id = ?' => $departmentId
			));
				
			$this->getAdapter()->commit();
		} catch (Application_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;
		}
		
		return $departmentId;
	}
}