<?php

class Lumia_Validate_InArray extends Zend_Validate_InArray
{

	/**
	 * Error messages
	 * 
	 * @var array
	 */
	protected $_messageTemplates = array(
			self::NOT_IN_ARRAY => "Validate:@'%value%' was not found in the haystack"
	);
}
