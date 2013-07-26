<?php
namespace Install;

use Acms\Core\Templates\Template;
use Acms\Core\Html\FormHelper;

/**
 * Things to fix:
 *     - *** COMPLETE *** Instead of sending css/image paths to theme.tpl.php, send $theme_folder and change calls in templates
 *     - Put any repeated code into functions/methods:
 *         *** COMPLETE *** template creation
 *         *** COMPLETE *** template rendering
 *         *** COMPLETE *** setup menu
 *         *** COMPLETE *** instantiate FormHelper
 *         process errors
 *     - Validate 'Venue Name' (make sure there are no numbers/symbols
 *     - Filter/Validate all $_POST data
 *     - Parse $schema array and check for/throw error before sending them to Db::someMethod
 *     - Validate form data using javascript (matching passwords, valid 'Venue Name', etc...)
 *     - Forms: Add links to help info for individual form fields (Venue Name will discribe what a venue name is, how it works, and valid examples)
 */

class InstallSite
{
    private $tpl;
    private $body;
    private $menu;

    // Installation Welcome Page action
    public function installWelcome($routeValues)
    {
        // Installation Welcome Screen

        // Setup theme template (only Install plugin should have to do this, once installed axis will take care of this)
        $this->startTemplate();

        // Setup body of plugin template
        $this->createBody('welcome.tpl.php');

        // Create menu template
        $this->createMenu('0');

        // Pass body and menu template to theme template (only Install plugin should have to do this, once installed axis will take care of this)
        // Render theme template (only Install plugin should have to do this, once installed axis will take care of this)
        $this->renderTemplate();

        exit;
    }

    // Installation: Language Page action
    public function installLanguage($routeValues)
    {
        // Select Language

        $this->startTemplate();
        $this->createBody('language.tpl.php');

        // Setup any installation data that's in $_POST
        foreach ($_POST as $key => $value) {
            if ((! ($key == 'install')) && (! ($key == 'installData')) && (! ($key == 'submit'))) {
                if (($value != '')) {
                    $installData[$key] = $value;
                }
            }
        }

        // Send $installData to plugin template if it exists
        if (! empty($installData)) {
            $this->body->set('installData', $installData);
        }

        $this->createMenu('1');
        $this->renderTemplate();

        exit;
    }

    // Installation: Database Info action
    public function installDbInfo($routeValues)
    {
        // Prompt For DB Info

        // If confirm_database_info found empty required fields, then process errors sent back to this action
        if (isset($routeValues['errors'])) {
            // Break down 'errors' route value into error array
            foreach ($routeValues['errors'] as $value) {
                $errorsArray[] = explode('.', $value);
            }

            // Setup associative array so we can parse it and send it to the template via Template::set
            if (isset($errorsArray)) {
                foreach ($errorsArray as $valueArray) {
                    // Convert |_| back to periods, and convert |-| back to / (if not, URLs will break routing)
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

        $this->startTemplate();
        $this->createBody('dbInfo.tpl.php');

        // Send $installData to plugin template if it exists
        if (isset($installData)) {
            $this->body->set('installData', $installData);
        };

        // If there are any errors (sent from 'confirm_db_info' page), set template vars from 'errors' route value
        if (isset($errors)) {
            foreach($errors as $attribute => $value) {
                if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                    if (($value != '')) {
                        $this->body->set($attribute, $value);
                    }
                }
            }
        }

        $this->createMenu('2');
        $this->renderTemplate();

        exit;
    }

    // Installation: Confirm Database Info action
    public function installConfirmDbInfo($routeValues)
    {
        // Confirm DB Info

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
                        // Convert periods to |_|, and convert / to |-| (if not, URLs will break routing)
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

            $this->startTemplate();
            $this->createBody('dbConfirm.tpl.php');

            // Send $installData to template
            $this->body->set('installData', $installData);

            // Set template vars from $_POST
            foreach($_POST as $attribute => $value) {
                if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                    if ($value != '') {
                        $this->body->set($attribute, $value);
                    }
                }
            }

            $this->createMenu('3');
            $this->renderTemplate();
        }
        exit;
    }

