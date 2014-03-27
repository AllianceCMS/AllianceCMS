<?php
/**
 * Setup base url
 */

if (isset($_SERVER['HTTPS'])) {
    $baseUrl = 'https://' . $_SERVER['SERVER_NAME'];
} else {
    $baseUrl = 'http://' . $_SERVER['SERVER_NAME'];
}

/**
 * Assign base directory path
 */

//$baseDir = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR;

/*
echo '<br />$baseDir_system is: ' . $baseDir . '<br />';
//exit;
//*/

/**
 * Assign file path information
 */

/*
echo '<br />$_SERVER["PHP_SELF"] is: ' . $_SERVER['PHP_SELF'] . '<br />';
exit;
//*/

/*
$currentFilePath = substr($_SERVER['PHP_SELF'], 1);
$filePathArray = explode('/', $currentFilePath);
$currentFile = $filePathArray[count($filePathArray) - 1];
array_pop($filePathArray);
$currentDir = '';
foreach ($filePathArray as $key => $val) {
    $currentDir .= $val . '/';
}
$thisPath = $currentDir . $currentFile;
//*/

/**
 * Extract query string
 */

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//*
echo '<br /><pre>$_SERVER["REQUEST_URI"]: ';
echo var_dump($_SERVER['REQUEST_URI']);
echo '</pre><br />';
//exit;
//*/

//*
echo '<br /><pre>$path: ';
echo var_dump($path);
echo '</pre><br />';
//exit;
//*/

$pathArray = explode('/', $path);
array_shift($pathArray);
$pathVenue = $pathArray[0];
array_shift($pathArray);

$queryString = '';

foreach ($pathArray as $val) {
    $queryString .= '/' . $val;
}

/**
 * Setup $subDomainFolder variable for PUBLIC_HTML definition
 *     $subDomainFolder will be defined in '/public_html/index.php' if site is installed on a subdomain
 */

if (!isset($subDomainFolder)) {
    $subDomainFolder = '';
} else {
    $subDomainFolder = $subDomainFolder . DIRECTORY_SEPARATOR;
}

/**
 * File system constants
 */

//define('THIS_FILE', $currentFile);
//define('THIS_DIR', $currentDir);
define('BASE_DIR', $baseDir);

/**
 * URL system constants
 */

define('BASE_URL', $baseUrl);
define('THIS_QUERY_STRING', $queryString); // Used in nav.tpl.php

/**
 * AllianceCMS folder locations
 */

define('AXIS', BASE_DIR . '/axis');
define('ZONES', BASE_DIR . '/zones');
define('PUBLIC_HTML', BASE_DIR . '/public_html' . DIRECTORY_SEPARATOR . $subDomainFolder);

/**
 * System folder locations
 */

define('CONFIGS', AXIS . '/configs');
define('INCLUDES', AXIS . '/includes');
define('TESTS', AXIS . '/tests');

/**
 * Vendor locations
 */

define('VENDOR', $vendorDir);

/**
 * Axis module/theme folder locations
 */

define('MODULES_AXIS', AXIS . '/modules');

/**
 * Resource folder locations
 */

define('RESOURCE_PATH', PUBLIC_HTML . '/resources');
define('RESOURCE_URL', BASE_URL . '/resources/');

/*
 * Domain/Subdomain module folder locations
 */

/**
 *
 * Database connections file location
 *     Dynamically load dbConnection.php, dependent on which domain/subdomain we're on
 */

$serverPathArray = explode('.', $_SERVER['SERVER_NAME']);

// If this is localhost or main domain (localhost, mysite.com, www.mysite.com)
if (((count($serverPathArray)) < 3) || ($serverPathArray[0] == 'www')) {
    if (file_exists(ZONES . $_SERVER['SERVER_NAME'])) {
        $moduleZones = ZONES . '/' . $_SERVER['SERVER_NAME'] . DIRECTORY_SEPARATOR . 'modules';
    } else {
        $moduleZones = ZONES . '/default' . DIRECTORY_SEPARATOR . 'modules';
    }
} else {
    // This is a subdomain, do not use '/default/dbConnection.php'
    $moduleZones = ZONES . '/' . $_SERVER['SERVER_NAME'] . DIRECTORY_SEPARATOR . 'modules';
}

define('MODULES_ZONES', $moduleZones);

/**
 * Theme/Template folder locations
 */

define('THEMES', PUBLIC_HTML . '/themes');
define('TEMPLATES', THEMES . '/templates');

/**
 *
 * Database connection file location
 *     Dynamically load dbConnection.php, dependent on which domain/subdomain we're on
 */

// If this is localhost or main domain (localhost/mysite.com/www.mysite.com)
if (((count(explode('.', $_SERVER['SERVER_NAME']))) < 3) || ($serverPathArray[0] == 'www')) {

    $serverName = $_SERVER['SERVER_NAME'];

    if ($serverPathArray[0] == 'www')
        $serverName = substr((string) $serverName, 4);

    if (file_exists(ZONES . '/' . $serverName .  DIRECTORY_SEPARATOR . 'dbConnection.php')) {
        $dbConnFile = ZONES . '/' . $serverName .  DIRECTORY_SEPARATOR . 'dbConnection.php';
    } else {
        $dbConnFile = ZONES . '/default' . DIRECTORY_SEPARATOR . 'dbConnection.php';
    }
} else {
    // This is a subdomain, do not use '/default/dbConnection.php'
    $dbConnFile = ZONES . '/' . $_SERVER['SERVER_NAME'] .  DIRECTORY_SEPARATOR . 'dbConnection.php';
}

define('DBCONNFILE', $dbConnFile);

$pathParameters = [
	//'dir.current' => $currentDir,
	'dir.base' => $baseDir,
	'dir.axis' => $baseDir . '/axis',
	'dir.public_html' => $baseDir . '/public_html',
	'dir.zones' => $baseDir . '/zones',
	'dir.configs' => $baseDir . '/axis/configs',
	'dir.includes' => $baseDir . '/axis/includes',
	'dir.tests' => $baseDir . '/axis/tests',
	'dir.vendor' => $baseDir . '/axis/vendor',
	'dir.axis_modules' => $baseDir . '/axis/modules',
	'dir.zones_modules' => $baseDir . '/zones/modules',
	'dir.resources' => $baseDir . '/public_html/resources',
	'dir.themes' => $baseDir . '/public_html/themes',
	'dir.templates' => $baseDir . '/public_html/templates',
	//'file.current' => $currentFile,
	'file.db_conn' => $dbConnFile,
	'url.base' => $baseUrl,
	'url.query_string' => $queryString, // I don't think we need this any more
	'url.resources' => $baseUrl . '/resources',
];

/**
 * Unset variables that are no longer needed
 *     We should not be using these in modules/themes
 */

unset($baseUrl);
unset($baseDir);
//unset($currentFilePath);
//unset($currentFile);
//unset($currentDir);
unset($key);
unset($val);
//unset($thisPath);
//unset($path);
unset($pathArray);
unset($thisQueryString);
unset($subDomainFolder);
