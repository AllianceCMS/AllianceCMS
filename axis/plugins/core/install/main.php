<?php
use Acms\Core\Templates\Template;
use Acms\Core\Html\FormHelper;

$pluginRoutes['Install']['Start Installation']['name'] = 'install_welcome'; // Required: Route name
$pluginRoutes['Install']['Start Installation']['path'] = '/install'; // Required: Route path
$pluginRoutes['Install']['Start Installation']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Start Installation']['specs']['values'] = [
    'controller' => 'install_welcome',
]; // Required: Callback function

function install_welcome($routeValues)
{

    //*
    echo '<br /><pre>$routeValues: ';
    echo print_r($routeValues);
    echo '</pre><br />';
    //*/

    // Installation Welcome Screen
    $formHelper = new FormHelper();

    $tpl = new Template();
    $tpl->set('title', 'AllianceCMS: Installation');
    $tpl->set('author', 'AllianceCMS Dev Team');
    $tpl->set('styleSheet', BASE_URL . 'themes/core/emplode/css/style.css');

    $body = new Template(dirname(__FILE__) . DS . 'views' . DS . 'welcome.tpl.php');
    $body->set('images', BASE_URL . 'themes/core/emplode/images');
    $body->set('formHelper', $formHelper);

    $menu[0] = new Template(dirname(__FILE__) . DS . 'views' . DS . 'menu.tpl.php');
    $menu[0]->set('installStage', '0');
    $menu[0]->set('images', BASE_URL . 'themes/core/emplode/images');

    $tpl->set('body', $body);
    $tpl->set('menu', $menu);

    // echo $tpl->fetch(THEMES . DS . 'core' . DS . 'emplode' . DS . '/theme.tpl.php');

    echo $tpl->fetch(dirname(__FILE__) . DS . 'views' . DS . 'theme.tpl.php');
    exit;
}

$pluginRoutes['Install']['Select Language']['name'] = 'install'; // Required: Route name
$pluginRoutes['Install']['Select Language']['path'] = '/install/language'; // Required: Route path
$pluginRoutes['Install']['Select Language']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Select Language']['specs']['values'] = [
    'controller' => 'install_language',
    'method' => [
        'POST'
    ]
]; // Required: Callback function
function install_language($routeValues)
{

    //*
    echo '<br /><pre>$routeValues: ';
    echo print_r($routeValues);
    echo '</pre><br />';
    //*/

    //*
    echo '<br /><pre>$_POST: ';
    echo print_r($_POST);
    echo '</pre><br />';
    //*/

    // Select Language
    $formHelper = new FormHelper();

    $count = 0;
    foreach ($_POST as $key => $value) {
        if ((! ($key == 'install')) && (! ($key == 'installData')) && (! ($key == 'submit'))) {
            if (($value != '')) {
                $installData[$count] = [
                    $key => $value
                ];
                $count ++;
            }
        }
    }

    $tpl = new Template();
    $tpl->set('title', 'AllianceCMS: Installation');
    $tpl->set('author', 'Jesse Burns');
    $tpl->set('styleSheet', BASE_URL . 'themes/core/emplode/css/style.css');

    $body = new Template(dirname(__FILE__) . DS . 'views' . DS . 'language.tpl.php');
    $body->set('images', THEMES . 'emplode' . DS . 'images');
    $body->set('formHelper', $formHelper);

    if (! empty($installData)) {
        $body->set('installData', $installData);
    }

    $menu[0] = new Template(dirname(__FILE__) . DS . 'views' . DS . 'menu.tpl.php');
    $menu[0]->set('installStage', '1');
    $menu[0]->set('images', BASE_URL . 'themes/core/emplode/images');

    $tpl->set('body', $body);
    $tpl->set('menu', $menu);

    echo $tpl->fetch(dirname(__FILE__) . DS . 'views' . DS . 'theme.tpl.php');
    exit;
}
$pluginRoutes['Install']['Prompt For DB Info']['name'] = 'install_db_info'; // Required: Route name
$pluginRoutes['Install']['Prompt For DB Info']['path'] = '/install/database-info/{:errors*}'; // Required: Route path
$pluginRoutes['Install']['Prompt For DB Info']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Prompt For DB Info']['specs']['values'] = [
    'controller' => 'install_db_info',
    'method' => [
        'POST',
        'GET',
    ]
]; // Required: Callback function

