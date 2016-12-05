<?php
class Admin_Form_Question_Add extends Admin_Form_Question
{
	/**
	 * View script path
	 *
	 * @var	string
	 */
	protected $_viewScript = 'question/form/add.phtml';
	
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		$this->setAction($this->getView()->baseUrl('admin/question/add'));
		
		parent::init();
	}
}
