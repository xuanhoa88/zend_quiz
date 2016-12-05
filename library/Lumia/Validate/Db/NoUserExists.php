<?php 

class Lumia_Validate_Db_NoUserExists extends Lumia_Validate_Db_NoRecordExists
{
	/**
	 * @var array Message templates
	 */
	protected $_messageTemplates = array(
			self::ERROR_RECORD_FOUND    => "Validate:@Username '%value%' was found"
	);
}