function install_db_info($routeValues)
{

    //*
    echo '<br /><pre>$routeValues: ';
    echo print_r($routeValues);
    echo '</pre><br />';
    //*/

    //*
    echo '<br /><pre>$_POST: ';
    echo print_r($_POST);
    echo '</pre><br />';
    //*/

    // Prompt For DB Info
    $formHelper = new FormHelper();

    /*
    $count = 0;
    foreach($_POST as $key => $value) {
        if ((!($key == 'install')) && (!($key == 'installData')) && (!($key == 'submit'))) {
            if (($value != '')) {
                $installData[$count] = [$key => $value];
                $count++;
            }
        }
    }
    unset($count);
    //*/

    if (isset($routeValues['errors'])) {
        foreach ($routeValues['errors'] as $value) {

            $valuesArray[] = explode('.', $value);

        }

        if (isset($valuesArray)) {
            foreach ($valuesArray as $valueArray) {

                $errors[$valueArray[0]] = $valueArray[1];

            }
        } else {

            /*
            $installData['dbHostName']       = 'localhost';
            $installData['dbUserName']       = 'root';
            $installData['dbDatabasePrefix'] = 'a_';
            $installData['dbFirstIteration'] = '1';
            //*/

            //$body->set('firstIteration', '1');
        }
    }
    //*
    if (!isset($errors)) {
    //if ($errors[0] !== null) {
        $installData['dbHostName']       = 'localhost';
        $installData['dbUserName']       = 'root';
        $installData['dbDatabasePrefix'] = 'a_';
        $installData['dbFirstIteration'] = '1';
    }
    //*/

    //*
    $count = 0;
    foreach($_POST as $key => $value) {
        if ((!($key == 'install')) && (!($key == 'installData')) && (!($key == 'submit'))) {
            if (($value != '')) {
                $installData[$key] = $value;
                //$count++;
            }
        }
    }
    //unset($count);
    //*/

    /*
    $installData[] = ['dbHostName'       => 'localhost'];
    $installData[] = ['dbUserName'       => 'root'];
    $installData[] = ['dbDatabasePrefix' => 'a_'];
    $installData[] = ['dbFirstIteration' => '1'];
    //*/

    $tpl = new Template;
    $tpl->set('title',	    'AllianceCMS: Installation');
    $tpl->set('author',	    'jburns131');
    $tpl->set('styleSheet',	BASE_URL . 'themes/core/emplode/css/style.css');

    $body = new Template(dirname(__FILE__) . DS . 'views' . DS . 'dbInfo.tpl.php');
    $body->set('images',      BASE_URL . 'themes/core/emplode/images');
    $body->set('formHelper',  $formHelper);
    if (isset($installData)) {
        $body->set('installData', $installData);
    }
    //$body->set('routeValues', $routeValues);

    if (isset($errors)) {
        foreach($errors as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                if (($value != '')) {
                    $body->set($attribute, $value);
                }
            }
        }
    }

    $menu[0] = new Template(dirname(__FILE__) . DS . 'views' . DS . 'menu.tpl.php');
    $menu[0]->set('installStage', '2');
    $menu[0]->set('images',       BASE_URL . 'themes/core/emplode/images');

    $tpl->set('body', $body);
    $tpl->set('menu', $menu);

    echo $tpl->fetch(dirname(__FILE__) . DS . 'views' . DS . 'theme.tpl.php');
    exit;
}

$pluginRoutes['Install']['Confirm DB Info']['name'] = 'install'; // Required: Route name
$pluginRoutes['Install']['Confirm DB Info']['path'] = '/install/confirm-database-info'; // Required: Route path
$pluginRoutes['Install']['Confirm DB Info']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Confirm DB Info']['specs']['values'] = [
    'controller' => 'install_confirm_db_info',
    'method' => ['POST'],
]; // Required: Callback function

function install_confirm_db_info($routeValues)
{

    //*
    echo '<br /><pre>$routeValues: ';
    echo print_r($routeValues);
    echo '</pre><br />';
    //*/

    //*
    echo '<br /><pre>$_POST: ';
    echo print_r($_POST);
    echo '</pre><br />';
    //*/

    // Confirm DB Info
    $formHelper = new FormHelper();

    if (($_POST['dbHostName'] == '') ||
    ($_POST['dbUserName'] == '') ||
    ($_POST['dbDatabase'] == '')) {

        /*
        $errors = 'dbInfoError=1';

        foreach($_POST as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                if (!($value == '')) {
                    $errors .= '&{$attribute}={$value}';
                }
            }
        }
        //*/

        $errors = '/dbInfoError.' . intval(1);

        foreach($_POST as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                if (!($value == '')) {
                    $errors .= '/' . $attribute . '.' . $value;
                }
            }
        }

        //*
        echo '<br /><pre>$errors: ';
        echo print_r($errors);
        echo '</pre><br />';
        //*/

        //exit;
        header('Location: /install/database-info'.$errors);
        exit;
    } else {

        $count = 0;
        foreach($_POST as $key => $value) {
            if ((!($key == 'install')) && (!($key == 'installData')) && (!($key == 'submit'))) {
                if (($value != '')) {
                    $installData[$key] = $value;
                    //$count++;
                }
            }
        }
        //unset($count);

        $tpl = new Template;
        $tpl->set('title',	    'AllianceCMS: Installation');
        $tpl->set('author',	    'jburns131');
        $tpl->set('styleSheet',	BASE_URL . 'themes/core/emplode/css/style.css');

        $body = new Template(dirname(__FILE__) . DS . 'views' . DS . 'dbConfirm.tpl.php');
        $body->set('images',      BASE_URL . 'themes/core/emplode/images');
        $body->set('formHelper',  $formHelper);
        $body->set('installData', $installData);

        foreach($_POST as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                if ($value != '') {
                    $body->set($attribute, $value);
                }
            }
        }

        $menu[0] = new Template(dirname(__FILE__) . DS . 'views' . DS . 'menu.tpl.php');
        $menu[0]->set('installStage', '3');
        $menu[0]->set('images',       BASE_URL . 'themes/core/emplode/images');

        $tpl->set('body', $body);
        $tpl->set('menu', $menu);

        echo $tpl->fetch(dirname(__FILE__) . DS . 'views' . DS . 'theme.tpl.php');
    }
    exit;
}

