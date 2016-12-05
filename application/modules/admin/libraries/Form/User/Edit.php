<?php
class Admin_Form_User_Edit extends Admin_Form_User
{
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'user/form/edit.phtml';
	
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
		$this->getElement('user_name')->addValidator('Db_NoRecordExists', false, array(
				'table' => 'core_user',
				'field' => 'user_name',
				'exclude' => array(
						'field' => 'user_id',
						'value' => $this->getValue('user_id')
				)
		));
		
		// Email
		$this->getElement('user_email')->addValidator('Db_NoRecordExists', false, array(
				'table' => 'core_user',
				'field' => 'user_email',
				'exclude' => array(
						'field' => 'user_id',
						'value' => $this->getValue('user_id')
				)
		));
		
		return parent::isValid($data);
	}
}
