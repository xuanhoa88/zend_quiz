<?php
class Admin_Form_Student extends Lumia_Form
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
		$this->setName('studentForm');
		$this->setMethod(self::METHOD_POST);
		
		// Id
		$id = new Zend_Form_Element_Hidden('student_id');
		$id->setOptions(array(
				'required' => false,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
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
		$name = new Zend_Form_Element_Text('student_name');
		$name->setOptions(array(
				'label' => 'StudentForm:@Full name',
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
		$code = new Zend_Form_Element_Text('student_code');
		$code->setOptions(array(
				'label' => 'StudentForm:@Code',
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
		$studentDateOfBirth = new Lumia_Form_Element_DateOfBirth('student_birth');
		$studentDateOfBirth->setOptions(array(
				'label' => 'StudentForm:@Date of birth',
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($studentDateOfBirth);
		
		// Department
		$department = new Zend_Form_Element_Select('student_department');
		$department->setOptions(array(
				'label' => 'StudentForm:@Department',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						null => 'StudentForm:@Default'
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

		// Class
		$classes = new Zend_Form_Element_Select('student_class');
		$classes->setOptions(array(
				'label' => 'StudentForm:@Class',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						null => 'StudentForm:@Default'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
		));
		$this->addElement($classes);

		// Identification
		$identification = new Zend_Form_Element_Text('student_identification');
		$identification->setOptions(array(
				'label' => 'StudentForm:@Identification',
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
				'label' => 'StudentForm:@Status',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						1 => 'StudentForm:@Status active',
						0 => 'StudentForm:@Status inactive'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($status);

		// Gender
		$status = new Zend_Form_Element_Radio('student_gender');
		$status->setOptions(array(
				'label' => 'StudentForm:@Gender',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'multiOptions' => array(
						'male' => 'StudentForm:@Male',
						'female' => 'StudentForm:@Female'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper')
		));
		$this->addElement($status);

		// Permanent address line
		$addressLine = new Zend_Form_Element_Text('address_line');
		$addressLine->setOptions(array(
				'label' => 'StudentForm:@Address line',
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
				'label' => 'StudentForm:@Address line 2',
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
				'label' => 'StudentForm:@Postal code',
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
				'label' => 'StudentForm:@Phone number',
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
				'label' => 'StudentForm:@District',
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
				'label' => 'StudentForm:@State / Province / Region',
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
				'label' => 'StudentForm:@Country',
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
	
	/**
     * Populate form
     *
     * Proxies to {@link setDefaults()}
     *
     * @param  array $values
     * @return Zend_Form
     */
    public function populate(array $values)
	{
		$populate = parent::populate($values);
		
		// Get element department
		$department = $this->getElement('student_department');
		
		// Get element class
		$classes = $this->getElement('student_class');
		
		// Get all classes by department
		$classesModel = new Admin_Model_Classes();
		$classRows = $classesModel->getByDepartment(array($department->getValue()));
		if ($classRows->count())
		{
			foreach ($classRows as $classRow)
			{
				$classes->addMultiOption($classRow->class_id, $classRow->class_name);
			}
		}
		$classes->setValue($classes->getValue());
		
		return $populate;
	}
}
