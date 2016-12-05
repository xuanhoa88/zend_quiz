<?php
class Admin_Form_Subject_Chapter_Edit extends Admin_Form_Subject_Chapter
{
	/**
	 * @var string
	 */
	protected $_viewScript = 'chapter/form/edit.phtml';
	
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
		$this->getElement('chapter_name')->addValidator('Db_NoRecordExists', false, array(
				'table' => 'core_chapter',
				'field' => 'chapter_name',
				'exclude' => 'chapter_id != ' . (int) $this->getValue('chapter_id') . ' AND chapter_subject = ' . (int) $this->getValue('chapter_subject'),
		));
		
		return parent::isValid($data);
	}
}
