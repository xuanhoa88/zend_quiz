<?php

/**
 * Lumia_Controller_Action_Helper_HashID
 *
 * @category   Lumia
 * @package    Lumia_Controller_Action_Helper
 */
class Lumia_Controller_Action_Helper_HashID extends Zend_Controller_Action_Helper_Abstract
{
	/**
	 * Initialize HashID and use session user id make token key
	 * 
	 * @return Lumia_Cryptography_HashID
	 */
	public function hashID()
    {
    	// Get class HashID
    	$cryptHashID = Lumia_Cryptography::factory('HashID');
    	
    	// Set private key
    	$cryptHashID->setPrivateKey(Lumia_Auth::getInstance()->getUser()->user_id);
    	
		return $cryptHashID;        
    }
	
    /**
     * Strategy pattern: proxy to hashID()
     *
     * @return 	Lumia_Cryptography_HashID
     */
	public function direct()
	{
		return $this->hashID();
	}
}
