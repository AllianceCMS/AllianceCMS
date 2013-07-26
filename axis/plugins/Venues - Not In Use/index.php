<?php

    if ($_GET['site_does_not_exist'] == 2) {
        
        require_once("../header.php");
        
        $body = new Template('views/site_does_not_exist.tpl.php');
        $body->set('requested_site_name', $_GET['requested_site_name']);
        
        require_once("../footer.php");

    } else if ($_GET['create_site'] == 2) {
    
        require_once("../header.php");
        
        $body = new Template('views/create_site.tpl.php');
        $body->set('requested_site_name', $_GET['requested_site_name']);
        $body->set('formHelper', $formHelper);
        
        require_once("../footer.php");
        
    } else if (isset($_POST['create_site_submit'])) {
        
        require_once("../core.php");
        
        // NEED TO FINISH WORKING ON "EXISTING SITE NAME" AND "REQUIRED FIELDS" ERROR MESSAGES
        // NEED TO FINISH CODE IN THE ACTION AND VIEW
        
        /*
        echo "test 1<br /><br />";
        
        var_dump($_POST);
        
        echo "\$_POST['create_site_submit'] = {$_POST['create_site_submit']}<br /><br />";
        */
        
        $sql->dbSelect("sites", "id, name", "name = '{$_POST['requested_site_name']}'");
        $row = $sql->dbFetch();
        
        /*
        echo "test 1.1<br /><br />";
        var_dump($row);
        echo "test 1.2<br /><br />";
        */
        
        if (is_array($row->fields)) {
            
            //echo "test 2<br /><br />";
            
            // The requested site exists.
            //echo "You are trying to create a site that exists.<br /><br />";

            header("Location: ".BASEDIR."sites/index.php?create_site=2&create_site_error=1&first_iteration=2&requested_site_name=".$_POST['requested_site_name']."&tagline=".$_POST['tagline']."&description=".$_POST['description']."");
            exit;

        } else {
            
            //echo "test 3<br /><br />";
            
            echo "You are trying to create a site that does not exist.<br /><br />";
            
        }
        
        /*
        echo "test 4<br /><br />";
        
        echo "\$_POST['create_site_submit'] = {$_POST['create_site_submit']}<br /><br />";
        */
        
    } else {
        
        header("Location: ".BASEDIR);
        exit;
        
    }
