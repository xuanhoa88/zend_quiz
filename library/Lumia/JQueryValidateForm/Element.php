<?php

class Lumia_JQueryValidateForm_Element
{

    /**
     *
     * @var Zend_Form
     */
    protected $_form;

    /**
     *
     * @var Zend_Form_Element
     */
    protected $_element;

    /**
     * jQuery validation rules
     *
     * @var array
     */
    protected $_validationRules = array();

    /**
     * jQuery validation messages
     *
     * @var array
     */
    protected $_validationMessages = array();

    /**
     * New jQueryValidate functions introduced for this element
     *
     * @var array
     */
    protected $_validationExtendMethods = array();

    /**
     * Validator prefix
     *
     * @var string
     */
    protected $_prefixValidator = 'Lumia_JQueryValidateForm_Validate';

    /**
     * Constructor
     *
     * @param Zend_Form_Element $elem            
     * @param Zend_Form $form            
     * @param unknown_type $msgs            
     */
    public function __construct(Zend_Form_Element $element, Zend_Form $form)
    {
        $this->_form = $form;
        $this->_element = $element;
    }

    /**
     * Returns an array of Lumia_JQueryValidateForm_Validate object from Zend_Validators used by this element
     *
     * @return void
     */
    public function initValidators()
    {
        foreach ($this->_element->getValidators() as $validator)
        {
            // Try to load appropriate Lumia_JQueryValidateForm class
            $validatorName = explode('_', get_class($validator));
            $validatorShortName = array_pop($validatorName);
            $class = rtrim($this->_prefixValidator, '_') . '_' . $validatorShortName;
            $file = dirname(__FILE__) . '/Validate/' . $validatorShortName . '.php';
            
            if (! class_exists($class, false) && file_exists($file))
            {
                Zend_Loader::loadFile($file, null, false);
            }
            
            if (class_exists($class, false))
            {
                $this->_validationRules[$validatorShortName] = new $class($validator, $this->_form, $this->_element);
            }
        }
    }

    /**
     * Returns an array of new jQueryValidate functions introduced for this element or an empty array if no functions have been created
     * 
     * @return array
     */
    public function getExtendMethods()
    {
        return $this->_validationExtendMethods;
    }

    /**
     * Renders rules used by this element
     *
     * @param array $forceRules            
     * @return string
     */
    public function initRules($forceRules = null)
    {
        if (! Lumia_JQueryValidateForm::isEnabled())
        {
            return null;
        }
        
        $valResult = array();
        $elementName = $this->_element->getName();
        
        $usedRules = array();
        foreach ($this->_validationRules as $validator)
        {
            foreach ($validator->getRulesUsed() as $usedRule)
            {
                if (array_key_exists($usedRule, $usedRules))
                {
                    if ($usedRule != 'pattern')
                    {
                        throw new Lumia_JQueryValidateForm_Exception('Used rule "' . $usedRule . '" multiple times in form element ' . $elementName . ' - can only use rule "pattern" multiple times');
                    }
                    
                    $fName = str_replace(' ', '', $elementName . 'Fctn' . $usedRules[$usedRule]);
                    $valName = strtolower(end(explode('_', get_class($validator))));
                    $this->_validationExtendMethods[$valName]['name'] = $fName;
                    $this->_validationExtendMethods[$valName]['fctn'] = 'jQuery.validator.addMethod("' . $fName . '", function(value, element) {return this.optional(element) || ' . $validator->getPatternUsed() . '.test(value); }, "' . addslashes($this->_form->getTranslator()->translate('Validate:@Invalid format')) . '");';
                    $usedRules[$usedRule] += 1;
                    $valResult[] = "'" . addslashes($fName) . ":true'";
                } else
                {
                    $usedRules[$usedRule] = 1;
                    $valResult = array_merge($valResult, $validator->render());
                }
            }
            
            $this->_validationMessages = array_merge($this->_validationMessages, $validator->getMessages());
        }
        
        // Force rules?
        if (is_array($forceRules))
        {
            foreach ($forceRules as $_key => $_val)
            {
                if (is_array($_val) && array_key_exists('fn', $_val))
                {
                    $fn = $_val['fn'];
                    $msg = $_val['message'];
                }
                
                if (isset($msg))
                {
                    $this->_validationMessages = array_merge($this->_validationMessages, (array) $msg);
                }
                
                if (isset($fn))
                {
                    $valResult[] = "'" . addslashes($_key) . ":" . $fn . "'";
                }
            }
        }
        
        return array_unique($valResult);
    }

    /**
     * Renders messages defined for this element
     *
     * @param
     *            $forceMessages
     * @return string
     */
    public function initMessages($forceMessages = null)
    {
        if (is_array($forceMessages))
        {
            $this->_validationMessages = array_merge($this->_validationMessages, $forceMessages);
        }
        
        if (! Lumia_JQueryValidateForm::isEnabled() || ! $this->_validationMessages)
        {
            return null;
        }
        
        $msgs = array();
        foreach ($this->_validationMessages as $filter => $msg)
        {
            $msg = addslashes($this->_element->getView()->translate($msg));
            
            // Message 'all' set? if so, return this message
            if (strtolower($filter) == 'all')
            {
                return $msg;
            }
            
            // Check if validator exists for defined message?
            if (array_key_exists($filter, $this->_validationExtendMethods))
            {
                $msgs[] = "'" . addslashes($this->_validationExtendMethods[$filter]['name']) . "':'" . addslashes($msg) . "'";
            } else
            {
                $msgs[] = "'" . addslashes($filter) . "':'" . addslashes($msg) . "'";
            }
        }
        
        return $msgs;
    }
}