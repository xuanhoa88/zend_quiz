<?php

class Lumia_Validate_NotEmpty extends Zend_Validate_NotEmpty
{

	/**
	 * Error messages
	 * 
	 * @var array
	 */
	protected $_messageTemplates = array(
			self::IS_EMPTY => "Validate:@Value is required and can't be empty", 
			self::INVALID => "Validate:@Invalid type given. String, integer, float, boolean or array expected"
	);
}
