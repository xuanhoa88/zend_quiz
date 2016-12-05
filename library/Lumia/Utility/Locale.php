<?php

class Lumia_Utility_Locale 
{
	/**
	 * Singleton instance
	 *
	 * @var Lumia_Utility_Locale
	 */
	protected static $_instance;
	
	/**
	 * @var Lumia_Translator
	 */
	protected $_translator;
	
	/**
	 * Stores the translated strings for the full weekday names.
	 *
	 * @var array
	 */
	protected $_weekdays;

	/**
	 * Stores the translated strings for the abbreviated weekday names.
	 *
	 * @var array
	 */
	protected $_weekdaysAbbrev;

	/**
	 * Stores the translated strings for the full month names.
	 *
	 * @var array
	 */
	protected $_months;

	/**
	 * Stores the translated strings for the abbreviated month names.
	 *
	 * @var array
	 */
	protected $_monthsAbbrev;

	/**
	 * Stores the translated strings for 'am' and 'pm'.
	 *
	 * Also the capitalized versions.
	 *
	 * @var array
	 */
	protected $_meridiem;

	/**
	 * The text direction of the locale language.
	 *
	 * Default is left to right 'ltr'.
	 *
	 * @var string
	 */
	protected $_textDirection = 'ltr';

	/**
	 * @var array
	 */
	protected $_numberFormat;
	
