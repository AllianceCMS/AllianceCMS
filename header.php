<?php

    require_once("core.php");
    
    $setupMenu = new Menus("1");
    $menu1 = $setupMenu->getMenus();

    $setupMenu = new Menus("2");
    $menu2 = $setupMenu->getMenus();
    
    $setupMenu = new Menus("3");
    $menu3 = $setupMenu->getMenus();
    
    $setupMenu = new Menus("4");
    $menu4 = $setupMenu->getMenus();
    
    $setupMenu = new Menus("5");
    $menu5 = $setupMenu->getMenus();
    
    $tpl = new Template();
    $tpl->set("themeImages", THEMES.THEME_FOLDER_NAME."images");
    $tpl->set("site_title", SITE_TITLE);
    $tpl->set("site_author", SITE_ADMIN_NAME);
    $tpl->set("site_description", SITE_DESCRIPTION);
    $tpl->set("site_styleSheet", THEMES.THEME_FOLDER_NAME."style.css");
    $tpl->set("nav1", $nav1);
    $tpl->set("menu1", $menu1);
    $tpl->set("menu2", $menu2);
    $tpl->set("menu3", $menu3);
    $tpl->set("menu4", $menu4);
    $tpl->set("menu5", $menu5);
    