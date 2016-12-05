<?php

class Lumia_Auth extends Zend_Auth
{
    /**
     * Singleton instance
     *
     * @var Lumia_Auth
     */
    protected static $_instance;

    /**
     * An array of string reasons why the authentication attempt was unsuccessful
     * If authentication was successful, this should be an empty array.
     *
     * @var array
     */
    protected $_messages = array();

    /**
     * Returns an instance of Lumia_Auth
     *
     * Singleton pattern implementation
     *
     * @return Lumia_Auth Provides a fluent interface
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
     * @return 	Lumia_Auth
     */
    public function login(Zend_Form $form)
    {
    	// Checks whether the user already exists?
    	$isValid = false;
				
		// Grant permissions
		$userPermissions = array();
    	
    	// Init Permission model
    	$userPermissionModel = new Lumia_Model_User_Permission();
    	
    	// Init Navigation model
    	$navModel = new Lumia_Model_Navigation();
    	
    	// Left navigation
    	$navigation = array();
    	
    	// Init user model
        $userModel = new Lumia_Model_User();
        if ($userRow = $userModel->authenticate($form->getValue('username'), $form->getValue('password'))) 
        {
        	$isValid = true;
        	
        	// Get role code
        	$userRow->user_role = isset($userRow->user_role) ? (string) $userRow->user_role : Lumia_Const::ROLE_CODE_GUEST;
        	
        	// Is admin?
        	$isAdmin = ($userRow->user_role === Lumia_Const::ROLE_CODE_ADMIN);
        	
        	// If user already exists
        	if (!($userRow->user_role === Lumia_Const::ROLE_CODE_GUEST))
        	{
        		// Get permission resources according to user
        		$userPermissionRow = $userPermissionModel->getByUser($userRow->user_id);
        		
	        	if (!$isAdmin)
	        	{
	        		// Init model
	        		$roleModel = new Lumia_Model_Role();
	        		
	        		// Get role
	        		$roleRow = $roleModel->getByCode($userRow->user_role);
	        		
	        		// If valid user must be corresponding with role already exists
	        		$isValid = !empty($roleRow->role_id);
	        		
	        		// Get permission resources according to user
	        		if (isset($userPermissionRow->permission_resource))
	        		{
		        		try 
		        		{
		        			$userPermissionRow->permission_resource = Zend_Json::decode((string) $userPermissionRow->permission_resource);
		        		} catch (Zend_Json_Exception $e)
		        		{
		        			$userPermissionRow->permission_resource = array();
		        		}
		        		
		        		// Get left nav according to permission keys
		        		if ($userPermissionRow->permission_resource)
		        		{
		        			foreach ($userPermissionRow->permission_resource as $resource => $hasPrivilege)
		        			{
		        				if (!$hasPrivilege)
		        				{
		        					continue;
		        				}
		        				
		        				if ($row = $navModel->fetchRow(array('navigation_privilege = ?' => $resource)))
		        				{
		        					if ($parents = $navModel->getParents($row->navigation_id, true))
		        					{
		        						$navigation = array_merge($navigation, $parents);
		        					}
		        				}
		        			}
		        			
		        			if ($navigation)
		        			{
		        				$navigation = array_map('serialize', $navigation);
		        				$navigation = array_unique($navigation);
		        				$navigation = array_map('unserialize', $navigation);
		        			}
		        		}
	        		}
	        	} else
	        	{
	        		// Get full left nav for admin
					$navigation = $navModel->getTree();
	        	}
        	}
        }
       
        if ($isValid)
        {
        	if ($navigation)
        	{
        		$navigationGrouped = array();
        		foreach ($navigation as $j => $item)
        		{
        			$navigationGrouped[$item['navigation_id']] = $item;
        		}
        		
        		$navigation = $navigationGrouped;
        		unset($navigationGrouped);
        		
        		if (!$isAdmin || isset($userPermissionRow->permission_left_navigation))
        		{
        			try
        			{
        				$userPermissionRow->permission_left_navigation = Zend_Json::decode((string) $userPermissionRow->permission_left_navigation);
        			} catch (Zend_Json_Exception $e)
        			{
        				$userPermissionRow->permission_left_navigation = array();
        			}
        			
        			if ($userPermissionRow->permission_left_navigation)
        			{
        				$navigation = array_intersect_key($navigation, $userPermissionRow->permission_left_navigation);
        				foreach ($navigation as &$item)
        				{
        					$item = array_merge($item, $userPermissionRow->permission_left_navigation[$item['navigation_id']]);
        				}
        			}
        		}
        					
        		// Sorting
        		usort($navigation, function ($a, $b)
            	{
            		if ($a['navigation_left'] == $b['navigation_left']) {
            			return 0;
            		}
            			
            		return ($a['navigation_left'] < $b['navigation_left']) ? -1 : 1;
            	});
        	}
        	
        	// Push message
        	array_push($this->_messages, Lumia_Translator::get()->translate('Authentication:@Authentication successful'));
        	
            // save the user in the session
            $this->clearIdentity();
            
            // Data to store
            $_sessionData = array(
                'user' => new Lumia_Auth_Identity($userRow->toArray()),
                'permission' => new Lumia_Auth_Identity($userPermissions),
            	'navigation' => new Lumia_Auth_Identity($navigation),
                'token' => md5(uniqid($userRow->user_id, true))
            );
            
            // TO HELP THWART SESSION FIXATION/HIJACKING
            if ($form->getValue('remember') == 1) 
            {
                // REMEMBER THE SESSION FOR 30 DAYS
                $_sessionData['session.cookie_lifetime'] = (24 * 60 * 60 * 30);
                Zend_Session::rememberMe($_sessionData['session.cookie_lifetime']);
            } else 
            {
                // DO NOT REMEMBER THE SESSION
                Zend_Session::forgetMe();
                $_sessionData['session.cookie_lifetime'] = 0;
            }
            
            // Inject to session
            $this->getStorage()->write($_sessionData);
        } else
        {
        	// Push message
        	array_push($this->_messages, Lumia_Translator::get()->translate('Authentication:@A record with the supplied identity could not be found'));
        }
        
        return $this;
    }

