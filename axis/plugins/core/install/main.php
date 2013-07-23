<?php
use Acms\Core\Templates\Template;
use Acms\Core\Html\FormHelper;

/**
 * Things to fix:
 *     - Instead of sending css/image paths to theme.tpl.php, send $theme_folder and change calls in templates
 *     - Put any repeated code into functions/methods:
 *         template creation
 *         template rendering
 *         setup menu
 *         instantiate FormHelper
 *         process errors
 */

// Create route for Installation: Welcome page
$pluginRoutes['Install']['Start Installation']['name'] = 'install_welcome'; // Required: Route name
$pluginRoutes['Install']['Start Installation']['path'] = '/install'; // Required: Route path
$pluginRoutes['Install']['Start Installation']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Start Installation']['specs']['values'] = [
    'controller' => 'install_welcome',
]; // Required: Callback function = controller

// Installation Welcome Page controller
function install_welcome($routeValues)
{
    //*
    echo '<br /><pre>$_POST: ';
    echo print_r($_POST);
    echo '</pre><br />';
    //exit;
    //*/

    // Installation Welcome Screen

    // Create FormHelper object for use in templates
    $formHelper = new FormHelper();

    // Setup theme template (only Install plugin should have to do this, once installed axis will take care of this)
    $tpl = new Template();
    $tpl->set('title', 'AllianceCMS: Installation');
    $tpl->set('author', 'AllianceCMS Dev Team');
    $tpl->set('styleSheet', BASE_URL . 'themes/core/emplode/css/style.css');

    // Setup body of plugin template
    $body = new Template(dirname(__FILE__) . DS . 'views' . DS . 'welcome.tpl.php');
    $body->set('images', BASE_URL . 'themes/core/emplode/images');
    $body->set('formHelper', $formHelper);

    // Create menu template
    $menu[0] = new Template(dirname(__FILE__) . DS . 'views' . DS . 'menu.tpl.php');
    $menu[0]->set('installStage', '0');
    $menu[0]->set('images', BASE_URL . 'themes/core/emplode/images');

    // Pass body and menu template to theme template (only Install plugin should have to do this, once installed axis will take care of this)
    $tpl->set('body', $body);
    $tpl->set('menu', $menu);

    // Render theme template (only Install plugin should have to do this, once installed axis will take care of this)
    echo $tpl->fetch(dirname(__FILE__) . DS . 'views' . DS . 'theme.tpl.php');
    exit;
}

// Create route for Installation Language page
$pluginRoutes['Install']['Select Language']['name'] = 'install_language'; // Required: Route name
$pluginRoutes['Install']['Select Language']['path'] = '/install/language'; // Required: Route path
$pluginRoutes['Install']['Select Language']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Select Language']['specs']['values'] = [
    'controller' => 'install_language',
    'method' => [
        'POST'
    ]
]; // Required: Callback function = controller

// Installation: Language Page controller
function install_language($routeValues)
{
    //*
    echo '<br /><pre>$_POST: ';
    echo print_r($_POST);
    echo '</pre><br />';
    //exit;
    //*/

    // Select Language

    // Create FormHelper object for use in templates
    $formHelper = new FormHelper();

    // Setup any installation data that's in $_POST
    foreach ($_POST as $key => $value) {
        if ((! ($key == 'install')) && (! ($key == 'installData')) && (! ($key == 'submit'))) {
            if (($value != '')) {
                $installData[$key] = $value;
            }
        }
    }

    // Setup theme template (only Install plugin should have to do this, once installed axis will take care of this)
    $tpl = new Template();
    $tpl->set('title', 'AllianceCMS: Installation');
    $tpl->set('author', 'Jesse Burns');
    $tpl->set('styleSheet', BASE_URL . 'themes/core/emplode/css/style.css');

    // Setup body of plugin template
    $body = new Template(dirname(__FILE__) . DS . 'views' . DS . 'language.tpl.php');
    $body->set('images', THEMES . 'emplode' . DS . 'images');
    $body->set('formHelper', $formHelper);

    // Send $installData to plugin template if it exists
    if (! empty($installData)) {
        $body->set('installData', $installData);
    }

    // Create menu template
    $menu[0] = new Template(dirname(__FILE__) . DS . 'views' . DS . 'menu.tpl.php');
    $menu[0]->set('installStage', '1');
    $menu[0]->set('images', BASE_URL . 'themes/core/emplode/images');

    // Pass body and menu template to theme template (only Install plugin should have to do this, once installed axis will take care of this)
    $tpl->set('body', $body);
    $tpl->set('menu', $menu);

    // Render theme template (only Install plugin should have to do this, once installed axis will take care of this)
    echo $tpl->fetch(dirname(__FILE__) . DS . 'views' . DS . 'theme.tpl.php');
    exit;
}

