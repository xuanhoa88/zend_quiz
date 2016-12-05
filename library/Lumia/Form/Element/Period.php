<?php

class Lumia_Form_Element_Period extends Zend_Form_Element_Xhtml
{
	/**
	 * @var string
	 */
	protected $_template;
	
	/**
	 * @var int
	 */
	protected $_begin;
	
	/**
	 * @var int
	 */
	protected $_end;
	
	/**
	 * Constructor
	 */
	public function __construct($spec, $options = null)
	{
		$this->addPrefixPath('Lumia_Form_Decorator', 'Lumia/Form/Decorator', 'decorator');
		
		parent::__construct($spec, $options);
		
		$this->setValidators(array(
				array('StringLength', false, 2)
		));
		$this->addErrorMessages(array(Lumia_Validate_StringLength::INVALID => 'Validate:@Value is required and can\'t be empty'));
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
	 * @return Lumia_Form_Element_Period
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
	 * Set begin of period time value
	 * 
	 * @param int $value
	 * @return Lumia_Form_Element_Period
	 */
	public function setBegin($value)
	{
		$this->_begin = (string) $value;
		
		return $this;
	}

	/**
	 * Get begin of period time value
	 *
	 * @param int $value
	 * @return Lumia_Form_Element_Period
	 */
	public function getBegin()
	{
		return $this->_begin;
	}

	/**
	 * Set end of period time value
	 *
	 * @param int $value
	 * @return Lumia_Form_Element_Period
	 */
	public function setEnd($value)
	{
		$this->_end = (string) $value;
		
		return $this;
	}

	/**
	 *  Get end of period time value
	 *
	 * @param int $value
	 * @return Lumia_Form_Element_Period
	 */
	public function getEnd()
	{
		return $this->_end;
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
		try
		{
			if (is_string($value))
			{
				$splitVal = explode('-', $value);
				
				if (isset($splitVal[0]))
				{
					$this->setBegin($splitVal[0]);
				}
				
				if (isset($splitVal[1]))
				{
					$this->setEnd($splitVal[1]);
				}
			} elseif (isset($value['begin'], $value['end']))
			{
				$this->setBegin($value['begin']);
				$this->setEnd($value['end']);
			}
			
		} catch (Zend_Form_Element_Exception $e)
		{
			throw new Zend_Form_Element_Exception('Invalid period value provided');
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
		return $this->getBegin() . '-' . $this->getEnd();
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
			$this->addDecorator('Period');
		}
	}
}
