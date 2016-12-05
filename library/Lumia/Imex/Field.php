<?php

class Lumia_Imex_Field
{
	/**
	 * Field constants
	 */
	const FILTER    = 'FILTER';
	const VALIDATE  = 'VALIDATE';
	
    /**
     * Field filters
     * 
     * @var array
     */
    protected $_filters = array();

    /**
     * Field validators
     * 
     * @var array Validators
     */
    protected $_validators = array();

    /**
     * Required flag
     * 
     * @var bool
     */
    protected $_required = false;

    /**
     * Ignore flag
     * 
     * @var bool
     */
    protected $_ignore = false;

    /**
     * 'Allow empty' flag
     * 
     * @var bool
     */
    protected $_allowEmpty = true;

    /**
     * Flag indicating whether or not to insert NotEmpty validator when field is required
     * 
     * @var bool
     */
    protected $_autoInsertNotEmptyValidator = true;

    /**
     * is the translator disabled?
     * 
     * @var bool
     */
    protected $_translatorDisabled = false;
    
    /**
     * Field value
     * 
     * @var mixed
     */
    protected $_value;

    /**
     * Does the field represent an array?
     * 
     * @var bool
     */
    protected $_isArray = false;

    /**
     * Formatted validation error messages
     * 
     * @var array
     */
    protected $_messages = array();

    /**
     * Validation errors
     * 
     * @var array
     */
    protected $_errors = array();

    /**
     * Plugin loaders for filter and validator chains
     * 
     * @var array
     */
    protected $_loaders = array();

    /**
     * Field name
     * 
     * @var string
     */
    protected $_name;

    /**
     * Is the error marked as in an invalid state?
     * 
     * @var bool
     */
    protected $_isError = false;
    
    /**
     * Field label
     * 
     * @var string
     */
    protected $_label;

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
            $this->setName($spec);
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