// Create route for Installation: Database Info page
$pluginRoutes['Install']['Prompt For DB Info']['name'] = 'install_db_info'; // Required: Route name
$pluginRoutes['Install']['Prompt For DB Info']['path'] = '/install/database-info/{:errors*}'; // Required: Route path
$pluginRoutes['Install']['Prompt For DB Info']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Prompt For DB Info']['specs']['values'] = [
    'controller' => 'install_db_info',
    'method' => [
        'POST',
        'GET',
    ]
]; // Required: Callback function = controller

// Installation: Database Info controller
function install_db_info($routeValues)
{
    //*
    echo '<br /><pre>$_POST: ';
    echo print_r($_POST);
    echo '</pre><br />';
    //exit;
    //*/

    // Prompt For DB Info

    // Create FormHelper object for use in templates
    $formHelper = new FormHelper();

    // If confirm_database_info found empty required fields, then process errors sent back to this controller
    if (isset($routeValues['errors'])) {
        // Break down 'errors' route value into error array
        foreach ($routeValues['errors'] as $value) {
            $errorsArray[] = explode('.', $value);
        }

        // Setup associative array so we can parse it and send it to the template via Template::set
        if (isset($errorsArray)) {
            foreach ($errorsArray as $valueArray) {
                $errors[$valueArray[0]] = str_replace('|_|', '.', str_replace('|-|', '/', $valueArray[1]));
            }
        }
    }

    // If no errors have been sent (this is first run or you clicked 'back' on 'confirm_db_info' page), initialize default field data
    if (!isset($errors)) {
        $installData['dbHostName']       = 'localhost';
        $installData['dbUserName']       = 'root';
        $installData['dbDatabasePrefix'] = 'a_';
        $installData['dbFirstIteration'] = '1';

        // Setup any installation data that is in $_POST
        foreach($_POST as $key => $value) {
            if ((!($key == 'install')) && (!($key == 'installData')) && (!($key == 'submit'))) {
                if (($value != '')) {
                    $installData[$key] = $value;
                }
            }
        }
    } else {
        // Setup any installation data that's in $errors (since we don't have $_POST)
        foreach($errors as $key => $value) {
            if ((!($key == 'install')) && (!($key == 'installData')) && (!($key == 'submit'))) {
                if (($value != '')) {
                    $installData[$key] = $value;
                }
            }
        }
    }

    // Setup theme template (only Install plugin should have to do this, once installed axis will take care of this)
    $tpl = new Template;
    $tpl->set('title',	    'AllianceCMS: Installation');
    $tpl->set('author',	    'jburns131');
    $tpl->set('styleSheet',	BASE_URL . 'themes/core/emplode/css/style.css');

    // Setup body of plugin template
    $body = new Template(dirname(__FILE__) . DS . 'views' . DS . 'dbInfo.tpl.php');
    $body->set('images',      BASE_URL . 'themes/core/emplode/images');
    $body->set('formHelper',  $formHelper);

    // Send $installData to plugin template if it exists
    if (isset($installData)) {
        $body->set('installData', $installData);
    };

    // If there are any errors (sent from 'confirm_db_info' page), set template vars from 'errors' route value
    if (isset($errors)) {
        foreach($errors as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                if (($value != '')) {
                    $body->set($attribute, $value);
                }
            }
        }
    }

    // Create menu template
    $menu[0] = new Template(dirname(__FILE__) . DS . 'views' . DS . 'menu.tpl.php');
    $menu[0]->set('installStage', '2');
    $menu[0]->set('images',       BASE_URL . 'themes/core/emplode/images');

    // Pass body and menu template to theme template (only Install plugin should have to do this, once installed axis will take care of this)
    $tpl->set('body', $body);
    $tpl->set('menu', $menu);

    // Render theme template (only Install plugin should have to do this, once installed axis will take care of this)
    echo $tpl->fetch(dirname(__FILE__) . DS . 'views' . DS . 'theme.tpl.php');
    exit;
}

