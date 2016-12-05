<?php

class Lumia_Cryptography_HashString extends Lumia_Cryptography_Abstract
{
	/**
	 * Constants
	 */
	const MIN_ALPHABET_LENGTH = 16;
	
	/**
	 * Encryption key
	 *
	 * @var string
	 */
	protected $_privateKey;
	
	/**
	 * @var	string
	 */
	protected $_algorithm = 'blowfish';
	
	/**
	 * @var	string
	 */
	protected $_adapter = 'Mcrypt';
	
	/**
	 * @var string
	 */
	protected $_mode = MCRYPT_MODE_ECB;
	
	/**
	 * Class constructor
	 *
	 * @param 	string $privateKey
	 * @param	string $algo
	 * @return 	void
	 */
	public function __construct($privateKey = '', $algo = 'blowfish')
	{
		parent::__construct();
		
		if (strlen($this->_alphabet) < self::MIN_ALPHABET_LENGTH)
		{
			throw new Lumia_Cryptography_Exception(sprintf('Alphabet must contain at least %d unique characters', self::MIN_ALPHABET_LENGTH));
		}
		
		if (is_int(strpos($this->_alphabet, ' ')))
		{
			throw new Lumia_Cryptography_Exception('Alphabet cannot contain spaces');
		}
		
		// Set private key
		$this->_privateKey = (string) $privateKey;
		if (!strlen($this->_privateKey))
		{
			$this->_privateKey = $this->_alphabet;
		}
		
		// Set algorithm
		if (strlen($algo) > 0)
		{
			$this->_algorithm = $algo;
		}
	}
	
	/**
	 * Sets private key to use when hashing the string
	 * 
	 * @param	string $privateKey
	 * @return 	Lumia_Cryptography_HashString
	 */
	public function setPrivateKey($privateKey)
	{
		$this->_privateKey = (string) $privateKey;
		
		return $this;
	}
	
	/**
	 * Sets algorithm mode to use when hashing the string
	 * 
	 * @param	string $mode
	 * @return 	Lumia_Cryptography_HashString
	 */
	public function setMode($mode)
	{
		$this->_mode = (string) $mode;
		
		return $this;
	}
	
	/**
     * Sets encryption adapter
     *
     * @param  	string $adapter
     * @return 	Lumia_Cryptography_HashString
     */
    public function setAdapter($adapter)
    {
        $this->_adapter = $adapter;
        
        return $this;
    }
	
	/**
	 * Sets algorithm to use when hashing the string
	 * 
	 * @param	string $algo
	 * @return 	Lumia_Cryptography_HashString
	 */
	public function setAlgorithm($algo)
	{
		$this->_algorithm = (string) $algo;
		
		return $this;
	}
	
	/**
	 * Encrypt the given data using symmetric-key encryption
	 *
	 * @param	string $str
	 * @return  string
	 */
	public function encrypt($str)
	{
		$filter = new Zend_Filter_Encrypt(array(
				'key'       => $this->_privateKey,
				'algorithm' => $this->_algorithm,
				'adapter' => $this->_adapter,
				'mode' => $this->_mode
		));
		
		return base64_encode($filter->filter($str));
	}
	
	/**
	 * Decrypt encrypted cipher using symmetric-key encryption
	 *
	 * @param	string $hash
	 * @return  string
	 */
	public function decrypt($hash)
	{
		$filter = new Zend_Filter_Decrypt(array(
				'key'       => $this->_privateKey,
				'algorithm' => $this->_algorithm,
				'adapter' => $this->_adapter,
				'mode' => $this->_mode
		));
		
		return rtrim($filter->filter(base64_decode($hash)), "\0");
	}
}
