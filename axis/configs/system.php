<?php
/**
 * Setup root url, i.e. http://www.mysite.com
 */

if (isset($_SERVER['HTTPS'])) {
    $rootUrl = 'https://' . $_SERVER['SERVER_NAME'];
} else {
    $rootUrl = 'http://' . $_SERVER['SERVER_NAME'];
}

/**
 * Setup $subDomainFolder variable for PUBLIC_HTML definition
 *     $subDomainFolder will be defined in '/public_html/index.php' if site is installed on a subdomain
 */

if (!isset($subDomainFolder)) {
    $subDomainFolder = '';
} else {
    $subDomainFolder = '/' . $subDomainFolder;
}

$zonesDir = $rootDir . '/zones';

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

// If this is localhost or main domain (localhost/mysite.com/www.mysite.com)
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
	//'dir.current' => $currentDir,
	'dir.root' => $rootDir, // Defined in 'axis/includes/autoload.php
	'dir.axis' => $rootDir . '/axis',
	'dir.public_html' => $rootDir . '/public_html' . $subDomainFolder,
	'dir.zones' => $rootDir . '/zones',
	'dir.configs' => $rootDir . '/axis/configs',
	'dir.includes' => $rootDir . '/axis/includes',
	'dir.tests' => $rootDir . '/axis/tests',
	'dir.vendor' => $vendorDir,
	'dir.axis_modules' => $rootDir . '/axis/modules',
	'dir.zones_modules' => $moduleZones,
	'dir.resources' => $rootDir . '/public_html/resources',
	'dir.themes' => $rootDir . '/public_html/themes',
	'dir.templates' => $rootDir . '/public_html/templates',
	//'file.current' => $currentFile,
	'file.db_conn' => $dbConnFile,
	'url.root' => $rootUrl,
	//'url.query_string' => $queryString, // Comes from '$request->getBaseUrl():' now
	'url.resources' => $rootUrl . '/resources',
];

/**
 * Unset variables that are no longer needed
 *     We should not be using these in modules/themes
 */

unset($subDomainFolder);
unset($dbConnFile);
unset($moduleZones);
unset($vendorDir);
