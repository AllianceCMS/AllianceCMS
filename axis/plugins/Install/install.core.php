<?php
/**
 * TODO: Test for ways to create database
 *     Problem: Having trouble connecting if the database doesn't exist, as the Db::__construct autoloads that info once DBCONNFILE is created
 *     Solution: Create DBCONNFILE at end of installation
 */

// Setup $_POST variables for database insertion

$dbInsertDatabase       = $_POST['dbDatabase'];

$adminInsertLoginName   = $_POST['adminLoginName'];
$adminInsertDisplayName = $_POST['adminDisplayName'];
$adminInsertRealName    = $_POST['adminRealName'];
//$adminInsertPassword    = md5($_POST['adminPassword']);
$adminInsertPassword    = crypt($_POST['adminPassword']);
//$adminInsertPassword    = crypt($_POST['adminPassword'], '$2y$22$alliancecmssocialcmsya$');
$adminInsertEmail       = $_POST['adminEmail'];
$adminInsertHideEmail   = intval($_POST['adminHideEmail']);
$adminInsertLocation    = $_POST['adminLocation'];
$adminInsertWebsite     = $_POST['adminWebsite'];
$adminInsertAvatar      = $_POST['adminAvatar'];
$adminInsertBio         = $_POST['adminBio'];
$adminInsertSignature   = $_POST['adminSignature'];

$venueInsertName          = preg_replace('/\s+/', '', $_POST['venueName']);
$venueInsertTitle         = $_POST['venueTitle'];
$venueInsertTagline       = $_POST['venueTagline'];
$venueInsertDescription   = $_POST['venueDescription'];
$venueInsertKeywords      = $_POST['venueKeywords'];
$venueInsertEmail         = $_POST['venueEmail'];
$venueInsertEmailName     = $_POST['venueEmailName'];

$languageInsert           = $_POST['language'];

// Initialize $dbCreateDatabase
$dbCreateDatabase = '';

if (!empty($_POST['dbCreateDatabase'])) {
    $dbCreateDatabase = intval($_POST['dbCreateDatabase']);
}

// Get current Unix timestamp and convert it to MySql timestamp format
$currentUnixTime = time();
$currentMySqlTimestamp = date("Y-m-d H:i:s", $currentUnixTime);

// Include the proper database schemas
include(dirname(__FILE__) . DS . 'schemata' . DS . 'install_alpha.php');

// Get the most recent schema version for this database install
end($schema); // move the internal pointer to the end of the array
$schemaVersion = key($schema); // fetches the key of the element pointed to by the internal pointer
reset($schema);

// Create Db object, Establish Database Connection

// Create database object
$sql = new \Acms\Core\Data\Db;
// Setup db connection variables
// Started this because there was an error if the password was null,
// then decided we might as well do this for all $_POST database elements)
if (isset($_POST['dbAdapter'])) {
    $dbAdapter = $_POST['dbAdapter'];
} else {
    $dbAdapter = '';
}

if (isset($_POST['dbHostName'])) {
    $dbHostName = $_POST['dbHostName'];
} else {
    $dbHostName = '';
}

if (isset($_POST['dbDatabase'])) {
    $dbDatabase = $_POST['dbDatabase'];
} else {
    $dbDatabase = '';
}

if (isset($_POST['dbUserName'])) {
    $dbUserName = $_POST['dbUserName'];
} else {
    $dbUserName = '';
}

if (isset($_POST['dbPassword'])) {
    $dbPassword = $_POST['dbPassword'];
} else {
    $dbPassword = '';
}

if (isset($_POST['dbDatabasePrefix'])) {
    $dbPrefix = $_POST['dbDatabasePrefix'];
} else {
    $dbPrefix = '';
}

if ($dbCreateDatabase == 1) {
    // Create database connection
    $sql->dbConnect(
        $dbAdapter,
        $dbHostName,
        '',
        $dbUserName,
        $dbPassword
    );

	// Create Database
    foreach ($schema as $version) {

        //*
        $sql->dbCreateDatabase(
            $version['create']['database']['name'],
            $version['create']['database']['charset'],
            $version['create']['database']['collation']
        );
        //*/

        echo '<br />Finished creating database ' . $version['create']['database']['name'];
    }
} else {
    // Create database connection
    $sql->dbConnect(
        $dbAdapter,
        $dbHostName,
        $dbDatabase,
        $dbUserName,
        $dbPassword
    );
}

// Create connection that includes the database name since we've already created the database, or the user created a database before installation
$sql->dbConnect(
    $dbAdapter,
    $dbHostName,
    $dbDatabase,
    $dbUserName,
    $dbPassword
);

// Perform table creation/alteration/inserts/updates/deletes
foreach ($schema as $version) {
    /*
    echo "<br /><pre>\$version['create']['table']: ";
    echo print_r($version['create']['table']);
    echo '</pre><br />';
    //exit;
    //*/

    /*
    echo "<br /><pre>\$version['insert']['table']: ";
    echo print_r($version['insert']['table']);
    echo '</pre><br />';
    //exit;
    //*/

    // Create Tables
    foreach ($version['create']['table'] as $tableName => $index) {
        /*
        echo "<br /><pre>\$tableName: ";
        echo print_r($tableName);
        echo '</pre><br />';
        //exit;
        //*/

        /*
        echo "<br /><pre>\$index: ";
        echo print_r($index);
        echo '</pre><br />';
        //exit;
        //*/

        /*
        echo '<br />Table name is: '. $tableName;
        echo '<br />First Column name is: '. $index[0]['name'];
        echo '<br />First Column type is: '. $index[0]['type'];
        echo '<br />First Column not_null is: '. $index[0]['not_null'];
        echo '<br />First Column signed is: '. $index[0]['signed'];
        echo '<br />First Column autoincrement is: '. $index[0]['autoincrement'];
        echo '<br />First Column primary_key is: '. $index[0]['primary_key'];
        echo '<br />First Column default is: '. $index[0]['default'];
        echo '<br />First Column unique_key is: '. $index[0]['unique_key'];
        //*/

        //*
        $sql->dbCreateTable($tableName, $index, $dbPrefix);
        //exit;
        //*/

        //echo '<br />Finished creating table ' . $tableName;
    }

    // Insert Data Into Database
    foreach ($version['insert']['table'] as $loopTables) {

        foreach ($loopTables as $tableName => $loopFields) {
            /*
            echo "<br /><pre>\$tableName: ";
            echo print_r($tableName);
            echo '</pre><br />';
            //exit;
            //*/

            foreach ($loopFields as $columns) {

                /*
                echo "<br /><pre>\$columns: ";
                echo print_r($columns);
                echo '</pre><br />';
                //exit;
                //*/

                //*
                $sql->dbInsert($tableName, $columns, $dbPrefix);
                //exit;
                //*/

                //echo '<br />Finished inserting data into table ' . $tableName;
            }
        }
    }
}

// Update database schema version

//echo "<br />Are we ready to insert data? Check the database buddy!<br />";

