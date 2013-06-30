<?php
/*
 * File: install.dbConnection.php
 * Intent: Create Database Connection File
 *
 */

$dbSoftware       = $_POST['dbSoftware'];
$dbHostName       = $_POST['dbHostName'];
$dbUserName       = $_POST['dbUserName'];
$dbPassword       = $_POST['dbPassword'];
$dbDatabase       = $_POST['dbDatabase'];
$dbDatabasePrefix = $_POST['dbDatabasePrefix'];
$dbPersistent     = "no";
$dbActiveValue    = "1";

$currentOS = strtoupper(substr(PHP_OS, 0, 3));

$data =	 "<?php
/*
+--------------------------------------------------------------------------------+
|   AllianceCMS - by Jesse Burns (jesse.burns@alliancecms.com)
|
|   Support Site: www.alliancecms.com
|
|   Released under the terms and conditions of the
|   GNU General Public License (http://gnu.org).
|
|   (This file is created by the AllianceCMS installation script)
|
+--------------------------------------------------------------------------------+
*/

define(\"DB_SOFTWARE\",   \"".$_POST['dbSoftware']."\");
define(\"DB_HOST\",       \"".$_POST['dbHostName']."\");
define(\"DB_USER\",       \"".$_POST['dbUserName']."\");
define(\"DB_PASSWORD\",   \"".$_POST['dbPassword']."\");
define(\"DB_NAME\", 		\"".$_POST['dbDatabase']."\");
define(\"DB_PREFIX\", 	\"".$_POST['dbDatabasePrefix']."\");
define(\"DB_PERSISTENT\", \"no\");
define(\"DB_ACTIVE\", 	\"1\");";

file_put_contents(DBCONNFILE, $data);

if ($currentOS != "WIN") {
	chmod(DBCONNFILE, 0644);
}