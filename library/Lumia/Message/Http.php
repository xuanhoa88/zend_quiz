<?php

class Lumia_Message_Http extends Lumia_Message_Abstract
{
	/**
	 * Returns a string representation of the object
	 * 
	 * @return	object
	 */
	public function toString()
	{
		$response = new stdClass();
		$response->message = implode(PHP_EOL, $this->_messages);
		$response->code = ($this->_code === self::SUCCESS_CODE ? self::SUCCESS_CODE : self::ERROR_CODE);
		$response->status = ($this->_status === true ? 'SUCCESS' : 'ERROR');
		$response->contexts = $this->_contexts;
		
		return $response;
	}
}