// Create route for Installation: Confirm Database Info page
$pluginRoutes['Install']['Confirm DB Info']['name'] = 'install_confirm_db_info'; // Required: Route name
$pluginRoutes['Install']['Confirm DB Info']['path'] = '/install/confirm-database-info'; // Required: Route path
$pluginRoutes['Install']['Confirm DB Info']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Confirm DB Info']['specs']['values'] = [
    'controller' => 'install_confirm_db_info',
    'method' => ['POST'],
]; // Required: Callback function = controller

// Installation: Confirm Database Info controller
function install_confirm_db_info($routeValues)
{
    //*
    echo '<br /><pre>$_POST: ';
    echo print_r($_POST);
    echo '</pre><br />';
    //exit;
    //*/

    // Confirm DB Info

    // Create FormHelper object for use in templates
    $formHelper = new FormHelper();

    // Check for required fields from db_info pages
    //     (password is not required as some local installations may not require one)
    if (($_POST['dbHostName'] == '') ||
    ($_POST['dbUserName'] == '') ||
    ($_POST['dbDatabase'] == '')) {

        // If there are missing required fields, first set 'dbInfoError' to 1, then setup route info to send required field data to db_info page
        //     (the template will check for missing values and display error message appropriately)
        $errors = '/dbInfoError.' . intval(1);

        foreach($_POST as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                if (!($value == '')) {
                    $errors .= '/' . $attribute . '.' . str_replace('.', '|_|', str_replace('/', '|-|', $value));
                }
            }
        }

        // Return user to db_info page, along with errors
        header('Location: /install/database-info'.$errors);
        exit;
    } else {

        // There are no missing required fields

        // Setup any installation data that's in $_POST
        foreach($_POST as $key => $value) {
            if ((!($key == 'install')) && (!($key == 'installData')) && (!($key == 'submit'))) {
                if (($value != '')) {
                    $installData[$key] = $value;
                }
            }
        }

        // Setup theme template (only Install plugin should have to do this, once installed axis will take care of this)
        $tpl = new Template;
        $tpl->set('title',	    'AllianceCMS: Installation');
        $tpl->set('author',	    'jburns131');
        $tpl->set('styleSheet',	BASE_URL . 'themes/core/emplode/css/style.css');

        // Setup body of plugin template
        $body = new Template(dirname(__FILE__) . DS . 'views' . DS . 'dbConfirm.tpl.php');
        $body->set('images',      BASE_URL . 'themes/core/emplode/images');
        $body->set('formHelper',  $formHelper);
        $body->set('installData', $installData);

        // Set template vars from $_POST
        foreach($_POST as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                if ($value != '') {
                    $body->set($attribute, $value);
                }
            }
        }

        // Create menu template
        $menu[0] = new Template(dirname(__FILE__) . DS . 'views' . DS . 'menu.tpl.php');
        $menu[0]->set('installStage', '3');
        $menu[0]->set('images',       BASE_URL . 'themes/core/emplode/images');

        // Pass body and menu template to theme template (only Install plugin should have to do this, once installed axis will take care of this)
        $tpl->set('body', $body);
        $tpl->set('menu', $menu);

        // Render theme template (only Install plugin should have to do this, once installed axis will take care of this)
        echo $tpl->fetch(dirname(__FILE__) . DS . 'views' . DS . 'theme.tpl.php');
    }
    exit;
}

// Create route for Installation: Test/Confirm Database Connection page
$pluginRoutes['Install']['Test/Confirm DB Connection']['name'] = 'install_test_db_connection'; // Required: Route name
$pluginRoutes['Install']['Test/Confirm DB Connection']['path'] = '/install/test-database-connection'; // Required: Route path
$pluginRoutes['Install']['Test/Confirm DB Connection']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Test/Confirm DB Connection']['specs']['values'] = [
    'controller' => 'install_test_db_connection',
    'method' => ['POST'],
]; // Required: Callback function = controller

