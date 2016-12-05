<?php

class Lumia_Validate_Identical extends Zend_Validate_Identical
{

	protected $_messageTemplates = array(
			self::NOT_SAME => 'Validate:@The two given tokens do not match', 
			self::MISSING_TOKEN => 'Validate:@No token was provided to match against'
	);
}