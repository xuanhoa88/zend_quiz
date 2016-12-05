<?php

/**
 * Resource loader
 *
 * @uses       Lumia_Loader_Autoloader_Resource
 * @package    Lumia_Loader
 * @subpackage Autoloader
 */
class Lumia_Loader_Autoloader_Resource extends Zend_Loader_Autoloader_Resource
{
    /**
     * Constructor
     *
     * @param  array|Zend_Config $options Configuration options for resource autoloader
     * @return void
     */
    public function __construct($options)
    {
        if ($options instanceof Zend_Config) {
            $options = $options->toArray();
        }
        
        if (!is_array($options)) {
            throw new Zend_Loader_Exception('Options must be passed to resource loader constructor');
        }
        
        $this->setOptions($options);
        
        $namespace = $this->getNamespace();
        if ((null === $namespace) || (null === $this->getBasePath())) {
            throw new Zend_Loader_Exception('Resource loader requires both a namespace and a base path for initialization');
        }
        
        if (!empty($namespace)) {
            $namespace .= '_';
        }
        
        Lumia_Loader_Autoloader::getInstance()->unshiftAutoloader($this, $namespace);
    }
}