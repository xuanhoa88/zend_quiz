<?php

class Admin_Model_Subject_Chapter extends Lumia_Model
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Admin_Db_Table_Subject_Chapter');
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
		
		return $this->update(array('chapter_status' => (int) $status), array($this->getDbPrimary() . ' IN (?)' => $selectRows));
	}

	/**
	 * Update order
	 *
	 * @param array $selectRows
	 * @param int $status
	 * @return int
	 */
	public function updateOrder(array $selectRows)
	{
		if (empty($selectRows))
		{
			return 0;
		}
		
		$this->getAdapter()->beginTransaction();
		
		try 
		{
			foreach ($selectRows as $chapterId => $order)
			{
				$this->update(array('chapter_order' => (int) $order), array($this->getDbPrimary() . ' = ?' => (int) $chapterId));
			}
			
			$this->getAdapter()->commit();
		} catch (Zend_Exception $e)
		{
			$this->getAdapter()->rollBack();
			return false;
		}
		
		return true;
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
			$chapterId = $this->insert(array(
					'chapter_name' => $formValues['chapter_name'],
					'chapter_subject' => $formValues['chapter_subject'],
					'chapter_order' => $formValues['chapter_order'],
					'chapter_status' => $formValues['chapter_status'],
					'chapter_date_created' => Lumia_Utility_DateTime::getInstance()->toMysql()
			));
			
			$this->getAdapter()->commit();
		} catch (Application_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;
		}
		
		return $chapterId;
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
			$chapterId = isset($formValues['chapter_id']) ? $formValues['chapter_id'] : 0;
			$this->update(array(
					'chapter_name' => $formValues['chapter_name'],
					'chapter_subject' => $formValues['chapter_subject'],
					'chapter_order' => $formValues['chapter_order'],
					'chapter_status' => $formValues['chapter_status']
			), array(
					'chapter_id = ?' => $chapterId
			));
			
			$this->getAdapter()->commit();
		} catch (Application_Exception $e)
		{
			$this->getAdapter()->rollBack();
			throw $e;
		}
		
		return $chapterId;
	}
}