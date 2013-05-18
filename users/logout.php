<?php
    if ($_GET['login_stage']  == "logout") {
        require_once("../header.php");
        
        // Destroy "Remember Me" Cookies
        
        /**
         *
         * TODO: Add 'logout' method to 'Session' class, use method to destroy cookies
         *
         */
        if (isset($_COOKIE['logged_status'])) {
            setcookie("logged_status",  "", time()-60*60*24*100, "/");
            setcookie("display_name",   "", time()-60*60*24*100, "/");
            setcookie("real_name",      "", time()-60*60*24*100, "/");
            setcookie("login_name",     "", time()-60*60*24*100, "/");
            setcookie("password",       "", time()-60*60*24*100, "/");
        }
        
        // Destroy Current Session
        session_destroy();
        
        header("Location: ".BASEDIR);
        exit;
    }