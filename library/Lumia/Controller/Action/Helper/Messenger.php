<?php

/**
 * Lumia_Controller_Action_Helper_Messenger
 *
 * @category   Lumia
 * @package    Lumia_Controller_Action_Helper
 */
class Lumia_Controller_Action_Helper_Messenger extends Zend_Controller_Action_Helper_Abstract
{
/**
	 * @var array
	 */
    protected $_messageKeys = array('danger', 'info', 'success', 'warning');
    
    /**
     * @var Lumia_Controller_Action_Helper_FlashMessenger
     */
    protected $_flashMessenger = null;

    /**
     * __construct() - Instance constructor
     *
     * @return void
     */
    public function __construct()
    {
    	$this->_flashMessenger = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
    }
    
    /**
     * Initialize flash message with specific namespace
     *
     * @param 	string $messageKey
     * @return 	Lumia_Controller_Action_Helper_FlashMessenger
     */
    public function messenger($messageKey = null)
    { 
        if ($messageKey === null) 
        {
            $result = array();
            foreach ($this->_messageKeys as $messageKey) 
            {
                if ($messages = $this->_find($messageKey))
                {
                    $result[$messageKey] = $messages;
                }
            }
            
            return $result;
        }
        
        if (in_array($messageKey, $this->_messageKeys, true)) 
        {
            return $this->_find($messageKey);
        }
    }
    
    protected function _find($messageKey)
    {
        $result = array();
        $this->_flashMessenger->setNamespace($messageKey);
        
        if ($this->_flashMessenger->hasMessages()) 
        {
            $result = $this->_flashMessenger->getMessages();
        }
        
        // check view object
        if (isset($this->view->{$messageKey})) 
        {
            array_push($result, $this->view->{$messageKey});
        }
       
        // add any messages from this request
        if ($this->_flashMessenger->hasCurrentMessages()) 
        {
            $result = array_merge($result, $this->_flashMessenger->getCurrentMessages());
            
            // we don't need to display them twice.
            $this->_flashMessenger->clearCurrentMessages();
        }
        
        return $result;
    }

    /**
     * setNamespace() - change the namespace messages are added to, useful for
     * per action controller messaging between requests
     *
     * @param  string $messageKey
     * @return Lumia_Controller_Action_Helper_Messenger
     */
    public function setNamespace($messageKey = null)
    {
    	if (!in_array($messageKey, $this->_messageKeys, true))
		{
			$messageKey = 'warning';
		}
		
		$this->_flashMessenger->setNamespace($messageKey);
		
    	return $this;
    }

	/**
	 * Strategy pattern: proxy to messenger()
	 *
	 * @param 	string $namespace
	 * @return 	Lumia_Controller_Action_Helper_FlashMessenger
	 */
	public function direct($messageKey = null)
	{
		$this->setNamespace($messageKey);
		
		return $this->_flashMessenger;
	}
	
	/**
	 * Invoking inaccessible methods in Lumia_Controller_Action_Helper_FlashMessenger
	 */
	public function __call($name , array $arguments) 
	{
		return call_user_func_array(array($this->_flashMessenger, $name), $arguments);
	}
}
