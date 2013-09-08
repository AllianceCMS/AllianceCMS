<?php
error_reporting(4);

$acmsSalt = '$2y$07$A11ian5eCM5k1cks2zzyAh$';

require_once ('configs/system.php');
require_once (CONFIGS . 'autoload.php');
require_once (INCLUDES . 'load_db.php');
require_once (INCLUDES . 'load_user.php');
require_once (INCLUDES . 'load_router.php');
require_once (CONFIGS . 'venue_info.php');
require_once (INCLUDES . 'load_templates.php');
require_once (INCLUDES . 'load_dispatcher.php');
