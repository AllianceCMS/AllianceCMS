<?php
// If the database config file (/venues/default/dbConnections.php) exists:
if (file_exists(DBCONNFILE)) {

    require_once (DBCONNFILE);
    $connection_factory = new Aura\Sql\ConnectionFactory();

    // Instantiate Database Object
    $sql = $connection_factory->newInstance(

        // adapter name
        DB_SOFTWARE,

        // DSN elements for PDO; this can also be
        // an array of key-value pairs
        'host=' . DB_HOST . ';dbname=' . DB_NAME,

        // username for the connection
        DB_USER,

        // password for the connection
        DB_PASSWORD);
}
