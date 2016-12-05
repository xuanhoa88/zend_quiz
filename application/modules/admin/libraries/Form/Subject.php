<?php
class Admin_Form_Subject extends Lumia_Form
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
		$this->setName('subjectForm');
		$this->setMethod(self::METHOD_POST);
		
		// Id
		$id = new Zend_Form_Element_Hidden('subject_id');
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
		$name = new Zend_Form_Element_Text('subject_name');
		$name->setOptions(array(
				'label' => 'SubjectForm:@Name',
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
		$code = new Zend_Form_Element_Text('subject_code');
		$code->setOptions(array(
				'label' => 'SubjectForm:@Code',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($code);

		// Status
		$status = new Zend_Form_Element_Radio('subject_status');
		$status->setOptions(array(
				'label' => 'SubjectForm:@Status',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						1 => 'SubjectForm:@Status active',
						0 => 'SubjectForm:@Status inactive'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($status);
		
		// Department
		$department = new Zend_Form_Element_MultiCheckbox('subject_department[]');
		$department->setOptions(array(
				'label' => 'SubjectForm:@Department',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper')
		));
		
		$department->getValidator('NotEmpty')->setMessage('Validate:@Select at least one value in the list box', 'isEmpty');
		
		$departmentModel = new Admin_Model_Department();
		$departmentRows = $departmentModel->allActivate();
		if ($departmentRows->count())
		{
			foreach ($departmentRows as $departmentRow)
			{
				$department->addMultiOption($departmentRow->department_id, $departmentRow->department_name);
			}
		}
		
		$this->addElement($department);
		
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
