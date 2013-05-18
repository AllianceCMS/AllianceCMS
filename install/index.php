<?php

    require_once("../core.php");

    if (!defined('DB_TYPE')) {

        if (isset($_GET['dbInfoError'])) {

            // Report DB Info Errors

            $count = 0;
            foreach($_GET as $key => $value) {
                if ((!($key == "install")) && (!($key == "installData")) && (!($key == "submit"))) {
            	    if (($value != "")) {
                        $installData[$count] = array($key => $value);
                        $count++;
                    }
                }
            }
            unset($count);

            $tpl = new Template;
            $tpl->set("title",	    "AllianceCMS: Installation");
            $tpl->set("author",	    "jburns131");
            $tpl->set("styleSheet",	THEMES."emplode".DS."style.css");

            $body = new Template("views".DS."dbInfo.tpl.php");
            $body->set("images",      THEMES."emplode".DS."images");
            $body->set("formHelper",  $formHelper);
            $body->set("installData", $installData);

            foreach($_GET as $attribute => $value) {
                if ((!($attribute == "install")) && (!($attribute == "installData")) && (!($attribute == "submit"))) {
                    if (($value != "")) {
                        $body->set($attribute, $value);
                    }
                }
            }

            $menu[0] = new Template("views".DS."menu.tpl.php");
            $menu[0]->set("installStage", "2");
            $menu[0]->set("images",       THEMES."emplode".DS."images");

            $tpl->set("body", $body);
            $tpl->set("menu", $menu);

            echo $tpl->fetch("views".DS."index.tpl.php");

        } else if (isset($_GET['adminInfoError'])) {

            // Report Admin Info Errors

            $count = 0;
            foreach($_GET as $key => $value) {
                if ((!($key == "install")) && (!($key == "installData")) && (!($key == "submit"))) {
            	    if (($value != "")) {
                        $installData[$count] = array($key => $value);
                        $count++;
                    }
                }
            }
            unset($count);

            $tpl = new Template;
            $tpl->set("title",	    "AllianceCMS: Installation");
            $tpl->set("author",	    "jburns131");
            $tpl->set("styleSheet",	THEMES."emplode".DS."style.css");

            $body = new Template("views".DS."adminInfo.tpl.php");
            $body->set("images",     THEMES."emplode".DS."images");
            $body->set("formHelper", $formHelper);
            $body->set("installData", $installData);

            foreach($_GET as $attribute => $value) {
                if ((!($attribute == "install")) && (!($attribute == "installData")) && (!($attribute == "submit"))) {
                    if (($value != "")) {
                        $body->set($attribute, $value);
                    }
                }
            }

            $menu[0] = new Template("views".DS."menu.tpl.php");
            $menu[0]->set("installStage", "4");
            $menu[0]->set("images",       THEMES."emplode".DS."images");

            $tpl->set("body", $body);
            $tpl->set("menu", $menu);

            echo $tpl->fetch("views".DS."index.tpl.php");

        } else if (empty($_POST['install'])) {

            // Installation Welcome Screen

            $tpl = new Template;
            $tpl->set("title",	    "AllianceCMS: Installation");
            $tpl->set("author",	    "jburns131");
            $tpl->set("styleSheet",	THEMES."emplode".DS."style.css");

            $body = new Template("views".DS."welcome.tpl.php");
            $body->set("images",     THEMES."emplode".DS."images");
            $body->set("formHelper", $formHelper);

            $menu[0] = new Template("views".DS."menu.tpl.php");
            $menu[0]->set("installStage", "0");
            $menu[0]->set("images",       THEMES."emplode".DS."images");

            $tpl->set("body", $body);
            $tpl->set("menu", $menu);

            echo $tpl->fetch("views".DS."index.tpl.php");
        } else {
        	switch ($_POST['install']) {
                case 1:
                    // Select Language

                    $count = 0;
                    foreach($_POST as $key => $value) {
                        if ((!($key == "install")) && (!($key == "installData")) && (!($key == "submit"))) {
                    	    if (($value != "")) {
                                $installData[$count] = array($key => $value);
                                $count++;
                            }
                        }
                    }

                    $tpl = new Template;
                    $tpl->set("title",	    "AllianceCMS: Installation");
                    $tpl->set("author",	    "jburns131");
                    $tpl->set("styleSheet",	THEMES."emplode".DS."style.css");

                    $body = new Template("views".DS."language.tpl.php");
                    $body->set("images",      THEMES."emplode".DS."images");
                    $body->set("formHelper",  $formHelper);

                    if (!empty($installData)) {
                        $body->set("installData", $installData);
                    }

                    $menu[0] = new Template("views".DS."menu.tpl.php");
                    $menu[0]->set("installStage", "1");
                    $menu[0]->set("images",       THEMES."emplode".DS."images");

                    $tpl->set("body", $body);
                    $tpl->set("menu", $menu);

                    echo $tpl->fetch("views".DS."index.tpl.php");
                    break;
                case 2:
                    // Prompt For DB Info

                    $count = 0;
                    foreach($_POST as $key => $value) {
                        if ((!($key == "install")) && (!($key == "installData")) && (!($key == "submit"))) {
                    	    if (($value != "")) {
                                $installData[$count] = array($key => $value);
                                $count++;
                            }
                        }
                    }
                    unset($count);

                    $installData[] = array("dbHostName"       => "localhost");
                    $installData[] = array("dbUserName"       => "root");
                    $installData[] = array("dbDatabasePrefix" => "a_");
                    $installData[] = array("dbFirstIteration" => "1");

                    $tpl = new Template;
                    $tpl->set("title",	    "AllianceCMS: Installation");
                    $tpl->set("author",	    "jburns131");
                    $tpl->set("styleSheet",	THEMES."emplode".DS."style.css");

                    $body = new Template("views".DS."dbInfo.tpl.php");
                    $body->set("images",      THEMES."emplode".DS."images");
                    $body->set("formHelper",  $formHelper);
                    $body->set("installData", $installData);

                    foreach($_POST as $attribute => $value) {
                        if ((!($attribute == "install")) && (!($attribute == "installData")) && (!($attribute == "submit"))) {
                            if (($value != "")) {
                                $body->set($attribute, $value);
                            }
                        }
                    }

                    $menu[0] = new Template("views".DS."menu.tpl.php");
                    $menu[0]->set("installStage", "2");
                    $menu[0]->set("images",       THEMES."emplode".DS."images");

                    $tpl->set("body", $body);
                    $tpl->set("menu", $menu);

                    echo $tpl->fetch("views".DS."index.tpl.php");
                    break;
                case 3:
                    // Confirm DB Info

                    if (($_POST['dbHostName'] == "") ||
                        ($_POST['dbUserName'] == "") ||
                        ($_POST['dbDatabase'] == "")) {

                        $errors = "dbInfoError=1";

                        foreach($_POST as $attribute => $value) {
                            if ((!($attribute == "install")) && (!($attribute == "installData")) && (!($attribute == "submit"))) {
                                if (!($value == "")) {
                                    $errors .= "&{$attribute}={$value}";
                                }
                            }
                        }

                        header("Location: index.php?".$errors);
                        exit;
                    } else {

                        $count = 0;
                        foreach($_POST as $key => $value) {
                        	if ((!($key == "install")) && (!($key == "installData")) && (!($key == "submit"))) {
                        	    if (($value != "")) {
                                    $installData[$count] = array($key => $value);
                                    $count++;
                                }
                            }
                        }
                        unset($count);

                        $tpl = new Template;
                        $tpl->set("title",	    "AllianceCMS: Installation");
                        $tpl->set("author",	    "jburns131");
                        $tpl->set("styleSheet",	THEMES."emplode".DS."style.css");

                        $body = new Template("views".DS."dbConfirm.tpl.php");
                        $body->set("images",      THEMES."emplode".DS."images");
                        $body->set("formHelper",  $formHelper);
                        $body->set("installData", $installData);

                        foreach($_POST as $attribute => $value) {
                            if ((!($attribute == "install")) && (!($attribute == "installData")) && (!($attribute == "submit"))) {
                                if ($value != "") {
                                    $body->set($attribute, $value);
                                }
                            }
                        }

                        $menu[0] = new Template("views".DS."menu.tpl.php");
                        $menu[0]->set("installStage", "3");
                        $menu[0]->set("images",       THEMES."emplode".DS."images");

                        $tpl->set("body", $body);
                        $tpl->set("menu", $menu);

                        echo $tpl->fetch("views".DS."index.tpl.php");
                    }
                    break;
                case 4:

                    // Test/Confirm DB Connection

                	require_once(HANDLERS."db".DS."adodb".DS."adodb.inc.php");
				    $db = ADONewConnection($_POST['dbSoftware']);

				    if (isset($_POST['dbCreateDatabase']) && $_POST['dbCreateDatabase'] == 1) {
					    if ($db->Connect($_POST['dbHostName'], $_POST['dbUserName'], $_POST['dbPassword'])) {
					    	$validConnection = 1;
	                    } else {
	                        $validConnection = "";
	                    }
				    } else {
				    	if ($db->Connect($_POST['dbHostName'], $_POST['dbUserName'], $_POST['dbPassword'], $_POST['dbDatabase'])) {
					    	$validConnection = 1;
	                    } else {
	                        $validConnection = "";
	                    }
				    }

                    // End DB Connection Test

                    $count = 0;
                    foreach($_POST as $key => $value) {
                    	if ((!($key == "install")) && (!($key == "installData")) && (!($key == "submit"))) {
                    	    $installData[$count] = array($key => $value);
                            $count++;
                        }
                    }
                    unset($count);

                    $tpl = new Template;
                    $tpl->set("title",	    "AllianceCMS: Installation");
                    $tpl->set("author",	    "jburns131");
                    $tpl->set("styleSheet",	THEMES."emplode".DS."style.css");

                    $body = new Template("views".DS."dbTestConfirm.tpl.php");
                    $body->set("images",          THEMES."emplode".DS."images");
                    $body->set("formHelper",      $formHelper);
                    $body->set("installData",     $installData);
                    $body->set("validConnection", $validConnection);

                    foreach($_POST as $attribute => $value) {
                        if ((!($attribute == "install")) && (!($attribute == "installData")) && (!($attribute == "submit"))) {
                            $body->set($attribute, $value);
                        }
                    }

                    $menu[0] = new Template("views".DS."menu.tpl.php");
                    $menu[0]->set("installStage", "3");
                    $menu[0]->set("images",       THEMES."emplode".DS."images");

                    $tpl->set("body", $body);
                    $tpl->set("menu", $menu);

                    echo $tpl->fetch("views".DS."index.tpl.php");
                    break;
                case 5:
                    // Prompt For Admin Info

                    $count = 0;
                    foreach($_POST as $key => $value) {
                    	if ((!($key == "install")) && (!($key == "installData")) && (!($key == "submit"))) {
                    	    $installData[$count] = array($key => $value);
                            $count++;
                        }
                    }
                    unset($count);

                    $installData[] = array("adminFirstIteration" => "1");

                    $tpl = new Template;
                    $tpl->set("title",	    "AllianceCMS: Installation");
                    $tpl->set("author",	    "jburns131");
                    $tpl->set("styleSheet",	THEMES."emplode".DS."style.css");

                    $body = new Template("views".DS."adminInfo.tpl.php");
                    $body->set("images",      THEMES."emplode".DS."images");
                    $body->set("formHelper",  $formHelper);
                    $body->set("installData", $installData);

                    foreach($_POST as $attribute => $value) {
                        if ((!($attribute == "install")) && (!($attribute == "installData")) && (!($attribute == "submit"))) {
                            $body->set($attribute, $value);
                        }
                    }

                    $menu[0] = new Template("views".DS."menu.tpl.php");
                    $menu[0]->set("installStage", "4");
                    $menu[0]->set("images",       THEMES."emplode".DS."images");

                    $tpl->set("body", $body);
                    $tpl->set("menu", $menu);

                    echo $tpl->fetch("views".DS."index.tpl.php");
                    break;
                case 6:
                    // Confirm Admin Info

                    if ((($_POST['adminLoginName']       == "") ||
                         ($_POST['adminPassword']        == "") ||
                         ($_POST['adminConfirmPassword'] == "") ||
                         ($_POST['adminEmail']           == "") ||
                         ($_POST['adminConfirmEmail']    == ""))
                         ||
                         ($_POST['adminPassword'] != $_POST['adminConfirmPassword'])
                         ||
                         ($_POST['adminEmail']    != $_POST['adminConfirmEmail'])) {

                        $errors = "adminInfoError=1";

                        foreach($_POST as $attribute => $value) {
                            if ((!($attribute == "install")) && (!($attribute == "installData")) && (!($attribute == "submit"))) {
                                $errors .= "&{$attribute}={$value}";
                            }
                        }

                        if ((($_POST['adminPassword'] != "") && ($_POST['adminConfirmPassword'] != ""))
                             &&
                            ($_POST['adminPassword']  != $_POST['adminConfirmPassword'])) {
                            $errors .= "&adminPasswordMatchError=1";
                        }

                        if ((($_POST['adminEmail'] != "") && ($_POST['adminConfirmEmail'] != ""))
                             &&
                            ($_POST['adminEmail']  != $_POST['adminConfirmEmail'])) {
                            $errors .= "&adminEmailMatchError=1";
                        }

                        header("Location: index.php?".$errors);
                        exit;

                    } else {

                        $count = 0;
                        foreach($_POST as $key => $value) {
                        	if ((!($key == "install")) && (!($key == "installData")) && (!($key == "submit"))) {
                        	    $installData[$count] = array($key => $value);
                                $count++;
                            }
                        }
                        unset($count);

                        $tpl = new Template;
                        $tpl->set("title",	    "AllianceCMS: Installation");
                        $tpl->set("author",	    "jburns131");
                        $tpl->set("styleSheet",	THEMES."emplode".DS."style.css");

                        $body = new Template("views".DS."adminConfirm.tpl.php");
                        $body->set("images",      THEMES."emplode".DS."images");
                        $body->set("formHelper",  $formHelper);
                        $body->set("installData", $installData);

                        foreach($_POST as $attribute => $value) {
                            if ((!($attribute == "install")) && (!($attribute == "installData")) && (!($attribute == "submit"))) {
                                $body->set($attribute, $value);
                            }
                        }

                        $menu[0] = new Template("views".DS."menu.tpl.php");
                        $menu[0]->set("installStage", "5");
                        $menu[0]->set("images",       THEMES."emplode".DS."images");

                        $tpl->set("body", $body);
                        $tpl->set("menu", $menu);

                        echo $tpl->fetch("views".DS."index.tpl.php");
                    }
                    break;
                case 7:
                    // Prompt For Site Info

                    $count = 0;
                    foreach($_POST as $key => $value) {
                    	if ((!($key == "install")) && (!($key == "installData")) && (!($key == "submit"))) {
                    	    $installData[$count] = array($key => $value);
                            $count++;
                        }
                    }
                    unset($count);

                    $tpl = new Template;
                    $tpl->set("title",	    "AllianceCMS: Installation");
                    $tpl->set("author",	    "jburns131");
                    $tpl->set("styleSheet",	THEMES."emplode".DS."style.css");

                    $body = new Template("views".DS."siteInfo.tpl.php");
                    $body->set("images",      THEMES."emplode".DS."images");
                    $body->set("formHelper",  $formHelper);
                    $body->set("installData", $installData);

                    foreach($_POST as $attribute => $value) {
                        if ((!($attribute == "install")) && (!($attribute == "installData")) && (!($attribute == "submit"))) {
                            $body->set($attribute, $value);
                        }
                    }

                    $menu[0] = new Template("views".DS."menu.tpl.php");
                    $menu[0]->set("installStage", "6");
                    $menu[0]->set("images",       THEMES."emplode".DS."images");

                    $tpl->set("body", $body);
                    $tpl->set("menu", $menu);

                    echo $tpl->fetch("views".DS."index.tpl.php");
                    break;
                case 8:
                    // Confirm Site Info

                    $count = 0;
                    foreach($_POST as $key => $value) {
                    	if ((!($key == "install")) && (!($key == "installData")) && (!($key == "submit"))) {
                    	    $installData[$count] = array($key => $value);
                            $count++;
                        }
                    }
                    unset($count);

                    $tpl = new Template;
                    $tpl->set("title",	    "AllianceCMS: Installation");
                    $tpl->set("author",	    "jburns131");
                    $tpl->set("styleSheet",	THEMES."emplode".DS."style.css");

                    $body = new Template("views".DS."siteConfirm.tpl.php");
                    $body->set("images",      THEMES."emplode".DS."images");
                    $body->set("formHelper",  $formHelper);
                    $body->set("installData", $installData);

                    foreach($_POST as $attribute => $value) {
                        if ((!($attribute == "install")) && (!($attribute == "installData")) && (!($attribute == "submit"))) {
                            $body->set($attribute, $value);
                        }
                    }

                    $menu[0] = new Template("views".DS."menu.tpl.php");
                    $menu[0]->set("installStage", "7");
                    $menu[0]->set("images",       THEMES."emplode".DS."images");

                    $tpl->set("body", $body);
                    $tpl->set("menu", $menu);

                    echo $tpl->fetch("views".DS."index.tpl.php");
                    break;
                case 9:
                    // ok To Install?

                    $count = 0;
                    foreach($_POST as $key => $value) {
                    	if ((!($key == "install")) && (!($key == "installData")) && (!($key == "submit"))) {
                    	    $installData[$count] = array($key => $value);
                            $count++;
                        }
                    }
                    unset($count);

                    $tpl = new Template;
                    $tpl->set("title",	    "AllianceCMS: Installation");
                    $tpl->set("author",	    "jburns131");
                    $tpl->set("styleSheet",	THEMES."emplode".DS."style.css");

                    $body = new Template("views".DS."siteConfirmInstall.tpl.php");
                    $body->set("images",      THEMES."emplode".DS."images");
                    $body->set("formHelper",  $formHelper);
                    $body->set("installData", $installData);

                    foreach($_POST as $attribute => $value) {
                        if ((!($attribute == "install")) && (!($attribute == "installData")) && (!($attribute == "submit"))) {
                            $body->set($attribute, $value);
                        }
                    }

                    $menu[0] = new Template("views".DS."menu.tpl.php");
                    $menu[0]->set("installStage", "8");
                    $menu[0]->set("images",       THEMES."emplode".DS."images");

                    $tpl->set("body", $body);
                    $tpl->set("menu", $menu);

                    echo $tpl->fetch("views".DS."index.tpl.php");
                    break;
                case 10:

                    //*
                    // Create Database Tables
                    // If Clean Installation: Go To 'cleanup.php' File That Deletes 'Install.php', Fixes File Permissions And Links To Main Site
                    // If Dirty Installation: Drop Everything From Database And Verify Database Connection Info

                    if (!defined('DB_SOFTWARE')) {
                		require_once("install.dbConnection.php");
                        require_once("install.core.php");
                        require_once("install.data.php");
                    }

                    $tpl = new Template;
                    $tpl->set("title",	    "AllianceCMS: Installation");
                    $tpl->set("author",	    "jburns131");
                    $tpl->set("styleSheet",	THEMES."emplode".DS."style.css");

                    $body = new Template("views".DS."installComplete.tpl.php");
                    $body->set("images",     THEMES."emplode".DS."images");
                    $body->set("formHelper", $formHelper);

                    $menu[0] = new Template("views".DS."menu.tpl.php");
                    $menu[0]->set("installStage", "9");
                    $menu[0]->set("images",       THEMES."emplode".DS."images");

                    $tpl->set("body", $body);
                    $tpl->set("menu", $menu);

                    echo $tpl->fetch("views".DS."index.tpl.php");
                    break;
            }
        }
    } else {
        header("Location: ".BASEDIR);
        exit;
    }
