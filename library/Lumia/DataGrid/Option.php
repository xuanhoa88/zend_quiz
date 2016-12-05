<?php

abstract class Lumia_DataGrid_Option
{
	/**
	 * @var array
	 */
	private $_options = array();

    /**
     * Flattened (lowercase) option keys used for lookups
     *
     * @var array
     */
    private $_optionKeys = array();

	/**
	 * Set class state
	 *
	 * @param  	array $options
	 * @return 	Lumia_DataGrid
	 */
	public function setOptions(array $options)
	{
		$this->_options = $this->_mergeOptions($this->_options, $options);
		$this->_optionKeys = array_merge($this->_optionKeys, array_keys(array_change_key_case($options, CASE_LOWER)));
	
		return $this;
	}
	
	/**
	 * Get current options from bootstrap
	 *
	 * @return 	array
	 */
	public function getOptions()
	{
		return $this->_options;
	}
	
	/**
	 * Is an option present?
	 *
	 * @param  string $key
	 * @return bool
	 */
	public function hasOption($key)
	{
		return in_array(strtolower($key), $this->_optionKeys);
	}
	
	/**
	 * Retrieve a single option
	 *
	 * @param  	string $key
	 * @return 	mixed
	 */
	public function getOption($key, $default = null)
	{
		if ($this->hasOption($key)) 
		{
			$options = $this->getOptions();
			$options = array_change_key_case($options, CASE_LOWER);
			return $options[strtolower($key)];
		}
		
		return $default;
	}

	/**
	 * Merge options recursively
	 *
	 * @param  	array $array1
	 * @param  	mixed $array2
	 * @return 	array
	 */
	protected function _mergeOptions(array $array1, $array2 = null)
	{
		if (is_array($array2)) 
		{
			foreach ($array2 as $key => $val) 
			{
				if (is_array($array2[$key])) 
				{
					$array1[$key] = (array_key_exists($key, $array1) && is_array($array1[$key]))
						? $this->_mergeOptions($array1[$key], $array2[$key])
						: $array2[$key];
				} else 
				{
					$array1[$key] = $val;
				}
			}
		}
		
		return $array1;
	}
}