<?php

class Lumia_Application_Resource_JQueryValidateForm extends Zend_Application_Resource_ResourceAbstract
{

    /**
     * Defined by Zend_Application_Resource_Resource
     */
    public function init()
    {
        $options = $this->getOptions();
        
        if (is_array($options))
        {
            Lumia_JQueryValidateForm::setOptions($options);
        } elseif ($options instanceof Zend_Config)
        {
            Lumia_JQueryValidateForm::setOptions($options->toArray());
        }
    }
}
