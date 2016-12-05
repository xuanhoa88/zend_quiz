<?php

class Lumia_Model_Permission extends Lumia_Model
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDbTable('Lumia_Db_Table_Permission');
	}
	
    /**
     * Returns a new array that is a one-dimensional flattening of the given array.
     *
     * @param 	array $array
     * @param	array $path
     * @return 	array
     */
    protected static function _flatten(array $array, array $path = array()) 
    {
	    $result = array();
	    foreach ($array as $key => $value) 
	    {
	        $currentPath = array_merge($path, array($key));
	
	        if (is_array($value)) 
	        {
	            $result = array_merge($result, self::_flatten($value, $currentPath));
	        } else 
	        {
	            $result[implode('@', $currentPath)] = $value;
	        }
	    }
	
	    return $result;
	}
	
	/**
	 * Filter roles
	 * 
	 * @param	array $resources
	 * @param	bool $useFlat
	 * @return	array
	 */
	public static function filter(array $resources, $useFlat = false)
	{
		if ($useFlat)
		{
			$resources = self::_flatten($resources);
		}
		
		return array_filter($resources, array('self', '_filterCallback'));
	}
	
	/**
	 * Filter callback function
	 * 
	 * @param	int $var
	 * @return	bool
	 */
	protected static function _filterCallback($var)
	{
		return ((int) $var === 1);
	}
}
