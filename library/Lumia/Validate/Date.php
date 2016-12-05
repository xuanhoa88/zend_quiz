<?php

class Lumia_Validate_Date extends Zend_Validate_Date
{
	/**
	 * Validation failure message template definitions
	 *
	 * @var array
	 */
	protected $_messageTemplates = array(
			self::INVALID => "Validate:@Invalid type given. String, integer, array or Zend_Date expected", 
			self::INVALID_DATE => "Validate:@'%value%' does not appear to be a valid date", 
			self::FALSEFORMAT => "Validate:@'%value%' does not fit the date format '%format%'"
	);
}
