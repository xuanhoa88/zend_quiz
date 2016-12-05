<?php
class Lumia_Utility_Filesystem
{
	/**
	 * Tests for file writability
	 *
	 * is_writable() returns TRUE on Windows servers when you really can't write to
	 * the file, based on the read-only attribute. is_writable() is also unreliable
	 * on Unix servers if safe_mode is on.
	 *
	 * @access private
	 * @return void
	 */
	public static function isReallyWritable($file)
	{
		// If we're on a Unix server with safe_mode off we call is_writable
		if (DIRECTORY_SEPARATOR == '/' && @ini_get( 'safe_mode' ) == FALSE)
		{
			return is_writable ( $file );
		}

		// For windows servers and safe_mode "on" installations we'll actually
		// write a file then read it. Bah...
		if (is_dir( $file ))
		{
			$file = rtrim( $file, '/' ) . '/' . md5( mt_rand( 1, 100 ) . mt_rand( 1, 100 ) );
				
			if (($fp = @fopen( $file, 'ab' )) === FALSE) 
			{
				return FALSE;
			}
				
			fclose( $fp );
			@chmod( $file, 0777 );
			@unlink( $file );
				
			return TRUE;
		}

		if (! is_file( $file ) || ($fp = @fopen( $file, 'ab' )) === FALSE)
		{
			return FALSE;
		}

		fclose( $fp );

		return TRUE;
	}

	/**
	 * Makes directory
	 *
	 * @param	string $pathname The directory path
	 * @param	int $mode
	 * @param	bool $recursive Allows the creation of nested directories specified in the pathname
	 * @param	Streams $context Context support was added with PHP 5.0.0. For a description of contexts, refer to Streams
	 */
	public static function makeDirectories($pathname, $mode = 0777, $recursive = TRUE, $context = NULL)
	{
		if (is_dir($pathname))
		{
			return TRUE;
		}

		if (is_resource($context))
		{
			return mkdir($pathname, $mode, $recursive, $context);
		}

		return mkdir($pathname, $mode, $recursive);
	}

	/**
	 * Get File Info
	 *
	 * Given a file and path, returns the name, path, size, date modified
	 * Second parameter allows you to explicitly declare what information you want returned
	 * Options are: name, server_path, size, date, readable, writable, executable, fileperms
	 * Returns FALSE if the file cannot be found.
	 *
	 * @param	string	path to file
	 * @param	mixed	array or comma separated string of information returned
	 * @return	array
	 */
	public static function fileInfo($file, array $returnVals = array('name', 'server_path', 'size', 'date'))
	{
		if (!is_file($file))
		{
			return FALSE;
		}

		$fileInfo = array();
		foreach ($returnVals as $key)
		{
			switch ($key)
			{
				case 'name':
					$fileInfo['name'] = basename($file);
					break;
				case 'server_path':
					$fileInfo['server_path'] = $file;
					break;
				case 'size':
					$fileInfo['size'] = filesize($file);
					break;
				case 'date':
					$fileInfo['date'] = filemtime($file);
					break;
				case 'readable':
					$fileInfo['readable'] = is_readable($file);
					break;
				case 'writable':
					$fileInfo['writable'] = self::isReallyWritable($file);
					break;
				case 'executable':
					$fileInfo['executable'] = is_executable($file);
					break;
				case 'fileperms':
					$fileInfo['fileperms'] = fileperms($file);
					break;
			}
		}

		return $fileInfo;
	}

	/**
	 * Create a Directory Map
	 *
	 * Reads the specified directory and builds an array
	 * representation of it. Sub-folders contained with the
	 * directory will be mapped as well.
	 *
	 * @param	string	$src		Path to source
	 * @param	int	$depth	Depth of directories to traverse (0 = fully recursive, 1 = current dir, etc)
	 * @param	bool	$hidden			Whether to show hidden files
	 * @return	array
	 */
	public static function directoryMap($src, $depth = 0, $hidden = FALSE)
	{
		$filedata = array();
		if ($fp = @opendir($src))
		{
			$currentDepth = $depth - 1;
			$src = rtrim($src, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

			while (FALSE !== ($file = readdir($fp)))
			{
				// Remove '.', '..', and hidden files [optional]
				if ($file === '.' || $file === '..' || ($hidden === FALSE && $file[0] === '.'))
				{
					continue;
				}

				is_dir($src . $file) && $file .= DIRECTORY_SEPARATOR;

				if (($depth < 1 || $currentDepth > 0) && is_dir($src . $file))
				{
					$filedata[$file] = self::directoryMap($src . $file, $currentDepth, $hidden);
				} else
				{
					$filedata[] = $file;
				}
			}

			closedir($fp);
		}

		return $filedata;
	}
	
	/**
	 * Returns a file size limit in bytes based on the PHP upload_max_filesize and post_max_size
	 * 
	 * @return int < follow Byte >
	 */
	public static function getFileUploadMaxSize() 
	{
		static $postMaxSize = -1;
	
		if ($postMaxSize < 0) 
		{
			// Start with post_max_size.
			$postMaxSize = self::_parseSize(ini_get('post_max_size'));
	
			// If upload_max_size is less, then reduce. Except if upload_max_size is
			// zero, which indicates no limit.
			$uploadMaxSize = self::_parseSize(ini_get('upload_max_filesize'));
			if ($uploadMaxSize > 0 && $uploadMaxSize < $postMaxSize) 
			{
				$postMaxSize = $uploadMaxSize;
			}
		}
		
		return $postMaxSize;
	}
	
	/**
	 * Convert max file upload size to Byte
	 * 
	 * @param 	mixed $size
	 * @return 	int
	 */
	protected static function _parseSize($size) 
	{
		$unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
		$size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
		
		if ($unit) 
		{
			// Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
			return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
		}
		
		return round($size);
	}
}
