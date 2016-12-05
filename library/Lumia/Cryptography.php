<?php

/**
 * Generate short hashes from numbers
 *
 * @see http://www.hashids.org/php/
 */
class Lumia_Cryptography
{
	/**
	 * Singleton instance
	 *
	 * @var Lumia_Cryptography
	 */
	protected static $_instance = array();
	
	/**
	 * Retrieve a singleton instance of the class
	 *
	 * @return Lumia_Cryptography
	 */
	public static function factory($type = 'HashID')
	{
		$type = ucfirst($type);
		if (!isset(self::$_instance[$type]))
		{
			$class = 'Lumia_Cryptography_'. $type;
			self::$_instance[$type] = new $class();
		}
		
		return self::$_instance[$type];
	}
}