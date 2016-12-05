<?php

/**
 * Validator for counting all given files
 */
class Lumia_Validate_File_Count extends Zend_Validate_File_Count
{
    /**
     * @var array Error message templates
     */
    protected $_messageTemplates = array(
        self::TOO_MANY => "Validate:@Too many files, maximum '%max%' are allowed but '%count%' are given",
        self::TOO_FEW  => "Validate:@Too few files, minimum '%min%' are expected but '%count%' are given",
    );
}
