<?php

class Admin_Imex_Validator
{
	/**
	 * Get classes for add more configuration of Zend_Validator_InArray
	 * 
	 * @param	Zend_Validate_Abstract $itSelf
	 * @param	Lumia_Imex_Field $fieldObj
	 * @return	void
	 */
	public static function getClasses($itSelf, $fieldObj)
	{
		$classesModel = new Admin_Model_Classes();
		if ($classRows = $classesModel->allActivate())
		{
			$haystack = array();
			foreach ($classRows as $row)
			{
				$haystack[$row->class_id] = $row->class_code;
			}
			
			$itSelf->setHaystack($haystack);
		}
	}
	
	/**
	 * Get departments for add more configuration of Zend_Validator_InArray
	 *
	 * @param	Zend_Validate_Abstract $itSelf
	 * @param	Lumia_Imex_Field $fieldObj
	 * @return	array
	 */
	public static function getDepartments($itSelf, $fieldObj)
	{
		$departmentModel = new Admin_Model_Department();
		if ($departmentRows = $departmentModel->allActivate())
		{
			$haystack = array();
			foreach ($departmentRows as $row)
			{
				$haystack[$row->department_id] = $row->department_code;
			}
			
			$itSelf->setHaystack($haystack);
		}
	}
}
