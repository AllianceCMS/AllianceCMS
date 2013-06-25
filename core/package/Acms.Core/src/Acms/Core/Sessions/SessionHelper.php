<?php
    
    class SessionHelper
    {
        
        public function buildSession($db_data) {
            $_SESSION['logged_status']  = "logged_in";
            $_SESSION['display_name']   = $db_data->fields[0];
            $_SESSION['real_name']      = $db_data->fields[1];
            $_SESSION['login_name']     = $db_data->fields[2];
            $_SESSION['password']       = $db_data->fields[3];
        }
        
        public function buildCookies() {
            setcookie("logged_status",  $_SESSION['logged_status'], time()+60*60*24*100, "/");
            setcookie("display_name",   $_SESSION['display_name'], time()+60*60*24*100, "/");
            setcookie("real_name",      $_SESSION['real_name'], time()+60*60*24*100, "/");
            setcookie("login_name",     $_SESSION['login_name'], time()+60*60*24*100, "/");
            setcookie("password",       $_SESSION['password'], time()+60*60*24*100, "/");
        }
        
    }