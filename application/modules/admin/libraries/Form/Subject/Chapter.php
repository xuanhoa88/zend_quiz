<?php
class Admin_Form_Subject_Chapter extends Lumia_Form
{
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		parent::init();

		// Set the form's attributes
		$this->setName('chapterForm');
		$this->setMethod(self::METHOD_POST);
		
		// Id
		$id = new Zend_Form_Element_Hidden('chapter_id');
		$id->setOptions(array(
				'required' => false,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'decorators' => array('ViewHelper')
		));
		$this->addElement($id);

		// Name
		$name = new Zend_Form_Element_Text('chapter_name');
		$name->setOptions(array(
				'label' => 'ChapterForm:@Name',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($name);

		// Code
		$code = new Zend_Form_Element_Hidden('chapter_subject');
		$code->setOptions(array(
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('NotEmpty', 'Int'),
				'decorators' => array('ViewHelper'),
		));
		$this->addElement($code);
		
		// Order
		$order = new Zend_Form_Element_Text('chapter_order');
		$order->setOptions(array(
				'label' => 'ChapterForm:@Order',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'default' => 0,
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($order);

		// Status
		$status = new Zend_Form_Element_Radio('chapter_status');
		$status->setOptions(array(
				'label' => 'ChapterForm:@Status',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						1 => 'ChapterForm:@Status active',
						0 => 'ChapterForm:@Status inactive'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($status);
		
		// Save button
		$submit = new Zend_Form_Element_Submit('btnSave');
		$submit->setOptions(array(
				'label' => 'Form:@Button save',
				'decorators' => array('ViewHelper')
		));
		$this->addElement($submit);

		// Reset button
		$submit = new Zend_Form_Element_Button('btnReset');
		$submit->setOptions(array(
				'label' => 'Form:@Button reset',
				'type' => 'reset',
				'decorators' => array('ViewHelper')
		));

		$this->addElement($submit);
	}
}
