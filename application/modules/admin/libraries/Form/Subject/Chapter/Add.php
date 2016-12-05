<?php
class Admin_Form_Subject_Chapter_Add extends Admin_Form_Subject_Chapter
{
	/**
	 * @var string
	 */
	protected $_viewScript = 'chapter/form/add.phtml';
	
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		parent::init();
		
		// Name
		$this->getElement('chapter_name')->addValidator('Db_NoRecordExists', false, array(
				'table' => 'core_chapter',
				'field' => 'chapter_name',
				'exclude' => 'chapter_subject = ' . (int) $this->getValue('chapter_subject'),
		));
	}
}
