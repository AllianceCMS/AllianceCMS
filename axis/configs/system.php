<?php
/*
 * if (!defined('DIRECTORY_SEPARATOR')) { define('DIRECTORY_SEPARATOR', strtoupper(substr(PHP_OS, 0, 3) == 'WIN') ? '\\' : '/'); } //
 */
//define("DS", DIRECTORY_SEPARATOR);
//define("DS", "/");
//*
if (!defined('DS')) {
    define('DS', strtoupper(substr(PHP_OS, 0, 3) == 'WIN') ? '\\' : '/');
}
//*/

if (isset($_SERVER['HTTPS'])) {
    $baseUrl = "https://" . $_SERVER['SERVER_NAME'] . '/';
} else {
    $baseUrl = "http://" . $_SERVER['SERVER_NAME'] . '/';
}

$baseDir = dirname(dirname(__DIR__)) . DS;

/*
$baseDir = "";
while (! file_exists("{$baseDir}hub.php")) {
    $baseDir .= ".." . DS;
}
//*/

//*
$currentFilePath = substr($_SERVER['PHP_SELF'], 1);
$pathArray = explode('/', $currentFilePath);
$currentFile = $pathArray[count($pathArray) - 1];
array_pop($pathArray);
$currentDir = '';
foreach ($pathArray as $key => $val) {
    $currentDir .= $val . '/';
}
//$currentDir = $pathArray;
//$currentDir = $pathArray[count($pathArray) - 2];
$thisPath = $currentDir . $currentFile;
//*/

/*
define("THIS_FILE", $currentFile);
define("THIS_DIR", $currentDir);
define("THIS_PATH", $thisPath);
define("BASE_URL", $baseUrl);
define("BASE_DIR", $baseDir);
define("ADMIN", BASE_DIR . "admin" . DS);
define("HANDLERS", BASE_DIR . "handlers" . DS);
define("INCLUDES", BASE_DIR . "includes" . DS);
define("PLUGINS", BASE_DIR . "plugins" . DS);
define("THEMES", BASE_DIR . "themes" . DS);
define("LANGUAGES", BASE_DIR . "languages" . DS);
define("INSTALL", BASE_DIR . "install" . DS);
//*/

define("THIS_FILE", $currentFile);
define("THIS_DIR", $currentDir);
define("THIS_PATH", $thisPath);
define("BASE_URL", $baseUrl);
define("BASE_DIR", $baseDir);
define("AXIS", BASE_DIR . 'axis' . DS);
define("VENUES", BASE_DIR . 'venues' . DS);
define("PUBLIC_HTML", BASE_DIR . 'public_html' . DS);

define("CONFIGS", AXIS . 'configs' . DS);
define("INCLUDES", AXIS . 'includes' . DS);
define("PACKAGES", AXIS . 'packages' . DS);
define("PACKAGES_ACMS_CORE", PACKAGES . 'Acms.Core' . DS . 'src' . DS . 'Acms' . DS . 'Core' . DS);
define("HANDLERS", PACKAGES . 'handlers' . DS);

define('AXIS_PLUGINS', AXIS . 'plugins' . DS);
define('AXIS_THEMES', AXIS . 'themes' . DS);
define('VENUES_PLUGINS', VENUES . 'plugins' . DS);
define('VENUES_THEMES', VENUES . 'themes' . DS);

define("ADMIN", BASE_DIR . "admin" . DS);
define("LANGUAGES", BASE_DIR . "languages" . DS);
define("INSTALL", BASE_DIR . "install" . DS);

define("DBCONNFILE", CONFIGS . 'dbconnections.php');

/*
$fileSystem = array(
    //'currentFilePath' => $currentFilePath,
    //'pathArray' => $pathArray,
    'axisDir' => 'axis',
    'venuesDir' => 'venues',
    'thisFile' => $currentFile,
    'thisDir' => $currentDir, // Current URL Directory (not including the file name), relative to webroot
    'thisPath' => $thisPath, // Current URL Path (including the file name), relative to webroot
    'baseUrl' => $baseUrl,
    'baseDir' => $baseDir,
    'admin' => $baseDir . 'admin' . DS,
    'handers' => $baseDir . 'handlers' . DS,
    'includes' => $baseDir . 'includes' . DS,
    'languages' => $baseDir . 'languages' . DS,
    'install' => $baseDir . 'install' . DS,
);

// Setup 'axis' and 'venues' plugin and theme folders
//     This allows us to change the names of the 'axis' and 'venues' folder in the above
//     array initialization and not have to change these values = as dynamic as possible
$fileSystem['axisPlugins'] = $baseDir . $fileSystem['axisDir'] . DS . 'plugins' . DS;
$fileSystem['axisThemes'] = $baseDir . $fileSystem['axisDir'] . DS . 'themes' . DS;
$fileSystem['venuesPlugins'] = $baseDir . $fileSystem['venuesDir'] . DS . 'plugins' . DS;
$fileSystem['venuesThemes'] = $baseDir . $fileSystem['venuesDir'] . DS . 'themes' . DS;
//*/

/*
$fileSystem = array();
//$fileSystem['currentFilePath'] = $currentFilePath,
//$fileSystem['pathArray'] = $pathArray,
$fileSystem['axisDir'] = 'axis';
$fileSystem['venuesDir'] = 'venues';
$fileSystem['thisFile'] = $currentFile;
$fileSystem['thisDir'] = $currentDir; // Current URL Directory (not including the file name), relative to webroot
$fileSystem['thisPath'] = $thisPath; // Current URL Path (including the file name), relative to webroot
$fileSystem['baseUrl'] = $baseUrl;
$fileSystem['baseDir'] = $baseDir;
$fileSystem['admin'] = $baseDir . 'admin' . DS;
$fileSystem['handers'] = $baseDir . 'handlers' . DS;
$fileSystem['includes'] = $baseDir . 'includes' . DS;
$fileSystem['axisPlugins'] = $baseDir . $fileSystem['axisDir'] . DS . 'plugins' . DS;
$fileSystem['axisThemes'] = $baseDir . $fileSystem['axisDir'] . DS . 'themes' . DS;
$fileSystem['venuesPlugins'] = $baseDir . $fileSystem['venuesDir'] . DS . 'plugins' . DS;
$fileSystem['venuesThemes'] = $baseDir . $fileSystem['venuesDir'] . DS . 'themes' . DS;
$fileSystem['languages'] = $baseDir . 'languages' . DS;
$fileSystem['install'] = $baseDir . 'install' . DS;
//*/

/*
// Old db connection file, used with custom db class
//define("DBCONNFILE", HANDLERS."db".DS."connections".DS."dbconnections.xml");
//*/

// New db connection file, used with ADOdb
//*
//define("DBCONNFILE", HANDLERS . "db" . DS . "connections" . DS . "dbconnections.php");
//define("DBCONNFILE", CONFIGS . 'dbconnections.php'');
//*/
