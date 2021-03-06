<?php
/**
 * This class reused from Security Class of Codeigniter
 *
 */

/**
 * Xss Clean
 *
 * @package		Lumia
 * @subpackage	Filter
 */
class Lumia_Filter_XSSClean implements Zend_Filter_Interface
{
	/**
	 * Character set
	 *
	 * Will be overridden by the constructor.
	 *
	 * @var	string
	 */
	public $_charset = 'UTF-8';

	/**
	 * List of never allowed strings
	 *
	 * @var	array
	 */
	protected $_strDisabled =	array(
		'document.cookie'	=> '[removed]',
		'document.write'	=> '[removed]',
		'.parentNode'		=> '[removed]',
		'.innerHTML'		=> '[removed]',
		'-moz-binding'		=> '[removed]',
		'<!--'				=> '&lt;!--',
		'-->'				=> '--&gt;',
		'<![CDATA['			=> '&lt;![CDATA[',
		'<comment>'			=> '&lt;comment&gt;'
	);

	/**
	 * List of never allowed regex replacements
	 *
	 * @var	array
	 */
	protected $_regexDisabled = array(
		'javascript\s*:',
		'(document|(document\.)?window)\.(location|on\w*)',
		'expression\s*(\(|&\#40;)', // CSS and IE
		'vbscript\s*:', // IE, surprise!
		'wscript\s*:', // IE
		'jscript\s*:', // IE
		'vbs\s*:', // IE
		'Redirect\s+30\d',
		"([\"'])?data\s*:[^\\1]*?base64[^\\1]*?,[^\\1]*?\\1?"
	);

	/**
	 * Sets filter options
	 *
	 * @param  integer|array $quoteStyle
	 * @param  string  $charSet
	 * @return void
	 */
	public function __construct($options = array())
	{
		if ($options instanceof Zend_Config)
		{
			$options = $options->toArray();
		} else if (!is_array($options))
		{
			$options = func_get_args();
			if (!empty($options)) 
			{
				$this->setCharset(array_shift($options));
			}
			
			if (isset($options['regexDisabled']))
			{
				$this->setRegexDisabled($options['regexDisabled']);
			}
			
			if (isset($options['strDisabled']))
			{
				$this->setStringDisabled($options['strDisabled']);
			}
		}
	}

	/**
	 * Set charset
	 *
	 * @param  string $value
	 * @return Lumia_Filter_XSSClean
	 */
	public function setCharset($value)
	{
		$this->_charset = (string) $value;

		return $this;
	}

	/**
	 * Set string never allowed
	 *
	 * @param  array $strDisabled
	 * @return Lumia_Filter_XSSClean
	 */
	public function setStringDisabled(array $strDisabled)
	{
		$this->_strDisabled = $strDisabled;

		return $this;
	}

	/**
	 * Set regex never allowed
	 *
	 * @param  array $strDisabled
	 * @return Lumia_Filter_XSSClean
	 */
	public function setRegexDisabled(array $regexDisabled)
	{
		$this->_regexDisabled = $regexDisabled;

		return $this;
	}

	/**
	 * Remove Invisible Characters
	 *
	 * This prevents sandwiching null characters
	 * between ascii characters, like Java\0script.
	 *
	 * @param	string
	 * @param	bool
	 * @return	string
	 */
	protected function _removeInvisibleCharacters($str, $url_encoded = TRUE)
	{
		$non_displayables = array();

		// every control character except newline (dec 10),
		// carriage return (dec 13) and horizontal tab (dec 09)
		if ($url_encoded)
		{
			$non_displayables[] = '/%0[0-8bcef]/';	// url encoded 00-08, 11, 12, 14, 15
			$non_displayables[] = '/%1[0-9a-f]/';	// url encoded 16-31
		}

		$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';	// 00-08, 11, 12, 14-31, 127

		do
		{
			$str = preg_replace($non_displayables, '', $str, -1, $count);
		} while ($count);

		return $str;
	}

	/**
	 * Attribute Conversion
	 *
	 * @param	array	$match
	 * @return	string
	 */
	protected function _convertAttribute(array $match)
	{
		return str_replace(array('>', '<', '\\'), array('&gt;', '&lt;', '\\\\'), $match[0]);
	}

