<?php
    if ($_POST['login_stage']  == "attempt_login") {
        
        require_once("../header.php");
        require_once(HANDLERS."sessions/class.session.php");
        
        // Attempt to validate member credentials
        $sql->dbSelect("users", "display_name, real_name, login_name, password", "login_name = '".$_POST['login_name']."' AND password = '".md5($_POST['password'])."'");
        $row = $sql->dbFetch();
        
        if (isset($row->fields[2])) {
        
            // Build $_SESSION variables
            $sessionHelper = new SessionHelper;
            $sessionHelper->buildSession($row);
            
            // If "Remember Me" is checked, build cookies that signify that the user is still logged in
            if (isset($_POST['remember_me'])) {
                
                $sessionHelper->buildCookies();
                
            }
        
            // Redirect member to the "Home" page
            
            /**
             * TODO: Redirect member to the page they logged in FROM
             */
            header("Location: ".BASEDIR);
            exit;
        } else {
            
            // Redirect to the "Incorrect Login" page
            header("Location: index.php?login_stage=incorrect_login");
            exit;
        }
        
    } else {
        
        // Redirect to the Home page
        //header("Location: ".BASEDIR);
        
        //*
        require_once("../header.php");
        
        // Prompt member for login name and password
        $body = new Template("views/login.tpl.php");
        $body->set("login_stage", "prompt");
        $body->set("formHelper", $formHelper);
        echo "login.php: step 3.1<br /><br />";
        
        require_once("../footer.php");
        //*/
        
    }