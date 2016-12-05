<?php

class Lumia_JQueryValidateForm
{

    /**
     * @var array
     */
    protected static $_options;

    /**
     * @var Zend_Form
     */
    protected $_form;

    /**
     * Constructor
     *
     * @param Zend_Form $form
     *            the form that serves as input
     */
    public function __construct(Zend_Form $form)
    {
        $this->_form = $form;
    }

    /**
     * Set a global options
     *
     * @param array $options            
     */
    public static function setOptions(array $options)
    {
        self::$_options = $options;
    }

    /**
     * Renders the JavaScript code
     *
     * @param Zend_View $view the view used to render the form
     * @param array $options an Array of options. Valid keys are: 'inject' and 'showWarnings' (see manual)
     * @return null|string
     */
    public function render(Zend_View $view, array $options = null)
    {
        if (! self::isEnabled())
        {
            return null;
        }
        
        // Merge with default options
        $options = array_merge(self::$_options, (array) $options);
        
        // Check options used...
        $showWarnings = (isset($options['showWarnings']) ? (boolean) $options['showWarnings'] : false);
        
        // Check form name
        $formName = trim($this->_form->getName());
        if ($formName === '')
        {
            throw new Lumia_JQueryValidateForm_Exception('Invalid form name provided; must contain only valid variable characters and be non-empty');
        }
        
        $messages = array();
        $rules = array();
        $jQueryFn = array();
        foreach ($this->_form->getElements() as $element)
        {
            $name = (string) $element->getName();
            if (trim($name) === '')
            {
                continue;
            }
            
            if (! empty($element->ignoreJQueryValidateForm))
            {
                continue;
            }
            
            $jElement = new Lumia_JQueryValidateForm_Element($element, $this->_form);
            $jElement->initValidators();
            
            if ($elementRules = $jElement->initRules(isset($element->forceRules) ? $element->forceRules : null))
            {
                $rules[] = "'" . addslashes($name) . "':{" . implode(',', $elementRules) . "}";
            }
            
            if ($elementMessages = $jElement->initMessages(isset($element->forceMessages) ? $element->forceMessages : null))
            {
                $messages[] = "'" . addslashes($name) . "':{" . implode(',', $elementMessages) . "}";
            }
            
            if ($elementMethodExts = $jElement->getExtendMethods())
            {
                $jQueryFn = array_merge($jQueryFn, $elementMethodExts);
            }
        }
        
        // No rules assigned to this form?
        if (empty($rules))
        {
            if ($showWarnings)
            {
                throw new Lumia_JQueryValidateForm_Exception('No validators assigned to form ' . $formName);
            }
            
            return null;
        }
        
        // Create jquery validate form
        $result = 'jQuery("form[name=' . $formName . ']").validate({rules:{' . implode(',', $rules) . '}';
        if ($messages)
        {
            $result .= ', messages:{' . implode(',', $messages) . '}';
        }
        $result .= '});';
        
        $fctnsString = '';
        foreach ($jQueryFn as $f)
        {
            $fctnsString .= $f['fctn'];
        }
        
        // Make sure to render script at the bottom
        return $view->headScript()->appendScript("jQuery(document).ready(function ($) { " . ($fctnsString . $result) . " });");
    }

    /**
     * Is jQuery validate form enabled?
     *
     * @return bool
     */
    public static function isEnabled()
    {
        return ! empty(self::$_options['enable']);
    }
}
