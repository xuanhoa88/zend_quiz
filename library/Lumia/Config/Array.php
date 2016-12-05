<?php
/**
 * @see Zend_Config
 */
require_once 'Zend/Config.php';

/**
 * Array Adapter for Zend_Config
 */
class Lumia_Config_Array extends Zend_Config
{
    /**
     * Name of object key indicating section current section extends
     */
    const EXTENDS_NAME = "_extends";

    /**
     * Whether to skip extends or not
     *
     * @var boolean
     */
    protected $_skipExtends = false;

    /**
     * Loads the section $section from the config file encoded as JSON
     *
     * Sections are defined as properties of the main object
     *
     * In order to extend another section, a section defines the "_extends"
     * property having a value of the section name from which the extending
     * section inherits values.
     *
     * Note that the keys in $section will override any keys of the same
     * name in the sections that have been included via "_extends".
     *
     * @param  string  $file     PHP file to process
     * @param  mixed   $section Section to process
     * @param  boolean $options Whether modifiacations are allowed at runtime
     * @throws Zend_Config_Exception When array is not set or cannot be loaded
     * @throws Zend_Config_Exception When section $sectionName cannot be found in $file
     */
    public function __construct($file, $section = null, $options = false)
    {
        if (empty($file)) {
            require_once 'Zend/Config/Exception.php';
            throw new Zend_Config_Exception('Filename is not set');
        }

        $allowModifications = false;
        if (is_bool($options)) {
            $allowModifications = $options;
        } elseif (is_array($options)) {
            foreach ($options as $key => $value) {
                switch (strtolower($key)) {
                    case 'allow_modifications':
                    case 'allowmodifications':
                        $allowModifications = (bool) $value;
                        break;
                    case 'skip_extends':
                    case 'skipextends':
                        $this->_skipExtends = (bool) $value;
                        break;
                    default:
                        break;
                }
            }
        }

        // Check if there was a error while loading file
        if (!file_exists($file)) {
        	throw new Zend_Application_Exception('Invalid configuration file provided; PHP file does not exists');
        }
        
        $config = include $file;
        if (!is_array($config)) {
            require_once 'Zend/Config/Exception.php';
            throw new Zend_Config_Exception('Invalid configuration file provided; PHP file does not return array value');
        }

        if ($section === null) {
            $dataArray = array();
            foreach ($config as $sectionName => $sectionData) {
                $dataArray[$sectionName] = $this->_processExtends($config, $sectionName);
            }

            parent::__construct($dataArray, $allowModifications);
        } elseif (is_array($section)) {
            $dataArray = array();
            foreach ($section as $sectionName) {
                if (!isset($config[$sectionName])) {
                    require_once 'Zend/Config/Exception.php';
                    throw new Zend_Config_Exception(sprintf('Section "%s" cannot be found', $sectionName));
                }

                $dataArray = array_merge($this->_processExtends($config, $sectionName), $dataArray);
            }

            parent::__construct($dataArray, $allowModifications);
        } else {
            if (!isset($config[$section])) {
                require_once 'Zend/Config/Exception.php';
                throw new Zend_Config_Exception(sprintf('Section "%s" cannot be found', $section));
            }

            $dataArray = $this->_processExtends($config, $section);
            if (!is_array($dataArray)) {
                // Section in the JSON data contains just one top level string
                $dataArray = array($section => $dataArray);
            }

            parent::__construct($dataArray, $allowModifications);
        }

        $this->_loadedSection = $section;
    }

    /**
     * Helper function to process each element in the section and handle
     * the "_extends" inheritance attribute.
     *
     * @param  array            $data Data array to process
     * @param  string           $section Section to process
     * @param  array            $config  Configuration which was parsed yet
     * @throws Zend_Config_Exception When $section cannot be found
     * @return array
     */
    protected function _processExtends(array $data, $section, array $config = array())
    {
        if (!isset($data[$section])) {
            require_once 'Zend/Config/Exception.php';
            throw new Zend_Config_Exception(sprintf('Section "%s" cannot be found', $section));
        }

        $thisSection  = $data[$section];

        if (is_array($thisSection) && isset($thisSection[self::EXTENDS_NAME])) {
            if (is_array($thisSection[self::EXTENDS_NAME])) {
                require_once 'Zend/Config/Exception.php';
                throw new Zend_Config_Exception('Invalid extends clause: must be a string; array received');
            }
            $this->_assertValidExtend($section, $thisSection[self::EXTENDS_NAME]);

            if (!$this->_skipExtends) {
                $config = $this->_processExtends($data, $thisSection[self::EXTENDS_NAME], $config);
            }
            unset($thisSection[self::EXTENDS_NAME]);
        }

        $config = $this->_arrayMergeRecursive($config, $thisSection);

        return $config;
    }
}
