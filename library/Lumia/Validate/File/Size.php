<?php

/**
 * Validator for the maximum size of a file up to a max of 2GB
 */
class Lumia_Validate_File_Size extends Zend_Validate_File_Size
{
    /**
     * @var array Error message templates
     */
    protected $_messageTemplates = array(
        self::TOO_BIG   => "Validate:@Maximum allowed size for file '%value%' is '%max%' but '%size%' detected",
        self::TOO_SMALL => "Validate:@Minimum expected size for file '%value%' is '%min%' but '%size%' detected",
        self::NOT_FOUND => "Validate:@File '%value%' is not readable or does not exist",
    );
}
