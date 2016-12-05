<?php

class Lumia_Form_Element_ExamStartTime extends Zend_Form_Element_Xhtml
{
	/**
	 * @var string
	 */
	protected $_dateFormat = '%year%/%month%/%day% %hour%:%minute%:%second%';
	
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
	 * @var int
	 */
	protected $_hour;
	
	/**
	 * @var int
	 */
	protected $_minute;
	
	/**
	 * Options
	 * 
	 * @var	array
	 */
	protected $_options = array();
	
	/**
	 * Constructor
	 */
	public function __construct($spec, $options = null)
	{
		// Add decorator
		$this->addPrefixPath('Lumia_Form_Decorator', 'Lumia/Form/Decorator', 'decorator');
		
		parent::__construct($spec, $options);
		
		// Add validator
		$this->setValidators(array(
				array('Date', false, 'y/MM/dd HH:mm')
		));
		$this->addErrorMessages(array(Lumia_Validate_Date::FALSEFORMAT => 'Validate:@Value does not fit the date format Day/Month/Year Hour:Minute'));
		
		// Set default options
		$this->getDecorator('ExamStartTime')->setOptions(array(
			'day' => array('size' => 2, 'maxlength' => 2, 'placeholder' => $this->getView()->translate('DateTime:@Day')),
			'month' => array('size' => 2, 'maxlength' => 2, 'placeholder' => $this->getView()->translate('DateTime:@Month')),
			'year' => array('size' => 4, 'maxlength' => 4, 'placeholder' => $this->getView()->translate('DateTime:@Year')),
			'hour' => array('size' => 2, 'maxlength' => 2, 'placeholder' => $this->getView()->translate('DateTime:@Hour')),
			'minute' => array('size' => 2, 'maxlength' => 2, 'placeholder' => $this->getView()->translate('DateTime:@Minute'))
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
	 * @return Lumia_Form_Element_ExamStartTime
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
	 * @return Lumia_Form_Element_ExamStartTime
	 */
	public function setDay($value)
	{
		$this->_day = (string) $value;
		
		return $this;
	}

	/**
	 * Get day value
	 *
	 * @return int
	 */
	public function getDay()
	{
		return $this->_day;
	}

	/**
	 * Set month value
	 *
	 * @param int $value
	 * @return Lumia_Form_Element_ExamStartTime
	 */
	public function setMonth($value)
	{
		$this->_month = (string) $value;
		
		return $this;
	}

	/**
	 * Get month value
	 *
	 * @return int
	 */
	public function getMonth()
	{
		return $this->_month;
	}

	/**
	 * Set year value
	 *
	 * @param int $value
	 * @return Lumia_Form_Element_ExamStartTime
	 */
	public function setYear($value)
	{
		$this->_year = (string) $value;
		
		return $this;
	}

	/**
	 * Get year value
	 *
	 * @return int
	 */
	public function getYear()
	{
		return $this->_year;
	}

	/**
	 * Set hour value
	 *
	 * @param int $value
	 * @return Lumia_Form_Element_ExamStartTime
	 */
	public function setHour($value)
	{
		$this->_hour = (string) $value;
		
		return $this;
	}

	/**
	 * Get hour value
	 *
	 * @return int
	 */
	public function getHour()
	{
		return $this->_hour;
	}

	/**
	 * Set minute value
	 *
	 * @param int $value
	 * @return Lumia_Form_Element_ExamStartTime
	 */
	public function setMinute($value)
	{
		$this->_minute = (string) $value;
		
		return $this;
	}

	/**
	 * Get minute value
	 *
	 * @return int
	 */
	public function getMinute()
	{
		return $this->_minute;
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
				->setYear(date('Y', $value))
				->setHour(date('H', $value))
				->setMinute(date('i', $value));
		} elseif (is_string($value))
		{
			$date = strtotime($value);
			$this->setDay(date('d', $date))
				->setMonth(date('m', $date))
				->setYear(date('Y', $date))
				->setHour(date('H', $value))
				->setMinute(date('i', $value));
		} elseif (isset($value['day'], $value['month'], $value['year'], $value['hour'], $value['minute']))
		{
			$this->setDay($value['day'])
				->setMonth($value['month'])
				->setYear($value['year'])
				->setHour($value['hour'])
				->setMinute($value['minute']);
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
		return str_replace(array('%year%', '%month%', '%day%', '%hour%', '%minute%'), 
				array($this->getYear(), $this->getMonth(), $this->getDay(), $this->getHour(), $this->getMinute()), 
				$this->_dateFormat);
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
			$this->addDecorator('ExamStartTime');
		}
	}
}
