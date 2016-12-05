<?php

class Lumia_Validate_VerifyPassword extends Lumia_Validate_Identical
{

	protected $_messageTemplates = array(
			self::NOT_SAME => 'Validate:@The password do not match', 
			self::MISSING_TOKEN => 'Validate:@No password field was provided to match against'
	);
}