<?php
class Admin_Form_Subject_Edit extends Admin_Form_Subject
{
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'subject/form/edit.phtml';
	
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
		$this->getElement('subject_name')->addValidator('Db_NoRecordExists', false, array(
				'table' => 'core_subject',
				'field' => 'subject_name',
				'exclude' => array(
						'field' => 'subject_id',
						'value' => $this->getValue('subject_id')
				)
		));
		
		// Code
		$this->getElement('subject_code')->addValidator('Db_NoRecordExists', false, array(
				'table' => 'core_subject',
				'field' => 'subject_code',
				'exclude' => array(
						'field' => 'subject_id',
						'value' => $this->getValue('subject_id')
				)
		));
		
		return parent::isValid($data);
	}
}
