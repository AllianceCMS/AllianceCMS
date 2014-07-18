<?php
/*
 * File: create.dbConnection.php
 * Intent: Create Database Connection File
 *
 */

$dbAdapter        = $_POST['dbAdapter'];
$dbHost           = $_POST['dbHost'];
$dbUserName       = $_POST['dbUserName'];
$dbPassword       = $_POST['dbPassword'];
$dbDatabase       = $_POST['dbDatabase'];
$dbDatabasePrefix = $_POST['dbDatabasePrefix'];
$dbActiveValue    = '1';

$data =	 "<?php
/**
 * Support Site: www.alliancecms.com
 * Lead Developer: Jesse Burns (jesse.burns@alliancecms.com)
 *
 * Copyright 2013 AllianceCMS
 *
 * Licensed under the Apache License, Version 2.0 (the \"License\");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an \"AS IS\" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * (This file is created by the AllianceCMS installation script)
 */

define('DB_ADAPTER',    '".$_POST['dbAdapter']."');
define('DB_HOST',       '".$_POST['dbHost']."');
define('DB_USER',       '".$_POST['dbUserName']."');
define('DB_PASSWORD',   '".$_POST['dbPassword']."');
define('DB_NAME',       '".$_POST['dbDatabase']."');
define('DB_PREFIX', 	'".$_POST['dbDatabasePrefix']."');
define('DB_ACTIVE', 	'1');
";

if (file_exists(ZONES_DIR . '/' . $_SERVER['SERVER_NAME'])) {
    $dbConnFile = ZONES_DIR . '/' . $_SERVER['SERVER_NAME'] . DIRECTORY_SEPARATOR . 'dbConnection.php';
} else {
    $dbConnFile = DB_CONNECTION_FILE;
}

$dumpFileSuccess = file_put_contents($dbConnFile, $data);

$currentOS = strtoupper(substr(PHP_OS, 0, 3));

if ($currentOS != 'WIN') {
	$chmodSuccess = chmod($dbConnFile, 0644);
}
