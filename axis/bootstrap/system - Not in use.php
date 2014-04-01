<?php
/**
 * Get base url, i.e. http://www.mysite.com
 */

if (isset($_SERVER['HTTPS'])) {
    $acmsBaseUrl = 'https://' . $_SERVER['SERVER_NAME'];
} else {
    $acmsBaseUrl = 'http://' . $_SERVER['SERVER_NAME'];
}

//$zonesDir = $systemPaths['dir.base'] . '/zones';
$zonesDir = $systemPaths['dir.zones'];

/**
 * Domain/Subdomain module folder locations
 */

$serverPathArray = explode('.', $_SERVER['SERVER_NAME']);

// If this is localhost or main domain (localhost, mysite.com, www.mysite.com)
if (((count($serverPathArray)) < 3) || ($serverPathArray[0] == 'www')) {
    if (file_exists($zonesDir . '/' . $_SERVER['SERVER_NAME'])) {
        $moduleZones = $zonesDir . '/' . $_SERVER['SERVER_NAME'] . '/modules';
    } else {
        $moduleZones = $zonesDir . '/default' . '/modules';
    }
} else {
    // This is a subdomain
    $moduleZones = $zonesDir . '/' . $_SERVER['SERVER_NAME'] . '/modules';
}

/**
 *
 * Database connection file location
 *     Dynamically load dbConnection.php, dependent on which domain/subdomain we're on
 */

// If this is localhost or main domain (localhost or mysite.com or www.mysite.com)
if (((count($serverPathArray)) < 3) || ($serverPathArray[0] == 'www')) {

    $serverName = $_SERVER['SERVER_NAME'];

    if ($serverPathArray[0] == 'www')
        $serverName = substr((string) $serverName, 4);

    if (file_exists($zonesDir . '/' . $serverName .  '/dbConnection.php')) {
        $dbConnFile = $zonesDir . '/' . $serverName .  '/dbConnection.php';
    } else {
        $dbConnFile = $zonesDir . '/default' . '/dbConnection.php';
    }
} else {
    // This is a subdomain, do not use '/default/dbConnection.php'
    $dbConnFile = $zonesDir . '/' . $_SERVER['SERVER_NAME'] . '/dbConnection.php';
}

$pathParameters = [
	//'dir.root' => $systemPaths['dir.base'], // Defined in 'axis/includes/autoload.php
	//'dir.axis' => $systemPaths['dir.base'] . '/axis',
	//'dir.public_html' => $systemPaths['dir.base'] . '/public_html' . $subDomainFolder,
	//'dir.zones' => $systemPaths['dir.base'] . '/zones',
	//'dir.configs' => $systemPaths['dir.base'] . '/axis/configs',
	//'dir.includes' => $systemPaths['dir.base'] . '/axis/includes',
	//'dir.tests' => $systemPaths['dir.base'] . '/axis/tests',
    //'dir.vendor' => $systemPaths['dir.axis'] . '/vendor',
	//'dir.axis_modules' => $systemPaths['dir.base'] . '/axis/modules',
	'dir.zones_modules' => $moduleZones,
	//'dir.resources' => $systemPaths['dir.base'] . '/public_html/resources',
	//'dir.themes' => $systemPaths['dir.base'] . '/public_html/themes',
	//'dir.templates' => $systemPaths['dir.base'] . '/public_html/templates',
	'file.db_conn' => $dbConnFile,
	'url.base' => $acmsBaseUrl,
	'url.resources' => $acmsBaseUrl . '/resources',
];

/**
 * Unset variables that are no longer needed
 *     We should not be using these in modules/themes
 */

unset($dbConnFile);
unset($moduleZones);
//unset($vendorDir);
