<?php

abstract class Lumia_Imex_Abstract
{
	/**
	 * Array of initialized file format
	 *
	 * @var array
	 */
	protected $_fileFormat = array();
	
	/**
	 * File path
	 * 
	 * @var	string
	 */
	protected $_filePath;

    /**
     * @var array
     */
    protected $_fields = array();
    
    /**
     * @var array
    */
    protected $_options = array();
	
	/**
     * Is the error marked as in an invalid state?
     * 
     * @var bool
     */
    protected $_isError = false; 

    /**
     * Validation errors
     * 
     * @var array
     */
    protected $_errors = array();
	
	/**
     * Constructor
     *
     * $spec may be:
     * - string: name of field
     * - array: options with which to configure field
     * - Zend_Config: Zend_Config with options for configuring field
     *
     * @param  string|array|Zend_Config $spec
     * @param  array|Zend_Config $options
     * @return void
     * @throws Lumia_Imex_Exception if no field name after initialization
     */
    public function __construct($spec, $options = null)
	{
		if (is_string($spec))
		{
			$this->setFileFormat($spec);
		} elseif (is_array($spec))
		{
			$this->setOptions($spec);
		} elseif ($spec instanceof Zend_Config)
		{
			$this->setOptions($spec->toArray());
		}
		
		if (is_string($spec) && is_array($options))
		{
			$this->setOptions($options);
		} elseif (is_string($spec) && ($options instanceof Zend_Config))
		{
			$this->setOptions($options->toArray());
		}
		
		/**
		 * Extensions
		 */
		$this->init();
	}
	
	/**
	 * Initialize object; used by extending classes
	 *
	 * @return void
	 */
	public function init()
	{
	}

    /**
     * Set object state from options array
     *
     * @param  array $options
     * @return Lumia_Imex_Abstract
     */
    public function setOptions(array $options)
    {
        unset($options['options'], $options['config']);

        foreach ($options as $key => $value) 
        {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) 
            {
                // Setter exists; use it
                $this->{$method}($value);
            } else 
            {
            	$this->_options[$key] = $value;
            }
        }
        
        return $this;
    }

    /**
     * Retrieve a value from options.
     *
     * @param string $name
     * @return mixed
     */
    public function getOption($name)
    {
        return isset($this->_options[$name]) ? $this->_options[$name] : null;
    }
    
    /**
     * Set option's value
     *
     * @param  string $name
     * @param  mixed  $value
     * @return Lumia_Imex_Abstract
     */
    public function setOption($name, $value)
    {
    	$this->_options[$name] = $value;
    	
    	return $this;
    }
	
	/**
	 * Set file format
	 * 
	 * @param	string $fileFormat
	 * @return	Lumia_Imex_Abstract
	 */
	public function setFileFormat($fileFormat)
	{
		$this->_fileFormat = Zend_Json::decode($fileFormat);
		
		return $this;
	}
	
	/**
	 * Set file path
	 * 
	 * @param	string $filePath
	 * @return	Lumia_Imex_Abstract
	 */
	public function setFilePath($filePath)
	{
		$this->_filePath = str_replace('/', DIRECTORY_SEPARATOR, $filePath);
		
		return $this;
	}
	
	/**
	 * Retrieve file path
	 * 
	 * @return	string
	 */
	public function getFilePath()
	{
		return (string) $this->_filePath;
	}
	
	/**
	 * Process file format
	 * 
	 * @return	Lumia_Imex_Abstract
	 * @throws	Lumia_Imex_Exception
	 */
	public function process()
	{
		// If the fields empty or not array, throw exception
		if (empty($this->_fileFormat['fields']) || !is_array($this->_fileFormat['fields']))
		{
			throw new Lumia_Imex_Exception('The format of import file not found');
		}
		
		// Remove invalid field name
		array_filter($this->_fileFormat['fields'], 'is_string');
		
		// If the fields empty, throw exception
		if (empty($this->_fileFormat['fields']))
		{
			throw new Lumia_Imex_Exception('The format of import file not found');
		}
		
		// Get extend options for each filter
		$extendFilters = empty($this->_fileFormat['filters']) ? null : (array) $this->_fileFormat['filters'];
		
		// Get extend options for each validator
		$extendValidators = empty($this->_fileFormat['validators']) ? null : (array) $this->_fileFormat['validators'];
		
		foreach ($this->_fileFormat['fields'] as $fieldName => $options)
		{
			// Init field obj
			$fieldObj = new Lumia_Imex_Field($fieldName, $options);
			$fieldObj->addPrefixPath('Lumia_Validate_', 'Lumia/Validate', 'validate');
			$fieldObj->addPrefixPath('Lumia_Filter_', 'Lumia/Filter', 'filter');
			
			// Set field label
			$fieldObj->setLabel(isset($options['label']) ? (string) $options['label'] : $fieldName);
			
			// Modify existing filters
			if (!empty($extendFilters[$fieldName]))
			{
				$fieldFilter = $fieldObj->getFilters();
				$fieldObj->clearFilters();
				foreach ($extendFilters[$fieldName] as $filterName => $filterOptions)
				{
					if (empty($fieldFilter[$filterName]))
					{
						continue;
					}
					
					if (is_array($filterOptions))
					{
						$fieldFilter[$filterName] = array_merge($fieldFilter[$filterName], $filterOptions);
					} elseif (is_callable($filterOptions))
					{
						if (is_array($filterOptions = call_user_func($filterOptions, $fieldObj)))
						{
							$fieldFilter[$filterName] = array_merge($fieldFilter[$filterName], $filterOptions);
						}
					}
				}
				
				$fieldObj->addFilters($fieldFilter);
			}
			
			// Modify existing validators
			if (!empty($extendValidators[$fieldName]))
			{
				$fieldValidator = $fieldObj->getValidators();
				$fieldObj->clearValidators();
				
				// Load extend validator's configuration
				foreach ($extendValidators[$fieldName] as $validatorName => $cfg)
				{
					$extendValidators[$fieldName][$fieldObj->getPluginLoader(Lumia_Imex_Field::VALIDATE)->load($validatorName)] = $cfg;
					unset($extendValidators[$fieldName][$validatorName]);
				}
				
				foreach ($extendValidators[$fieldName] as $validatorName => $validatorOptions)
				{
					if (empty($fieldValidator[$validatorName]))
					{
						continue;
					}
					
					if (is_callable($validatorOptions))
					{
						call_user_func($validatorOptions, $fieldValidator[$validatorName], $fieldObj);
					}
				}
				
				$fieldObj->addValidators($fieldValidator);
			}
			
			$this->_fields[$fieldName] = $fieldObj;
		}
		
		// Process data
		$this->_fileHandler();
	}

    /**
     * Are there errors registered?
     *
     * @return bool
     */
    public function hasErrors()
    {
        return $this->_isError;
    }

    /**
     * Retrieve errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->_errors;
    }
	
	/**
	 * Process file data
	 */
	abstract protected function _fileHandler();
}