	/**
	 * HTML Entities Decode
	 *
	 * A replacement for html_entity_decode()
	 *
	 * The reason we are not using html_entity_decode() by itself is because
	 * while it is not technically correct to leave out the semicolon
	 * at the end of an entity most browsers will still interpret the entity
	 * correctly. html_entity_decode() does not convert entities without
	 * semicolons, so we are left with our own little solution here. Bummer.
	 *
	 * @link	http://php.net/html-entity-decode
	 *
	 * @param	string	$str		Input
	 * @param	string	$charset	Character set
	 * @return	string
	 */
	protected function _entityDecode($str, $charset = NULL)
	{
		if (strpos($str, '&') === FALSE)
		{
			return $str;
		}

		static $_entities;

		!is_string($charset) || $charset = $this->_charset;
		$flag = Lumia_Utility_Common::isPhp('5.4') ? ENT_COMPAT | ENT_HTML5 : ENT_COMPAT;

		do
		{
			$str_compare = $str;

			// Decode standard entities, avoiding false positives
			if (preg_match_all('/&[a-z]{2,}(?![a-z;])/i', $str, $matches))
			{
				if ( ! isset($_entities))
				{
					$_entities = array_map(
					'strtolower',
					Lumia_Utility_Common::isPhp('5.3.4')
					? get_html_translation_table(HTML_ENTITIES, $flag, $charset)
					: get_html_translation_table(HTML_ENTITIES, $flag)
					);

					// If we're not on PHP 5.4+, add the possibly dangerous HTML 5
					// entities to the array manually
					if ($flag === ENT_COMPAT)
					{
						$_entities[':'] = '&colon;';
						$_entities['('] = '&lpar;';
						$_entities[')'] = '&rpar;';
						$_entities["\n"] = '&newline;';
						$_entities["\t"] = '&tab;';
					}
				}

				$replace = array();
				$matches = array_unique(array_map('strtolower', $matches[0]));
				foreach ($matches as &$match)
				{
					if (($char = array_search($match.';', $_entities, TRUE)) !== FALSE)
					{
						$replace[$match] = $char;
					}
				}

				$str = str_ireplace(array_keys($replace), array_values($replace), $str);
			}

			// Decode numeric & UTF16 two byte entities
			$str = html_entity_decode(preg_replace('/(&#(?:x0*[0-9a-f]{2,5}(?![0-9a-f;])|(?:0*\d{2,4}(?![0-9;]))))/iS', '$1;', $str), $flag, $charset);
		} while ($str_compare !== $str);

		return $str;
	}
	
	/**
	 * Generates the XSS hash if needed and returns it.
	 *
	 * @return	string	XSS hash
	 */
	protected function _hash()
	{
		static $xssHash;
		if ($xssHash === NULL)
		{
			$rand = Lumia_Utility_Common::randomBytes(16);
			$xssHash = ($rand === FALSE) ? md5(uniqid(mt_rand(), TRUE)) : bin2hex($rand);
		}

		return $xssHash;
	}

	/**
	 * HTML Entity Decode Callback
	 *
	 * @param	array	$match
	 * @return	string
	 */
	protected function _decodeEntity($match)
	{
		// Protect GET variables in URLs
		// 901119URL5918AMP18930PROTECT8198
		$match = preg_replace('|\&([a-z\_0-9\-]+)\=([a-z\_0-9\-/]+)|i', $this->_hash().'\\1=\\2', $match[0]);

		// Decode, then un-protect URL GET vars
		return str_replace($this->_hash(), '&',	$this->_entityDecode($match, $this->_charset));
	}

	/**
	 * Do Never Allowed
	 *
	 * @param 	string
	 * @return 	string
	 */
	protected function _doNeverAllowed($str)
	{
		$str = str_replace(array_keys($this->_strDisabled), $this->_strDisabled, $str);
		foreach ($this->_regexDisabled as $regex)
		{
			$str = preg_replace('#' . $regex . '#is', '[removed]', $str);
		}

		return $str;
	}

	/**
	 * Compact Exploded Words
	 *
	 * Callback method for _xssClean() to remove whitespace from
	 * things like 'j a v a s c r i p t'.
	 *
	 * @param	array	$matches
	 * @return	string
	 */
	protected function _compactExplodedWords(array $matches)
	{
		return preg_replace('/\s+/s', '', $matches[1]) . $matches[2];
	}
	
