<?php
# PHP error reporting. supported values are given below.
# -1 - Show every possible error, even when new levels and constants are added in future PHP versions
# 0 - Turn off all error reporting
# 1 - Running errors
# 2 - Running errors + notices
# 3 - All errors except notices and warnings
# 4 - All errors except notices
# 5 - All errors

error_reporting(-1);

require_once ('configs/system.php');
require_once (CONFIGS . 'autoload.php');
require_once (INCLUDES . 'load_db.php');
require_once (INCLUDES . 'load_user.php');
require_once (INCLUDES . 'load_router.php');
require_once (CONFIGS . 'venue_info.php');
require_once (INCLUDES . 'load_templates.php');
require_once (INCLUDES . 'load_dispatcher.php');
