<?php

    /**
     * Setup Core Site Constants
     *
     */

    $sql->dbSelect("sites", "name, title, tagline, description, active_theme, owner_id, default_plugin, maintenance_flag", "id = ".intval(1));
    $row = $sql->dbFetch();

    define("CORE_SITE_NAME",             $row->fields['name']);
    define("CORE_SITE_TITLE",            $row->fields['title']);
    define("CORE_SITE_TAGLINE",          $row->fields['tagline']);
    define("CORE_SITE_DESCRIPTION",      $row->fields['description']);
    define("CORE_SITE_THEME",            $row->fields['active_theme']);
    define("CORE_SITE_ADMIN_ID",         $row->fields['owner_id']);
    define("CORE_SITE_DEFAULT_PLUGIN",   $row->fields['default_plugin']);
    define("CORE_SITE_MAINTENANCE_FLAG", $row->fields['maintenance_flag']);

    /**
     * Setup Sub Site Constants
     *
     */

    $sql->dbSelect("sites", "name, title, tagline, description, active_theme, owner_id, default_plugin, maintenance_flag", "id = {$site_id}");
    $row = $sql->dbFetch();

    define("SITE_NAME",             $row->fields['name']);
    define("SITE_TITLE",            $row->fields['title']);
    define("SITE_TAGLINE",          $row->fields['tagline']);
    define("SITE_DESCRIPTION",      $row->fields['description']);
    define("SITE_THEME",            $row->fields['active_theme']);
    define("SITE_ADMIN_ID",         $row->fields['owner_id']);
    define("SITE_DEFAULT_PLUGIN",   $row->fields['default_plugin']);
    define("SITE_MAINTENANCE_FLAG", $row->fields['maintenance_flag']);

    /**
     * Setup User Constants
     *
     */

    $sql->dbSelect("users", "display_name, email_address", "id = ".intval(CORE_SITE_ADMIN_ID));
    $row = $sql->dbFetch();

    define("SITE_ADMIN_NAME", $row->fields['display_name']);
    define("SITE_ADMIN_EMAIL", $row->fields['email_address']);

    /**
     * Setup Theme Constants
     *
     */

    $sql->dbSelect("themes", "name, designer, folder_name, favicon", "id = ".intval(SITE_THEME));
    $row = $sql->dbFetch();

    define("THEME_NAME",        $row->fields['name']);
    define("THEME_DESIGNER",    $row->fields['designer']);
    define("THEME_FOLDER_NAME", $row->fields['folder_name']."/");
    define("THEME_FAVICON",     $row->fields['favicon']);

    /**
     * Setup Plugin Constants
     *
     */

    $sql->dbSelect("plugins", "name, folder_base_dir, folder_name", "id = ".intval(SITE_DEFAULT_PLUGIN));
    $row = $sql->dbFetch();

    $basePluginDir = NULL;
    if (($row->fields['folder_base_dir'] != NULL) && ($row->fields['folder_base_dir'] != "basedir")) {
        $basePluginDir = $row->fields['folder_base_dir'].DS;
    } else {
        $basePluginDir = BASEDIR;
    }

    define("PLUGINS_NAME",            $row->fields['name']);
    define("PLUGINS_FOLDER_BASE_DIR", $basePluginDir);
    define("PLUGINS_FOLDER_NAME",     $row->fields['folder_name']);


    /**
     * Setup Menu Constants
     *
     */
    /*
    $sql->dbSelect("menus", "name, link, plugin_id, menu_area", "active = 2 ORDER BY menu_order";
    $row = $sql->dbFetch();

    $basePluginDir = NULL;
    if (($row->fields['folder_base_dir'] != NULL) && ($row->fields['folder_base_dir'] != "basedir")) {
        $basePluginDir = $row->fields['folder_base_dir'].DS;
    } else {
        $basePluginDir = BASEDIR;
    }

    define("PLUGINS_NAME",            $row->fields['name']);
    define("PLUGINS_FOLDER_BASE_DIR", $basePluginDir);
    define("PLUGINS_FOLDER_NAME",     $row->fields['folder_name']);
    //*/
