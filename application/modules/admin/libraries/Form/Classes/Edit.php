<?php
class Admin_Form_Classes_Edit extends Admin_Form_Classes
{
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'classes/form/edit.phtml';
	
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
		$this->getElement('class_code')->addValidator('Db_NoRecordExists', false, array(
				'table' => 'core_classes',
				'field' => 'class_code',
				'exclude' => array(
						'field' => 'class_id',
						'value' => $this->getValue('class_id')
				)
		));
		
		return parent::isValid($data);
	}
}