// Installation: Test Connection Info controller
function install_test_db_connection($routeValues)
{
    //*
    echo '<br /><pre>$_POST: ';
    echo print_r($_POST);
    echo '</pre><br />';
    //exit;
    //*/

    // Test/Confirm DB Connection

    // Create FormHelper object for use in templates
    $formHelper = new FormHelper();

    // Create database object for testing purposes
    $sql = new Acms\Core\Data\Db;

    // Setup db connection variables
    // Started this because there was an error if the password was null,
    // then decided we might as well do this for all $_POST elements)
    if (isset($_POST['dbAdapter'])) {
        $dbAdapter = $_POST['dbAdapter'];
    } else {
        $dbAdapter = '';
    }

    if (isset($_POST['dbHostName'])) {
        $dbHostName = $_POST['dbHostName'];
    } else {
        $dbHostName = '';
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

    if (isset($_POST['dbPrefix'])) {
        $dbPrefix = $_POST['dbPrefix'];
    } else {
        $dbPrefix = '';
    }

    //*
    // Create connection (lazy-connection, won't connect to db unless a query is submitted, hense Db::dbActiveConnect)
    $sql->dbConnect(
        $dbAdapter,
        $dbHostName,
        $dbDatabase,
        $dbUserName,
        $dbPassword
    );

    /*
     // Actively connect to database, if an exception is thrown then the connection failed
    try {
    $sql->dbActiveConnect();
    $validConnection = 1;
    }
    catch (PDOException $e) {
    $validConnection = '';
    }
    //*/

    //*
    // Actively connect to database, if an exception is thrown then the connection failed
    try {
        $sql->dbValidConnection();
        $validConnection = 1;
    }
    catch (PDOException $e) {
        $validConnection = '';
    }
    //*/

    /*
    if ($sql->dbValidConnection()) {
        $validConnection = 1;
    } else {
        $validConnection = '';
    }
    //*/

    /*
    $connection_factory = new Aura\Sql\ConnectionFactory();
    $connection = $connection_factory->newInstance(

        // adapter name
        $dbAdapter,

        // DSN elements for PDO; this can also be
        // an array of key-value pairs
        'host='.$dbHostName.';dbname='.$dbDatabase,

        // username for the connection
        $dbUserName,

        // password for the connection
        $dbPassword
    );

    $pdo = null;
    try {
        $pdo = $connection->getPdo();
        //$connection->connect();
        //$validConnection = 1;
    } catch (Exception $e) {
        // on failure
        //$validConnection = '';
    }

    if ($pdo) {
        // Success, Continue
        $validConnection = 1;
    } else {
        // Failed, Go back and enter proper credentials
        $validConnection = '';
    }
    //*/

    // End DB Connection Test

    foreach($_POST as $key => $value) {
        if ((!($key == 'install')) && (!($key == 'installData')) && (!($key == 'submit'))) {
            $installData[$key] = $value;
        }
    }
    unset($count);

    $tpl = new Template;
    $tpl->set('title',	    'AllianceCMS: Installation');
    $tpl->set('author',	    'jburns131');
    $tpl->set('styleSheet',	BASE_URL . 'themes/core/emplode/css/style.css');

    $body = new Template(dirname(__FILE__) . DS . 'views' . DS . 'dbTestConfirm.tpl.php');
    $body->set('images',          BASE_URL . 'themes/core/emplode/images');
    $body->set('formHelper',      $formHelper);
    $body->set('installData',     $installData);
    $body->set('validConnection', $validConnection);

    // Set template vars from $_POST
    foreach($_POST as $attribute => $value) {
        if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
            $body->set($attribute, $value);
        }
    }

    $menu[0] = new Template(dirname(__FILE__) . DS . 'views' . DS . 'menu.tpl.php');
    $menu[0]->set('installStage', '3');
    $menu[0]->set('images',       BASE_URL . 'themes/core/emplode/images');

    $tpl->set('body', $body);
    $tpl->set('menu', $menu);

    echo $tpl->fetch(dirname(__FILE__) . DS . 'views' . DS . 'theme.tpl.php');
    exit;
}

// Create route for Installation: Prompt For Admin Info page
$pluginRoutes['Install']['Prompt For Admin Info']['name'] = 'install_admin_info'; // Required: Route name
$pluginRoutes['Install']['Prompt For Admin Info']['path'] = '/install/admin-info/{:errors*}'; // Required: Route path
$pluginRoutes['Install']['Prompt For Admin Info']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Prompt For Admin Info']['specs']['values'] = [
    'controller' => 'install_admin_info',
    'method' => [
        'POST',
        'GET',
    ],
]; // Required: Callback function = controller

