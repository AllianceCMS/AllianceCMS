<?php

    /*
	if (!defined('DIRECTORY_SEPARATOR')) {
		define('DIRECTORY_SEPARATOR', strtoupper(substr(PHP_OS, 0, 3) == 'WIN') ? '\\' : '/');
	}
	//*/

    //define("DS", DIRECTORY_SEPARATOR);
    define("DS", "/");

    if (isset($_SERVER['HTTPS'])) {
        $baseUrl = "https://".$_SERVER['SERVER_NAME'].DS;
    } else {
        $baseUrl = "http://".$_SERVER['SERVER_NAME'].DS;
    }

    $baseDir = "";
    while (!file_exists("{$baseDir}hub.php")) {
		$baseDir .= "..".DS;
	}

    $currentFilePath = $_SERVER['PHP_SELF'];
    $pathArray = Explode(DS, $currentFilePath);
    $currentDir = $pathArray[count($pathArray) - 2];
    $currentFile = $pathArray[count($pathArray) - 1];
    $thisPath = $currentDir.DS.$currentFile;

    define("THIS_FILE", $currentFile);
    define("THIS_DIR",  $currentDir);
    define("THIS_PATH", $thisPath);
    define("BASEURL",   $baseUrl);
    define("BASEDIR",   $baseDir);
    define("ADMIN",     BASEDIR."admin".DS);
    define("HANDLERS",  BASEDIR."handlers".DS);
    define("INCLUDES",  BASEDIR."includes".DS);
    define("PLUGINS",   BASEDIR."plugins".DS);
    define("THEMES",    BASEDIR."themes".DS);
    define("LANGUAGES", BASEDIR."languages".DS);
    define("INSTALL",   BASEDIR."install".DS);

    /*
    // Old db connection file, used with custom db class
	//define("DBCONNFILE", HANDLERS."db".DS."connections".DS."dbconnections.xml");
	//*/

    // New db connection file, used with ADOdb
	define("DBCONNFILE", HANDLERS."db".DS."connections".DS."dbconnections.php");
