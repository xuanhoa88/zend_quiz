<?php

class Lumia_Utility_DateTime extends Zend_Date 
{
	const NOW = 'CURRENT_DATE';
	const MYSQL_DATETIME = 'MYSQL_DATETIME';
	const MYSQL_TIME = 'MYSQL_TIME';
	const MYSQL_TIMESTAMP = 'MYSQL_TIMESTAMP';
	
	/**
	 * Singleton instance
	 *
	 * @var Lumia_Utility_DateTime
	 */
	protected static $_instance = array();
	
	/**
	 * Retrieve a singleton instance of the class
	 *
	 * @return Lumia_Utility_DateTime
	 */
	public static function getInstance($date = self::NOW, $part = Zend_Date::TIMESTAMP, $locale = null)
	{
		if ($date === self::NOW)
		{
			$date = time();
		}
		
		if (null === $locale && Zend_Registry::isRegistered('Zend_Locale'))
		{
			$locale = Zend_Registry::get('Zend_Locale');
		}
		
		$singletonKey = serialize(func_get_args());
		if (!array_key_exists($singletonKey, self::$_instance) || !self::$_instance[$singletonKey] instanceof Zend_Date) 
		{
			self::$_instance = new self($date, $part, $locale);
		}
		
		return self::$_instance;
	}

	/**
     * Returns the current date
     *
     * @param  string|Zend_Locale $locale  OPTIONAL Locale for parsing input
     * @return Zend_Date
     */
    public static function now($format = 'YYYY-MM-dd HH:mm:ss', $locale = null)
    {
    	self::getInstance(self::NOW, Zend_Date::TIMESTAMP, $locale);
    	
        return self::$_instance->toString($format, $locale);
    }
    
    /**
     * Returns the current date corresponds with mysql
     * 
     * @param string $type
     * @param string|Zend_Locale $locale
     * @return string
     */
    public function toMysql($type = self::MYSQL_DATETIME, $locale = null)
    {
    	self::now('YYYY-MM-dd HH:mm:ss', $locale);

    	switch ($type)
    	{
    		case self::MYSQL_TIME:
    			$format = 'HH:mm:ss';
    			break;
    		case self::MYSQL_TIMESTAMP:
    			$format = Zend_Date::TIMESTAMP;
    			break;
    		default:
    			$format = 'YYYY-MM-dd HH:mm:ss';
    			break;
    	}
    	
    	return $this->toString($format, $locale);
    }
}