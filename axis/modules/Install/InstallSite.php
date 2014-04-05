<?php
namespace Install;

use Acms\Core\Application;
use Acms\Core\Components\Installer;
use Acms\Core\Templates\Template;
use Acms\Core\Html\FormHelper;
use Acms\Core\Data\Security;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * @todo: Multiple Items
 *     - Filter/Validate all $_POST/$_GET data
 *         - Validate 'Venue Name'
 *             - use blacklist to prevent using reserved words
 *             - make sure there are no symbols other than dashes (spaces will be converted to dashes)
 *             - can not begin with a number
 *         - go over every input field and validate correctly
 *             - dbName, adminLogin, etc...
 *             - contains spaces/numbers/symbols?
 *         - Validate form data using javascript (matching passwords, valid 'Venue Name', etc...)
 *
 *     - Parse $schema array and check for/throw error before sending them to Db::someMethod
 *
 *     - Forms: Add links/tooltips to "help info" for individual form fields (Venue Name will describe what a venue name is, how it's used, and valid examples)
 *
 *     - Change naming scheme of variables (from camelCase to use_underscores). Need to change it in actions and views
 */

class InstallSite
{
    private $app;
    private $tpl;
    private $content;
    private $menu;

    public function __construct(Application $app)
    {
        $this->app = $app;

        /*
        echo '<br /><pre>$this->app: ';
        echo var_dump($this->app['paths']->all());
        echo '</pre><br />';
        //exit;
        //*/

        /*
         $var_array = get_defined_vars();
        //*/

        /*
        echo '<br /><pre>$var_array: ';
        echo var_dump($var_array);
        echo '</pre><br />';
        exit;
        //*/
    }

    // Installation Welcome Page action
    public function installWelcome()
    {
        $missingZone = null;

        $serverPathArray = explode('.', $_SERVER['SERVER_NAME']);

        if (((count($serverPathArray)) < 3) || ($serverPathArray[0] == 'www')) {
            if (file_exists($this->app['paths']->get('dir.zones') . $_SERVER['SERVER_NAME'])) {
                $moduleZones = $this->app['paths']->get('dir.zones') . $_SERVER['SERVER_NAME'] . DIRECTORY_SEPARATOR . 'modules';
            } else {
                $moduleZones = $this->app['paths']->get('dir.zones') . 'default' . DIRECTORY_SEPARATOR . 'modules';
            }
        } else {
            // This is a subdomain, check for zone folder
            if (!file_exists($this->app['paths']->get('dir.zones') . $_SERVER['SERVER_NAME'])) {
                $missingZone = 1;
            }
        }

        if (isset($missingZone)) {

            // Create FormHelper object for use in templates
            $formHelper = new FormHelper($this->app['paths']->get('url.base'));

            $this->startTemplate();
            $this->createBody('welcomeWarnings.tpl.php');

            // Send formHelper to template
            $this->content->set('formHelper', $formHelper);

            // Send error to template
            $this->content->set('missingZone', $missingZone);

            $this->createMenu('1');
            $this->renderTemplate();

            exit;
        }

        // Installation Welcome Screen

        // Create FormHelper object for use in templates
        $formHelper = new FormHelper($this->app['paths']->get('url.base'));

        // Setup theme template (only Install module should have to do this, once installed axis will take care of this)
        $this->startTemplate();

        // Setup content for module template
        $this->createBody('welcome.tpl.php');

        // Send formHelper to template
        $this->content->set('formHelper', $formHelper);

        // Create menu template
        $this->createMenu('0');

        // Pass content and menu template to theme template (only Install module should have to do this, once installed axis will take care of this)
        // Render theme template (only Install module should have to do this, once installed axis will take care of this)
        $this->renderTemplate();

        exit;
    }

    // Installation: Language Page action
    public function installLanguage()
    {
        // Select Language

        // Create FormHelper object for use in templates
        $formHelper = new FormHelper($this->app['paths']->get('url.base'));

        $this->startTemplate();
        $this->createBody('language.tpl.php');

        // Send formHelper to template
        $this->content->set('formHelper', $formHelper);

        // Setup any form data that's in $_POST
        foreach ($_POST as $key => $value) {
            if ((! ($key == 'install')) && (! ($key == 'formData')) && (! ($key == 'submit'))) {
                if (($value != '')) {
                    $formData[$key] = $value;
                }
            }
        }

        // Send $formData to module template if it exists
        if (! empty($formData)) {
            $this->content->set('formData', $formData);
        }

        $this->createMenu('1');
        $this->renderTemplate();

        exit;
    }

    // Installation: Database Info action
    public function installDbInfo()
    {
        /*
        echo '<br /><pre>$this->app["request"]: ';
        echo print_r($this->app['request']);
        echo '</pre><br />';
        //exit;
        //*/

        $request = $this->app['request'];

        // Prompt For DB Info

        // Create FormHelper object for use in templates
        $formHelper = new FormHelper($this->app['paths']->get('url.base'));

        $this->startTemplate();
        $this->createBody('dbInfo.tpl.php');

        // If installConfirmDbInfo found empty required fields, then process errors sent back to this action
        if ($request->query->get('formErrors')) {

            $formData = $formHelper->processErrors($request->query->all());

            if (!empty($formData)) {
                foreach($formData as $attribute => $value) {
                    $this->content->set($attribute, $value);
                }
            }
        } else {

            $formData['dbHost']       = 'localhost';
            $formData['dbUserName']       = 'root';
            $formData['dbDatabasePrefix'] = 'a_';
            $formData['firstIteration'] = '1';

            // Setup any form data that is in $_POST
            foreach($_POST as $key => $value) {
                if ((!($key == 'install')) && (!($key == 'formData')) && (!($key == 'submit')) && (!($key == 'formErrors'))) {
                    if (($value != '')) {
                        $formData[$key] = $value;
                    }
                }
            }
        }

        // Send $formData to module template if it exists
        if (isset($formData)) {
            $this->content->set('formData', $formData);
        };

        // Send formHelper to template
        $this->content->set('formHelper', $formHelper);

        $this->createMenu('2');
        $this->renderTemplate();

        exit;
    }

    // Installation: Confirm Database Info action
    public function installConfirmDbInfo()
    {
        // Confirm DB Info

        // Create FormHelper object for use in templates
        $formHelper = new FormHelper($this->app['paths']->get('url.base'));

        // Check for missing required fields
        $requiredFields = [
            'dbHost',
            'dbUserName',
            'dbDatabase',
        ];

        $formHelper->checkRequired($requiredFields);

        $formHelper->sendErrors('/install/database-info');

        // There are no missing required fields

        // Setup any form data that's in $_POST (exclude any data that's not pertinent to the installation)
        foreach($_POST as $key => $value) {
            if ((!($key == 'install'))
                && (!($key == 'formData'))
                && (!($key == 'submit'))
                && (!($key == 'firstIteration')))
                {

                if (($value != '')) {
                    $formData[$key] = $value;
                }
            }
        }

        $this->startTemplate();
        $this->createBody('dbConfirm.tpl.php');

        // Send formHelper to template
        $this->content->set('formHelper', $formHelper);

        // Send $formData to template
        $this->content->set('formData', $formData);

        // Set template vars from $_POST
        foreach($_POST as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'formData')) && (!($attribute == 'submit'))) {
                if ($value != '') {
                    $this->content->set($attribute, $value);
                }
            }
        }

        $this->createMenu('3');
        $this->renderTemplate();

        exit;
    }

    // Installation: Test Connection Info action
    public function installTestDbConnection()
    {
        // Test/Confirm DB Connection

        // Create database object for testing purposes
        //$sql = new \Acms\Core\Data\Db;

        $sql = $this->app['model'];

        // Setup db connection variables
        // Started this because there was an error if the password was null,
        // then decided we might as well do this for all $_POST elements)
        if (isset($_POST['dbAdapter'])) {
            $dbAdapter = $_POST['dbAdapter'];
        } else {
            $dbAdapter = '';
        }

        if (isset($_POST['dbHost'])) {
            $dbHost = $_POST['dbHost'];
        } else {
            $dbHost = '';
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

        if (isset($_POST['dbDatabasePrefix'])) {
            $dbPrefix = $_POST['dbDatabasePrefix'];
        } else {
            $dbPrefix = '';
        }

        if (isset($_POST['dbCreateDatabase']) && ($_POST['dbCreateDatabase'] == '1')) {
            $dbCreateDatabase = 1;

            $sql->dbConnect(
                $dbAdapter,
                $dbHost,
                '',
                $dbUserName,
                $dbPassword
            );
        } else {
            $dbCreateDatabase = '';

            $sql->dbConnect(
                $dbAdapter,
                $dbHost,
                $dbDatabase,
                $dbUserName,
                $dbPassword
            );
        }

        if ($sql->dbValidConnection()) {
            $validConnection = 1;
        } else {
            $validConnection = '';
        }

        // End DB Connection Test

        // Setup any form data that's in $_POST
        foreach($_POST as $key => $value) {
            if ((!($key == 'install')) && (!($key == 'formData')) && (!($key == 'submit'))) {
                $formData[$key] = $value;
            }
        }

        // Create FormHelper object for use in templates
        $formHelper = new FormHelper($this->app['paths']->get('url.base'));

        $this->startTemplate();
        $this->createBody('dbTestConfirm.tpl.php');

        // Send formHelper to template
        $this->content->set('formHelper', $formHelper);

        // Send $formData to template
        $this->content->set('formData',     $formData);

        // Send $validConnection to template
        $this->content->set('validConnection', $validConnection);
        $this->content->set('dbCreateDatabase', $dbCreateDatabase);

        // Set template vars from $_POST
        foreach($_POST as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'formData')) && (!($attribute == 'submit'))) {
                $this->content->set($attribute, $value);
            }
        }

        $this->createMenu('3');
        $this->renderTemplate();

        exit;
    }

    // Installation: Admin Info action
    public function installAdminInfo()
    {
        // Prompt For Admin Info

        $request = $this->app['request'];

        // Create FormHelper object for use in templates
        $formHelper = new FormHelper($this->app['paths']->get('url.base'));

        $this->startTemplate();
        $this->createBody('adminInfo.tpl.php');

        // If installConfirmAdminInfo found empty required fields, then process errors sent back to this action
        if ($request->query->get('formErrors')) {

            $formData = $formHelper->processErrors($request->query->all());

            if (!empty($formData)) {
                foreach($formData as $attribute => $value) {
                    $this->content->set($attribute, $value);
                }
            }
        } else {
            $formData['firstIteration'] = '1';

            // Setup any form data that is in $_POST
            foreach($_POST as $key => $value) {
                if ((!($key == 'install')) && (!($key == 'formData')) && (!($key == 'submit'))) {
                    if (($value != '')) {
                        $formData[$key] = $value;
                    }
                }
            }
        }

        // Send $formData to module template if it exists
        if (isset($formData)) {
            $this->content->set('formData', $formData);
        };

        // Send formHelper to template
        $this->content->set('formHelper', $formHelper);

        $this->createMenu('4');
        $this->renderTemplate();

        exit;
    }

    // Installation: Confirm Admin Info action
    public function installConfirmAdminInfo()
    {
        // Confirm Admin Info

        // Create FormHelper object for use in templates
        $formHelper = new FormHelper($this->app['paths']->get('url.base'));

        // Check for missing required fields
        $requiredFields = [
            'adminLoginName',
            'adminPassword',
            'adminConfirmPassword',
            'adminEmail',
            'adminConfirmEmail',
        ];

        $matchingFields = [
            'adminPassword' => 'adminConfirmPassword',
            'adminEmail' => 'adminConfirmEmail',
        ];

        $validateFields = [
            'adminEmail' => $formHelper->isValidEmail(),
        ];

        $formHelper->checkRequired($requiredFields);
        $formHelper->checkMatches($matchingFields);
        $formHelper->checkRegex($validateFields);

        $formHelper->sendErrors('/install/admin-info');

        // There are no form input errors

        // Setup any form data that's in $_POST
        foreach($_POST as $key => $value) {
        	if ((!($key == 'install'))
        	   && (!($key == 'formData'))
        	   && (!($key == 'submit'))
               && (!($key == 'firstIteration')))
        	{
        	    $formData[$key] = $value;
            }
        }

        $this->startTemplate();
        $this->createBody('adminConfirm.tpl.php');

        // Send formHelper to template
        $this->content->set('formHelper', $formHelper);

        // Send $formData to template
        $this->content->set('formData', $formData);

        // Set template vars from $_POST
        foreach($_POST as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'formData')) && (!($attribute == 'submit'))) {
                if ($value != '') {
                    $this->content->set($attribute, $value);
                }
            }
        }

        $this->createMenu('5');
        $this->renderTemplate();

        exit;
    }

    // Installation: Venue Info action
    public function installVenueInfo()
    {
        // Prompt For Venue Info

        $request = $this->app['request'];

        // Create FormHelper object for use in templates
        $formHelper = new FormHelper($this->app['paths']->get('url.base'));

        $this->startTemplate();
        $this->createBody('venueInfo.tpl.php');

        // If installConfirmVenueInfo found empty required fields, then process errors sent back to this action
        if ($request->query->get('formErrors')) {

            $formData = $formHelper->processErrors($request->query->all());

            if (!empty($formData)) {
                foreach($formData as $attribute => $value) {
                    $this->content->set($attribute, $value);
                }
            }
        } else {
            $formData['firstIteration'] = '1';

            // Setup any form data that is in $_POST
            foreach($_POST as $key => $value) {
                if ((!($key == 'install')) && (!($key == 'formData')) && (!($key == 'submit'))) {
                    if (($value != '')) {
                        $formData[$key] = $value;
                    }
                }
            }
        }

        // Send $formData to module template if it exists
        if (isset($formData)) {
            $this->content->set('formData', $formData);
        };

        // Send formHelper to template
        $this->content->set('formHelper', $formHelper);

        $this->createMenu('6');
        $this->renderTemplate();

        exit;
    }

    // Installation: Confirm Venue Info action
    public function installConfirmVenueInfo()
    {
        // Confirm Venue Info

        // Create FormHelper object for use in templates
        $formHelper = new FormHelper($this->app['paths']->get('url.base'));

        // Check for missing required fields
        $requiredFields = [
            'venueLabel',
            'venueEmail',
            'venueConfirmEmail',
        ];

        $matchingFields = [
            'venueEmail' => 'venueConfirmEmail',
        ];

        $alterFields = [
            ['venueLabel', '/^\s+|\s+$/', ''],
        ];

        $formHelper->alterRegex($alterFields);

        $validateFields = [
            'venueLabel' => '/^[A-z]+[A-z0-9\s-]+[A-z0-9]$/',
            'venueEmail' => $formHelper->isValidEmail(),
        ];

        $formHelper->checkRequired($requiredFields);
        $formHelper->checkMatches($matchingFields);
        $formHelper->checkRegex($validateFields);

        $formHelper->sendErrors('/install/venue-info');

        $alterFields = [
            ['venueLabel', '/\s+/', '-'],
        ];

        $formHelper->alterRegex($alterFields);

        $_POST['venueLabel'] = ucwords($_POST['venueLabel']);

        // There are no missing required fields or form input errors

        // Setup any installation data that's in $_POST
        foreach($_POST as $key => $value) {
            if ((!($key == 'install'))
                && (!($key == 'formData'))
                && (!($key == 'submit'))
                && (!($key == 'firstIteration')))
            {
                $formData[$key] = $value;
            }
        }

        $this->startTemplate();
        $this->createBody('venueConfirm.tpl.php');

        // Send formHelper to template
        $this->content->set('formHelper', $formHelper);

        // Send $formData to template
        $this->content->set('formData', $formData);

        // Set template vars from $_POST
        foreach($_POST as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'formData')) && (!($attribute == 'submit'))) {
                if ($value != '') {
                    $this->content->set($attribute, $value);
                }
            }
        }

        $this->createMenu('5');
        $this->renderTemplate();

        exit;
    }

    // Installation: Confirm Installation action
    public function installConfirmInstallation()
    {
        // ok To Install?

        // Create FormHelper object for use in templates
        $formHelper = new FormHelper($this->app['paths']->get('url.base'));

        // Setup any installation data that's in $_POST
        foreach($_POST as $key => $value) {
            if ((!($key == 'install')) && (!($key == 'formData')) && (!($key == 'submit'))) {
                $formData[$key] = $value;
            }
        }

        $this->startTemplate();
        $this->createBody('confirmInstall.tpl.php');

        // Send formHelper to template
        $this->content->set('formHelper', $formHelper);

        // Send $formData to template
        $this->content->set('formData', $formData);

        // Set template vars from $_POST
        foreach($_POST as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'formData')) && (!($attribute == 'submit'))) {
                $this->content->set($attribute, $value);
            }
        }

        $this->createMenu('8');
        $this->renderTemplate();

        exit;
    }

    // Installation: Complete Installation action
    public function installCompleteInstallation()
    {
        // Complete Installation

        $installer = new Installer($this->app);
        $security = new Security();
        $filesystem = new Filesystem();

        // Create Database Tables
        // ??? From Old Code Base ??? If Clean Installation: Go To 'cleanup.php' File That Deletes 'Install.php', Fixes File Permissions And Links To Main Venue
        // ??? From Old Code Base ??? If Dirty Installation: Drop Everything From Database And Verify Database Connection Info

        // Create database if requested, create tables, insert data into table fields
        //if (!defined('DB_SOFTWARE')) {
            require_once('install.data.php');
            require_once('create.dbConnection.php');
        //}

        // Login Admin
        $this->loginAdmin($_POST['adminLoginName'], $_POST['adminPassword']);

        // Installation Complete Page

        // Create FormHelper object for use in templates
        $formHelper = new FormHelper($this->app['paths']->get('url.base'));

        $this->startTemplate();
        $this->createBody('installComplete.tpl.php');

        // Send formHelper to template
        $this->content->set('formHelper', $formHelper);
        $this->content->set('dumpFileSuccess', $dumpFileSuccess);
        $this->content->set('chmodSuccess', $chmodSuccess);

        $this->createMenu('9');
        $this->renderTemplate();

        exit;
    }

    private function loginAdmin($loginName, $password)
    {
        $sql = $this->app['model'];
        $security = new Security();

        // Setup db connection variables
        // Started this because there was an error if the password was null,
        // then decided we might as well do this for all $_POST elements)
        if (isset($_POST['dbAdapter'])) {
            $dbAdapter = $_POST['dbAdapter'];
        } else {
            $dbAdapter = '';
        }

        if (isset($_POST['dbHost'])) {
            $dbHost = $_POST['dbHost'];
        } else {
            $dbHost = '';
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

        if (isset($_POST['dbDatabasePrefix'])) {
            $dbPrefix = $_POST['dbDatabasePrefix'];
        } else {
            $dbPrefix = '';
        }

        $sql->dbConnect(
            $dbAdapter,
            $dbHost,
            $dbDatabase,
            $dbUserName,
            $dbPassword
        );

        // Setup Session
        $sessionAxis = include $this->app['paths']->get('dir.vendor') . '/aura/session/scripts/instance.php';
        $sessionAxis->start();
        $segmentUser = $sessionAxis->newSegment('User');
        $segmentUser->display_name = $loginName;
        $sessionAxis->commit();

        $acms_id = crypt($loginName, $security->randomBlowfishSalt());

        $tableColumns = [
            'acms_id' => $acms_id,
            'modified' => date("Y-m-d H:i:s", time()),
        ];

        $conditions = 'id = :id';
        $bind = ['id' => intval(1)];

        $sql->dbUpdate('users', $tableColumns, $conditions, $bind, $dbPrefix);

        setcookie($_SERVER['SERVER_NAME'] . '_acms', $acms_id, 0, '/', $_SERVER['SERVER_NAME']);
    }

    private function startTemplate()
    {
        // Setup theme template (only Install module should have to do this, once installed axis will take care of this)
        $this->tpl = new Template();
        $this->tpl->set('title', 'AllianceCMS: Installation');
        $this->tpl->set('author', 'AllianceCMS Dev Team');
        $this->tpl->set('theme_folder', $this->app['paths']->get('url.base') . '/' . 'themes/Emplode');

    }

    private function createBody($view)
    {
        // Setup content for module template
        $this->content = new Template(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $view);
        $this->content->set('theme_folder', $this->app['paths']->get('url.base') . '/' . 'themes/Emplode');

    }

    private function createMenu($stage)
    {
        // Create menu template
        $this->menu[0] = new Template(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'menu.tpl.php');
        $this->menu[0]->set('installStage', $stage);
        $this->menu[0]->set('theme_folder', $this->app['paths']->get('url.base') . '/' . 'themes/Emplode');

    }

    private function renderTemplate()
    {
        // Pass content and menu template to theme template (only Install module should have to do this, once installed axis will take care of this)
        $this->tpl->set('content', $this->content);
        $this->tpl->set('menu', $this->menu);

        // Render theme template (only Install module should have to do this, once installed axis will take care of this)
        echo $this->tpl->fetch(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'theme.tpl.php');
    }
}
