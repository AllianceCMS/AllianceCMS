<?php

if (phpversion() < '5.4.0'):
?>
    <h1>AllianceCMS: Error</h1>
    <h2>
        <span style="color: red;">There are one or more errors that will prevent you from installing and using AllianceCMS</span>
    </h2>

    <p>
        Current PHP version: <strong><?php echo phpversion(); ?></strong>
    </p>
    <p>
        Required PHP version: <strong>5.4+</strong>
    </p>
    <p>
        Please talk to your system administrator about upgrading your PHP server software before continuing...
    </p>
<?php
    exit;
endif;

/**
 * Create random salt for blowfish crypt hash
 */

$acmsSalt = sprintf('$2y$%02d$', 12).substr(str_replace('+', '.', base64_encode(pack('N4', mt_rand(), mt_rand(), mt_rand(), mt_rand()))), 0, 22).'$';

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
define('PACKAGE_AURA_SESSION', PACKAGES . 'Aura.Session' . DS);

/**
 * Axis plugin/theme folder locations
 */

define('PLUGINS_AXIS', AXIS . 'plugins' . DS);

/*
 * Domain/Subdomain plugin folder locations
 */

/**
 *
 * Database connections file location
 *     Dynamically load dbConnection.php, dependant on which domain/subdomain we're on
 */

$serverPathArray = explode('.', $_SERVER['SERVER_NAME']);

// If this is localhost or main domain (localhost, mysite.com, www.mysite.com)
if (((count($serverPathArray)) < 3) || ($serverPathArray[0] == 'www')) {
    if (file_exists(ZONES . $_SERVER['SERVER_NAME'])) {
        $pluginZones = ZONES . $_SERVER['SERVER_NAME'] . DS . 'plugins';
    } else {
        $pluginZones = ZONES . 'default' . DS . 'plugins';
    }
} else {
    // This is a subdomain, do not use '/default/dbConnection.php'
    $pluginZones = ZONES . $_SERVER['SERVER_NAME'] . DS . 'plugins';
}

define('PLUGINS_ZONES', $pluginZones);

/**
 * Theme/Template folder locations
 */

define('THEMES', PUBLIC_HTML . 'themes' . DS);
define('TEMPLATES', THEMES . 'templates' . DS);

/**
 *
 * Database connection file location
 *     Dynamically load dbConnection.php, dependant on which domain/subdomain we're on
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
