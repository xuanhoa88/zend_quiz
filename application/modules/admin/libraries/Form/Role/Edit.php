<?php
class Admin_Form_Role_Edit extends Admin_Form_Role
{
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'role/form/edit.phtml';
	
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
		
		// Name
		$this->getElement('role_name')->addValidator('Db_NoRecordExists', false, array(
				'table' => 'core_role',
				'field' => 'role_name',
				'exclude' => array(
						'field' => 'role_id',
						'value' => $this->getValue('role_id')
				)
		));
		
		// Email
		$this->getElement('role_code')->addValidator('Db_NoRecordExists', false, array(
				'table' => 'core_role',
				'field' => 'role_code',
				'exclude' => array(
						'field' => 'role_id',
						'value' => $this->getValue('role_id')
				)
		));
		
		return parent::isValid($data);
	}
}
