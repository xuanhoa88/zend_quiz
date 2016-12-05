<?php

class Lumia_Validate_Db_RecordExists extends Zend_Validate_Db_RecordExists
{
	/**
	 * @var array Message templates
	 */
	protected $_messageTemplates = array(
			self::ERROR_NO_RECORD_FOUND => "Validate:@No record matching '%value%' was found"
	);
}