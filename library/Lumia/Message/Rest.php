<?php

class Lumia_Message_Rest extends Lumia_Message_Abstract
{
	/**
	 * Ajax request callback
	 *
	 * @var string
	 */
	protected $_callback;

	/**
	 * Constructor
	 *
	 * @param string $callback        	
	 */
	public function __construct($callback)
	{
		$this->_callback = (string) $callback;
	}

	/**
	 * Returns a string representation of the object
	 */
	public function toString()
	{
		$response = new stdClass();
		$response->message = implode(PHP_EOL, $this->_messages);
		$response->code = ($this->_code === self::SUCCESS_CODE ? self::SUCCESS_CODE : self::ERROR_CODE);
		$response->status = ($this->_status === true ? 'SUCCESS' : 'ERROR');
		$response->contexts = $this->_contexts;
		
		return $this->_callback . '(' . Zend_Json::encode($response) . ')';
	}
}
