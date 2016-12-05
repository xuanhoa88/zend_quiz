<?php

/**
 * Autoloader stack and namespace autoloader
 *
 * @uses       Lumia_Loader_Autoloader
 * @package    Lumia_Loader
 * @subpackage Autoloader
 */
class Lumia_Loader_Autoloader extends Zend_Loader_Autoloader
{
	/**
	 * @var Lumia_Loader_Autoloader Singleton instance
	 */
	protected static $_instance;

    /**
     * Constructor
     *
     * Registers instance with spl_autoload stack
     *
     * @return void
     */
    protected function __construct()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
        $this->_internalAutoloader = array($this, '_autoload');
    }

	/**
	 * Retrieve singleton instance
	 *
	 * @return Lumia_Loader_Autoloader
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
	 * Autoload a class
	 *
	 * @param  string $class
	 * @return bool
	 */
	public static function autoload($class)
	{
		$self = self::getInstance();
		foreach ($self->getClassAutoloaders($class) as $autoloader) 
		{
			if ($autoloader instanceof Zend_Loader_Autoloader_Interface) 
			{
				if ($autoloader->autoload($class)) 
				{
					return true;
				}
			} elseif (is_array($autoloader)) 
			{
				if (call_user_func($autoloader, $class)) 
				{
					return true;
				}
			} elseif (is_string($autoloader) || is_callable($autoloader)) 
			{
				if ($autoloader($class)) 
				{
					return true;
				}
			}
		}
	
		return false;
	}
}