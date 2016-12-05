<?php
class Admin_Form_Setting_General extends Lumia_Form
{
	/**
	 * @var string
	 */
	protected $_viewScript = 'setting/form/general.phtml';
	
	/**
	 * Overrides init() in Zend_Form
	 *
	 * @return void
	 */
	public function init()
	{
		parent::init();
		
		$this->setAction($this->getView()->baseUrl('/admin/setting/general'));

		// Set the form's attributes
		$this->setName('settingGeneralForm');
		$this->setMethod(self::METHOD_POST);

		// Site title
		$siteTitle = new Zend_Form_Element_Text('site_title');
		$siteTitle->setOptions(array(
				'label' => 'Setting:@Site title',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($siteTitle);

		// Email address
		$emailAddress = new Zend_Form_Element_Text('email_address');
		$emailAddress->setOptions(array(
				'label' => 'Setting:@Email address',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('NotEmpty', array('EmailAddress', true, array(array(
			        'allow' => Zend_Validate_Hostname::ALLOW_DNS,
			        'mx'    => false,
			        'deep'  => false
			    )))),
				'decorators' => array('ViewHelper'),
				'autocomplete' => 'off'
		));
		$this->addElement($emailAddress);
		
		// Membership
		$membership = new Zend_Form_Element_Checkbox('users_can_register');
		$membership->setOptions(array(
				'label' => 'Setting:@Membership',
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'decorators' => array('ViewHelper'),
				'placeholder' => $this->getTranslator()->translate('Setting:@Anyone can register')
		));
		$this->addElement($membership);
		
		// Timezone
		$timeZone = new Zend_Form_Element_Select('timezone');
		$timeZone->setOptions(array(
				'label' => 'Setting:@Timezone',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper')
		));
		
		$timeZone->addMultiOptions(Lumia_Utility_Timezone::getInstance()->fetchAll());
		$this->addElement($timeZone);
		
		// Week Starts On
		$startOfWeek = new Zend_Form_Element_Select('start_of_week');
		$startOfWeek->setOptions(array(
				'label' => 'Setting:@Week Starts On',
				'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
				'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper')
		));
		
		$startOfWeek->addMultiOptions(Lumia_Utility_Locale::getInstance()->getWeekDays());
		$this->addElement($startOfWeek);
		
		// DateTime object
		$dateTimeObj = Lumia_Utility_DateTime::getInstance();
		
		// Date format
		$dateFormat = new Zend_Form_Element_Radio('date_format');
		$dateFormat->setOptions(array(
				'label' => 'Setting:@Date format',
		        'required' => true,
				'filters' => array(
						'StringTrim',
						'StripTags'
				),
		        'escape' => false,
		        'validators' => array('NotEmpty'),
				'decorators' => array('ViewHelper')
		));
		
		$dateFormatOptions = array( 'YYYY-MM-dd', 'MM/dd/YYYY', 'dd/MM/YYYY' );
		foreach ( $dateFormatOptions as $format ) 
		{
			$dateFormat->addMultiOption($format, $dateTimeObj->toString($format));
		}
		
		// Date format custom
		$dateFormatCustom = new Zend_Form_Element_Text('date_format_custom');
		$dateFormatCustom->setOptions(array(
		    'label' => 'Setting:@Custom',
		    'filters' => array(
		        'StringTrim',
		        'StripTags'
		    ),
		    'validators' => array(
	    		array('Dependency', true, array('date_format', 'custom', 'function(element) {return jQuery("[name=date_format]:checked").val() === "custom"}'))
			),
		    'decorators' => array('ViewHelper'),
		    'autocomplete' => 'off',
		    'placeholder' => $this->getTranslator()->translate('Setting:@Custom')
		))->setAttribs(array('class' => 'form-control'));
		
		$this->addElement($dateFormatCustom);
		$dateFormat->addMultiOption('custom', $dateFormatCustom);
		
		$this->addElement($dateFormat);
		
		// Time format
		$timeFormat = new Zend_Form_Element_Radio('time_format');
		$timeFormat->setOptions(array(
		    'label' => 'Setting:@Time format',
		    'required' => true,
		    'filters' => array(
		        'StringTrim',
		        'StripTags'
		    ),
		    'escape' => false,
		    'validators' => array('NotEmpty'),
		    'decorators' => array('ViewHelper')
		));
		
		$timeFormatOptions = array( 'H:m a', 'HH:m a', 'HH:mm' );
		foreach ( $timeFormatOptions as $format )
		{
		    $timeFormat->addMultiOption($format, $dateTimeObj->toString($format));
		}
		
		// Time format custom
		$timeFormatCustom = new Zend_Form_Element_Text('time_format_custom');
		$timeFormatCustom->setOptions(array(
		    'label' => 'Setting:@Custom',
		    'filters' => array(
		        'StringTrim',
		        'StripTags'
		    ),
		    'validators' => array(
		    		array('Dependency', true, array('time_format', 'custom', 'function(element) {return jQuery("[name=time_format]:checked").val() === "custom"}'))
		    ),
		    'decorators' => array('ViewHelper'),
		    'autocomplete' => 'off',
		    'placeholder' => $this->getTranslator()->translate('Setting:@Custom')
		))->setAttribs(array('class' => 'form-control'));
		
		$this->addElement($timeFormatCustom);
		$timeFormat->addMultiOption('custom', $timeFormatCustom);
		
		$this->addElement($timeFormat);
		
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