	/**
	 * Filters tag attributes for consistency and safety.
	 *
	 * @param	string	$str
	 * @return	string
	 */
	protected function _filterAttributes($str)
	{
		$out = '';
		if (preg_match_all('#\s*[a-z\-]+\s*=\s*(\042|\047)([^\\1]*?)\\1#is', $str, $matches))
		{
			foreach ($matches[0] as $match)
			{
				$out .= preg_replace('#/\*.*?\*/#s', '', $match);
			}
		}

		return $out;
	}
	
	/**
	 * JS Link Removal
	 *
	 * Callback method for _xssClean() to sanitize links.
	 *
	 * This limits the PCRE backtracks, making it more performance friendly
	 * and prevents PREG_BACKTRACK_LIMIT_ERROR from being triggered in
	 * PHP 5.2+ on link-heavy strings.
	 *
	 * @param	array	$match
	 * @return	string
	 */
	protected function _jsLinkRemoval($match)
	{
		return str_replace($match[1],
			preg_replace('#href=.*?(?:(?:alert|prompt|confirm)(?:\(|&\#40;)|javascript:|livescript:|mocha:|charset=|window\.|document\.|\.cookie|<script|<xss|data\s*:)#si',
					'',
					$this->_filterAttributes(str_replace(array('<', '>'), '', $match[1]))
			),
			$match[0]);
	}
	
	/**
	 * JS Image Removal
	 *
	 * Callback method for _xssClean() to sanitize image tags.
	 *
	 * This limits the PCRE backtracks, making it more performance friendly
	 * and prevents PREG_BACKTRACK_LIMIT_ERROR from being triggered in
	 * PHP 5.2+ on image tag heavy strings.
	 *
	 * @param	array	$match
	 * @return	string
	 */
	protected function _jsImgRemoval($match)
	{
		return str_replace($match[1],
			preg_replace('#src=.*?(?:(?:alert|prompt|confirm)(?:\(|&\#40;)|javascript:|livescript:|mocha:|charset=|window\.|document\.|\.cookie|<script|<xss|base64\s*,)#si',
					'',
					$this->_filterAttributes(str_replace(array('<', '>'), '', $match[1]))
			),
			$match[0]);
	}
	
	/**
	 * Remove Evil HTML Attributes (like event handlers and style)
	 *
	 * It removes the evil attribute and either:
	 *
	 *  - Everything up until a space. For example, everything between the pipes:
	 *
	 *	<code>
	 *		<a |style=document.write('hello');alert('world');| class=link>
	 *	</code>
	 *
	 *  - Everything inside the quotes. For example, everything between the pipes:
	 *
	 *	<code>
	 *		<a |style="document.write('hello'); alert('world');"| class="link">
	 *	</code>
	 *
	 * @param	string	$str		The string to check
	 * @param	bool	$isImage	Whether the input is an image
	 * @return	string	The string with the evil attributes removed
	 */
	protected function _removeEvilAttributes($str, $isImage)
	{
		$evil_attributes = array('on\w*', 'style', 'xmlns', 'formaction', 'form', 'xlink:href', 'FSCommand', 'seekSegmentTime');
		if ($isImage === TRUE)
		{
			/*
			 * Adobe Photoshop puts XML metadata into JFIF images,
			 * including namespacing, so we have to allow this for images.
			 */
			unset($evil_attributes[array_search('xmlns', $evil_attributes)]);
		}

		do 
		{
			$count = $temp_count = 0;

			// replace occurrences of illegal attribute strings with quotes (042 and 047 are octal quotes)
			$str = preg_replace('/(<[^>]+)(?<!\w)('.implode('|', $evil_attributes).')\s*=\s*(\042|\047)([^\\2]*?)(\\2)/is', '$1[removed]', $str, -1, $temp_count);
			$count += $temp_count;

			// find occurrences of illegal attribute strings without quotes
			$str = preg_replace('/(<[^>]+)(?<!\w)('.implode('|', $evil_attributes).')\s*=\s*([^\s>]*)/is', '$1[removed]', $str, -1, $temp_count);
			$count += $temp_count;
		} while ($count);

		return $str;
	}
	
