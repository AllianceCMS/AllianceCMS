<?php

/**
 * Define HTTP Method
 */

if (isset($_SERVER['HTTPS'])) {
    $acmsBaseUrl = 'https://' . $_SERVER['SERVER_NAME'];
} else {
    $acmsBaseUrl = 'http://' . $_SERVER['SERVER_NAME'];
}

/**
 * Extract query string from $_SERVER['REQUEST_URI']
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
 * Define sub-domain folder
 */

if (!isset($subDomainFolder)) {
    $subDomainFolder = '';
} else {
    if (!empty($subDomainFolder)) {
        $subDomainFolder = '/' . $subDomainFolder;
    }
}

/**
 * Define which zone is the active zone
 */

$zonesDir = $acmsBaseDir . '/zones';
$serverPathArray = explode('.', $_SERVER['SERVER_NAME']);

// If this is localhost or main domain (localhost or mysite.com or www.mysite.com)
if (((count($serverPathArray)) < 3) || ($serverPathArray[0] == 'www')) {

    $serverName = $_SERVER['SERVER_NAME'];

    if ($serverPathArray[0] == 'www')
        $serverName = substr((string) $serverName, 4);

    if (file_exists($zonesDir . '/' . $serverName)) {
        $activeZone = $zonesDir . '/' . $serverName;
    } else {
        $activeZone = $zonesDir . '/default';
    }
} else {
    // This is a subdomain, do not use '/default/dbConnection.php'
    $activeZone = $zonesDir . '/' . $_SERVER['SERVER_NAME'];
}

/**
 * Create global constants
 */

define('BASE_DIR', $acmsBaseDir);
define('AXIS_DIR', $acmsBaseDir . '/axis');
define('WWW_DIR', $acmsBaseDir . '/public_html' . $subDomainFolder);
define('ZONES_DIR', $acmsBaseDir . '/zones');
define('STORAGE_DIR', $acmsBaseDir . '/axis/storage');
define('CONFIGS_DIR', $acmsBaseDir . '/axis/configs');
define('INCLUDES_DIR', $acmsBaseDir . '/axis/includes');
define('TESTS_DIR', $acmsBaseDir . '/axis/tests');
define('VENDOR_DIR', $acmsBaseDir . '/axis/vendor');
define('AXIS_MODULES_DIR', $acmsBaseDir . '/axis/modules');
define('ZONES_MODULES_DIR', $activeZone . '/modules');
define('WWW_RESOURCES_DIR', $acmsBaseDir . '/public_html/resources');
define('THEMES_DIR', $acmsBaseDir . '/public_html/themes');
define('TEMPLATES_DIR', $acmsBaseDir . '/public_html/themes/templates');
define('DB_CONNECTION_FILE', $activeZone . '/dbConnection.php');
define('SUBDOMAIN_FOLDER', $subDomainFolder);
define('BASE_URL', $acmsBaseUrl);
define('WWW_RESOURCES_URL', $acmsBaseUrl . '/resources');
define('THIS_QUERY_STRING', $thisQueryString); // Used in nav.tpl.php

unset($acmsBaseDir);
unset($subDomainFolder);
unset($activeZone);
