<?php

/**
 * Generate short hashes from numbers
 *
 * @see http://www.hashids.org/php/
 */
class Lumia_Cryptography_HashID extends Lumia_Cryptography_Abstract
{

	/**
	 * Constants
	 */
	const MIN_ALPHABET_LENGTH = 16;
	const SEP_DIV = 3.5;
	const GUARD_DIV = 12;
	
	/**
	 * Encryption key
	 *
	 * @var string
	 */
	protected $_privateKey;
	
	/**
	 * Separate string
	 * 
	 * @var string
	 */
	protected $_seps = 'cfhistuCFHISTU';
	
	/**
	 * Length of hash string
	 * 
	 * @var int
	 */
	protected $_minHashLength;
	
	/**
	 * Math libraries for encrypt & decrypt string
	 * 
	 * @var array
	 */
	protected $_fnMath = array();
	
	/**
	 * The largest integer supported in this build of PHP
	 * 
	 * @var int
	 */
	protected $_maxIntValue = 1000000000;
	
	/**
	 * Minimum value of the largest integer supported in this build of PHP
	 * 
	 * @var int
	 */
	protected $_lowerMaxIntValue;

	/**
	 * Class constructor
	 *
	 * @param 	string $privateKey
	 * @param	int $minHashLength        	
	 * @return 	void
	 */
	public function __construct($privateKey = '', $minHashLength = 0, $alphabet = '')
	{
		parent::__construct();
		
		/*
		 * If either math precision library is present, raise $this->_maxIntValue
		 */
		if (function_exists('gmp_add'))
		{
			$this->_fnMath['add'] = 'gmp_add';
			$this->_fnMath['div'] = 'gmp_div';
			$this->_fnMath['str'] = 'gmp_strval';
		} else if (function_exists('bcadd'))
		{
			$this->_fnMath['add'] = 'bcadd';
			$this->_fnMath['div'] = 'bcdiv';
			$this->_fnMath['str'] = 'strval';
		}
		
		$this->_lowerMaxIntValue = $this->_maxIntValue;
		
		if ($this->_fnMath)
		{
			$this->_maxIntValue = PHP_INT_MAX;
		}
		
		if (strlen($this->_alphabet) < self::MIN_ALPHABET_LENGTH)
		{
			throw new Lumia_Cryptography_Exception(sprintf('Alphabet must contain at least %d unique characters', self::MIN_ALPHABET_LENGTH));
		}
		
		if (is_int(strpos($this->_alphabet, ' ')))
		{
			throw new Lumia_Cryptography_Exception('Alphabet cannot contain spaces');
		}
		
		$this->_privateKey = (string) $privateKey;
		if (!strlen($this->_privateKey))
		{
			$this->_privateKey = $this->_alphabet;
		}
			
		$alphabetArray = str_split($this->_alphabet);
		$sepsArray = str_split($this->_seps);
		
		$this->_alphabet = implode('', array_diff($alphabetArray, $sepsArray));
		$this->_seps = $this->_shuffle(implode('', array_intersect($alphabetArray, $sepsArray)), $this->_privateKey);
		
		if (!$this->_seps || (strlen($this->_alphabet) / strlen($this->_seps)) > self::SEP_DIV)
		{
			$sepsLength = floor(strlen($this->_alphabet) / self::SEP_DIV);
			if ($sepsLength == 1) 
			{
				$sepsLength ++;
			}
				
			if ($sepsLength > strlen($this->_seps))
			{
				$diff = $sepsLength - strlen($this->_seps);
				$this->_seps .= substr($this->_alphabet, 0, $diff);
				$this->_alphabet = substr($this->_alphabet, $diff);
			} else
			{
				$this->_seps = substr($this->_seps, 0, $sepsLength);
			}
		}
		
		$this->_alphabet = $this->_shuffle($this->_alphabet, $this->_privateKey);
		$guardCount = (int) ceil(strlen($this->_alphabet) / self::GUARD_DIV);
		
		if (strlen($this->_alphabet) < 3)
		{
			$this->_guards = substr($this->_seps, 0, $guardCount);
			$this->_seps = substr($this->_seps, $guardCount);
		} else
		{
			$this->_guards = substr($this->_alphabet, 0, $guardCount);
			$this->_alphabet = substr($this->_alphabet, $guardCount);
		}
		
		$this->_minHashLength = (int) $minHashLength;
	}
	
