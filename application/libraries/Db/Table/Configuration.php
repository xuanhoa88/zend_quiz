<?php

class Application_Db_Table_Configuration extends Lumia_Db_Table
{

	/**
	 * Column for the primary key
	 *
	 * @var string
	 */
	protected $_primary = 'cfg_id';

	/**
	 * Holds the table's name
	 *
	 * @var string
	 */
	protected $_name = 'core_configuration';

	/**
	 * Add a new configuration.
	 *
	 * You do not need to serialize values. If the value needs to be serialized, then
	 * it will be serialized before it is inserted into the database. Remember,
	 * resources can not be serialized or added as an configuration.
	 *
	 * You can create configurations without values and then update the values later.
	 * Existing configurations will not be updated and checks are performed to ensure that you
	 * aren't adding a protected WordPress configuration. Care should be taken to not name
	 * configurations the same as the ones which are protected.
	 *
	 * @param 	string $option      Name of configuration to add. Expected to not be SQL-escaped.
	 * @param 	mixed $value       Optional. Option value. Must be serializable if non-scalar. Expected to not be SQL-escaped.
	 * @return 	bool False if configuration was not added and true if configuration was added.
	 */
	public function set($option, $value = '')
	{
		$option = trim($option);
		if ( empty($option) )
		{
			return false;
		}

		if ( is_object($value) )
		{
			$value = clone $value;
		}

		if ( false !== $this->get( $option ) )
		{
			return $this->update(array(
				'cfg_value' => is_scalar($value) ? $value : Zend_Json::encode($value)
			), array(
				'cfg_name = ?' => $option
			));
		}

		return $this->insert(array(
			'cfg_name' => $option,
			'cfg_value' => is_scalar($value) ? $value : Zend_Json::encode($value)
		));
	}

	/**
	 * Retrieve configuration value based on name of configuration.
	 *
	 * If the configuration does not exist or does not have a value, then the return value
	 * will be false. This is useful to check whether you need to install an configuration
	 * and is commonly used during installation of plugin configurations and to test
	 * whether upgrading is required.
	 *
	 * If the configuration was serialized then it will be unserialized when it is returned.
	 *
	 * @param 	string $option Name of configuration to retrieve. Expected to not be SQL-escaped.
	 * @param 	mixed $default Optional. Default value to return if the configuration does not exist.
	 * @return 	mixed Value set for the configuration.
	 */
	public function get($option, $default = false)
	{
		$option = trim( $option );
		if ( empty( $option ) )
		{
			return false;
		}

		$cfgRows =& Lumia_Utility_StaticCache::add(__METHOD__ . '[' . $option . ']');
		if (!isset($cfgRows))
		{
			$cfgRows = $this->fetchPairs();
		}

		if (is_array($cfgRows) && array_key_exists($option, $cfgRows))
		{
			return $cfgRows[$option];
		}

		return false;
	}

	/**
	 * Removes configuration by name. Prevents removal of protected WordPress configurations.
	 *
	 * @param 	string $option Name of configuration to remove. Expected to not be SQL-escaped.
	 * @return 	int, if configuration is successfully deleted. False on failure.
	 */
	public function delete($option)
	{
		$option = trim( $option );
		if ( empty( $option ) )
		{
			return false;
		}
		
		return parent::delete(array('cfg_name = ?' => $option));
	}

	/**
	 * Retrieve all configuration values.
	 *
	 * @return 	array
	 */
	public function fetchPairs()
	{
		$select = $this->select(self::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
		$select->reset(self::COLUMNS);
		$select->columns(array('cfg_name', 'cfg_value'));
		return $this->getAdapter()->fetchPairs($select);
	}

}
