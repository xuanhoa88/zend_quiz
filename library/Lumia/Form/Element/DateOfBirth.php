<?php

class Lumia_Form_Element_DateOfBirth extends Zend_Form_Element_Xhtml
{
	/**
	 * @var string
	 */
	protected $_dateFormat = '%year%/%month%/%day%';
	
	/**
	 * @var string
	 */
	protected $_template;
	
	/**
	 * @var int
	 */
	protected $_day;
	
	/**
	 * @var int
	 */
	protected $_month;
	
	/**
	 * @var int
	 */
	protected $_year;
	
	/**
	 * Constructor
	 */
	public function __construct($spec, $options = null)
	{
		// Add decorator
		$this->addPrefixPath('Lumia_Form_Decorator', 'Lumia/Form/Decorator', 'decorator');
		
		parent::__construct($spec, $options);
		
		// Set validator
		$this->setValidators(array(
				array('Date', false, 'y/MM/dd')
		));
		$this->addErrorMessages(array(Lumia_Validate_Date::FALSEFORMAT => 'Validate:@Value does not fit the date format Day / Month / Year'));
		
		// Set default options
		$this->getDecorator('DateOfBirth')->setOptions(array(
			'day' => array('size' => 2, 'maxlength' => 2, 'placeholder' => $this->getView()->translate('DateTime:@Day')),
			'month' => array('size' => 2, 'maxlength' => 2, 'placeholder' => $this->getView()->translate('DateTime:@Month')),
			'year' => array('size' => 4, 'maxlength' => 4, 'placeholder' => $this->getView()->translate('DateTime:@Year'))
		));
	}

    /**
     * Overwrite all decorators
     *
     * @param  array $decorators
     * @return Zend_Form_Element
     */
    public function setDecorators(array $decorators)
    {
        return $this;
    }
	
	/**
	 * Set template render
	 * 
	 * @param	string $template
	 * @return Lumia_Form_Element_DateOfBirth
	 */
	public function setTemplate($template)
	{
		$this->_template = (string) $template;
		
		return $this;
	}
	
	/**
	 * Get template render
	 * 
	 * @return	string
	 */
	public function getTemplate()
	{
		return $this->_template;
	}
	
	/**
	 * Set day value
	 * 
	 * @param int $value
	 * @return Lumia_Form_Element_DateOfBirth
	 */
	public function setDay($value)
	{
		$this->_day = (string) $value;
		
		return $this;
	}

	/**
	 * Get day value
	 *
	 * @param int $value
	 * @return Lumia_Form_Element_DateOfBirth
	 */
	public function getDay()
	{
		return $this->_day;
	}

	/**
	 * Set month value
	 *
	 * @param int $value
	 * @return Lumia_Form_Element_DateOfBirth
	 */
	public function setMonth($value)
	{
		$this->_month = (string) $value;
		
		return $this;
	}

	/**
	 * Get month value
	 *
	 * @param int $value
	 * @return Lumia_Form_Element_DateOfBirth
	 */
	public function getMonth()
	{
		return $this->_month;
	}

	/**
	 * Set year value
	 *
	 * @param int $value
	 * @return Lumia_Form_Element_DateOfBirth
	 */
	public function setYear($value)
	{
		$this->_year = (string) $value;
		
		return $this;
	}

	/**
	 * Set year value
	 *
	 * @param int $value
	 * @return Lumia_Form_Element_DateOfBirth
	 */
	public function getYear()
	{
		return $this->_year;
	}
	
	/**
	 * Validate element value
	 *
	 * If a translation adapter is registered, any error messages will be
	 * translated according to the current locale, using the given error code;
	 * if no matching translation is found, the original message will be
	 * utilized.
	 *
	 * Note: The *filtered* value is validated.
	 *
	 * @param  mixed $value
	 * @param  mixed $context
	 * @return boolean
	 */
	public function setValue($value)
	{
		if (is_int($value))
		{
			$this->setDay(date('d', $value))
				->setMonth(date('m', $value))
				->setYear(date('Y', $value));
		} elseif (is_string($value))
		{
			$date = strtotime($value);
			$this->setDay(date('d', $date))
				->setMonth(date('m', $date))
				->setYear(date('Y', $date));
		} elseif (isset($value['day'], $value['month'], $value['year']))
		{
			$this->setDay($value['day'])
				->setMonth($value['month'])
				->setYear($value['year']);
		} else
		{
			throw new Zend_Form_Element_Exception('Invalid date value provided');
		}
		
		return $this;
	}

	/**
	 * Retrieve filtered element value
	 *
	 * @return mixed
	 */
	public function getValue()
	{
		return str_replace(array('%year%', '%month%', '%day%'), array($this->getYear(), $this->getMonth(), $this->getDay()), $this->_dateFormat);
	}
	
	/**
	 * Load default decorators
	 *
	 * @return Zend_Form_Element
	 */
	public function loadDefaultDecorators()
	{
		if ($this->loadDefaultDecoratorsIsDisabled())
		{
			return;
		}
		
		$decorators = $this->getDecorators();
		if (empty($decorators))
		{
			$this->addDecorator('DateOfBirth');
		}
	}
}
