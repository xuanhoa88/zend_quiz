<?php

class Lumia_Validate_Int extends Zend_Validate_Int
{

	/**
	 * Error messages
	 * 
	 * @var array
	 */
	protected $_messageTemplates = array(
			self::INVALID => "Validate:@Invalid type given. String or integer expected", 
			self::NOT_INT => "Validate:@'%value%' does not appear to be an integer"
	);
}
