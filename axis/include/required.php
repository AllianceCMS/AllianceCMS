<?php
require_once (HANDLERS . "html" . DS . "class.forms.php");
require_once (HANDLERS . "html" . DS . "class.html.php");
require_once (HANDLERS . "templates" . DS . "template.php");

if (file_exists(DBCONNFILE)) {

    require_once (HANDLERS . "db" . DS . "db.php");
    require_once (HANDLERS . "sessions" . DS . "sessions.php");

    // Everything loaded up till here needs to be loaded in this order

    // require_once(HANDLERS."templates".DS."site.hub.php");
    // require_once(HANDLERS."templates".DS."nav.php");
    // require_once(HANDLERS."templates".DS."menus.php");
}
