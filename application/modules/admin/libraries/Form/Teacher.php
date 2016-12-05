<?php
class Admin_Form_Teacher extends Lumia_Form
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
		$this->setName('teacherForm');
		$this->setMethod(self::METHOD_POST);
		
		// Id
		$id = new Zend_Form_Element_Hidden('teacher_id');
		$id->setOptions(array(
				'required' => false,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('Int'),
				'decorators' => array('ViewHelper')
		));
		$this->addElement($id);
		
		// User id
		$userId = new Zend_Form_Element_Hidden('user_id');
		$userId->setOptions(array(
				'required' => false,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('Int'),
				'decorators' => array('ViewHelper')
		));
		$this->addElement($userId);
		
		// Address id
		$addressId = new Zend_Form_Element_Hidden('address_id');
		$addressId->setOptions(array(
				'required' => false,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('Int'),
				'decorators' => array('ViewHelper')
		));
		$this->addElement($addressId);

		// Name
		$name = new Zend_Form_Element_Text('teacher_name');
		$name->setOptions(array(
				'label' => 'TeacherForm:@Full name',
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
		$code = new Zend_Form_Element_Text('teacher_code');
		$code->setOptions(array(
				'label' => 'TeacherForm:@Code',
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

		// Date of birth
		$teacherDateOfBirth = new Lumia_Form_Element_DateOfBirth('teacher_birth');
		$teacherDateOfBirth->setOptions(array(
				'label' => 'TeacherForm:@Date of birth',
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($teacherDateOfBirth);
		
		// Department
		$department = new Zend_Form_Element_Select('teacher_department');
		$department->setOptions(array(
				'label' => 'TeacherForm:@Department',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						null => 'TeacherForm:@Default'
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

		// Subject
		$subject = new Zend_Form_Element_MultiCheckbox('teacher_subject[]');
		$subject->setOptions(array(
				'label' => 'TeacherForm:@Subject',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
		));
		
		$subject->getValidator('NotEmpty')->setMessage('Validate:@Select at least one value in the list box', 'isEmpty');
		
		$subjectModel = new Admin_Model_Subject();
		$subjectRows = $subjectModel->allActivate();
		if ($subjectRows->count())
		{
			foreach ($subjectRows as $subjectRow)
			{
				$subject->addMultiOption($subjectRow->subject_id, $subjectRow->subject_name);
			}
		}

		$this->addElement($subject);

		// Identification
		$identification = new Zend_Form_Element_Text('teacher_identification');
		$identification->setOptions(array(
				'label' => 'TeacherForm:@Identification',
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($identification);

		// Status
		$status = new Zend_Form_Element_Radio('user_status');
		$status->setOptions(array(
				'label' => 'TeacherForm:@Status',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						1 => 'TeacherForm:@Status active',
						0 => 'TeacherForm:@Status inactive'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($status);

		// Gender
		$status = new Zend_Form_Element_Radio('teacher_gender');
		$status->setOptions(array(
				'label' => 'TeacherForm:@Gender',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						'male' => 'TeacherForm:@Male',
						'female' => 'TeacherForm:@Female'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper')
		));
		$this->addElement($status);

		// Permanent address line
		$addressLine = new Zend_Form_Element_Text('address_line');
		$addressLine->setOptions(array(
				'label' => 'TeacherForm:@Address line',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($addressLine);

		// Address line 2
		$addressLine2 = new Zend_Form_Element_Text('address_line2');
		$addressLine2->setOptions(array(
				'label' => 'TeacherForm:@Address line 2',
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($addressLine2);

		// Address postal code
		$addressPostalCode = new Zend_Form_Element_Text('address_postal_code');
		$addressPostalCode->setOptions(array(
				'label' => 'TeacherForm:@Postal code',
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($addressPostalCode);

		// Address phone
		$addressPhone = new Zend_Form_Element_Text('address_phone');
		$addressPhone->setOptions(array(
				'label' => 'TeacherForm:@Phone number',
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($addressPhone);

		// Address district
		$addressDistrict = new Zend_Form_Element_Text('address_district');
		$addressDistrict->setOptions(array(
				'label' => 'TeacherForm:@District',
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'decorators' => array('ViewHelper')
		));
		$this->addElement($addressDistrict);

		// Address province
		$addressProvince = new Zend_Form_Element_Text('address_province');
		$addressProvince->setOptions(array(
				'label' => 'TeacherForm:@State / Province / Region',
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'decorators' => array('ViewHelper')
		));
		$this->addElement($addressProvince);

		// Address country
		$addressCountry = new Zend_Form_Element_Select('address_country');
		$addressCountry->setOptions(array(
				'label' => 'TeacherForm:@Country',
				'required' => true,
				'decorators' => array('ViewHelper')
		));
		
		$countryModel = new Application_Model_Country();
		$countryRows = $countryModel->allActivate();
		if ($countryRows->count())
		{
			foreach ($countryRows as $countryRow)
			{
				$addressCountry->addMultiOption($countryRow->country_code, $countryRow->country_name);
			}
		}
		
		$this->addElement($addressCountry);
		
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
