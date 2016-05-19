<?php
header('Content-Type: text/html; charset=utf-8');

// ************ SETTINGS ************ //
date_default_timezone_set('Europe/London'); // Set Timezone to UK
define('SITE_STATUS', 'LOCAL'); // SITE STATUS (LIVE, DEV or LOCAL)
define('SITE_NAME', "Temp");
define('SITE_EMAIL', "info@temp.com");
define('ERROR_EMAIL', "william@outputdigital.com"); // Used for error reporting
define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/'); // Site Document Root
define('MAX_FILE_SIZE', 8388608); // Maximum Upload Size 8MB
define('CURRENT_PAGE', basename($_SERVER['SCRIPT_NAME'])); // Used for nav active states
define('CURRENT_URL', $_SERVER['REQUEST_URI']); // Used for nav active states
define("DAYS", "Mon,Tues,Wed,Thurs,Fri,Sat,Sun");
define("MONTHS", "Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec");
define('UPLOAD_DIR', '/assets/uploads');


function __autoload($class){
	$parts = explode('_', $class);
	$path = implode(DIRECTORY_SEPARATOR,$parts);
	require_once $path . '.php';
}

/**
 * Check if request has come from HTTP or HTTPS
 * Get the trailing name component of path
 * Set SITE_URL
 */
$baseURL = (isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'];
$baseURL .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
define('SITE_URL', $baseURL);

/** Database Connection (LOCAL, DEV or LIVE) */
define('DB_TYPE', 'mysql');
if(SITE_STATUS == 'LIVE'){
	define('DB_USER', 'luxuryle_admin');
 	define('DB_PASSWORD', 'bXAjJpV5P8CbUu8n');
 	define('DB_HOST', 'localhost');
 	define('DB_NAME', 'luxuryle_backoffice_live');

}elseif(SITE_STATUS == 'DEV'){
	define('DB_USER', 'root');
 	define('DB_PASSWORD', '');
 	define('DB_HOST', 'localhost');
 	define('DB_NAME', 'luxurylet');

}else{
	define('DB_USER', 'root');
 	define('DB_PASSWORD', '');
 	define('DB_HOST', 'localhost');
 	define('DB_NAME', 'skelly');
}

/** Format URL */
function FormatUrl($title){
	$url = preg_replace("/[^A-Za-z0-9 ]/", "", $title);
	$url = trim($url);
	$url = str_replace('  ', ' ', $url);
	$url = str_replace(' ', '-', $url);
	$url = strtolower($url);
	return $url;
}

/** Format Date to MySQL */
function FormatDateToMySQL($month, $day, $year) {
	$month = trim($month);
	$day = trim($day);
	$year = trim($year);
	$result[0] = false;
	if (empty($month) || empty($day) || empty($year)) {
		$result[1] = 'Please fill in all fields';
	} elseif (!is_numeric($month) || !is_numeric($day) || !is_numeric($year)) {
		$result[1] = 'Please use numbers only';
	} elseif (($month < 1 || $month > 12) || ($day < 1 || $day > 31) || ($year < 1000 || $year > 9999)) {
		$result[1] = 'Please use numbers within the correct range';
	} elseif (!checkdate($month,$day,$year)) {
		$result[1] = 'You have used an invalid date';
	} else {
		$result[0] = true;
		$result[1] = "$year-$month-$day";
	}
	return $result;
}

/** Unique items in multi dimensional array by key */
function ArrayUniqueByKey ($array, $key) {
    $tmp = array();
    $result = array();
    foreach ($array as $value) {
        if (!in_array($value[$key], $tmp)) {
            array_push($tmp, $value[$key]);
            array_push($result, $value);
        }
    }
    return $array = $result;
}

/** in_array() case insensitive */
function InArrayCaseInsensitive($needle, $haystack){
	return in_array( strtolower($needle), array_map('strtolower', $haystack) );
}

// ************ ERROR MANAGEMENT ************ //
function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {
	$message = "<p>An error occurred in script '$e_file' on line $e_line: $e_message\n<br />";
	$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n<br />";
	$message .= "<pre>" . print_r ($e_vars, 1) . "</pre>\n</p>";

	if (SITE_STATUS != 'LIVE') { // Development (print the error).
		echo '<div class="error">' . $message . '</div><br />';
	} else {
		// Don't show the error by send email
		//mail(ERROR_EMAIL, 'Site Error!', $message, 'From: info@luxurylet.com');

		// Only print an error message if the error isn't a notice:
		if ($e_number != E_NOTICE) {
			echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div><br />';
		}
	}
}
/** Use my error handler */
set_error_handler ('my_error_handler');

/** Remove Backslashes if magic quotes exists */
if (get_magic_quotes_gpc()) {
  $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
  while (list($key, $val) = each($process)) {
	foreach ($val as $k => $v) {
	  unset($process[$key][$k]);
	  if (is_array($v)) {
		$process[$key][stripslashes($k)] = $v;
		$process[] = &$process[$key][stripslashes($k)];
	  } else {
		$process[$key][stripslashes($k)] = stripslashes($v);
	  }
	}
  }
  unset($process);
}
?>