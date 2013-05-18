<?php

    $userLoggedIn = "";
    
    $htmlHelper = new HtmlHelper;
    $formHelper = new HtmlFormHelper;
    
    $menu[$count]->set("htmlHelper",      $htmlHelper);
    $menu[$count]->set("formHelper",      $formHelper);
    $menu[$count]->set("menuTitle",       "Welcome");
    $menu[$count]->set("thisPage",        THIS_FILE);
    $menu[$count]->set("basedir",         BASEDIR);
    $menu[$count]->set("userDisplayName", $_SESSION['display_name']);
    
    if ($_SESSION['logged_status']  == "logged_in") {
        $menu[$count]->set("loginStatus", "2");
    } else {
        $menu[$count]->set("loginStatus", "1");
    }