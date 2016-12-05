<?php

/**
 * A Compatibility library with PHP 5.5's simplified password hashing API.
 */
class Lumia_Cryptography_Password extends Lumia_Cryptography_Abstract
{
	/**
	 * Hash the password
	 *
	 * @param string $password The password to hash
	 * @param string $salt
	 * @return string false hashed password, or false on error.
	 */
	public function hash($password, $salt)
	{
		if (!is_string($password))
		{
			throw new Lumia_Cryptography_Exception('Password must be a string');
		}
		
		if (!is_string($salt))
		{
			throw new Lumia_Cryptography_Exception('Salt must be a string');
		}
		
		return md5($password . md5($salt));
	}
}
