<?php

class Lumia_Model_Navigation extends Lumia_Model
{

	/**
	 * Constructor
	 */
	public function __construct(array $options = array())
	{
		// Set database table class
		if (!isset($options['dbTable']))
		{
			$options['dbTable'] = 'Lumia_Db_Table_Navigation';
		}
		
		// Call parent method
		parent::__construct($options);
	}
}