	/**
	 * Sets up the translated strings and object properties.
	 *
	 * The method creates the translatable strings for various
	 * calendar elements. Which allows for specifying locale
	 * specific calendar names and text direction.
	 */
	public function __construct() {
		
		// Init translator
		$this->_translator = Lumia_Translator::get();
		
		// The Weekdays
		$this->_weekdays[0] = /* translators: weekday */ $this->_translator->translate('Locale:@Sunday');
		$this->_weekdays[1] = /* translators: weekday */ $this->_translator->translate('Locale:@Monday');
		$this->_weekdays[2] = /* translators: weekday */ $this->_translator->translate('Locale:@Tuesday');
		$this->_weekdays[3] = /* translators: weekday */ $this->_translator->translate('Locale:@Wednesday');
		$this->_weekdays[4] = /* translators: weekday */ $this->_translator->translate('Locale:@Thursday');
		$this->_weekdays[5] = /* translators: weekday */ $this->_translator->translate('Locale:@Friday');
		$this->_weekdays[6] = /* translators: weekday */ $this->_translator->translate('Locale:@Saturday');
	
		// Abbreviations for each day.
		$this->_weekdaysAbbrev[$this->_translator->translate('Locale:@Sunday')]    = /* translators: three-letter abbreviation of the weekday */ $this->_translator->translate('Locale:@Sun');
		$this->_weekdaysAbbrev[$this->_translator->translate('Locale:@Monday')]    = /* translators: three-letter abbreviation of the weekday */ $this->_translator->translate('Locale:@Mon');
		$this->_weekdaysAbbrev[$this->_translator->translate('Locale:@Tuesday')]   = /* translators: three-letter abbreviation of the weekday */ $this->_translator->translate('Locale:@Tue');
		$this->_weekdaysAbbrev[$this->_translator->translate('Locale:@Wednesday')] = /* translators: three-letter abbreviation of the weekday */ $this->_translator->translate('Locale:@Wed');
		$this->_weekdaysAbbrev[$this->_translator->translate('Locale:@Thursday')]  = /* translators: three-letter abbreviation of the weekday */ $this->_translator->translate('Locale:@Thu');
		$this->_weekdaysAbbrev[$this->_translator->translate('Locale:@Friday')]    = /* translators: three-letter abbreviation of the weekday */ $this->_translator->translate('Locale:@Fri');
		$this->_weekdaysAbbrev[$this->_translator->translate('Locale:@Saturday')]  = /* translators: three-letter abbreviation of the weekday */ $this->_translator->translate('Locale:@Sat');
	
		// The Months
		$this->_months['01'] = /* translators: month name */ $this->_translator->translate('Locale:@January');
		$this->_months['02'] = /* translators: month name */ $this->_translator->translate('Locale:@February');
		$this->_months['03'] = /* translators: month name */ $this->_translator->translate('Locale:@March');
		$this->_months['04'] = /* translators: month name */ $this->_translator->translate('Locale:@April');
		$this->_months['05'] = /* translators: month name */ $this->_translator->translate('Locale:@May');
		$this->_months['06'] = /* translators: month name */ $this->_translator->translate('Locale:@June');
		$this->_months['07'] = /* translators: month name */ $this->_translator->translate('Locale:@July');
		$this->_months['08'] = /* translators: month name */ $this->_translator->translate('Locale:@August');
		$this->_months['09'] = /* translators: month name */ $this->_translator->translate('Locale:@September');
		$this->_months['10'] = /* translators: month name */ $this->_translator->translate('Locale:@October');
		$this->_months['11'] = /* translators: month name */ $this->_translator->translate('Locale:@November');
		$this->_months['12'] = /* translators: month name */ $this->_translator->translate('Locale:@December');
	
		// Abbreviations for each month. Uses the same hack as above to get around the 'May' duplication.
		$this->_monthsAbbrev[$this->_translator->translate('Locale:@January')] = /* translators: three-letter abbreviation of the month */ $this->_translator->translate('Locale:@Jan');
		$this->_monthsAbbrev[$this->_translator->translate('Locale:@February')] = /* translators: three-letter abbreviation of the month */ $this->_translator->translate('Locale:@Feb');
		$this->_monthsAbbrev[$this->_translator->translate('Locale:@March')] = /* translators: three-letter abbreviation of the month */ $this->_translator->translate('Locale:@Mar');
		$this->_monthsAbbrev[$this->_translator->translate('Locale:@April')] = /* translators: three-letter abbreviation of the month */ $this->_translator->translate('Locale:@Apr');
		$this->_monthsAbbrev[$this->_translator->translate('Locale:@May')] = /* translators: three-letter abbreviation of the month */ $this->_translator->translate('Locale:@May');
		$this->_monthsAbbrev[$this->_translator->translate('Locale:@June')] = /* translators: three-letter abbreviation of the month */ $this->_translator->translate('Locale:@Jun');
		$this->_monthsAbbrev[$this->_translator->translate('Locale:@July')] = /* translators: three-letter abbreviation of the month */ $this->_translator->translate('Locale:@Jul');
		$this->_monthsAbbrev[$this->_translator->translate('Locale:@August')] = /* translators: three-letter abbreviation of the month */ $this->_translator->translate('Locale:@Aug');
		$this->_monthsAbbrev[$this->_translator->translate('Locale:@September')] = /* translators: three-letter abbreviation of the month */ $this->_translator->translate('Locale:@Sep');
		$this->_monthsAbbrev[$this->_translator->translate('Locale:@October')] = /* translators: three-letter abbreviation of the month */ $this->_translator->translate('Locale:@Oct');
		$this->_monthsAbbrev[$this->_translator->translate('Locale:@November')] = /* translators: three-letter abbreviation of the month */ $this->_translator->translate('Locale:@Nov');
		$this->_monthsAbbrev[$this->_translator->translate('Locale:@December')] = /* translators: three-letter abbreviation of the month */ $this->_translator->translate('Locale:@Dec');
	
		// The Meridiems
		$this->_meridiem['Locale:@am'] = $this->_translator->translate('Locale:@am');
		$this->_meridiem['Locale:@pm'] = $this->_translator->translate('Locale:@pm');
		$this->_meridiem['Locale:@AM'] = $this->_translator->translate('Locale:@AM');
		$this->_meridiem['Locale:@PM'] = $this->_translator->translate('Locale:@PM');
	
		// Numbers formatting
		// See http://php.net/number_format
		$this->_numberFormat['thousands_sep'] = $this->_translator->translate('Locale:@The thousands separator');
		$this->_numberFormat['decimals'] = $this->_translator->translate('Locale:@The number of decimal points');
		$this->_numberFormat['decimal_point'] = $this->_translator->translate('Locale:@The separator for the decimal point');
	
		// Set text direction.
		if ( isset( $GLOBALS['text_direction'] ) ) {
			$this->_textDirection = $GLOBALS['text_direction'];
		}
	
		if ( 'rtl' === $this->_textDirection ) {
			$this->_textDirection = 'ltr';
		}
	}
	
	/**
	 * Retrieve a singleton instance of the class
	 *
	 * @return Lumia_Utility_Locale
	 */
	public static function getInstance()
	{
		if (null === self::$_instance) 
		{
			self::$_instance = new self();
		}
		
		return self::$_instance;
	}
	
	/**
	 * Get weekdays
	 * 
	 * @param	bool $useShortLabel
	 * @return	array
	 */
	public function getWeekDays($useShortLabel = false)
	{
		if ($useShortLabel)
		{
			return $this->_weekdaysAbbrev;
		}
		
		return $this->_weekdays;
	}
	
	/**
	 * Get months
	 * 
	 * @param	bool $useShortLabel
	 * @return	array
	 */
	public function getMonths($useShortLabel = false)
	{
		if ($useShortLabel)
		{
			return $this->_monthsAbbrev;
		}
		
		return $this->_months;
	}

	/**
	 * Retrieve translated version of meridiem string.
	 *
	 * The $meridiem parameter is expected to not be translated.
	 *
	 * @param string $meridiem Either 'am', 'pm', 'AM', or 'PM'. Not translated version.
	 * @return string Translated version
	 */
	public function getMeridiem($meridiem) 
	{
		return $this->_meridiem[$meridiem];
	}
}