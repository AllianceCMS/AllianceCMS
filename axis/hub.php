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

require_once $acmsBaseDir . '/axis/bootstrap/autoload.php';
require_once $acmsBaseDir . '/axis/bootstrap/load_system_paths.php';

require_once (INCLUDES_DIR . '/load_db.php');
require_once (INCLUDES_DIR . '/load_user.php');
require_once (INCLUDES_DIR . '/load_router.php');
require_once (CONFIGS_DIR . '/venue_info.php');
require_once (INCLUDES_DIR . '/load_templates.php');
require_once (INCLUDES_DIR . '/load_dispatcher.php');
require_once (INCLUDES_DIR . '/test_code.php');

// Attempt to calculate execution time
$execution_time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];

/*
echo '<br /><h1>Execution Time is: ' . $execution_time . '</h1><br />';
//exit;
//*/
