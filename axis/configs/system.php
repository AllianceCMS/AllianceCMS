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

/**
 * Axis plugin/theme folder locations
 */

define('PLUGINS_AXIS', AXIS . 'plugins' . DS);

/**
 * Domain/Subdomain plugin/theme folder locations
 */

define('PLUGINS_ZONES', ZONES . 'plugins' . DS);

/**
 * Theme/Template folder locations
 */

define('THEMES', PUBLIC_HTML . 'themes' . DS);
define('TEMPLATES', THEMES . 'templates' . DS);

/**
 *
 * Database connections file location
 *     Dynamically load dbConnections.php, dependant on which domain/subdomain we're on
 */

// If this is localhost or main domain (mysite.com)
if ((count(explode('.', $_SERVER['SERVER_NAME']))) < 3) {
    if (file_exists(ZONES . $_SERVER['SERVER_NAME'] .  DS . 'dbConnections.php')) {
            $dbConnFile = ZONES . $_SERVER['SERVER_NAME'] .  DS . 'dbConnections.php';
        } else {
            $dbConnFile = ZONES . 'default' . DS . 'dbConnections.php';
        }
} else {
    // This is a subdomain, do not use '/default/dbConnections.php'
    $dbConnFile = ZONES . $_SERVER['SERVER_NAME'] .  DS . 'dbConnections.php';
}

define('DBCONNFILE', $dbConnFile);

/**
 * Unset variables that are no longer needed
 *     We should not be using these in plugins/themes
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
