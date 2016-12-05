<?php

class Lumia_Cryptography_Abstract
{

	/**
	 * Unique alphabet string
	 *
	 * @var string
	 */
	protected $_alphabet;

	/**
	 * Class constructor
	 *
	 * @param string $alphabet        	
	 * @return void
	 */
	public function __construct($alphabet = '')
	{
		if ($alphabet)
		{
			$this->_alphabet = implode('', array_unique(str_split($alphabet)));
		} else
		{
			$this->_alphabet = implode('', array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9)));
		}
	}

	/**
	 * Create a randomized string
	 *
	 * @param int $len        	
	 * @return string
	 */
	public function random($len = 32)
	{
		$alphabet = str_split($this->_alphabet);
		shuffle($alphabet);
		$num = count($alphabet) - 1;
		
		// Create random token at the specified length.
		$token = '';
		for ($i = 0; $i < $len; $i ++)
		{
			$token .= $alphabet[mt_rand(0, $num)];
		}
		
		return $token;
	}
}