// Installation: Admin Info controller
function install_admin_info($routeValues)
{
    /*
    echo '<br /><pre>$routeValues: ';
    echo print_r($routeValues);
    echo '</pre><br />';
    //*/

    //*
    echo '<br /><pre>$_POST: ';
    echo print_r($_POST);
    echo '</pre><br />';
    //exit;
    //*/

    /*
    // Template testing code

    $arr = get_defined_vars();

    echo '<br /><pre>$arr: ';
    echo print_r($arr);
    echo '</pre><br />';
    //*/


    // Prompt For Admin Info

    // Create FormHelper object for use in templates
    $formHelper = new FormHelper();

    // If confirm_database_info found empty required fields, then process errors sent back to this controller
    if (isset($routeValues['errors'])) {
        // Break down 'errors' route value into error array
        foreach ($routeValues['errors'] as $value) {
            $errorsArray[] = explode('.', $value);
        }

        // Setup associative array so we can parse it and send it to the template via Template::set
        if (isset($errorsArray)) {
            foreach ($errorsArray as $valueArray) {
                $errors[$valueArray[0]] = str_replace('|_|', '.', str_replace('|-|', '/', $valueArray[1]));
            }
        }
    }

    // If no errors have been sent (this is first run or you clicked 'back' on 'confirm_admin_info' page), initialize default field data
    if (!isset($errors)) {
        $installData['adminFirstIteration'] = '1';

        // Setup any installation data that's in $_POST
        foreach($_POST as $key => $value) {
            if ((!($key == 'install')) && (!($key == 'installData')) && (!($key == 'submit'))) {
                $installData[$key] = $value;
            }
        }
    } else {
        // Setup any installation data that's in $errors (since we don't have $_POST)
        foreach($errors as $key => $value) {
            if ((!($key == 'install')) && (!($key == 'installData')) && (!($key == 'submit'))) {
                $installData[$key] = $value;
            }
        }
    }

    // Setup theme template (only Install plugin should have to do this, once installed axis will take care of this)
    $tpl = new Template;
    $tpl->set('title',	    'AllianceCMS: Installation');
    $tpl->set('author',	    'jburns131');
    $tpl->set('styleSheet',	BASE_URL . 'themes/core/emplode/css/style.css');

    // Setup body of plugin template
    $body = new Template(dirname(__FILE__) . DS . 'views' . DS . 'adminInfo.tpl.php');
    $body->set('images',      BASE_URL . 'themes/core/emplode/images');
    $body->set('formHelper',  $formHelper);

    // Send $installData to plugin template if it exists
    if (isset($installData)) {
        $body->set('installData', $installData);
    }

    // If there are any errors (sent from 'confirm_admin_info' page), set template vars from 'errors' route value
    if (isset($errors)) {
        foreach($errors as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                if (($value != '')) {
                    $body->set($attribute, $value);
                }
            }
        }
    } else {
        // Set template vars from $_POST
        foreach($_POST as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                $body->set($attribute, $value);
            }
        }
    }

    // Create menu template
    $menu[0] = new Template(dirname(__FILE__) . DS . 'views' . DS . 'menu.tpl.php');
    $menu[0]->set('installStage', '4');
    $menu[0]->set('images',       BASE_URL . 'themes/core/emplode/images');

    // Pass body and menu template to theme template (only Install plugin should have to do this, once installed axis will take care of this)
    $tpl->set('body', $body);
    $tpl->set('menu', $menu);

    // Render theme template (only Install plugin should have to do this, once installed axis will take care of this)
    echo $tpl->fetch(dirname(__FILE__) . DS . 'views' . DS . 'theme.tpl.php');
    exit;
}

// Create route for Installation: Confirm Admin Info page
$pluginRoutes['Install']['Confirm Admin Info']['name'] = 'install_confirm_admin_info'; // Required: Route name
$pluginRoutes['Install']['Confirm Admin Info']['path'] = '/install/confirm-admin-info'; // Required: Route path
$pluginRoutes['Install']['Confirm Admin Info']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Confirm Admin Info']['specs']['values'] = [
    'controller' => 'install_confirm_admin_info',
    'method' => ['POST'],
]; // Required: Callback function = controller

