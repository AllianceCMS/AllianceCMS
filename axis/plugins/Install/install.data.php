<?php

    require_once(HANDLERS."db".DS."db.php");

    // Setup Database Variables

    $siteName         = $_POST['siteName'];
    $siteTitle        = $_POST['siteTitle'];
    $siteTagline      = $_POST['siteTagline'];
    $siteEmail        = $_POST['siteEmail'];
    $siteEmailName    = $_POST['siteEmailName'];
    $siteDescription  = $_POST['siteDescription'];
    $siteKeywords     = $_POST['siteKeywords'];

    $adminLoginName   = $_POST['adminLoginName'];
    $adminDisplayName = $_POST['adminDisplayName'];
    $adminRealName    = $_POST['adminRealName'];
    //$adminPassword    = md5($_POST['adminPassword']);
    $adminPassword    = crypt($_POST['adminPassword'], '$2y$22$alliancecmssocialcmsya$');
    $adminEmail       = $_POST['adminEmail'];
    $adminHideEmail   = intval($_POST['adminHideEmail']);
    $adminLocation    = $_POST['adminLocation'];
    $adminWebsite     = $_POST['adminWebsite'];
    $adminBio         = $_POST['adminBio'];
    $adminAvatar      = $_POST['adminAvatar'];
    $adminSignature   = $_POST['adminSignature'];

    $sql->dbExecuteQueries(array(

        "INSERT INTO ".$sql->getDbPrefix()."languages
            (name, folder_name, created)
         VALUES
            ('English', 'english', ".$sql->getDbConn()->DBDate(time()).");",

        "INSERT INTO ".$sql->getDbPrefix()."links
            (label, url, parent, link_area, link_order, active, created)
         VALUES
            ('Home', 'news".DS."index.php', 0, 1, 1, 2, ".$sql->getDbConn()->DBDate(time()).");",

        /*
        "INSERT INTO ".$sql->getDbPrefix()."menus
            (name, link, plugin_id, menu_area, active, menu_order, created)
         VALUES
            ('news_menu', 'news".DS."news_menu.php', '1', '1', '2', '2', ".$sql->getDbConn()->DBDate(time())."),
            ('user_menu', 'users".DS."user_menu.php', '2', '1', '2', '1', ".$sql->getDbConn()->DBDate(time()).");",
        //*/

        "INSERT INTO ".$sql->getDbPrefix()."plugins
            (name, version, folder_base_dir, folder_name, description, developer, developer_email, developer_site, active, created)
         VALUES
            ('News', '0.01', '', 'news', 'This is the default news plugin.', 'jburns131', 'jburns131@jbwebware.com', 'http://www.jbwebware.com', 2, ".$sql->getDbConn()->DBDate(time())."),
            ('User Manager', '0.01', '', 'users', 'This is the default user management plugin.', 'jburns131', 'jburns131@jbwebware.com', 'http://www.jbwebware.com', 2, ".$sql->getDbConn()->DBDate(time()).");",

         "INSERT INTO ".$sql->getDbPrefix()."venues
            (name, title, tagline, description, keywords, owner_id, owner_email, main_site_email, main_site_email_name, active_theme, default_plugin, maintenance_flag, maintenance_flag_text, language_id, active, created)
         VALUES
            ('{$siteName}', '{$siteTitle}', '{$siteTagline}', '{$siteDescription}', '{$siteKeywords}', 1, '{$adminEmail}', '{$siteEmail}', '{$siteEmailName}', 1, 1, 1, 'Our Site Is Down For Maintenance, Please Come Back Later', 1, 2, ".$sql->getDbConn()->DBDate(time()).");",

        "INSERT INTO ".$sql->getDbPrefix()."themes
            (name, version, folder_name, description, designer, designer_email, designer_site, selectable, active, created)
         VALUES
            ('Emplode', '1.0', 'emplode', 'This theme was found @ http://templates.arcsin.se.', 'Arcsin', 'kontakt@arcsin.se', 'http://templates.arcsin.se/', 2, 2, ".$sql->getDbConn()->DBDate(time())."),
            ('Interlude', '1.0', 'interlude', 'This theme is from freecsstemplates.org', 'freecsstemplates.org', '?', '?', 2, 2, ".$sql->getDbConn()->DBDate(time()).");",

        "INSERT INTO ".$sql->getDbPrefix()."users
            (display_name, real_name, login_name, password, email_address, hide_email_address, timezone_offset, location, website, bio, avatar, signature, preferred_theme_id, user_classes, last_ip, last_login_time, registration_ip, created)
         VALUES
            ('{$adminDisplayName}', '{$adminRealName}', '{$adminLoginName}', '{$adminPassword}', '{$adminEmail}', {$adminHideEmail}, 0, '{$adminLocation}', '{$adminWebsite}', '{$adminBio}', '{$adminAvatar}', '{$adminSignature}', 1, '1', '".getenv('REMOTE_ADDR')."', ".$sql->getDbConn()->DBDate(time()).", '".getenv('REMOTE_ADDR')."', ".$sql->getDbConn()->DBDate(time()).");",

        /*
        "INSERT INTO ".$sql->getDbPrefix()."user_classes
            (name, created)
         VALUES
            ('Main_Admin', ".$sql->getDbConn()->DBDate(time())."),
            ('Admin', ".$sql->getDbConn()->DBDate(time())."),
            ('Forum_Moderator', ".$sql->getDbConn()->DBDate(time()).");"
        //*/
        )
    );