	/**
	 * Set private key
	 * 
	 * @param	string $key
	 * @return Lumia_Cryptography_Abstract
	 */
	public function setPrivateKey($privateKey)
	{
		$this->_privateKey = (string) $privateKey;
		
		return $this;
	}
	
	/**
	 * Encrypt the given data using symmetric-key encryption
	 *
	 * @param	string
	 * @return  string
	 */
	public function encryptArray()
	{
		$ret = '';
		$numbers = func_get_args();
		if (!$numbers)
		{
			return $ret;
		}
		
		foreach ($numbers as $number)
		{
			$is_number = ctype_digit((string) $number);
			if (!$is_number || $number < 0 || $number > $this->_maxIntValue)
			{
				return $ret;
			}
		}
		
		return $this->_encode($numbers);
	}
	
	/**
	 * Decrypt encrypted cipher using symmetric-key encryption
	 *
	 * @param	string $hash
	 * @return  array
	 */
	public function decryptArray($hash)
	{
		$ret = array();
		if (!$hash || !is_string($hash) || !trim($hash))
		{
			return $ret;
		}
		
		return $this->_decode(trim($hash));
	}
	
	/**
	 * Encrypt the given data using symmetric-key encryption
	 *
	 * @param	string
	 * @return  string
	 */
	public function encrypt($str)
	{
		// Check for character(s) representing a hexadecimal digit
		if (!ctype_xdigit((string) $str))
		{
			return '';
		}
		
		$numbers = trim(chunk_split($str, 12, ' '));
		$numbers = explode(' ', $numbers);
		foreach ($numbers as $i => $number)
		{
			$numbers[$i] = hexdec('1' . $number);
		}
		
		return call_user_func_array(array($this, 'encryptArray'), $numbers);
	}
	
	/**
	 * Decrypt encrypted cipher using symmetric-key encryption
	 *
	 * @param	string $hash
	 * @return  string
	 */
	public function decrypt($hash)
	{
		$ret = '';
		$numbers = $this->decryptArray($hash);
		foreach ($numbers as $i => $number)
		{
			$ret .= substr(dechex($number), 1);
		}
		
		return $ret;
	}
	
	/**
	 * Calculate generate hash string
	 * 
	 * @param array $numbers
	 * @return string
	 */
	protected function _encode(array $numbers)
	{
		$alphabet = $this->_alphabet;
		$numbersSize = count($numbers);
		$numbersHashInt = 0;
		
		foreach ($numbers as $i => $number)
		{
			$numbersHashInt += ($number % ($i + 100));
		}
		
		$lottery = $ret = $alphabet[$numbersHashInt % strlen($alphabet)];
		foreach ($numbers as $i => $number)
		{
			$alphabet = $this->_shuffle($alphabet, substr($lottery . $this->_privateKey . $alphabet, 0, strlen($alphabet)));
			$ret .= $last = $this->_hash($number, $alphabet);
			
			if ($i + 1 < $numbersSize)
			{
				$number %= (ord($last) + $i);
				$seps_index = $number % strlen($this->_seps);
				$ret .= $this->_seps[$seps_index];
			}
		}
		
		if (strlen($ret) < $this->_minHashLength)
		{
			$guardIndex = ($numbersHashInt + ord($ret[0])) % strlen($this->_guards);
			$guard = $this->_guards[$guardIndex];
			$ret = $guard . $ret;
			$guardIndex = ($numbersHashInt + ord($ret[2])) % strlen($this->_guards);
			$guard = $this->_guards[$guardIndex];
			$ret .= $guard;
		}
		
		$halfLength = (int) (strlen($alphabet) / 2);
		while (strlen($ret) < $this->_minHashLength)
		{
			$alphabet = $this->_shuffle($alphabet, $alphabet);
			$ret = substr($alphabet, $halfLength) . $ret . substr($alphabet, 0, $halfLength);
			$excess = strlen($ret) - $this->_minHashLength;
			
			if ($excess > 0)
			{
				$ret = substr($ret, $excess / 2, $this->_minHashLength);
			}
		}
		
		return $ret;
	}
	
