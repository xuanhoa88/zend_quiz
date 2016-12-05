<?php

class Lumia_Validate_EmailAddress extends Zend_Validate_EmailAddress
{
	/**
	 * @var array
	 */
	protected $_messageTemplates = array(
			self::INVALID            => "Validate:@This e-mail address is not valid",
			self::INVALID_FORMAT     => "Validate:@'%value%' is not a valid email address in the basic format local-part@hostname",
			self::INVALID_HOSTNAME   => "Validate:@'%hostname%' is not a valid hostname for email address '%value%'",
			self::INVALID_MX_RECORD  => "Validate:@'%hostname%' does not appear to have a valid MX record for the email address '%value%'",
			self::INVALID_SEGMENT    => "Validate:@'%hostname%' is not in a routable network segment. The email address '%value%' should not be resolved from public network",
			self::DOT_ATOM           => "Validate:@'%localPart%' can not be matched against dot-atom format",
			self::QUOTED_STRING      => "Validate:@'%localPart%' can not be matched against quoted-string format",
			self::INVALID_LOCAL_PART => "Validate:@'%localPart%' is not a valid local part for email address '%value%'",
			self::LENGTH_EXCEEDED    => "Validate:@'%value%' exceeds the allowed length",
	);
}