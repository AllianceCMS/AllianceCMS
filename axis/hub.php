<?php
require_once ('package/Acms.Core/src/Acms/Core/Bootstrap.php');
require_once ('config/system.php');
require_once (INCLUDES . 'required.php');
echo 'no error';
exit();

//
// STOPPED REFACTORING NEW CODE HERE
// STOPPED REFACTORING NEW CODE HERE
// STOPPED REFACTORING NEW CODE HERE
//

// Check to see if the database config file exists.
if (! file_exists(DBCONNFILE)) {

    // Go to the installation page if the dabase config file doesn't exist, and we're not already there.
    if (THIS_PATH != "install" . DS . "index.php") {
        header("Location: " . INSTALL . "index.php");
        exit();
    } else {

        // Execute this block only during site installation (doesn't matter which step of the installation we're on).

        // You can initialize any code needed for every page loaded. Ask yourself, "Does this code really need to run on every page load?".
        // Maybe add session data here?

        // Will initialize helpers in Controller Actions
        $htmlHelper = new HtmlHelper();
        $formHelper = new HtmlFormHelper();
    }
} else
    if (SITE_MAINTENANCE_FLAG == 2) {

        // If the site maintenance flag is set, display the "Site Down" page.

        header("Location: " . ADMIN . "sitedown.php");
        exit();
    } else {

        // Execute this block if the database config file exists, and the site is not down for maintenance.

        // You can initialize any code needed for every page loaded. Ask yourself, "Does this code really need to run on every page load?".
        // Maybe add session data here?

        if (isset($_GET['site_name'])) {

            // This means that the user is trying to access a specific site.
            // echo "User is trying to access a specific site.";

            // echo "\$_GET['site_name'] = ".$_GET['site_name']."<br /><br />";
            // exit;

            $sql->dbSelect("sites", "id, name", "name = '{$_GET['site_name']}'");
            $row = $sql->dbFetch();

            // echo "\$row->fields = {$row->fields}<br /><br />";

            if (is_array($row->fields)) {

                // The requested site exists.
                // echo "You are trying to enter a site that exists.";

                $site_id = $row->fields['id'];
                $site_name = $_GET['site_name'];
            } else {

                // The requested site doesn't exists.
                // echo "You are trying to enter a site that doesn't exist.";

                // *** NEED TO REDIRECT USER TO "Site Doesn't Exists/Create Site" PAGE, WHICH WILL EITHER ASK THE USER TO CHECK FOR
                // *** CORRECT SPELLING, OR ASK THE USER IF THEY WANT TO CREATE A SITE

                header("Location: " . BASE_DIR . "sites" . DS . "index.php?site_does_not_exist=2&requested_site_name={$_GET['site_name']}");
                exit();

                // $site_id = $row->fields['id'];
                // $site_id = 1;
            }
        } else {

            // No site_name was provided in the $_GET array keys
            // Enter the core site's home page
            $site_id = 1;
        }

        require_once (INCLUDES . "setup_site.php");

        // Will initialize helpers in Controller Actions
        // *** NEED TO CREATE A CLASS THAT USERS CAN CALL IN A CONTROLLER'S ACTION, WHICH WILL ALLOW THE USER TO INCLUDE ONLY THE HELPERS
        // *** THAT ARE NEEDED. THIS WILL CUT DOWN ON LOADING TIMES BY LOADING ONLY THE FEATURES THAT USERS WILL NEED FOR THAT SPECIFIC
        // *** ACTION/VIEW

        $htmlHelper = new HtmlHelper();
        $formHelper = new HtmlFormHelper();
    }