	/**
	 * Sanitize Naughty HTML
	 *
	 * Callback method for _xssClean() to remove naughty HTML elements.
	 *
	 * @param	array	$matches
	 * @return	string
	 */
	protected function _sanitizeNaughtyHtml(array $matches)
	{
		return '&lt;' . $matches[1] . $matches[2] . $matches[3] // encode opening brace
			// encode captured opening or closing brace to prevent recursive vectors:
			. str_replace(array('>', '<'), array('&gt;', '&lt;'), $matches[4]);
	}

	/**
	 * XSS Clean
	 *
	 * Sanitizes data so that Cross Site Scripting Hacks can be
	 * prevented.  This method does a fair amount of work but
	 * it is extremely thorough, designed to prevent even the
	 * most obscure XSS attempts.  Nothing is ever 100% foolproof,
	 * of course, but I haven't been able to get anything passed
	 * the filter.
	 *
	 * Note: Should only be used to deal with data upon submission.
	 *	 It's not something that should be used for general
	 *	 runtime processing.
	 *
	 * @link	http://channel.bitflux.ch/wiki/XSS_Prevention
	 * 		Based in part on some code and ideas from Bitflux.
	 *
	 * @link	http://ha.ckers.org/xss.html
	 * 		To help develop this script I used this great list of
	 *		vulnerabilities along with a few other hacks I've
	 *		harvested from examining vulnerabilities in other programs.
	 *
	 * @param	string|string[]	$str		Input data
	 * @param 	bool		$isImage	Whether the input is an image
	 * @return	string
	 */
	protected function _xssClean($str, $isImage = FALSE)
	{
		// Is the string an array?
		if (is_array($str))
		{
			while (list($key) = each($str))
			{
				$str[$key] = $this->_xssClean($str[$key]);
			}

			return $str;
		}

		// Remove Invisible Characters
		$str = $this->_removeInvisibleCharacters($str);

		/*
		 * URL Decode
		 *
		 * Just in case stuff like this is submitted:
		 *
		 * <a href="http://%77%77%77%2E%67%6F%6F%67%6C%65%2E%63%6F%6D">Google</a>
		 *
		 * Note: Use rawurldecode() so it does not remove plus signs
		 */
		do
		{
			$str = rawurldecode($str);
		} while (preg_match('/%[0-9a-f]{2,}/i', $str));

		/*
		 * Convert character entities to ASCII
		 *
		 * This permits our tests below to work reliably.
		 * We only convert entities that are within tags since
		 * these are the ones that will pose security problems.
		 */
		$str = preg_replace_callback("/[^a-z0-9>]+[a-z0-9]+=([\'\"]).*?\\1/si", array($this, '_convertAttribute'), $str);
		$str = preg_replace_callback('/<\w+.*/si', array($this, '_decodeEntity'), $str);

		// Remove Invisible Characters Again!
		$str = $this->_removeInvisibleCharacters($str);

		/*
		 * Convert all tabs to spaces
		 *
		 * This prevents strings like this: ja	vascript
		 * NOTE: we deal with spaces between characters later.
		 * NOTE: preg_replace was found to be amazingly slow here on
		 * large blocks of data, so we use str_replace.
		 */
		$str = str_replace("\t", ' ', $str);

		// Capture converted string for later comparison
		$newString = $str;

		// Remove Strings that are never allowed
		$str = $this->_doNeverAllowed($str);

		/*
		 * Makes PHP tags safe
		 *
		 * Note: XML tags are inadvertently replaced too:
		 *
		 * <?xml
		 *
		 * But it doesn't seem to pose a problem.
		 */
		if ($isImage === TRUE)
		{
			// Images have a tendency to have the PHP short opening and
			// closing tags every so often so we skip those and only
			// do the long opening tags.
			$str = preg_replace('/<\?(php)/i', '&lt;?\\1', $str);
		} else
		{
			$str = str_replace(array('<?', '?' . '>'), array('&lt;?', '?&gt;'), $str);
		}

		/*
		 * Compact any exploded words
		 *
		 * This corrects words like:  j a v a s c r i p t
		 * These words are compacted back to their correct state.
		 */
		$words = array(
			'javascript', 'expression', 'vbscript', 'jscript', 'wscript',
			'vbs', 'script', 'base64', 'applet', 'alert', 'document',
			'write', 'cookie', 'window', 'confirm', 'prompt'
		);

		foreach ($words as $word)
		{
			$word = implode('\s*', str_split($word)) . '\s*';

			// We only want to do this when it is followed by a non-word character
			// That way valid stuff like "dealer to" does not become "dealerto"
			$str = preg_replace_callback('#(' . substr($word, 0, -3) . ')(\W)#is', array($this, '_compactExplodedWords'), $str);
		}

		/*
		 * Remove disallowed Javascript in links or img tags
		 * We used to do some version comparisons and use of stripos(),
		 * but it is dog slow compared to these simplified non-capturing
		 * preg_match(), especially if the pattern exists in the string
		 *
		 * Note: It was reported that not only space characters, but all in
		 * the following pattern can be parsed as separators between a tag name
		 * and its attributes: [\d\s"\'`;,\/\=\(\x00\x0B\x09\x0C]
		 * ... however, remove_invisible_characters() above already strips the
		 * hex-encoded ones, so we'll skip them below.
		 */
		do
		{
			$original = $str;

			if (preg_match('/<a/i', $str))
			{
				$str = preg_replace_callback('#<a[^a-z0-9>]+([^>]*?)(?:>|$)#si', array($this, '_jsLinkRemoval'), $str);
			}

			if (preg_match('/<img/i', $str))
			{
				$str = preg_replace_callback('#<img[^a-z0-9]+([^>]*?)(?:\s?/?>|$)#si', array($this, '_jsImgRemoval'), $str);
			}

			if (preg_match('/script|xss/i', $str))
			{
				$str = preg_replace('#</*(?:script|xss).*?>#si', '[removed]', $str);
			}
		} while ($original !== $str);

		unset($original);

		// Remove evil attributes such as style, onclick and xmlns
		$str = $this->_removeEvilAttributes($str, $isImage);

		/*
		 * Sanitize naughty HTML elements
		 *
		 * If a tag containing any of the words in the list
		 * below is found, the tag gets converted to entities.
		 *
		 * So this: <blink>
		 * Becomes: &lt;blink&gt;
		 */
		$naughty = 'alert|prompt|confirm|applet|audio|basefont|base|behavior|bgsound|blink|body|embed|expression|form|frameset|frame|head|html|ilayer|iframe|input|button|select|isindex|layer|link|meta|keygen|object|plaintext|style|script|textarea|title|math|video|svg|xml|xss';
		$str = preg_replace_callback('#<(/*\s*)(' . $naughty . ')([^><]*)([><]*)#is', array($this, '_sanitizeNaughtyHtml'), $str);

		/*
		 * Sanitize naughty scripting elements
		 *
		 * Similar to above, only instead of looking for
		 * tags it looks for PHP and JavaScript commands
		 * that are disallowed. Rather than removing the
		 * code, it simply converts the parenthesis to entities
		 * rendering the code un-executable.
		 *
		 * For example:	eval('some code')
		 * Becomes:	eval&#40;'some code'&#41;
		 */
		$str = preg_replace('#(alert|prompt|confirm|cmd|passthru|eval|exec|expression|system|fopen|fsockopen|file|file_get_contents|readfile|unlink)(\s*)\((.*?)\)#si', '\\1\\2&#40;\\3&#41;', $str);

		// Final clean up
		// This adds a bit of extra precaution in case
		// something got through the above filters
		$str = $this->_doNeverAllowed($str);

		/*
		 * Images are Handled in a Special Way
		 * - Essentially, we want to know that after all of the character
		 * conversion is done whether any unwanted, likely XSS, code was found.
		 * If not, we return TRUE, as the image is clean.
		 * However, if the string post-conversion does not matched the
		 * string post-removal of XSS, then it fails, as there was unwanted XSS
		 * code found and removed/changed during processing.
		 */
		if ($isImage === TRUE)
		{
			return ($str === $newString);
		}

		return $str;
	}

	/**
	 * Defined by Zend_Filter_Interface
	 *
	 * Returns the string $value, converting characters to their corresponding HTML entity
	 * equivalents where they exist
	 *
	 * @param  string $value
	 * @return string
	 */
	public function filter($value)
	{
		return $this->_xssClean($value);
	}
}
