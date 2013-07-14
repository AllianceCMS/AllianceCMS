<?php

//use Aura\Sql\ConnectionFactory;

// If the database config file (/axis/configs/dbconnections.php) exists:
//     Load ADOdb
//     Create Database Object
//     Start Session Functionality
if (file_exists(DBCONNFILE)) {

    require_once(DBCONNFILE);

    $connection_factory = new Aura\Sql\ConnectionFactory;

    // Instantiate Database Object
    $sql = $connection_factory->newInstance(

        // adapter name
        DB_SOFTWARE,

        // DSN elements for PDO; this can also be
        // an array of key-value pairs
        'host=' . DB_HOST . ';dbname='.DB_NAME,

        // username for the connection
        DB_USER,

        // password for the connection
        DB_PASSWORD
    );

    /*
    // Load ADOdb
    require_once (DBCONNFILE);
    require_once (PACKAGE_ACMS_CORE . 'Db' . DS . 'adodb' . DS . 'adodb.inc.php');
    require_once (PACKAGE_ACMS_CORE . 'Db' . DS . 'adodb' . DS . 'adodb-exceptions.inc.php');

    // Instantiate Database Object
    $sql = new Acms\Core\Db\Db();
    $sql->debug(0);

    // Load Session Functionality (Needs Database access to store sessions)
    require_once (PACKAGE_ACMS_CORE . "Sessions" . DS . "sessions.php");
    //*/

    // Everything loaded up till here needs to be loaded in this order

    // require_once(HANDLERS."templates".DS."site.hub.php");
    // require_once(HANDLERS."templates".DS."nav.php");
    // require_once(HANDLERS."templates".DS."menus.php");
}



// First lets parse the folder structure for plugins and include 'main.php'

//require_once (INCLUDES . 'pluginParser.php');

// Then lets parse the folder structure for themes and include 'theme.php'

//require_once (INCLUDES . 'themeParser.php');

// Now lets call the router so we can attach plugin routes to their respective functions

//require_once (INCLUDES . 'router.php');
