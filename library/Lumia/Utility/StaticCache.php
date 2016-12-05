<?php
class Lumia_Utility_StaticCache 
{
	/**
	 * Storage unique name with corresponding value
	 * 
	 * @var array
	 */
	private static $_dataCache = array();
	
	/**
	 * Storage default value
	 * 
	 * @var array
	 */
	private static $_defaultValue = array();
	
	/**
	 * Provides central static variable storage.
	 * 
	 * All functions requiring a static variable to persist or cache data within 
	 * a single page request are encouraged to use this function unless it is absolutely certain 
	 * that the static variable will not need to be reset during the page request. 
	 * By centralizing static variable storage through this function, other functions can rely on a consistent API 
	 * for resetting any other function's static variables.
	 * 
	 * @param 	string $name <Globally unique name for the variable>
	 * @param 	mixed $defaultValue <Optional default value>
	 * @param 	boolean $reset <TRUE to reset one or all variables(s)>
	 * @return 	mixed
	 */
	public static function &add($name, $defaultValue = NULL, $reset = FALSE) 
	{
		// First check if dealing with a previously defined static variable.
		if (isset ( self::$_dataCache[$name] ) || array_key_exists( $name, self::$_dataCache )) 
		{
			// Non-NULL $name and both self::$_dataCache[$name] and self::$_defaultValue[$name] statics exist.
			if ($reset) 
			{
				// Reset pre-existing static variable to its default value.
				self::$_dataCache[$name] = self::$_defaultValue[$name];
			}
			
			return self::$_dataCache[$name];
		}
		
		// Neither self::$_dataCache[$name] nor self::$_defaultValue[$name] static variables exist.
		if (isset ( $name )) 
		{
			if ($reset) 
			{
				// Reset was called before a default is set and yet a variable must be returned.
				return self::$_dataCache;
			}
			
			// First call with new non-NULL $name. Initialize a new static variable.
			self::$_defaultValue[$name] = self::$_dataCache[$name] = $defaultValue;
			
			return self::$_dataCache[$name];
		}
		
		// Reset all: ($name == NULL). This needs to be done one at a time so that
		// references returned by earlier invocations of drupal_static() also get reset.
		foreach ( self::$_defaultValue as $name => $value ) 
		{
			self::$_dataCache[$name] = $value;
		}
		
		// As the function returns a reference, the return should always be a variable.
		return self::$_dataCache;
	}
	
	/**
	 * Resets one or all centrally stored static variable(s).
	 * 
	 * @param string $name
	 */
	public static function reset($name = NULL) 
	{
		self::add($name, NULL, TRUE);
	}
}