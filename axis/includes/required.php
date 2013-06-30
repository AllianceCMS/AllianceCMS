<?php
// require_once (HANDLERS . "html" . DS . "class.forms.php");
// require_once (HANDLERS . "html" . DS . "class.html.php");
// require_once (HANDLERS . "templates" . DS . "template.php");
if (file_exists(DBCONNFILE)) {

    // require_once (HANDLERS . "db" . DS . "db.php");
    require_once (DBCONNFILE);
    //require_once (HANDLERS . "db" . DS . "adodb" . DS . "adodb.inc.php");
    //require_once (HANDLERS . "db" . DS . "adodb" . DS . "adodb-exceptions.inc.php");
    //require_once (HANDLERS . "db" . DS . "class.db.php");
    require_once (PACKAGES_ACMS_CORE . 'Db' . DS . 'adodb' . DS . 'adodb.inc.php');
    require_once (PACKAGES_ACMS_CORE . 'Db' . DS . 'adodb' . DS . 'adodb-exceptions.inc.php');
    //require_once (PACKAGES_ACMS_CORE . 'Db' . DS . 'class.db.php');

    $sql = new Acms\Core\Db\Db();
    $sql->debug(0);

    require_once (PACKAGES_ACMS_CORE . "Sessions" . DS . "sessions.php");

    // Everything loaded up till here needs to be loaded in this order

    // require_once(HANDLERS."templates".DS."site.hub.php");
    // require_once(HANDLERS."templates".DS."nav.php");
    // require_once(HANDLERS."templates".DS."menus.php");
}
