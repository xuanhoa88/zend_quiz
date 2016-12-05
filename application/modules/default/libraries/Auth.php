<?php

class Default_Auth extends Lumia_Auth
{

    /**
     * Singleton instance
     *
     * @var Default_Auth
     */
    protected static $_instance;

    /**
     * Returns an instance of Default_Auth
     *
     * Singleton pattern implementation
     *
     * @return Default_Auth Provides a fluent interface
     */
    public static function getInstance()
    {
        if (null === self::$_instance) 
        {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Authenticate an user in the application
     *
     * @param 	Zend_Form $form        
     * @return 	Default_Auth
     */
    public function login(Zend_Form $form)
    {
    	// Checks valid login
    	parent::login($form);
    	
        if ($this->isValid()) 
        {
            $studentModel = new Default_Model_Student();
            if ($studentRow = $studentModel->getByUser($this->getUser()->user_id)) 
            {
            	// save the student in the session
            	$identity = (array) $this->getIdentity();
            	$identity['student'] = new Lumia_Auth_Identity($studentRow->toArray());
            	$this->getStorage()->write($identity);
            } else
            {
            	// log the user out
            	$this->clearIdentity();
            	
            	// destroy the session
            	Zend_Session::destroy();
            }
        }
        
        return $this;
    }
    
    /**
     * Get student information from session
     *
     * @return  mixed
     */
    public function getStudent()
    {
        $identity = $this->getIdentity();
        return isset($identity['student']) ? $identity['student'] : new Lumia_Auth_Identity();
    }
    
    /**
     * Inject guest information into session
     * 
     * @return  void
     */
    public function forceGuestLogin()
    {
    	parent::forceGuestLogin();
    	
    	$identity = (array) $this->getIdentity();
    	$identity['student'] = new Lumia_Auth_Identity();
        $this->getStorage()->write($identity);
    }
}
