<?php

/**
 * Lumia_Controller_Action_Helper_FlashMessenger
 *
 * @category   Lumia
 * @package    Lumia_Controller_Action_Helper
 */
class Lumia_Controller_Action_Helper_FlashMessenger extends Zend_Controller_Action_Helper_FlashMessenger
{
    /**
     * addMessage() - Add a message to flash message
     *
     * @param  	string $message
     * @param	string $namespace
     * @return 	Zend_Controller_Action_Helper_FlashMessenger Provides a fluent interface
     */
    public function addMessage($message, $namespace = null)
    {
        if (!is_string($namespace) || $namespace == '')
        {
            $namespace = $this->_namespace;
        }

        if (self::$_messageAdded === false)
        {
            self::$_session->setExpirationHops(1, null, true);
        }

        if (!is_array(self::$_session->{$this->_namespace}))
        {
            self::$_session->{$this->_namespace} = array();
            self::$_session->{$namespace} = array();
        }
        
        if (is_array($message))
        {
        	$flatten = new RecursiveIteratorIterator(new RecursiveArrayIterator($message));
        	foreach($flatten as $line) 
        	{
        		self::$_session->{$namespace}[] = (string) $line;
        	}
        } else
        {
        	self::$_session->{$namespace}[] = (string) $message;
        }
		
        self::$_session->{$namespace} = array_unique(self::$_session->{$namespace});
        self::$_messageAdded = true;

        return $this;
    }
}
