<?php
set_time_limit(3600);
function hyphenize($string) {
	return preg_replace ( array (
			'#[\\s-]+#',
			'#[^A-Za-z0-9\. -]+#' 
	), array (
			'' 
	), urldecode ( $string ) );
}
function pre($str) {
	echo '<pre>';
	var_dump ( $str );
	echo '</pre>';
}

$string = file_get_contents ( __DIR__ . '/data.txt' );
$string = hyphenize ( $string );
$string = strtolower ( $string );
$length = strlen ( $string );

$pos = array ();
$flag = '';
for($i = 0; $i <= $length; $i ++) {
	$symmetric = substr ( $string, 0, $i );
	if ($symmetric == strrev ( $symmetric )) {
		if (strlen ( $symmetric ) > strlen ( $flag )) {
			$flag = $symmetric;
			$pos = array (
					'from' => 0,
					'to' => $i 
			);
		}
	}
	
	$subString = substr ( $string, $i, $length );
	$subLength = strlen ( $subString );
	for($j = 0; $j <= $subLength; $j ++) {
		$subSymmetric = substr ( $subString, 0, $j );
		if ($subSymmetric == strrev ( $subSymmetric )) {
			if (strlen ( $subSymmetric ) > strlen ( $flag )) {
				$flag = $subSymmetric;
				$pos = array (
						'from' => $i,
						'to' => $i + $j - 1 
				);
			}
		}
	}
}
pre ( $length );
pre ( $flag );
pre ( $pos );
pre ( substr ( $string, $pos ['from'], $pos ['to'] ) );
pre ( $string [$pos ['from']] );
pre ( $string [$pos ['to']] );