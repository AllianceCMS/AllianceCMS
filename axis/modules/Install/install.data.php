<?php
/**
 * Setup $_POST variables for database insertion
 */

$dbInsertDatabase       = $_POST['dbDatabase'];

$adminInsertLoginName   = $_POST['adminLoginName'];
$adminInsertDisplayName = $_POST['adminLoginName'];
$adminInsertPassword    = crypt($_POST['adminPassword'], $security->randomBlowfishSalt());
$adminInsertEmail       = $_POST['adminEmail'];
$adminInsertHideEmail   = intval($_POST['adminHideEmail']);

//$venueInsertLabel          = preg_replace('/\s+/', '', $_POST['venueLabel']);
$venueInsertLabel          = 'Main';
$venueInsertTitle         = isset($_POST['venueTitle']) ? $_POST['venueTitle'] : '';
$venueInsertTagline       = isset($_POST['venueTagline']) ? $_POST['venueTagline'] : '';
$venueInsertEmail         = $_POST['venueEmail'];
$venueInsertEmailName     = $_POST['venueEmailName'];

$languageInsert           = isset($_POST['language']) ? $_POST['language'] : '';

/**
 * Create data needed during installation
 */

// Initialize $dbCreateDatabase
$dbCreateDatabase = '';

if (!empty($_POST['dbCreateDatabase'])) {
    $dbCreateDatabase = intval($_POST['dbCreateDatabase']);
}

// Get current Unix timestamp and convert it to MySql timestamp format
$currentUnixTime = time();
$currentMySqlTimestamp = date("Y-m-d H:i:s", $currentUnixTime);

// Include the proper database schemas
include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'schemata' . DIRECTORY_SEPARATOR . 'install_alpha.php');

/**
 * Create Db object, Establish Database Connection
 */

// Create database object
$sql = new \Acms\Data\Db;
// Setup db connection variables
//     Started this because there was an error if the password was null,
//     then decided we might as well do this for all $_POST database elements)
if (isset($_POST['dbAdapter'])) {
    $dbAdapter = $_POST['dbAdapter'];
} else {
    $dbAdapter = '';
}

if (isset($_POST['dbHost'])) {
    $dbHost = $_POST['dbHost'];
} else {
    $dbHost = '';
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
        $dbHost,
        '',
        $dbUserName,
        $dbPassword
    );

	// Create Database
    foreach ($schema as $version) {

        if (isset($version['create']['database'])) {
            $sql->dbCreateDatabase(
                $version['create']['database']['name'],
                $version['create']['database']['charset'],
                $version['create']['database']['collation']
            );
        }
    }
} else {
    // Create database connection
    $sql->dbConnect(
        $dbAdapter,
        $dbHost,
        $dbDatabase,
        $dbUserName,
        $dbPassword
    );
}

// Create connection that includes the database name since we've already created the database, or the user created a database before installation
$sql->dbConnect(
    $dbAdapter,
    $dbHost,
    $dbDatabase,
    $dbUserName,
    $dbPassword
);

/**
 * Perform table creation/alteration/inserts/updates/deletes
 */

foreach ($schema as $version) {
    // Create Tables
    if (isset($version['create']['table'])){
        foreach ($version['create']['table'] as $tableName => $index) {
            $sql->dbCreateTable($tableName, $index, $dbPrefix);
        }
    }

    // Insert Data Into Database and mirror assets folder into public_html
    if (isset($version['insert']['table'])) {
        foreach ($version['insert']['table'] as $loopTables) {

            foreach ($loopTables as $tableName => $loopFields) {
                foreach ($loopFields as $columns) {
                    $result = $sql->dbInsert($tableName, $columns, $dbPrefix);

                    if ($tableName == 'modules') {
                        $installer->mirrorAssets($columns['folder_path'], $columns['folder_name']);
                    }
                }
            }
        }
    }

    // Alter Database Tables
    if (isset($version['alter']['table'])) {
        foreach ($version['alter']['table'] as $loopTables) {
            foreach ($loopTables as $tableName => $statement) {
                $sql->dbAlterTable($tableName, $statement);
            }
        }
    }
}

/**
 * Update database schema version
 */

// Get the most recent schema version for this database install
end($schema); // move the internal pointer to the end of the array
$schemaVersion = key($schema); // fetches the key of the element pointed to by the internal pointer
reset($schema);

$schemaColumns = [
    'system_name' => 'Axis',
    'schema_version' => $schemaVersion,
    'created' => $currentMySqlTimestamp,
    'modified' => $currentMySqlTimestamp,
];

$sql->dbInsert('schemas', $schemaColumns, $dbPrefix);
