<?php
class Lumia_Placeholder
{
	protected $_backgroundColor;
	protected $_enableCache;
	protected $_cacheDir;
	protected $_expires;
	protected $_font;
	protected $_height;
	protected $_maxHeight;
	protected $_width;
	protected $_maxWidth;
	protected $_textColor;

	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->setBackgroundColor('dddddd');
		$this->enableCache();
		$this->setCacheDir(LUMIA_UPLOAD_DIR . DIRECTORY_SEPARATOR . 'placeholder');
		$this->setExpires(604800);
		$this->setFont(dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'Placeholder' . DIRECTORY_SEPARATOR . 'Oswald-Regular.ttf');
		$this->setMaxHeight(2000);
		$this->setMaxWidth(2000);
		$this->setTextColor('000000');
	}

	/**
	 * Sets background color
	 *
	 * @param string $hex Hex code value
	 * @throws Lumia_Placeholder_Exception
	 */
	public function setBackgroundColor($hex)
	{
		if (strlen($hex) === 3 || strlen($hex) === 6)
		{
			if (preg_match('/^[a-f0-9]{3}$|^[a-f0-9]{6}$/i', $hex))
			{
				$this->_backgroundColor = $hex;
			} else
			{
				throw new Lumia_Placeholder_Exception(__METHOD__ . '() Background color must be a valid RGB hex code.');
			}
		} else
		{
			throw new Lumia_Placeholder_Exception(__METHOD__ . '() Background color must be 3 or 6 character hex code.');
		}
	}

	/**
	 * Gets background color
	 */
	protected function _getBackgroundColor()
	{
		return $this->_backgroundColor;
	}

	/**
	 * Sets text color
	 *
	 * @param string $hex Hex code value
	 * @throws Lumia_Placeholder_Exception
	 */
	function setTextColor($hex)
	{
		if (strlen($hex) === 3 || strlen($hex) === 6)
		{
			if (preg_match ( '/^[a-f0-9]{3}$|^[a-f0-9]{6}$/i', $hex ))
			{
				$this->_textColor = $hex;
			} else
			{
				throw new Lumia_Placeholder_Exception(__METHOD__ . '() Text color must be a valid RGB hex code.');
			}
		} else
		{
			throw new Lumia_Placeholder_Exception(__METHOD__ . '() Text color must be 3 or 6 character hex code.');
		}
	}

	/**
	 * Gets text color
	 * 
	 * @return	string
	 */
	protected function _getTextColor()
	{
		return $this->_textColor;
	}

	/**
	 * Sets location of TTF font
	 *
	 * @param string $fontPath Location of TTF font
	 * @throws Lumia_Placeholder_Exception
	 */
	public function setFont($fontPath)
	{
		if (is_readable ( $fontPath ))
		{
			$this->_font = $fontPath;
		} else
		{
			throw new Lumia_Placeholder_Exception(__METHOD__ . '() Font file must exist and be readable by web server.');
		}
	}

	/**
	 * Gets location of font
	 * 
	 * @return	string
	 */
	protected function _getFont()
	{
		return $this->_font;
	}

	/**
	 * Set expires header value
	 *
	 * @param int $expires Seconds used in expires HTTP header
	 * @throws Lumia_Placeholder_Exception
	 */
	public function setExpires($expires)
	{
		if (preg_match( '/^\d+$/', $expires ))
		{
			$this->_expires = $expires;
		} else
		{
			throw new Lumia_Placeholder_Exception(__METHOD__ . '() Expires must be an integer.');
		}
	}

	/**
	 * Get expires header value
	 */
	protected function _getExpires()
	{
		return $this->_expires;
	}

	/**
	 * Set maximum width allowed for placeholder image
	 *
	 * @param int $maxWidth Maximum width of generated image
	 * @throws Lumia_Placeholder_Exception
	 */
	public function setMaxWidth($maxWidth)
	{
		if (preg_match ( '/^\d+$/', $maxWidth ))
		{
			$this->_maxWidth = $maxWidth;
		} else
		{
			throw new Lumia_Placeholder_Exception(__METHOD__ . '() Maximum width must be an integer.');
		}
	}
	/**
	 * Get max width value
	 */
	protected function _getMaxWidth()
	{
		return $this->_maxWidth;
	}

	/**
	 * Set maximum height allowed for placeholder image
	 *
	 * @param int $maxHeight Maximum height of generated image
	 * @throws Lumia_Placeholder_Exception
	 */
	public function setMaxHeight($maxHeight)
	{
		if (preg_match ( '/^\d+$/', $maxHeight ))
		{
			$this->_maxHeight = $maxHeight;
		} else
		{
			throw new Lumia_Placeholder_Exception(__METHOD__ . '() Maximum height must be an integer.');
		}
	}

	/**
	 * Get max height value
	 */
	protected function _getMaxHeight()
	{
		return $this->_maxHeight;
	}

	/**
	 * Enable or disable cache
	 *
	 * @param bool $cache Whether or not to cache
	 * @throws Lumia_Placeholder_Exception
	 */
	public function enableCache()
	{
		$this->_enableCache = true;
	}

	/**
	 * Enable or disable cache
	 *
	 * @param bool $cache Whether or not to cache
	 * @throws Lumia_Placeholder_Exception
	 */
	public function disableCache()
	{
		$this->_enableCache = false;
	}

    /**
     * Is cache enabled?
     *
     * @return bool
     */
    public function cacheIsEnabled()
    {
        return $this->_enableCache;
    }

	/**
	 * Sets caching path
	 *
	 * @param string $cacheDir Path to cache folder, must be writable by web server
	 * @throws Lumia_Placeholder_Exception
	 */
	public function setCacheDir($cacheDir)
	{
		if (is_dir($cacheDir))
		{
			$this->_cacheDir = $cacheDir;
		} else
		{
			throw new Lumia_Placeholder_Exception(__METHOD__ . '() expects a directory.');
		}
	}

	/**
	 * Get cache directory value
	 * 
	 * @return	string
	 */
	protected function _getCacheDir()
	{
		return $this->_cacheDir;
	}

	/**
	 * Set width of image to render
	 *
	 * @param int $width Width of generated image
	 * @throws Lumia_Placeholder_Exception
	 */
	public function setWidth($width)
	{
		if (preg_match('/^\d+$/', $width))
		{
			if ($width > 0)
			{
				$this->_width = $width;
			} else
			{
				throw new Lumia_Placeholder_Exception(__METHOD__ . '() Width must be greater than zero.');
			}
		} else
		{
			throw new Lumia_Placeholder_Exception(__METHOD__ . '() Width must be an integer.');
		}
	}

	/**
	 * Get width value
	 * 
	 * @return	float
	 */
	protected function _getWidth()
	{
		return $this->_width;
	}

	/**
	 * Set height of image to render
	 *
	 * @param int $height Height of generated image
	 * @throws Lumia_Placeholder_Exception
	 */
	public function setHeight($height)
	{
		if (preg_match ( '/^\d+$/', $height ))
		{
			if ($height > 0)
			{
				$this->_height = $height;
			} else
			{
				throw new Lumia_Placeholder_Exception(__METHOD__ . '() Height must be greater than zero.');
			}
		} else
		{
			throw new Lumia_Placeholder_Exception(__METHOD__ . '() Height must be an integer.');
		}
	}

	/**
	 * Get height value
	 * 
	 * @return	float
	 */
	protected function _getHeight()
	{
		return $this->_height;
	}

	/**
	 * Display image and cache (if enabled)
	 *
	 * @throws Lumia_Placeholder_Exception
	 */
	public function render()
	{
		if ($this->_getWidth() <= $this->_getMaxWidth() && $this->_getHeight() <= $this->_getMaxHeight())
		{
			$backgroundColor = $this->_getBackgroundColor();
			$textColor = $this->_getTextColor();
			$cachePath = $this->_getCacheDir() . '/' . $this->_getWidth() . '_' . $this->_getHeight() . '_' . (strlen($backgroundColor) === 3 ? $backgroundColor[0] . $backgroundColor[0] . $backgroundColor[1] . $backgroundColor[1] . $backgroundColor[2] . $backgroundColor[2] : $backgroundColor) . '_' . (strlen($textColor) === 3 ? $textColor[0] . $textColor[0] . $textColor[1] . $textColor[1] . $textColor[2] . $textColor[2] : $textColor) . '.png';
			header('Content-type: image/png');
			header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time () + $this->_getExpires()));
			header('Cache-Control: public');
			if ($this->cacheIsEnabled() && Lumia_Utility_Filesystem::isReallyWritable($cachePath))
			{
				// send header identifying cache hit & send cached image
				header('img-src-cache: hit');
				print file_get_contents($cachePath);
			} else
			{
				// cache disabled or no cached copy exists
				// send header identifying cache miss if cache enabled
				if ($this->cacheIsEnabled())
				{
					header('img-src-cache: miss');
				}

				$image = $this->_createImage();
				imagepng($image);

				// write cache
				if ($this->cacheIsEnabled() && Lumia_Utility_Filesystem::isReallyWritable($this->_getCacheDir()))
				{
					imagepng($image, $cachePath);
				}

				imagedestroy($image);
			}
				
			exit;
		} 
		
		throw new Lumia_Placeholder_Exception(__METHOD__ . '() Placeholder size may not exceed ' . $this->_getMaxWidth() . 'x' . $this->_getMaxHeight() . ' pixels.');
	}

	/**
	 * Generate image file
	 *
	 * @return resource
	 */
	protected function _createImage()
	{
		$image = imagecreate($this->_getWidth(), $this->_getHeight());
		// convert backgroundColor hex to RGB values
		list($bgR, $bgG, $bgB) = $this->_hexToDec($this->_getBackgroundColor());
		$backgroundColor = imagecolorallocate($image, $bgR, $bgG, $bgB);
		// convert textColor hex to RGB values
		list($textR, $textG, $textB) = $this->_hexToDec($this->_getTextColor());
		$textColor = imagecolorallocate($image, $textR, $textG, $textB);
		$text = $this->_getWidth() . 'x' . $this->_getHeight();
		imagefilledrectangle($image, 0, 0, $this->_getWidth(), $this->_getHeight(), $backgroundColor);
		$fontSize = 26;
		$textBoundingBox = imagettfbbox($fontSize, 0, $this->_getFont(), $text);
		
		// decrease the default font size until it fits nicely within the image
		while (((($this->_getWidth() - ($textBoundingBox[2] - $textBoundingBox[0])) < 10) || (($this->_getHeight() - ($textBoundingBox[1] - $textBoundingBox[7])) < 10)) && ($fontSize > 1))
		{
			$fontSize--;
			$textBoundingBox = imagettfbbox($fontSize, 0, $this->_getFont(), $text);
		}
		
		imagettftext($image, $fontSize, 0, ($this->_getWidth() / 2) - (($textBoundingBox[2] - $textBoundingBox[0]) / 2), ($this->_getHeight() / 2) + (($textBoundingBox[1] - $textBoundingBox[7]) / 2), $textColor, $this->_getFont(), $text);

		return $image;
	}

	/**
	 * Render image file
	 *
	 * @param string $file
	 */
	function renderToFile($file)
	{
		if (!file_exists($file))
		{
			touch($file);
		}

		$image = $this->_createImage();
		imagepng($image, $file);
		imagedestroy($image);
	}

	/**
	 * Convert hex code to array of RGB decimal values
	 *
	 * @param string $hex Hex code to convert to dec
	 * @return array
	 * @throws Lumia_Placeholder_Exception
	 */
	protected function _hexToDec($hex)
	{
		if (strlen($hex) === 3)
		{
			return array (
				hexdec($hex [0] . $hex [0]),
				hexdec($hex [1] . $hex [1]),
				hexdec($hex [2] . $hex [2])
			);
		} 
		
		if (strlen($hex) === 6)
		{
			return array (
				hexdec($hex [0] . $hex [1]),
				hexdec($hex [2] . $hex [3]),
				hexdec($hex [4] . $hex [5])
			);
		} 
		
		throw new Lumia_Placeholder_Exception(__METHOD__ . '() Could not convert hex value to decimal.');
	}
}