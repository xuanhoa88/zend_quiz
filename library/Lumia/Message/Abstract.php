<?php

abstract class Lumia_Message_Abstract
{
	/**
	 * Constants
	 */
	const ERROR_CODE = 0;
	const SUCCESS_CODE = 1;

	/**
	 * Response code
	 *
	 * @var int
	 */
	protected $_code = 0;

	/**
	 * Response status
	 *
	 * @var boolean
	 */
	protected $_status = false;

	/**
	 * Response message
	 *
	 * @var array
	 */
	protected $_messages = array();

	/**
	 * Response context
	 *
	 * @var array
	 */
	protected $_contexts = array();

	/**
	 * Force response status code
	 *
	 * @param int $code        	
	 * @return void
	 */
	public function setCode($code = self::ERROR_CODE)
	{
		$this->_code = (int) $code;
	}

	/**
	 * Force response status success
	 *
	 * @return void
	 */
	public function setError()
	{
		$this->_status = false;
		$this->setCode(self::ERROR_CODE);
	}

	/**
	 * Force response status success
	 *
	 * @return void
	 */
	public function setSuccess()
	{
		$this->_status = true;
		$this->setCode(self::SUCCESS_CODE);
	}

	/**
	 * Determine if a variable is error
	 *
	 * @return boolean
	 */
	public function isSuccess()
	{
		return ($this->_status === true);
	}

	/**
	 * Determine if a variable is error
	 *
	 * @return boolean
	 */
	public function isError()
	{
		return ! $this->isSuccess();
	}

	/**
	 * Set response messages en masse
	 *
	 * @param array $messages        	
	 */
	public function setMessages(array $messages)
	{
		$this->_messages = $messages;
	}

	/**
	 * Append response message
	 *
	 * @param string $messages        	
	 */
	public function appendMessage($message)
	{
		array_push($this->_messages, (string) $message);
	}
	
	/**
	 * Prepend response message
	 *
	 * @param string $messages
	 */
	public function prependMessage($message)
	{
		array_unshift($this->_messages, (string) $message);
	}

	/**
	 * Force response contexts en masse
	 *
	 * @param array $contexts        	
	 */
	public function setContexts(array $contexts)
	{
		$this->_contexts = $contexts;
	}
	
	/**
	 * Append response context
	 *
	 * @param string $messages
	 */
	public function addContext($context, $index = null)
	{
		if ($index === null) 
		{
			array_push($this->_contexts, (string) $context);
		} else
		{
			$this->_contexts[$index] = $context;
		}
	}

	/**
	 * Returns a string representation of the object
	 * 
	 * @return	string
	 */
	public function __toString()
	{
		return $this->toString();
	}
}