	/**
	 * Calculate rebuild normal string from hash string
	 * @param string $hash
	 * @return array <multitype:, multitype:number >
	 */
	protected function _decode($hash)
	{
		$ret = array();
		$alphabet = $this->_alphabet;
		$hashBreakdown = str_replace(str_split($this->_guards), ' ', $hash);
		$hashArray = explode(' ', $hashBreakdown);
		
		$i = 0;
		$hashSize = count($hashArray);
		if ($hashSize > 1 && $hashSize < 4)
		{
			$i = 1;
		}
		
		$hashBreakdown = $hashArray[$i];
		if (isset($hashBreakdown[0]))
		{
			$lottery = $hashBreakdown[0];
			$hashBreakdown = substr($hashBreakdown, 1);
			$hashBreakdown = str_replace(str_split($this->_seps), ' ', $hashBreakdown);
			$hashArray = explode(' ', $hashBreakdown);
			
			foreach ($hashArray as $sub_hash)
			{
				$alphabet = $this->_shuffle($alphabet, substr($lottery . $this->_privateKey . $alphabet, 0, strlen($alphabet)));
				$ret[] = (int) $this->_unhash($sub_hash, $alphabet);
			}
			
			if ($this->_encode($ret) != $hash)
			{
				$ret = array();
			}
		}
		
		return $ret;
	}
	
	/**
	 * Shuffle randomize the order of the elements
	 * 
	 * @param string $alphabet
	 * @param string $privateKey
	 * @return string
	 */
	protected function _shuffle($alphabet, $privateKey)
	{
		$privateKeyLength = strlen($privateKey);
		if (!$privateKeyLength)
		{
			return $alphabet;
		}
		
		for ($i = strlen($alphabet) - 1, $v = 0, $p = 0; $i > 0; $i--, $v++)
		{
			$v %= $privateKeyLength;
			$p += $int = ord($privateKey[$v]);
			$j = ($int + $v + $p) % $i;
			$temp = $alphabet[$j];
			$alphabet[$j] = $alphabet[$i];
			$alphabet[$i] = $temp;
		}
		
		return $alphabet;
	}
	
	/**
	 * Generate a hash value
	 * 
	 * @param string $input
	 * @param string $alphabet
	 * @return string
	 */
	protected function _hash($input, $alphabet)
	{
		$hash = '';
		$alphabetLength = strlen($alphabet);
		do
		{
			$hash = $alphabet[$input % $alphabetLength] . $hash;
			if ($input > $this->_lowerMaxIntValue && $this->_fnMath)
			{
				$input = $this->_fnMath['str']($this->_fnMath['div']($input, $alphabetLength));
			} else
			{
				$input = (int) ($input / $alphabetLength);
			}
				
		} while ($input);
		
		return $hash;
	}
	
	/**
	 * Rebuild normal string from hash string
	 *
	 * @param string $input
	 * @param string $alphabet
	 * @return string
	 */
	protected function _unhash($input, $alphabet)
	{
		$number = 0;
		if (strlen($input) && $alphabet)
		{
			$alphabetLength = strlen($alphabet);
			$inputChars = str_split($input);
			
			foreach ($inputChars as $i => $char)
			{
				$pos = strpos($alphabet, $char);
				if ($this->_fnMath)
				{
					$number = $this->_fnMath['str']($this->_fnMath['add']($number, $pos * pow($alphabetLength, (strlen($input) - $i - 1))));
				} else
				{
					$number += $pos * pow($alphabetLength, (strlen($input) - $i - 1));
				}
			}
		}
		
		return $number;
	}
}