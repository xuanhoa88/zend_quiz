<?php
class Lumia_Utility_Timezone {
	/**
	 * Singleton instance
	 *
	 * @var Lumia_Utility_TimeZone
	 */
	protected static $_instance;
	
	/**
	 * Returns an instance of Lumia_Utility_TimeZone
	 *
	 * Singleton pattern implementation
	 *
	 * @return Lumia_Utility_TimeZone Provides a fluent interface
	 */
	public static function getInstance() {
		if (null === self::$_instance) {
			self::$_instance = new self ();
		}
		
		return self::$_instance;
	}
	
	/**
	 * Gives a nicely-formatted list of timezone strings.
	 *
	 * @return array
	 */
	public function fetchAll() {
		$translator = Lumia_Translator::get ();
		
		$continents = array (
				'Africa',
				'America',
				'Antarctica',
				'Arctic',
				'Asia',
				'Atlantic',
				'Australia',
				'Europe',
				'Indian',
				'Pacific' 
		);
		
		$zonen = array ();
		foreach ( timezone_identifiers_list () as $zone ) {
			$zone = explode ( '/', $zone );
			
			if (! in_array ( $zone [0], $continents )) {
				continue;
			}
			
			// This determines what gets set and translated - we don't translate Etc/* strings here, they are done later
			$exists = array (
					0 => (isset ( $zone [0] ) && $zone [0]),
					1 => (isset ( $zone [1] ) && $zone [1]),
					2 => (isset ( $zone [2] ) && $zone [2]) 
			);
			$exists [3] = ($exists [0] && 'Etc' !== $zone [0]);
			$exists [4] = ($exists [1] && $exists [3]);
			$exists [5] = ($exists [2] && $exists [3]);
			
			$continent = ($exists [0] ? $zone [0] : '');
			$tContinent = ($exists [3] ? $translator->translate ( str_replace ( '_', ' ', $zone [0] ) ) : '');
			$city = ($exists [1] ? $zone [1] : '');
			$tCity = ($exists [4] ? $translator->translate ( str_replace ( '_', ' ', $zone [1] ) ) : '');
			$subCity = ($exists [2] ? $zone [2] : '');
			$tSubcity = ($exists [5] ? $translator->translate ( str_replace ( '_', ' ', $zone [2] ) ) : '');
			
			if (! array_key_exists ( $continent, $zonen )) {
				$zonen [$continent] = array ();
			}
			
			// Build value in an array to join later
			$value = array ( $continent );
			
			if (empty ( $city )) {
				// It's at the continent level (generally won't happen)
				$display = $tContinent;
			} else {
				// It's inside a continent group
				
				// Add the city to the value
				$value [] = $city;
				
				$display = $tCity;
				if (! empty ( $subCity )) {
					// Add the subcity to the value
					$value [] = $subCity;
					$display .= ' - ' . $tSubcity;
				}
			}
			
			// Build the value
			$value = join ( '/', $value );
			
			$zonen [$continent][$value] = $display;
		}
		
		// Do UTC
		$utcLabel = $translator->translate ('UTC');
		$zonen [$utcLabel]['UTC'] = $utcLabel;
		
		// Do manual UTC offsets
		$manualOffsetsLabel = $translator->translate ('Manual Offsets');
		$zonen[$manualOffsetsLabel] = array();
		$offset_range = array (-12, -11.5, -11, -10.5, -10, -9.5, -9, -8.5, -8, -7.5, -7, -6.5, -6, -5.5, -5, -4.5, -4, -3.5, -3, -2.5, -2, -1.5, -1, -0.5,
		0, 0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5, 5.5, 5.75, 6, 6.5, 7, 7.5, 8, 8.5, 8.75, 9, 9.5, 10, 10.5, 11, 11.5, 12, 12.75, 13, 13.75, 14);
		foreach ( $offset_range as $offset ) {
			if (0 <= $offset)
				$offsetName = '+' . $offset;
			else
				$offsetName = ( string ) $offset;
			
			$offsetValue = $offsetName;
			$offsetName = str_replace ( array ( '.25', '.5', '.75' ), array ( ':15', ':30', ':45' ), $offsetName );
			$offsetName = 'UTC' . $offsetName;
			$offsetValue = 'UTC' . $offsetValue;
			$zonen [$manualOffsetsLabel][$offsetValue] = $offsetName;
		}
		
		return $zonen;
	}
	
	/**
	 * Get current timezone
	 *
	 * @return string
	 */
	public function getCurrentTimezone() 
	{
		$configuration = Application_Model_Configuration::getInstance();
		$currentTimezone = (string) $configuration->get('date.timezone');
		
		return ($currentTimezone === '') ? ini_get('date.timezone') : $currentTimezone;
	}
}
