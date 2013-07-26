<?php

    if ($_GET['login_stage']  == "incorrect_login") {
        
        require_once("../header.php");
        
        $body = new Template('invalid_login.tpl.php');
        $body->set('formHelper', $formHelper);
        $body->set('caption', 'My Test Page');
        $body->set('intro', 'The intro paragraph.');
        $body->set('list', array('cat', 'dog', 'mouse'));
                
        /*
        if ($_SESSION['logged_status']  == "logged_in") {
            header("Location: user.php");
            exit;
        } else {
            header("Location: login.php");
            exit;
        }
        //*/
        
        /*
        $loggedIn = "";
        if ($loggedIn == 2) {
            header("Location: user.php");
            exit;
        } else {
            header("Location: login.php");
            exit;
        }
        //*/
        
        /*
        if (isset($_POST['page'])) {
    
            switch ($_POST['page']) {
                case "login":
                    $body = new Template("login.tpl.php");
                    break;
                case "logout":
                    $body = new Template("login.tpl.php");
                    break;
                case "profile_view":
                    $body = new Template("login.tpl.php");
                    break;
                case "profile_edit":
                    $body = new Template("login.tpl.php");
                    break;
                default:
                    header("Location: ".BASEDIR);
                    exit;
            }
            
        } else {
            header("Location: ".BASEDIR);
            exit;
        }
        //*/
    }
    
    require_once("../footer.php");
    
?>