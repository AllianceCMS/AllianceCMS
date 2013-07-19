<?php

if (!defined('DS')) {
    define('DS', strtoupper(substr(PHP_OS, 0, 3) == 'WIN') ? '\\' : '/');
}

if (isset($_SERVER['HTTPS'])) {
    $baseUrl = "https://" . $_SERVER['SERVER_NAME'] . '/';
} else {
    $baseUrl = "http://" . $_SERVER['SERVER_NAME'] . '/';
}

$baseDir = dirname(dirname(__DIR__)) . DS;

$currentFilePath = substr($_SERVER['PHP_SELF'], 1);
$filePathArray = explode('/', $currentFilePath);
$currentFile = $filePathArray[count($filePathArray) - 1];
array_pop($filePathArray);
$currentDir = '';
foreach ($filePathArray as $key => $val) {
    $currentDir .= $val . '/';
}
$thisPath = $currentDir . $currentFile;

/*
$acmsSystem['this_file'] = $currentFile;
$acmsSystem['this_dir'] = $currentDir;
$acmsSystem['this_path'] = $thisPath;
$acmsSystem['base_url'] = $baseUrl;
$acmsSystem['base_dir'] = $baseDir;
$acmsSystem['axis'] =  $acmsSystem['base_dir'] . 'axis' . DS;
$acmsSystem['venues'] = $acmsSystem['base_dir'] . 'venues' . DS;
$acmsSystem['public_html'] = $acmsSystem['base_dir'] . 'public_html' . DS;
$acmsSystem['configs'] = $acmsSystem['axis'] . 'configs' . DS;
$acmsSystem['includes'] = $acmsSystem['axis'] . 'includes' . DS;
$acmsSystem['packages'] = $acmsSystem['axis'] . 'packages' . DS;
$acmsSystem['package_acms_core'] = $acmsSystem['packages'] . 'Acms.Core' . DS . 'src' . DS . 'Acms' . DS . 'Core' . DS;
$acmsSystem['tests'] = $acmsSystem['axis'] . 'tests' . DS;
$acmsSystem['plugins_axis'] = $acmsSystem['axis'] . 'plugins' . DS;
$acmsSystem['themes_axis'] = $acmsSystem['axis'] . 'themes' . DS;
$acmsSystem['plugins_venues'] = $acmsSystem['venues'] . 'plugins' . DS;
$acmsSystem['themes_venues'] = $acmsSystem['venues'] . 'themes' . DS;
$acmsSystem['db_connections'] = $acmsSystem['venues'] . DS . 'default' . DS . 'dbConnections.php';
//*/

//*
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
define("PACKAGE_ACMS_CORE", PACKAGES . 'Acms.Core' . DS . 'src' . DS . 'Acms' . DS . 'Core' . DS);

define("TESTS", AXIS . 'tests' . DS);

define('PLUGINS_AXIS', AXIS . 'plugins' . DS);
define('THEMES_AXIS', AXIS . 'themes' . DS);

define('PLUGINS_VENUES', VENUES . 'plugins' . DS);
define('THEMES_VENUES', VENUES . 'themes' . DS);

//define('THEMES', PUBLIC_HTML . 'themes' . DS);
define('THEMES', PUBLIC_HTML . 'themes' . DS);
define('TEMPLATES', THEMES . DS . 'templates' . DS);

define("DBCONNFILE", VENUES . DS . 'default' . DS . 'dbConnections.php');
//*/