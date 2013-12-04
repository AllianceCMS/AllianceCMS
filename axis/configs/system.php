<?php
/**
 * Create directory separator for file system paths
 */

if (!defined('DS')) {
    define('DS', strtoupper(substr(PHP_OS, 0, 3) == 'WIN') ? '\\' : '/');
}

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

$baseDir = dirname(dirname(__DIR__)) . DS;

/**
 * Assign file path information
 */

$currentFilePath = substr($_SERVER['PHP_SELF'], 1);
$filePathArray = explode('/', $currentFilePath);
$currentFile = $filePathArray[count($filePathArray) - 1];
array_pop($filePathArray);
$currentDir = '';
foreach ($filePathArray as $key => $val) {
    $currentDir .= $val . '/';
}
$thisPath = $currentDir . $currentFile;

/**
 * Extract query string
 */

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathArray = explode('/', $path);
array_shift($pathArray);
$pathVenue = $pathArray[0];
array_shift($pathArray);

$thisQueryString = '';

foreach ($pathArray as $val) {
    $thisQueryString .= '/' . $val;
}

/**
 * Setup $subDomainFolder variable for PUBLIC_HTML definition
 *     $subDomainFolder will be defined in '/public_html/index.php' if site is installed on a subdomain
 */

if (!isset($subDomainFolder)) {
    $subDomainFolder = '';
} else {
    $subDomainFolder = $subDomainFolder . DS;
}

/**
 * File system constants
 */

define('THIS_FILE', $currentFile);
define('THIS_DIR', $currentDir);
define('BASE_DIR', $baseDir);

/**
 * URL system constants
 */

define('BASE_URL', $baseUrl);
define('THIS_QUERY_STRING', $thisQueryString); // Used in nav.tpl.php

/**
 * AllianceCMS folder locations
 */

define('AXIS', BASE_DIR . 'axis' . DS);
define('ZONES', BASE_DIR . 'zones' . DS);
define('PUBLIC_HTML', BASE_DIR . 'public_html' . DS . $subDomainFolder);

/**
 * Resource folder locations
 */

define('RESOURCE_PATH', PUBLIC_HTML . 'resources' . DS);
define('RESOURCE_URL', BASE_URL . DS . 'resources' . DS);

/**
 * System folder locations
 */

define('CONFIGS', AXIS . 'configs' . DS);
define('INCLUDES', AXIS . 'includes' . DS);
define('TESTS', AXIS . 'tests' . DS);

/**
 * Package locations
 */

define('PACKAGES', AXIS . 'packages' . DS);
define('PACKAGE_ACMS_CORE', PACKAGES . 'Acms.Core' . DS . 'src' . DS . 'Acms' . DS . 'Core' . DS);
define('PACKAGE_AURA_SESSION', PACKAGES . 'Aura.Session' . DS);

/**
 * Axis module/theme folder locations
 */

define('MODULES_AXIS', AXIS . 'modules' . DS);

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
        $moduleZones = ZONES . $_SERVER['SERVER_NAME'] . DS . 'modules';
    } else {
        $moduleZones = ZONES . 'default' . DS . 'modules';
    }
} else {
    // This is a subdomain, do not use '/default/dbConnection.php'
    $moduleZones = ZONES . $_SERVER['SERVER_NAME'] . DS . 'modules';
}

define('MODULES_ZONES', $moduleZones);

/**
 * Theme/Template folder locations
 */

define('THEMES', PUBLIC_HTML . 'themes' . DS);
define('TEMPLATES', THEMES . 'templates' . DS);

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

    if (file_exists(ZONES . $serverName .  DS . 'dbConnection.php')) {
        $dbConnFile = ZONES . $serverName .  DS . 'dbConnection.php';
    } else {
        $dbConnFile = ZONES . 'default' . DS . 'dbConnection.php';
    }
} else {
    // This is a subdomain, do not use '/default/dbConnection.php'
    $dbConnFile = ZONES . $_SERVER['SERVER_NAME'] .  DS . 'dbConnection.php';
}

define('DBCONNFILE', $dbConnFile);

/**
 * Unset variables that are no longer needed
 *     We should not be using these in modules/themes
 */

unset($baseUrl);
unset($baseDir);
unset($currentFilePath);
unset($currentFile);
unset($currentDir);
unset($key);
unset($val);
unset($thisPath);
unset($path);
unset($pathArray);
unset($thisQueryString);
unset($subDomainFolder);