// Installation: Confirm Admin Info controller
function install_confirm_admin_info($routeValues)
{
    /*
    echo '<br /><pre>$routeValues: ';
    echo print_r($routeValues);
    echo '</pre><br />';
    //*/

    //*
    echo '<br /><pre>$_POST: ';
    echo print_r($_POST);
    echo '</pre><br />';
    //exit;
    //*/

    /*
    // Template testing code

    $arr = get_defined_vars();

    echo '<br /><pre>$arr: ';
    echo print_r($arr);
    echo '</pre><br />';
    //*/


    // Confirm Admin Info

    // Create FormHelper object for use in templates
    $formHelper = new FormHelper();

    // Check for required fields from db_info pages
    //     (password is not required as some local installations may not require one)
    if ((($_POST['adminLoginName']       == '') ||
         ($_POST['adminPassword']        == '') ||
         ($_POST['adminConfirmPassword'] == '') ||
         ($_POST['adminEmail']           == '') ||
         ($_POST['adminConfirmEmail']    == ''))
         ||
         ($_POST['adminPassword'] != $_POST['adminConfirmPassword'])
         ||
         ($_POST['adminEmail']    != $_POST['adminConfirmEmail'])) {

        // If there are missing required fields, first set 'adminInfoError' to 1, then setup route info to send required field data to admin_info page
        //     (the template will check for missing values and display error message appropriately)
        $errors = '/adminInfoError.' . intval(1);

        foreach($_POST as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                if (!($value == '')) {
                    $errors .= '/' . $attribute . '.' . str_replace('.', '|_|', str_replace('/', '|-|', $value));
                }
            }
        }

        // If passwords don't match send error
        // TODO: Use javascript for this functionality
        if ((($_POST['adminPassword'] != '') && ($_POST['adminConfirmPassword'] != ''))
             &&
            ($_POST['adminPassword']  != $_POST['adminConfirmPassword'])) {
            $errors .= '/adminPasswordMatchError.' . intval(1);
        }

        // If email addresses doesn't match send error
        // TODO: Use javascript for this functionality
        if ((($_POST['adminEmail'] != '') && ($_POST['adminConfirmEmail'] != ''))
             &&
            ($_POST['adminEmail']  != $_POST['adminConfirmEmail'])) {
            $errors .= '/adminEmailMatchError.' . intval(1);
        }

        // Return user to admin_info page, along with errors
        header('Location: /install/admin-info'.$errors);
        exit;
    } else {

        // There are no missing required fields or form input errors

        // Setup any installation data that's in $_POST
        foreach($_POST as $key => $value) {
        	if ((!($key == 'install')) && (!($key == 'installData')) && (!($key == 'submit'))) {
        	    $installData[$key] = $value;
            }
        }

        // Setup theme template (only Install plugin should have to do this, once installed axis will take care of this)
        $tpl = new Template;
        $tpl->set('title',	    'AllianceCMS: Installation');
        $tpl->set('author',	    'jburns131');
        $tpl->set('styleSheet',	BASE_URL . 'themes/core/emplode/css/style.css');

        // Setup body of plugin template
        $body = new Template(dirname(__FILE__) . DS . 'views' . DS . 'adminConfirm.tpl.php');
        $body->set('images',      BASE_URL . 'themes/core/emplode/images');
        $body->set('formHelper',  $formHelper);
        $body->set('installData', $installData);

        // Set template vars from $_POST
        foreach($_POST as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                if ($value != '') {
                    $body->set($attribute, $value);
                }
            }
        }

        // Create menu template
        $menu[0] = new Template(dirname(__FILE__) . DS . 'views' . DS . 'menu.tpl.php');
        $menu[0]->set('installStage', '5');
        $menu[0]->set('images',       BASE_URL . 'themes/core/emplode/images');

        // Pass body and menu template to theme template (only Install plugin should have to do this, once installed axis will take care of this)
        $tpl->set('body', $body);
        $tpl->set('menu', $menu);

        // Render theme template (only Install plugin should have to do this, once installed axis will take care of this)
        echo $tpl->fetch(dirname(__FILE__) . DS . 'views' . DS . 'theme.tpl.php');
    }
    exit;
}

// Create route for Installation: Prompt For Site Info page
$pluginRoutes['Install']['Prompt For Site Info']['name'] = 'install_site_info'; // Required: Route name
$pluginRoutes['Install']['Prompt For Site Info']['path'] = '/install/site-info'; // Required: Route path
$pluginRoutes['Install']['Prompt For Site Info']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Prompt For Site Info']['specs']['values'] = [
    'controller' => 'install_site_info',
    'method' => ['POST'],
]; // Required: Callback function = controller