/*
$pluginRoutes['Install']['Test/Confirm DB Connection']['name'] = 'install'; // Required: Route name
$pluginRoutes['Install']['Test/Confirm DB Connection']['path'] = '/install/test-database-info'; // Required: Route path
$pluginRoutes['Install']['Test/Confirm DB Connection']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Test/Confirm DB Connection']['specs']['values'] = [
    'controller' => 'install_start',
    'method' => ['POST'],
]; // Required: Callback function

$pluginRoutes['Install']['Prompt For Admin Info']['name'] = 'install'; // Required: Route name
$pluginRoutes['Install']['Prompt For Admin Info']['path'] = '/install'; // Required: Route path
$pluginRoutes['Install']['Prompt For Admin Info']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Prompt For Admin Info']['specs']['values'] = [
    'controller' => 'install_start',
    'method' => ['POST'],
]; // Required: Callback function

$pluginRoutes['Install']['Confirm Admin Info']['name'] = 'install'; // Required: Route name
$pluginRoutes['Install']['Confirm Admin Info']['path'] = '/install'; // Required: Route path
$pluginRoutes['Install']['Confirm Admin Info']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Confirm Admin Info']['specs']['values'] = [
    'controller' => 'install_start',
    'method' => ['POST'],
]; // Required: Callback function

$pluginRoutes['Install']['Prompt For Site Info']['name'] = 'install'; // Required: Route name
$pluginRoutes['Install']['Prompt For Site Info']['path'] = '/install'; // Required: Route path
$pluginRoutes['Install']['Prompt For Site Info']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Prompt For Site Info']['specs']['values'] = [
    'controller' => 'install_start',
    'method' => ['POST'],
]; // Required: Callback function

$pluginRoutes['Install']['Confirm Site Info']['name'] = 'install'; // Required: Route name
$pluginRoutes['Install']['Confirm Site Info']['path'] = '/install'; // Required: Route path
$pluginRoutes['Install']['Confirm Site Info']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Confirm Site Info']['specs']['values'] = [
    'controller' => 'install_start',
    'method' => ['POST'],
]; // Required: Callback function

$pluginRoutes['Install']['Confirm Installation']['name'] = 'install'; // Required: Route name
$pluginRoutes['Install']['Confirm Installation']['path'] = '/install'; // Required: Route path
$pluginRoutes['Install']['Confirm Installation']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Confirm Installation']['specs']['values'] = [
    'controller' => 'install_start',
    'method' => ['POST'],
]; // Required: Callback function

$pluginRoutes['Install']['Create Database Tables']['name'] = 'install'; // Required: Route name
$pluginRoutes['Install']['Create Database Tables']['path'] = '/install'; // Required: Route path
$pluginRoutes['Install']['Create Database Tables']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Create Database Tables']['specs']['values'] = [
    'controller' => 'install_start',
    'method' => ['POST'],
]; // Required: Callback function

$pluginRoutes['Install']['Install AllianceCMS']['name'] = 'install'; // Required: Route name
$pluginRoutes['Install']['Install AllianceCMS']['path'] = '/install'; // Required: Route path
$pluginRoutes['Install']['Install AllianceCMS']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Install AllianceCMS']['specs']['values'] = [
    'controller' => 'install_start',
    'method' => ['POST'],
]; // Required: Callback function

$pluginRoutes['Install']['Start Installation']['name'] = 'install'; // Required: Route name
$pluginRoutes['Install']['Start Installation']['path'] = '/install'; // Required: Route path
$pluginRoutes['Install']['Start Installation']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Install']['Start Installation']['specs']['values'] = [
    'controller' => 'install_start',
    'method' => ['POST'],
]; // Required: Callback function
//*/
