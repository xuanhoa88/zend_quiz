<?php
class Admin_Form_Department_Edit extends Admin_Form_Department
{
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'department/form/edit.phtml';
		
	/**
	 * Validate the form
	 *
	 * @param  array $data
	 * @throws Zend_Form_Exception
	 * @return bool
	 */
	public function isValid($data)
	{
		$this->populate($data);
		
		// Code
		$this->getElement('department_code')->addValidator('Db_NoRecordExists', false, array(
				'table' => 'core_department',
				'field' => 'department_code',
				'exclude' => array(
						'field' => 'department_id',
						'value' => $this->getValue('department_id')
				)
		));
		
		return parent::isValid($data);
	}
}