// Installation: Site Info controller
function install_site_info($routeValues)
{
    /*
    echo '<br /><pre>$routeValues: ';
    echo print_r($routeValues);
    echo '</pre><br />';
    //*/

    //*
    echo '<br /><pre>$_POST: ';
    echo print_r($_POST);
    echo '</pre><br />';
    //exit;
    //*/

    /*
    // Template testing code

    $arr = get_defined_vars();

    echo '<br /><pre>$arr: ';
    echo print_r($arr);
    echo '</pre><br />';
    //*/


    // Prompt For Site Info

    // Create FormHelper object for use in templates
    $formHelper = new FormHelper();

    foreach($_POST as $key => $value) {
        if ((!($key == 'install')) && (!($key == 'installData')) && (!($key == 'submit'))) {
            $installData[$key] = $value;
        }
    }

    $tpl = new Template;
    $tpl->set('title',	    'AllianceCMS: Installation');
    $tpl->set('author',	    'jburns131');
    $tpl->set('styleSheet',	BASE_URL . 'themes/core/emplode/css/style.css');

    $body = new Template(dirname(__FILE__) . DS . 'views' . DS . 'siteInfo.tpl.php');
    $body->set('images',      BASE_URL . 'themes/core/emplode/images');
    $body->set('formHelper',  $formHelper);
    $body->set('installData', $installData);

    foreach($_POST as $attribute => $value) {
        if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
            $body->set($attribute, $value);
        }
    }

    $menu[0] = new Template(dirname(__FILE__) . DS . 'views' . DS . 'menu.tpl.php');
    $menu[0]->set('installStage', '6');
    $menu[0]->set('images',       BASE_URL . 'themes/core/emplode/images');

    $tpl->set('body', $body);
    $tpl->set('menu', $menu);

    echo $tpl->fetch(dirname(__FILE__) . DS . 'views' . DS . 'theme.tpl.php');
    exit;
}

// Create route for Installation: Confirm Site Info page
$pluginRoutes['Install']['Confirm Site Info']['name'] = 'install_confirm_site_info'; // Required: Route name
$pluginRoutes['Install']['Confirm Site Info']['path'] = '/install/confirm-site-info'; // Required: Route path
$pluginRoutes['Install']['Confirm Site Info']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Confirm Site Info']['specs']['values'] = [
    'controller' => 'install_confirm_site_info',
    'method' => ['POST'],
]; // Required: Callback function = controller

// Installation: Confirm Site Info controller
function install_confirm_site_info($routeValues)
{
    /*
    echo '<br /><pre>$routeValues: ';
    echo print_r($routeValues);
    echo '</pre><br />';
    //*/

    //*
    echo '<br /><pre>$_POST: ';
    echo print_r($_POST);
    echo '</pre><br />';
    //exit;
    //*/

    /*
    // Template testing code

    $arr = get_defined_vars();

    echo '<br /><pre>$arr: ';
    echo print_r($arr);
    echo '</pre><br />';
    //*/


    // Confirm Site Info

    // Create FormHelper object for use in templates
    $formHelper = new FormHelper();

    // Setup any installation data that's in $_POST
    foreach($_POST as $key => $value) {
        if ((!($key == 'install')) && (!($key == 'installData')) && (!($key == 'submit'))) {
            $installData[$key] = $value;
        }
    }

    // Setup theme template (only Install plugin should have to do this, once installed axis will take care of this)
    $tpl = new Template;
    $tpl->set('title',	    'AllianceCMS: Installation');
    $tpl->set('author',	    'jburns131');
    $tpl->set('styleSheet',	BASE_URL . 'themes/core/emplode/css/style.css');

    // Setup body of plugin template
    $body = new Template(dirname(__FILE__) . DS . 'views' . DS . 'siteConfirm.tpl.php');
    $body->set('images',      BASE_URL . 'themes/core/emplode/images');
    $body->set('formHelper',  $formHelper);
    $body->set('installData', $installData);

    // Set template vars from $_POST
    foreach($_POST as $attribute => $value) {
        if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
            $body->set($attribute, $value);
        }
    }

    // Create menu template
    $menu[0] = new Template(dirname(__FILE__) . DS . 'views' . DS . 'menu.tpl.php');
    $menu[0]->set('installStage', '7');
    $menu[0]->set('images',       BASE_URL . 'themes/core/emplode/images');

    // Pass body and menu template to theme template (only Install plugin should have to do this, once installed axis will take care of this)
    $tpl->set('body', $body);
    $tpl->set('menu', $menu);

    // Render theme template (only Install plugin should have to do this, once installed axis will take care of this)
    echo $tpl->fetch(dirname(__FILE__) . DS . 'views' . DS . 'theme.tpl.php');
    exit;
}

// Create route for Installation: Confirm Installation page
$pluginRoutes['Install']['Confirm Installation']['name'] = 'install_confirm_installation'; // Required: Route name
$pluginRoutes['Install']['Confirm Installation']['path'] = '/install/confirm-installation'; // Required: Route path
$pluginRoutes['Install']['Confirm Installation']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Confirm Installation']['specs']['values'] = [
    'controller' => 'install_confirm_installation',
    'method' => ['POST'],
]; // Required: Callback function = controller