        if (null === $this->getName()) 
        {
            throw new Lumia_Imex_Exception('Lumia_Imex_Field requires each field to have a name');
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
     * @return Lumia_Imex_Field
     */
    public function setOptions(array $options)
    {
        if (isset($options['prefixPath'])) 
        {
            $this->addPrefixPaths($options['prefixPath']);
            unset($options['prefixPath']);
        }

        if (isset($options['disableTranslator'])) 
        {
            $this->setDisableTranslator($options['disableTranslator']);
            unset($options['disableTranslator']);
        }
       
        unset($options['options'], $options['config']);

        foreach ($options as $key => $value) 
        {
            $method = 'set' . ucfirst($key);

            if (in_array($method, array('setTranslator', 'setPluginLoader'))) 
            {
                if (!is_object($value)) 
                {
                    continue;
                }
            }

            if (method_exists($this, $method)) 
            {
                // Setter exists; use it
                $this->{$method}($value);
            }
        }
        
        return $this;
    }

    /**
     * Return field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Filter a name to only allow valid variable characters
     *
     * @param  string $value
     * @param  bool $allowBrackets
     * @return string
     */
    public function filterName($value, $allowBrackets = false)
    {
        $charset = '^a-zA-Z0-9_\x7f-\xff';
        if ($allowBrackets) 
        {
            $charset .= '\[\]';
        }
        
        return preg_replace('/[' . $charset . ']/', '', (string) $value);
    }

    /**
     * Set field name
     *
     * @param  string $name
     * @return Zend_Form
     */
    public function setName($name)
    {
        $name = $this->filterName($name);
        if ('' === (string)$name) 
        {
            throw new Lumia_Imex_Exception('Invalid name provided; must contain only valid variable characters and be non-empty');
        }
        
        $this->_name = $name;

        return $this;
    }

    /**
     * Set field label
     *
     * @param  string $label
     * @return Zend_Form_Element
     */
    public function setLabel($label)
    {
        $this->_label = (string) $label;
        
        return $this;
    }

    /**
     * Retrieve field label
     *
     * @return string
     */
    public function getLabel()
    {
        if (null !== (Lumia_Translator::alreadyExists())) 
        {
            return Lumia_Translator::get()->translate($this->_label);
        }

        return $this->_label;
    }
    
    /**
     * Set plugin loader to use for validator or filter chain
     *
     * @param  Zend_Loader_PluginLoader_Interface $loader
     * @param  string $type 'filter' or 'validate'
     * @return Lumia_Imex_Field
     * @throws Lumia_Imex_Exception on invalid type
     */
    public function setPluginLoader(Zend_Loader_PluginLoader_Interface $loader, $type)
    {
        $type = strtoupper($type);
        switch ($type) {
            case self::FILTER:
            case self::VALIDATE:
                $this->_loaders[$type] = $loader;
                return $this;
            default:
                require_once 'Zend/Form/Exception.php';
                throw new Lumia_Imex_Exception(sprintf('Invalid type "%s" provided to setPluginLoader()', $type));
        }
    }

    /**
     * Retrieve plugin loader for validator or filter chain
     *
     * Instantiates with default rules if none available for that type. 
     * Use 'filter', or 'validate' for $type.
     *
     * @param  string $type
     * @return Zend_Loader_PluginLoader
     * @throws Zend_Loader_Exception on invalid type.
     */
    public function getPluginLoader($type)
    {
        switch ($type = strtoupper($type)) 
        {
            case self::FILTER:
            case self::VALIDATE:
                $prefixSegment = ucfirst(strtolower($type));
                $pathSegment   = $prefixSegment;
                if (!isset($this->_loaders[$type])) 
                {
                    require_once 'Zend/Loader/PluginLoader.php';
                    $this->_loaders[$type] = new Zend_Loader_PluginLoader(
                        array('Zend_' . $prefixSegment . '_' => 'Zend/' . $pathSegment . '/')
                    );
                }
                
                return $this->_loaders[$type];
            default:
                throw new Lumia_Imex_Exception(sprintf('Invalid type "%s" provided to getPluginLoader()', $type));
        }
    }

    /**
     * Add prefix path for plugin loader
     *
     * If no $type specified, assumes it is a base path for both filters and
     * validators, and sets each according to the following rules:
     * - filters: $prefix = $prefix . '_Filter'
     * - validators: $prefix = $prefix . '_Validate'
     *
     * Otherwise, the path prefix is set on the appropriate plugin loader.
     *
     * @param  string $prefix
     * @param  string $path
     * @param  string $type
     * @return Lumia_Imex_Field
     * @throws Lumia_Imex_Exception for invalid type
     */
    public function addPrefixPath($prefix, $path, $type = null)
    {
        switch ($type = strtoupper($type)) 
        {
            case self::FILTER:
            case self::VALIDATE:
                $loader = $this->getPluginLoader($type);
                $loader->addPrefixPath($prefix, $path);
                return $this;
            default:
                throw new Lumia_Imex_Exception(sprintf('Invalid type "%s" provided to getPluginLoader()', $type));
        }
    }

    /**
     * Add many prefix paths at once
     *
     * @param  array $spec
     * @return Lumia_Imex_Field
     */
    public function addPrefixPaths(array $spec)
    {
        if (isset($spec['prefix'], $spec['path'])) 
        {
            return $this->addPrefixPath($spec['prefix'], $spec['path']);
        }
        
        foreach ($spec as $type => $paths) 
        {
            if (is_numeric($type) && is_array($paths)) 
            {
                $type = null;
                if (isset($paths['prefix']) && isset($paths['path'])) 
                {
                    if (isset($paths['type'])) 
                    {
                        $type = $paths['type'];
                    }
                    
                    $this->addPrefixPath($paths['prefix'], $paths['path'], $type);
                }
            } elseif (!is_numeric($type)) 
            {
                if (!isset($paths['prefix']) || !isset($paths['path'])) 
                {
                    foreach ($paths as $prefix => $spec) 
                    {
                        if (is_array($spec)) 
                        {
                            foreach ($spec as $path) 
                            {
                                if (!is_string($path)) 
                                {
                                    continue;
                                }
                                
                                $this->addPrefixPath($prefix, $path, $type);
                            }
                        } elseif (is_string($spec)) 
                        {
                            $this->addPrefixPath($prefix, $spec, $type);
                        }
                    }
                } else 
                {
                    $this->addPrefixPath($paths['prefix'], $paths['path'], $type);
                }
            }
        }
        
        return $this;
    }
    
    /**
     * Add a filter to the field
     *
     * @param  string|Zend_Filter_Interface $filter
     * @return Lumia_Imex_Field
     */
    public function addFilter($filter, $options = array())
    {
        if ($filter instanceof Zend_Filter_Interface) 
        {
            $name = get_class($filter);
        } elseif (is_string($filter)) 
        {
            $name = $filter;
            $filter = array(
            		'filter'  => $filter,
            		'options' => $options,
            );
        } else 
        {
            throw new Lumia_Imex_Exception('Invalid filter provided to addFilter; must be string or Zend_Filter_Interface');
        }

        $this->_filters[$name] = $filter;

        return $this;
    }

    /**
     * Add filters to field
     *
     * @param  array $filters
     * @return Lumia_Imex_Field
     */
    public function addFilters(array $filters)
    {
        foreach ($filters as $filterInfo) 
        {
            if (is_string($filterInfo)) 
            {
                $this->addFilter($filterInfo);
            } elseif ($filterInfo instanceof Zend_Filter_Interface) 
            {
                $this->addFilter($filterInfo);
            } elseif (is_array($filterInfo)) 
            {
                $argc = count($filterInfo);
                $options = array();
                if (isset($filterInfo['filter'])) 
                {
                    $filter = $filterInfo['filter'];
                    if (isset($filterInfo['options'])) 
                    {
                        $options = $filterInfo['options'];
                    }
                    $this->addFilter($filter, $options);
                } else 
                {
                    switch (true) 
                    {
                        case (0 == $argc):
                            break;
                        case (1 <= $argc):
                            $filter  = array_shift($filterInfo);
                        case (2 <= $argc):
                            $options = array_shift($filterInfo);
                        default:
                            $this->addFilter($filter, $options);
                            break;
                    }
                }
            } else 
            {
                throw new Lumia_Imex_Exception('Invalid filter passed to addFilters()');
            }
        }
        
        return $this;
    }

    /**
     * Add filters to field, overwriting any already existing
     *
     * @param  array $filters
     * @return Lumia_Imex_Field
     */
    public function setFilters(array $filters)
    {
        $this->clearFilters();
        
        return $this->addFilters($filters);
    }

    /**
     * Retrieve a single filter by name
     *
     * @param  string $name
     * @return Zend_Filter_Interface
     */
    public function getFilter($name)
    {
        if (!isset($this->_filters[$name])) 
        {
            $len = strlen($name);
            foreach ($this->_filters as $localName => $filter) 
            {
                if ($len > strlen($localName)) 
                {
                    continue;
                }

                if (0 === substr_compare($localName, $name, -$len, $len, true)) 
                {
                    if (is_array($filter)) 
                    {
                        return $this->_loadFilter($filter);
                    }
                    
                    return $filter;
                }
            }
            
            return false;
        }

        if (is_array($this->_filters[$name])) 
        {
            return $this->_loadFilter($this->_filters[$name]);
        }

        return $this->_filters[$name];
    }

    /**
     * Get all filters
     *
     * @return array
     */
    public function getFilters()
    {
        $filters = array();
        foreach ($this->_filters as $key => $value) 
        {
            if ($value instanceof Zend_Filter_Interface) 
            {
                $filters[$key] = $value;
                continue;
            }
            
            $filter = $this->_loadFilter($value);
            $filters[get_class($filter)] = $filter;
        }
        
        return $filters;
    }

    /**
     * Remove a filter by name
     *
     * @param  string $name
     * @return Lumia_Imex_Field
     */
    public function removeFilter($name)
    {
        if (isset($this->_filters[$name])) 
        {
            unset($this->_filters[$name]);
        } else 
        {
            $len = strlen($name);
            foreach (array_keys($this->_filters) as $filter) 
            {
                if ($len > strlen($filter)) 
                {
                    continue;
                }
                
                if (0 === substr_compare($filter, $name, -$len, $len, true)) 
                {
                    unset($this->_filters[$filter]);
                    break;
                }
            }
        }

        return $this;
    }

    /**
     * Clear all filters
     *
     * @return Lumia_Imex_Field
     */
    public function clearFilters()
    {
        $this->_filters = array();
        
        return $this;
    }

    /**
     * Lazy-load a filter
     *
     * @param  array $filter
     * @return Zend_Filter_Interface
     */
    protected function _loadFilter(array $filter)
    {
        $origName = $filter['filter'];
        $name = $this->getPluginLoader(self::FILTER)->load($filter['filter']);

        if (array_key_exists($name, $this->_filters)) 
        {
            throw new Lumia_Imex_Exception(sprintf('Filter instance already exists for filter "%s"', $origName));
        }
		
        if (!array_key_exists('options', $filter)) 
        {
            $instance = new $name;
        } else 
        {
            $r = new ReflectionClass($name);
            if ($r->hasMethod('__construct')) 
            {
                $instance = $r->newInstanceArgs((array) $filter['options']);
            } else 
            {
                $instance = $r->newInstance();
            }
        }

        if ($origName != $name) 
        {
            $filterNames  = array_keys($this->_filters);
            $order        = array_flip($filterNames);
            $order[$name] = $order[$origName];
            $filtersExchange = array();
            unset($order[$origName]);
            asort($order);
            foreach ($order as $key => $index) 
            {
                if ($key == $name) 
                {
                    $filtersExchange[$key] = $instance;
                    continue;
                }
                
                $filtersExchange[$key] = $this->_filters[$key];
            }
            
            $this->_filters = $filtersExchange;
        } else 
        {
            $this->_filters[$name] = $instance;
        }

        return $instance;
    }
    
    /**
     * Add validator to validation chain
     *
     * Note: will overwrite existing validators if they are of the same class.
     *
     * @param  string|Zend_Validate_Interface $validator
     * @param  bool $breakChainOnFailure
     * @param  array $options
     * @return Lumia_Imex_Field
     * @throws Lumia_Imex_Exception if invalid validator type
     */
    public function addValidator($validator, $breakChainOnFailure = true, $options = array())
    {
        if ($validator instanceof Zend_Validate_Interface) 
        {
            $name = get_class($validator);
            if (!isset($validator->zfBreakChainOnFailure)) 
            {
                $validator->zfBreakChainOnFailure = $breakChainOnFailure;
            }
        } elseif (is_string($validator)) 
        {
            $name = $validator;
            $validator = array(
                'validator' => $validator,
                'breakChainOnFailure' => $breakChainOnFailure,
                'options'             => $options,
            );
        } else 
        {
            throw new Lumia_Imex_Exception('Invalid validator provided to addValidator; must be string or Zend_Validate_Interface');
        }

        $this->_validators[$name] = $validator;

        return $this;
    }

    /**
     * Add multiple validators
     *
     * @param  array $validators
     * @return Lumia_Imex_Field
     */
    public function addValidators(array $validators)
    {
        foreach ($validators as $validatorInfo) 
        {
            if (is_string($validatorInfo)) 
            {
                $this->addValidator($validatorInfo);
            } elseif ($validatorInfo instanceof Zend_Validate_Interface) 
            {
                $this->addValidator($validatorInfo);
            } elseif (is_array($validatorInfo)) 
            {
                $argc = count($validatorInfo);
                $breakChainOnFailure = true;
                $options = array();
                if (isset($validatorInfo['validator'])) 
                {
                    $validator = $validatorInfo['validator'];
                    
                    if (isset($validatorInfo['breakChainOnFailure'])) 
                    {
                        $breakChainOnFailure = $validatorInfo['breakChainOnFailure'];
                    }
                    
                    if (isset($validatorInfo['options'])) 
                    {
                        $options = $validatorInfo['options'];
                    }
                    
                    $this->addValidator($validator, $breakChainOnFailure, $options);
                } else 
                {
                    switch (true) 
                    {
                        case (0 == $argc):
                            break;
                        case (1 <= $argc):
                            $validator  = array_shift($validatorInfo);
                        case (2 <= $argc):
                            $breakChainOnFailure = array_shift($validatorInfo);
                        case (3 <= $argc):
                            $options = array_shift($validatorInfo);
                        default:
                            $this->addValidator($validator, $breakChainOnFailure, $options);
                            break;
                    }
                }
            } else 
            {
                throw new Lumia_Imex_Exception('Invalid validator passed to addValidators()');
            }
        }

        return $this;
    }

    /**
     * Set multiple validators, overwriting previous validators
     *
     * @param  array $validators
     * @return Lumia_Imex_Field
     */
    public function setValidators(array $validators)
    {
        $this->clearValidators();
        
        return $this->addValidators($validators);
    }

    /**
     * Retrieve a single validator by name
     *
     * @param  string $name
     * @return Zend_Validate_Interface|false False if not found, validator otherwise
     */
    public function getValidator($name)
    {
        if (!isset($this->_validators[$name])) 
        {
            $len = strlen($name);
            foreach ($this->_validators as $localName => $validator) 
            {
                if ($len > strlen($localName)) 
                {
                    continue;
                }
                
                if (0 === substr_compare($localName, $name, -$len, $len, true)) 
                {
                    if (is_array($validator)) 
                    {
                        return $this->_loadValidator($validator);
                    }
                    
                    return $validator;
                }
            }
            
            return false;
        }

        if (is_array($this->_validators[$name])) 
        {
            return $this->_loadValidator($this->_validators[$name]);
        }

        return $this->_validators[$name];
    }

    /**
     * Retrieve all validators
     *
     * @return array
     */
    public function getValidators()
    {
        $validators = array();
        foreach ($this->_validators as $key => $value) 
        {
            if ($value instanceof Zend_Validate_Interface) 
            {
                $validators[$key] = $value;
                continue;
            }
            
            $validator = $this->_loadValidator($value);
            $validators[get_class($validator)] = $validator;
        }
        
        return $validators;
    }

    /**
     * Remove a single validator by name
     *
     * @param  string $name
     * @return bool
     */
    public function removeValidator($name)
    {
        if (isset($this->_validators[$name])) 
        {
            unset($this->_validators[$name]);
        } else 
        {
            $len = strlen($name);
            foreach (array_keys($this->_validators) as $validator) 
            {
                if ($len > strlen($validator)) 
                {
                    continue;
                }
                
                if (0 === substr_compare($validator, $name, -$len, $len, true)) 
                {
                    unset($this->_validators[$validator]);
                    break;
                }
            }
        }

        return $this;
    }

    /**
     * Clear all validators
     *
     * @return Lumia_Imex_Field
     */
    public function clearValidators()
    {
        $this->_validators = array();
        
        return $this;
    }

    /**
     * Lazy-load a validator
     *
     * @param  array $validator Validator definition
     * @return Zend_Validate_Interface
     */
    protected function _loadValidator(array $validator)
    {
        $origName = $validator['validator'];
        $name = $this->getPluginLoader(self::VALIDATE)->load($validator['validator']);

        if (array_key_exists($name, $this->_validators)) 
        {
            throw new Lumia_Imex_Exception(sprintf('Validator instance already exists for validator "%s"', $origName));
        }

        $messages = false;
        if (isset($validator['options']) && array_key_exists('messages', (array)$validator['options'])) 
        {
            $messages = $validator['options']['messages'];
            unset($validator['options']['messages']);
        }

        if (!array_key_exists('options', $validator)) 
        {
            $instance = new $name;
        } else 
        {
            $r = new ReflectionClass($name);
            if ($r->hasMethod('__construct')) 
            {
                $numeric = false;
                if (is_array($validator['options'])) 
                {
                    $keys = array_keys($validator['options']);
                    foreach($keys as $key) 
                    {
                        if (is_numeric($key)) 
                        {
                            $numeric = true;
                            break;
                        }
                    }
                }

                if ($numeric) 
                {
                    $instance = $r->newInstanceArgs((array) $validator['options']);
                } else 
                {
                    $instance = $r->newInstance($validator['options']);
                }
            } else 
            {
                $instance = $r->newInstance();
            }
        }

        if ($messages) 
        {
            if (is_array($messages)) 
            {
                $instance->setMessages($messages);
            } elseif (is_string($messages)) 
            {
                $instance->setMessage($messages);
            }
        }
        
        $instance->zfBreakChainOnFailure = $validator['breakChainOnFailure'];

        if ($origName != $name) 
        {
            $validatorNames = array_keys($this->_validators);
            $order = array_flip($validatorNames);
            $order[$name] = $order[$origName];
            $validatorsExchange = array();
            unset($order[$origName]);
            asort($order);
            foreach ($order as $key => $index) 
            {
                if ($key == $name) 
                {
                    $validatorsExchange[$key] = $instance;
                    continue;
                }
                
                $validatorsExchange[$key] = $this->_validators[$key];
            }
            
            $this->_validators = $validatorsExchange;
        } else 
        {
            $this->_validators[$name] = $instance;
        }

        return $instance;
    }

    /**
     * Set required flag
     *
     * @param  bool $flag Default value is true
     * @return Lumia_Imex_Field
     */
    public function setRequired($flag = true)
    {
        $this->_required = (bool) $flag;
        
        return $this;
    }

    /**
     * Is the field required?
     *
     * @return bool
     */
    public function isRequired()
    {
        return $this->_required;
    }

    /**
     * Set 'allow empty' flag
     *
     * When the allow empty flag is enabled and the required flag is false, the
     * field will validate with empty values.
     *
     * @param  bool $flag
     * @return Lumia_Imex_Field
     */
    public function setAllowEmpty($flag)
    {
        $this->_allowEmpty = (bool) $flag;
        
        return $this;
    }

    /**
     * Get 'allow empty' flag
     *
     * @return bool
     */
    public function getAllowEmpty()
    {
        return $this->_allowEmpty;
    }

    /**
     * Set ignore flag
     *
     * @param  bool $flag
     * @return Lumia_Imex_Field
     */
    public function setIgnore($flag)
    {
        $this->_ignore = (bool) $flag;
        
        return $this;
    }

    /**
     * Get ignore flag
     *
     * @return bool
     */
    public function getIgnore()
    {
        return $this->_ignore;
    }

    /**
     * Set flag indicating whether a NotEmpty validator should be inserted when field is required
     *
     * @param  bool $flag
     * @return Lumia_Imex_Field
     */
    public function setAutoInsertNotEmptyValidator($flag)
    {
        $this->_autoInsertNotEmptyValidator = (bool) $flag;
        
        return $this;
    }

    /**
     * Get flag indicating whether a NotEmpty validator should be inserted when field is required
     *
     * @return bool
     */
    public function autoInsertNotEmptyValidator()
    {
        return $this->_autoInsertNotEmptyValidator;
    }

    /**
     * Indicate whether or not translation should be disabled
     *
     * @param  bool $flag
     * @return Zend_Form
     */
    public function setDisableTranslator($flag)
    {
        $this->_translatorDisabled = (bool) $flag;
        
        return $this;
    }

    /**
     * Is translation disabled?
     *
     * @return bool
     */
    public function translatorIsDisabled()
    {
        return $this->_translatorDisabled;
    }

    /**
     * Set flag indicating if field represents an array
     *
     * @param  bool $flag
     * @return Lumia_Imex_Field
     */
    public function setIsArray($flag)
    {
        $this->_isArray = (bool) $flag;
        return $this;
    }

    /**
     * Is the field representing an array?
     *
     * @return bool
     */
    public function isArray()
    {
        return $this->_isArray;
    }
    
    /**
     * Validate field value
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
    public function isValid($value, $context = null)
    {
        $this->setValue($value);
        $value = $this->getValue();

        if ((('' === $value) || (null === $value)) && !$this->isRequired() && $this->getAllowEmpty()) 
        {
            return true;
        }

        if ($this->isRequired() && $this->autoInsertNotEmptyValidator() && !$this->getValidator('NotEmpty'))
        {
            $validators = $this->getValidators();
            $notEmpty = array('validator' => 'NotEmpty', 'breakChainOnFailure' => true);
            array_unshift($validators, $notEmpty);
            $this->setValidators($validators);
        }

        // Find the correct translator. Zend_Validate_Abstract::getDefaultTranslator()
        // will get either the static translator attached to Zend_Validate_Abstract
        // or the 'Zend_Translate' from Zend_Registry.
        if (Zend_Validate_Abstract::hasDefaultTranslator() && !Lumia_Translator::alreadyExists())
        {
            $translator = Zend_Validate_Abstract::getDefaultTranslator();
        } else 
        {
            $translator = $this->translatorIsDisabled() ? null : Lumia_Translator::get();
        }

        $this->_messages = array();
        $this->_errors   = array();
        $result = true;
        $isArray = $this->isArray();
        foreach ($this->getValidators() as $key => $validator) 
        {
            if (method_exists($validator, 'setTranslator')) 
            {
                if (method_exists($validator, 'hasTranslator')) 
                {
                    if (!$validator->hasTranslator()) 
                    {
                        $validator->setTranslator($translator);
                    }
                } else 
                {
                    $validator->setTranslator($translator);
                }
            }

            if (method_exists($validator, 'setDisableTranslator')) 
            {
                $validator->setDisableTranslator($this->translatorIsDisabled());
            }

            if ($isArray && is_array($value)) 
            {
                $messages = array();
                $errors = array();
                foreach ($value as $val) 
                {
                    if (!$validator->isValid($val, $context)) 
                    {
                        $result = false;
                        $messages = array_merge($messages, $validator->getMessages());
                        $errors = array_merge($errors, $validator->getErrors());
                    }
                }
                
                if ($result) 
                {
                    continue;
                }
            } elseif ($validator->isValid($value, $context)) 
            {
                continue;
            } else 
            {
                $result = false;
                $messages = $validator->getMessages();
                $errors = array_keys($messages);
            }

            $result = false;
            $this->_messages = array_merge($this->_messages, $messages);
            $this->_errors = array_merge($this->_errors, $errors);

            if ($validator->zfBreakChainOnFailure) 
            {
                break;
            }
        }
        
        $this->_isError = !$result;
		
        return $result;
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
     * Retrieve validator chain errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->_errors;
    }

    /**
     * Retrieve error messages
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->_messages;
    }

    /**
     * Set field value
     *
     * @param  mixed $value
     * @return Lumia_Imex_Field
     */
    public function setValue($value)
    {
        $this->_value = $value;
        
        return $this;
    }

    /**
     * Filter a value
     *
     * @param  string $value
     * @param  string $key
     * @return void
     */
    protected function _filterValue(&$value, &$key)
    {
        foreach ($this->getFilters() as $filter) 
        {
            $value = $filter->filter($value);
        }
    }

    /**
     * Retrieve filtered field value
     *
     * @return mixed
     */
    public function getValue()
    {
        $valueFiltered = $this->_value;
        if ($this->isArray() && is_array($valueFiltered)) 
        {
            array_walk_recursive($valueFiltered, array($this, '_filterValue'));
        } else 
        {
            $this->_filterValue($valueFiltered, $valueFiltered);
        }

        return $valueFiltered;
    }

    /**
     * Retrieve unfiltered field value
     *
     * @return mixed
     */
    public function getUnfilteredValue()
    {
        return $this->_value;
    }
}