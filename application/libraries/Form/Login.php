<?php

class Application_Form_Login extends Lumia_Form
{
	/**
	 * @var string
	 */
	protected $_viewScript = 'session/form/login.phtml';

	/**
	 * Overrides init() in Zend_Form
	 *
	 * @access public
	 * @return void
	 */
	public function init()
    {
        parent::init();

        // Set the form's method
        $this->setName('loginForm');
        $this->setMethod(self::METHOD_POST);
        
        // Username
        $username = new Zend_Form_Element_Text('username');
        $username->setOptions(array(
            'label' => 'LoginForm:@Username',
            'required' => true,
            'filters' => array('StringTrim', 'StripTags'),
            'validators' => array('NotEmpty'),
            'decorators' => array('ViewHelper'),
            'autocomplete' => 'off',
        	'placeholder' => $this->getTranslator()->translate('LoginForm:@Username')
        ));
        $this->addElement($username);
        
        // Password
        $password = new Zend_Form_Element_Password('password');
        $password->setOptions(array(
            'label' => 'LoginForm:@Password',
            'required' => true,
            'filters' => array('StringTrim', 'StripTags'),
            'validators' => array('NotEmpty'),
            'decorators' => array('ViewHelper'),
            'autocomplete' => 'off',
        	'placeholder' => $this->getTranslator()->translate('LoginForm:@Password'),
        ));
        $this->addElement($password);
        
        // Remember me
        $remember = new Zend_Form_Element_Checkbox('remember');
        $remember->setOptions(array(
            'label' => 'LoginForm:@Remember me',
        	'filters' => array('Int'),
            'decorators' => array('ViewHelper')
        ));
        $this->addElement($remember);
        
        // Submit button
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setOptions(array(
            'label' => 'LoginForm:@Login now',
            'decorators' => array('ViewHelper')
        ));
        
        $this->addElement($submit);
    }
}
