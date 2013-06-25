<?php

    // Establish Database Connection
    require_once(DBCONNFILE);
    require_once(HANDLERS."db".DS."adodb".DS."adodb.inc.php");
    require_once(HANDLERS."db".DS."adodb".DS."adodb-exceptions.inc.php");
    require_once(HANDLERS."db".DS."class.db.php");
    
    $sql = new Db;
    $sql->debug(0);