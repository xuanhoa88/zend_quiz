<?php

class Lumia_Validate_GreaterThan extends Zend_Validate_GreaterThan
{
	/**
	 *
	 * @var array
	 */
	protected $_messageTemplates = array(
		self::NOT_GREATER => "Validate:@'%value%' is not greater than '%min%'"
	);
}