    /**
     * Returns an array of string reasons why the authentication attempt was unsuccessful
     *
     * If authentication was successful, this method returns an empty array.
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->_messages;
    }
    
    /**
     * Returns whether the result represents a successful authentication attempt
     *
     * @return boolean
     */
    public function isValid()
    {
    	return $this->getUser()->count();
    }
    
    /**
     * Inject guest information into session
     * 
     * @return  void
     */
    public function forceGuestLogin()
    {
        $this->getStorage()->write(array(
            'user' => new Lumia_Auth_Identity(),
            'permission' => new Lumia_Auth_Identity(),
        	'navigation' => new Lumia_Auth_Identity()
        ));
    }
    
    /**
     * Get user navigation from session
     *
     * @return  mixed|null
     */
    public function getNavigation()
    {
        $identity = $this->getIdentity();
        return isset($identity['navigation']) ? $identity['navigation'] : new Lumia_Auth_Identity();
    }
    
    /**
     * Set user navigation into session
     *
     * @return  mixed|null
     */
    public function setNavigation(array $navigation)
    {
        $identity = $this->getIdentity();
        $identity['navigation'] = new Lumia_Auth_Identity($navigation);
        
        $this->getStorage()->write($identity);
    }
    
    /**
     * Get user information from session
     *
     * @return  mixed|null
     */
    public function getUser()
    {
        $identity = $this->getIdentity();
        return isset($identity['user']) ? $identity['user'] : new Lumia_Auth_Identity();
    }
    
    /**
     * Get user permissions from session
     *
     * @return  mixed|null
     */
    public function getPermissions()
    {
        $identity = $this->getIdentity();
        return isset($identity['permission']) ? $identity['permission'] : new Lumia_Auth_Identity();
    }
	
	/**
	 * Are you logged ?
	 * 
	 * @return boolean
	 */
	public function isLogged()
	{
		return !empty($this->getUser()->user_id);
	}
	
	/**
	 * Are you admin?
	 * 
	 * @return boolean
	 */
	public function isAdmin()
	{
		return $this->isLogged() && ($this->getUser()->user_role === Lumia_Const::ROLE_CODE_ADMIN);
	}
	
	/**
	 * Are you guest?
	 * 
	 * @return boolean
	 */
	public function isGuest()
	{
		return !$this->isLogged() || ($this->getUser()->user_role === Lumia_Const::ROLE_CODE_GUEST);
	}
    
    /**
     * Get token key
     *
     * @return  mixed|null
     */
    public function getToken()
    {
        $identity = $this->getIdentity();
        return isset($identity['token']) ? (string) $identity['token'] : null;
    }
}
