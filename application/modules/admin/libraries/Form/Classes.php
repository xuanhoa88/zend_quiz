<?php
class Admin_Form_Classes extends Lumia_Form
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
		$this->setName('classesForm');
		$this->setMethod(self::METHOD_POST);

		// Id
		$id = new Zend_Form_Element_Hidden('class_id');
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
		$name = new Zend_Form_Element_Text('class_name');
		$name->setOptions(array(
				'label' => 'ClassForm:@Name',
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
		$code = new Zend_Form_Element_Text('class_code');
		$code->setOptions(array(
				'label' => 'ClassForm:@Code',
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
		
		// Period
		$period = new Lumia_Form_Element_Period('class_period');
		$period->setOptions(array(
				'label' => 'ClassForm:@Period',
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($period);
		
		// Homeroom teacher
		$homeroomTeacher = new Zend_Form_Element_Select('class_teacher');
		$homeroomTeacher->setOptions(array(
				'label' => 'ClassForm:@Homeroom teacher',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						null => 'ClassForm:@Default'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper')
		));
		
		$teacherModel = new Admin_Model_Teacher();
		$teacherRows = $teacherModel->allActivate();
		if ($teacherRows->count())
		{
			foreach ($teacherRows as $teacherRow)
			{
				$homeroomTeacher->addMultiOption($teacherRow->teacher_id, $teacherRow->teacher_name);
			}
		}

		$this->addElement($homeroomTeacher);

		// Status
		$status = new Zend_Form_Element_Radio('class_status');
		$status->setOptions(array(
				'label' => 'ClassForm:@Status',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						1 => 'ClassForm:@Status active',
						0 => 'ClassForm:@Status inactive'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($status);
		
		// Department
		$department = new Zend_Form_Element_Select('class_department');
		$department->setOptions(array(
				'label' => 'ClassForm:@Department',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						null => 'ClassForm:@Default'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper')
		));

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