    // Installation: Test Connection Info action
    public function installTestDbConnection($routeValues)
    {
        // Test/Confirm DB Connection

        // Create database object for testing purposes
        $sql = new \Acms\Core\Data\Db;

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

        if (isset($_POST['dbDatabasePrefix'])) {
            $dbPrefix = $_POST['dbDatabasePrefix'];
        } else {
            $dbPrefix = '';
        }

        if (isset($_POST['dbCreateDatabase']) && ($_POST['dbCreateDatabase'] == '1')) {
            $sql->dbConnect(
                $dbAdapter,
                $dbHostName,
                '',
                $dbUserName,
                $dbPassword
            );
        } else {
            $sql->dbConnect(
                $dbAdapter,
                $dbHostName,
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

        // Setup any installation data that's in $_POST
        foreach($_POST as $key => $value) {
            if ((!($key == 'install')) && (!($key == 'installData')) && (!($key == 'submit'))) {
                $installData[$key] = $value;
            }
        }

        $this->startTemplate();
        $this->createBody('dbTestConfirm.tpl.php');

        // Send $installData to template
        $this->body->set('installData',     $installData);
        // Send $validConnection to template
        $this->body->set('validConnection', $validConnection);

        // Set template vars from $_POST
        foreach($_POST as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                $this->body->set($attribute, $value);
            }
        }

        $this->createMenu('3');
        $this->renderTemplate();

        exit;
    }

    // Installation: Admin Info action
    public function installAdminInfo($routeValues)
    {
        // Prompt For Admin Info

        // If confirm_database_info found empty required fields, then process errors sent back to this action
        if (isset($routeValues['errors'])) {
            // Break down 'errors' route value into error array
            foreach ($routeValues['errors'] as $value) {
                $errorsArray[] = explode('.', $value);
            }

            // Setup associative array so we can parse it and send it to the template via Template::set
            if (isset($errorsArray)) {
                foreach ($errorsArray as $valueArray) {
                    // Convert |_| back to periods, and convert |-| back to / (if not, URLs will break routing)
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

        $this->startTemplate();
        $this->createBody('adminInfo.tpl.php');

        // Send $installData to plugin template if it exists
        if (isset($installData)) {
            $this->body->set('installData', $installData);
        }

        // If there are any errors (sent from 'confirm_admin_info' page), set template vars from 'errors' route value
        if (isset($errors)) {
            foreach($errors as $attribute => $value) {
                if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                    if (($value != '')) {
                        $this->body->set($attribute, $value);
                    }
                }
            }
        } else {
            // Set template vars from $_POST
            foreach($_POST as $attribute => $value) {
                if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                    $this->body->set($attribute, $value);
                }
            }
        }

        $this->createMenu('4');
        $this->renderTemplate();

        exit;
    }

    // Installation: Confirm Admin Info action
    public function installConfirmAdminInfo($routeValues)
    {
        // Confirm Admin Info

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
                        // Convert periods to |_|, and convert / to |-| (if not, URLs will break routing)
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

            $this->startTemplate();
            $this->createBody('adminConfirm.tpl.php');

            // Send $installData to template
            $this->body->set('installData', $installData);

            // Set template vars from $_POST
            foreach($_POST as $attribute => $value) {
                if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                    if ($value != '') {
                        $this->body->set($attribute, $value);
                    }
                }
            }

            $this->createMenu('5');
            $this->renderTemplate();
        }
        exit;
    }

    // Installation: Venue Info action
    public function installVenueInfo($routeValues)
    {
        // Prompt For Venue Info

        foreach($_POST as $key => $value) {
            if ((!($key == 'install')) && (!($key == 'installData')) && (!($key == 'submit'))) {
                $installData[$key] = $value;
            }
        }

        $this->startTemplate();
        $this->createBody('venueInfo.tpl.php');

        // Send $installData to template
        $this->body->set('installData', $installData);

        foreach($_POST as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                $this->body->set($attribute, $value);
            }
        }

