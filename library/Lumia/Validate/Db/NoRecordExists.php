<?php 

class Lumia_Validate_Db_NoRecordExists extends Zend_Validate_Db_NoRecordExists
{
	/**
	 * @var array Message templates
	 */
	protected $_messageTemplates = array(
			self::ERROR_RECORD_FOUND    => "Validate:@A record matching '%value%' was found"
	);
}