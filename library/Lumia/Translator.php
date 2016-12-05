<?php
class Lumia_Translator extends ArrayObject 
{
	/**
	 * Constants
	 */
	const KEY = 'TRANSLATOR';
	
	/**
     * Singleton instance
     *
     * @var Lumia_Translator
     */
    protected static $_instance;

    /**
     * @var Zend_Translate
     */
    protected $_translator;

    /**
     * Constructs a parent ArrayObject with default
     * ARRAY_AS_PROPS to allow acces as an object
     *
     * @param array $array data array
     * @param integer $flags ArrayObject flags
     */
    public function __construct($array = array(), $flags = parent::ARRAY_AS_PROPS)
    {
        parent::__construct($array, $flags);
    }

    /**
     * Returns an instance of Lumia_Auth
     *
     * Singleton pattern implementation
     *
     * @return Lumia_Auth Provides a fluent interface
     */
    public static function getInstance()
    {
        if (null === self::$_instance) 
        {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Set translation object
     *
     * @param  Zend_Translate|Zend_Translate_Adapter|null $translator
     * @return Lumia_Translator
     * @throws Lumia_Exception
     */
    public static function set($translator = null)
    {
    	$instance = self::getInstance();
    	if (!$instance->offsetExists(self::KEY)) 
    	{
	    	if ((null === $translator) || ($translator instanceof Zend_Translate_Adapter)) 
	        {
	            $instance->offsetSet(self::KEY, $translator);
	        } elseif ($translator instanceof Zend_Translate) 
	        {
	        	$instance->offsetSet(self::KEY, $translator->getAdapter());
	        } else 
	        {
	            throw new Lumia_Exception('Invalid translator specified');
	        }
        }
    }

    /**
     * Return translation object
     *
     * @return Zend_Translate_Adapter
     * @throws Lumia_Exception
     */
    public static function get()
    {
    	$instance = self::getInstance();
    	if (!$instance->offsetExists(self::KEY)) 
    	{
    		if (Zend_Registry::isRegistered('Zend_Translate')) 
            {
                $translator = Zend_Registry::get('Zend_Translate');
                if ($translator instanceof Zend_Translate_Adapter) 
                {
                	$instance->offsetSet(self::KEY, $translator);
                } elseif ($translator instanceof Zend_Translate) 
                {
                	$instance->offsetSet(self::KEY, $translator->getAdapter());
                } else 
		        {
		            throw new Lumia_Exception('Invalid translator specified');
		        }
            }
        }
        
        return $instance->offsetGet(self::KEY);
    }

    /**
     * Workaround for http://bugs.php.net/bug.php?id=40442 (ZF-960).
     * 
     * @param string $index
     * @returns mixed
     */
    public function offsetExists($index)
    {
        return array_key_exists($index, $this);
    }
    
    /**
     * Returns TRUE if the existing translator,
     * or FALSE if translator not found.
     *
     * @return boolean
     */
    public static function alreadyExists()
    {
        return self::getInstance()->offsetExists(self::KEY);
    }
}