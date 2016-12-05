<?php

class Admin_Model_Department_Subject extends Lumia_Model
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Admin_Db_Table_Department_Subject');
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
}