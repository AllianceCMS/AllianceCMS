<?php
/**
 * Get base url, i.e. http://www.mysite.com
 */

if (isset($_SERVER['HTTPS'])) {
    $acmsBaseUrl = 'https://' . $_SERVER['SERVER_NAME'];
} else {
    $acmsBaseUrl = 'http://' . $_SERVER['SERVER_NAME'];
}
/**
 * Locate/define active zone folder
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

return ['paths' => [

    /*
    |--------------------------------------------------------------------------
    | Base Path
    |--------------------------------------------------------------------------
    |
    | The base path is the root of the AllianceCMS installation. Most likely you
    | will not need to change this value. But, if for some wild reason it
    | is necessary you will do so here, just proceed with some caution.
    |
    */

    'dir.base' => $acmsBaseDir,

	/*
	|--------------------------------------------------------------------------
	| Axis Path
	|--------------------------------------------------------------------------
	|
	| Here we just defined the path to the application directory. Most likely
	| you will never need to change this value as the default setup should
	| work perfectly fine for the vast majority of all our applications.
	|
	*/

    'dir.axis' => $acmsBaseDir . '/axis',

	/*
	|--------------------------------------------------------------------------
	| Public Path
	|--------------------------------------------------------------------------
	|
	| The public path contains the assets for your web application, such as
	| your Themes, JavaScript and CSS files, and also contains the primary entry
	| point for web requests into Axis from the outside.
	|
	*/

    'dir.public_html' => $acmsBaseDir . '/public_html' . $subDomainFolder,

    /*
    |--------------------------------------------------------------------------
    | Zones Path
    |--------------------------------------------------------------------------
    |
    | The zones path contains the domain specific configs and Modules for your web application. This enables
    | multi-site installations. This is great for development workflow: "dev -> test -> QA -> production"
    |
    */

    'dir.zones' => $zonesDir,

	/*
	|--------------------------------------------------------------------------
	| Storage Path
	|--------------------------------------------------------------------------
	|
	| The storage path is used by AllianceCMS to store cached templates, logs
	| and other pieces of information. You may modify the path here when
	| you want to change the location of this directory.
	|
	*/

    'dir.storage' => $acmsBaseDir . '/axis/storage',

    'dir.configs' => $acmsBaseDir . '/axis/configs',
	'dir.includes' => $acmsBaseDir . '/axis/includes',
	'dir.tests' => $acmsBaseDir . '/axis/tests',
    'dir.vendor' => $acmsBaseDir . '/axis/vendor',
	'dir.axis_modules' => $acmsBaseDir . '/axis/modules',
	//'dir.zones_modules' => $moduleZones,
    'dir.zones_modules' => $activeZone . '/modules',
	'dir.resources' => $acmsBaseDir . '/public_html/resources',
	'dir.themes' => $acmsBaseDir . '/public_html/themes',
	'dir.templates' => $acmsBaseDir . '/public_html/templates',
	//'file.db_conn' => $dbConnFile,
    'file.db_connection' => $activeZone . '/dbConnection.php',

    /*
    |--------------------------------------------------------------------------
    | Subdomain Folder Name
    |--------------------------------------------------------------------------
    |
    | The subdomain folder name. Needed to load proper zone files. Used for multi-site installations
    | and development workflow: "dev -> test -> QA -> production"
    |
    */

    'folder.subDomainFolder' => $subDomainFolder,

    'url.base' => $acmsBaseUrl,
    'url.resources' => $acmsBaseUrl . '/resources',
]];