// Installation: Confirm Installation controller
function install_confirm_installation($routeValues)
{
    /*
    echo '<br /><pre>$routeValues: ';
    echo print_r($routeValues);
    echo '</pre><br />';
    //*/

    //*
    echo '<br /><pre>$_POST: ';
    echo print_r($_POST);
    echo '</pre><br />';
    //exit;
    //*/

    /*
    // Template testing code

    $arr = get_defined_vars();

    echo '<br /><pre>$arr: ';
    echo print_r($arr);
    echo '</pre><br />';
    //*/


    // ok To Install?

    // Create FormHelper object for use in templates
    $formHelper = new FormHelper();

    foreach($_POST as $key => $value) {
        if ((!($key == 'install')) && (!($key == 'installData')) && (!($key == 'submit'))) {
            $installData[$key] = $value;
        }
    }

    $tpl = new Template;
    $tpl->set('title',	    'AllianceCMS: Installation');
    $tpl->set('author',	    'jburns131');
    $tpl->set('styleSheet',	BASE_URL . 'themes/core/emplode/css/style.css');

    $body = new Template(dirname(__FILE__) . DS . 'views' . DS . 'siteConfirmInstall.tpl.php');
    $body->set('images',      BASE_URL . 'themes/core/emplode/images');
    $body->set('formHelper',  $formHelper);
    $body->set('installData', $installData);

    foreach($_POST as $attribute => $value) {
        if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
            $body->set($attribute, $value);
        }
    }

    $menu[0] = new Template(dirname(__FILE__) . DS . 'views' . DS . 'menu.tpl.php');
    $menu[0]->set('installStage', '8');
    $menu[0]->set('images',       BASE_URL . 'themes/core/emplode/images');

    $tpl->set('body', $body);
    $tpl->set('menu', $menu);

    echo $tpl->fetch(dirname(__FILE__) . DS . 'views' . DS . 'theme.tpl.php');
    exit;
}

// Create route for Installation: Complete Installation page
$pluginRoutes['Install']['Complete Installation']['name'] = 'install_complete_installation'; // Required: Route name
$pluginRoutes['Install']['Complete Installation']['path'] = '/install/complete-installation'; // Required: Route path
$pluginRoutes['Install']['Complete Installation']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Complete Installation']['specs']['values'] = [
    'controller' => 'install_complete_installation',
    'method' => ['POST'],
]; // Required: Callback function = controller

// Installation: Complete Installation controller
function install_complete_installation($routeValues)
{
    /*
    echo '<br /><pre>$routeValues: ';
    echo print_r($routeValues);
    echo '</pre><br />';
    //*/

    //*
    echo '<br /><pre>$_POST: ';
    echo print_r($_POST);
    echo '</pre><br />';
    //exit;
    //*/

    /*
    // Template testing code

    $arr = get_defined_vars();

    echo '<br /><pre>$arr: ';
    echo print_r($arr);
    echo '</pre><br />';
    //*/

    // Complete Installation

    //*
    // Create Database Tables
    // If Clean Installation: Go To 'cleanup.php' File That Deletes 'Install.php', Fixes File Permissions And Links To Main Site
    // If Dirty Installation: Drop Everything From Database And Verify Database Connection Info

    if (!defined('DB_SOFTWARE')) {
        require_once('install.dbConnection.php');
        require_once('install.core.php');
        require_once('install.data.php');
    }

    // Installation Complete Page

    // Create FormHelper object for use in templates
    $formHelper = new FormHelper();

    $tpl = new Template;
    $tpl->set('title',	    'AllianceCMS: Installation');
    $tpl->set('author',	    'jburns131');
    $tpl->set('styleSheet',	BASE_URL . 'themes/core/emplode/css/style.css');

    $body = new Template(dirname(__FILE__) . DS . 'views' . DS . 'installComplete.tpl.php');
    $body->set('images',     BASE_URL . 'themes/core/emplode/images');
    $body->set('formHelper', $formHelper);

    $menu[0] = new Template(dirname(__FILE__) . DS . 'views' . DS . 'menu.tpl.php');
    $menu[0]->set('installStage', '9');
    $menu[0]->set('images',       BASE_URL . 'themes/core/emplode/images');

    $tpl->set('body', $body);
    $tpl->set('menu', $menu);

    echo $tpl->fetch(dirname(__FILE__) . DS . 'views' . DS . 'theme.tpl.php');
    exit;
}
