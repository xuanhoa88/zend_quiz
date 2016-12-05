<?php

/**
 * Validator for the maximum size of a file up to a max of 2GB
 */
class Lumia_Validate_File_Upload extends Zend_Validate_File_Upload
{
    /**
     * @var array Error message templates
     */
    protected $_messageTemplates = array(
        self::INI_SIZE       => "Validate:@File '%value%' exceeds the defined ini size",
        self::FORM_SIZE      => "Validate:@File '%value%' exceeds the defined form size",
        self::PARTIAL        => "Validate:@File '%value%' was only partially uploaded",
        self::NO_FILE        => "Validate:@File '%value%' was not uploaded",
        self::NO_TMP_DIR     => "Validate:@No temporary directory was found for file '%value%'",
        self::CANT_WRITE     => "Validate:@File '%value%' can't be written",
        self::EXTENSION      => "Validate:@A PHP extension returned an error while uploading the file '%value%'",
        self::ATTACK         => "Validate:@File '%value%' was illegally uploaded. This could be a possible attack",
        self::FILE_NOT_FOUND => "Validate:@File '%value%' was not found",
        self::UNKNOWN        => "Validate:@Unknown error while uploading file '%value%'"
    );
}