        $this->createMenu('6');
        $this->renderTemplate();

        exit;
    }

    // Installation: Confirm Venue Info action
    public function installConfirmVenueInfo($routeValues)
    {
        // Confirm Venue Info

        // Setup any installation data that's in $_POST
        foreach($_POST as $key => $value) {
            if ((!($key == 'install')) && (!($key == 'installData')) && (!($key == 'submit'))) {
                $installData[$key] = $value;
            }
        }

        $this->startTemplate();
        $this->createBody('venueConfirm.tpl.php');

        // Send $installData to template
        $this->body->set('installData', $installData);

        // Set template vars from $_POST
        foreach($_POST as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                $this->body->set($attribute, $value);
            }
        }

        $this->createMenu('7');
        $this->renderTemplate();

        exit;
    }

    // Installation: Confirm Installation action
    public function installConfirmInstallation($routeValues)
    {
        // ok To Install?

        // Setup any installation data that's in $_POST
        foreach($_POST as $key => $value) {
            if ((!($key == 'install')) && (!($key == 'installData')) && (!($key == 'submit'))) {
                $installData[$key] = $value;
            }
        }

        $this->startTemplate();
        $this->createBody('venueConfirmInstall.tpl.php');

        // Send $installData to template
        $this->body->set('installData', $installData);

        // Set template vars from $_POST
        foreach($_POST as $attribute => $value) {
            if ((!($attribute == 'install')) && (!($attribute == 'installData')) && (!($attribute == 'submit'))) {
                $this->body->set($attribute, $value);
            }
        }

        $this->createMenu('8');
        $this->renderTemplate();

        exit;
    }

    // Installation: Complete Installation action
    public function installInstallationComplete($routeValues)
    {
        // Complete Installation

        // Create Database Tables
        // ??? From Old Code Base ??? If Clean Installation: Go To 'cleanup.php' File That Deletes 'Install.php', Fixes File Permissions And Links To Main Venue
        // ??? From Old Code Base ??? If Dirty Installation: Drop Everything From Database And Verify Database Connection Info

        // Create database if requested, create tables, insert data into table fields
        if (!defined('DB_SOFTWARE')) {
            require_once('install.data.php');
            require_once('create.dbConnection.php');
        }

        // Installation Complete Page

        $this->startTemplate();
        $this->createBody('installComplete.tpl.php');

        $this->createMenu('9');
        $this->renderTemplate();

        exit;
    }

    private function startTemplate()
    {
        // Setup theme template (only Install plugin should have to do this, once installed axis will take care of this)
        $this->tpl = new Template();
        $this->tpl->set('title', 'AllianceCMS: Installation');
        $this->tpl->set('author', 'AllianceCMS Dev Team');
        $this->tpl->set('theme_folder', BASE_URL . '/' . 'themes/core/emplode/');

    }

    private function createBody($view)
    {
        // Create FormHelper object for use in templates
        $formHelper = new FormHelper();

        // Setup body of plugin template
        $this->body = new Template(dirname(__FILE__) . DS . 'views' . DS . $view);
        $this->body->set('theme_folder', BASE_URL . '/' . 'themes/core/emplode/');
        $this->body->set('formHelper', $formHelper);

    }

    private function createMenu($stage)
    {
        // Create menu template
        $this->menu[0] = new Template(dirname(__FILE__) . DS . 'views' . DS . 'menu.tpl.php');
        $this->menu[0]->set('installStage', $stage);
        $this->menu[0]->set('theme_folder', BASE_URL . '/' . 'themes/core/emplode/');

    }

    private function renderTemplate()
    {
        // Pass body and menu template to theme template (only Install plugin should have to do this, once installed axis will take care of this)
        $this->tpl->set('body', $this->body);
        $this->tpl->set('menu', $this->menu);

        // Render theme template (only Install plugin should have to do this, once installed axis will take care of this)
        echo $this->tpl->fetch(dirname(__FILE__) . DS . 'views' . DS . 'theme.tpl.php');
    }
}
