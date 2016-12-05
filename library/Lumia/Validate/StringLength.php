<?php

class Lumia_Validate_StringLength extends Zend_Validate_StringLength
{

	protected $_messageTemplates = array(
			self::INVALID => "Validate:@Invalid type given. String expected", 
			self::TOO_SHORT => "Validate:@'%value%' is less than %min% characters long", 
			self::TOO_LONG => "Validate:@'%value%' is more than %max% characters long"
	);
}