<?php

// If the database config file (/axis/configs/dbconnections.php) exists:
// Load ADOdb
// Create Database Object
// Start Session Functionality
if (file_exists(DBCONNFILE)) {

    // Load ADOdb
    require_once (DBCONNFILE);
    require_once (PACKAGE_ACMS_CORE . 'Db' . DS . 'adodb' . DS . 'adodb.inc.php');
    require_once (PACKAGE_ACMS_CORE . 'Db' . DS . 'adodb' . DS . 'adodb-exceptions.inc.php');

    // Instantiate Database Object
    $sql = new Acms\Core\Db\Db();
    $sql->debug(0);

    // Load Session Functionality (Needs Database access to store sessions)
    require_once (PACKAGE_ACMS_CORE . "Sessions" . DS . "sessions.php");

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

require_once (INCLUDES . 'router.php');
