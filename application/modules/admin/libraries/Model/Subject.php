<?php

class Admin_Model_Subject extends Lumia_Model
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Admin_Db_Table_Subject');
	}

	/**
	 * Delete selected rows
	 *
	 * @param array $selectRows        	
	 * @return int
	 */
	public function deleteSelectedRows(array $selectRows)
	{
		if (empty($selectRows))
		{
			return 0;
		}
		
		$departmentSubjectDbTable = new Admin_Model_Department_Subject();
		$departmentSubjectDbTable->delete(array('department_subject_subject IN (?)' => $selectRows));
		
		$teacherSubjectDbTable = new Admin_Model_Teacher_Subject();
		$teacherSubjectDbTable->delete(array('teacher_subject_subject IN (?)' => $selectRows));
		
		return $this->delete(array(
				$this->getDbPrimary() . ' IN (?)' => $selectRows
		));
	}

	/**
	 * Update status
	 *
	 * @param array $selectRows        	
	 * @param int $status        	
	 * @return int
	 */
	public function updateStatus(array $selectRows, $status)
	{
		if (empty($selectRows))
		{
			return 0;
		}
		
		return $this->update(array('subject_status' => (int) $status), array($this->getDbPrimary() . ' IN (?)' => $selectRows));
	}

	/**
	 * Save data
	 *
	 * @param string $type        	
	 * @param array $formValues        	
	 * @return mixed
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
	 * @param array $formValues        	
	 */
	protected function _add(array $formValues)
	{
		$this->getAdapter()->beginTransaction();
		try
		{
			$subjectId = $this->insert(array(
					'subject_name' => $formValues['subject_name'],
					'subject_code' => $formValues['subject_code'],
					'subject_status' => $formValues['subject_status'],
					'subject_date_created' => Lumia_Utility_DateTime::getInstance()->toMysql()
			));
			
			if (!empty($formValues['subject_department']) && is_array($formValues['subject_department']))
			{
				$departmentSubjectDbTable = new Admin_Model_Department_Subject();
				foreach ($formValues['subject_department'] as $departmentId)
				{
					$departmentSubjectDbTable->insert(array(
							'department_subject_department' => $departmentId,
							'department_subject_subject' => $subjectId
					));
				}
			}
			
			$this->getAdapter()->commit();
		} catch (Application_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;
		}
		
		return $subjectId;
	}

	/**
	 * Modify data
	 *
	 * @param array $formValues        	
	 */
	protected function _edit(array $formValues)
	{
		$this->getAdapter()->beginTransaction();
		try
		{
			$subjectId = isset($formValues['subject_id']) ? $formValues['subject_id'] : 0;
			$this->update(array(
					'subject_name' => $formValues['subject_name'],
					'subject_code' => $formValues['subject_code'],
					'subject_status' => $formValues['subject_status']
			), array(
					'subject_id = ?' => $subjectId
			));
			
			if (!empty($formValues['subject_department']) && is_array($formValues['subject_department']))
			{
				$departmentSubjectDbTable = new Admin_Model_Department_Subject();
				$departmentSubjectDbTable->delete(array(
					'department_subject_subject = ?' => $subjectId
				));
				
				foreach ($formValues['subject_department'] as $departmentId)
				{
					$departmentSubjectDbTable->insert(array(
							'department_subject_department' => $departmentId,
							'department_subject_subject' => $subjectId
					));
				}
			}
			
			$this->getAdapter()->commit();
		} catch (Application_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;
		}
		
		return $subjectId;
	}
	
	public function a_fGetAllSubject()
	{
		$subjectDbTable = new Admin_Db_Table_Subject();
		return $subjectDbTable->a_fGetAllSubject();
	}
}