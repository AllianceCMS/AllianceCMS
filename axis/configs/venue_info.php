<?php

    /**
     * Setup Core Site Constants
     *
     */

    /*
    $sql->dbSelect("sites", "name, title, tagline, description, active_theme, owner_id, default_plugin, maintenance_flag", "id = ".intval(1));
    $row = $sql->dbFetch();
    //*/

    /*
    $select = $connection->newSelect();
    $select->cols(['name, title, tagline, description, active_theme, venue_admin, default_plugin, maintenance_flag'])
    ->from('a_venues')
    ->where('id = :id');
    $bind = ['id' => intval(1)];
    $fields = $connection->fetchOne($select, $bind);
    //*/

    $sql->dbSelect('venues',
        'name, title, tagline, description, active_theme, venue_admin, default_plugin, maintenance_flag',
        'id = :id',
        ['id' => intval(1)]);
    $fields = $sql->dbFetch('one');

    /*
    echo '<br /><pre>$fields = ';
    echo print_r($fields);
    echo '</pre><br />';

    echo '$fields["name"] = ' . $fields['name'];
    exit;
    //*/

    define("MAIN_VENUE_NAME",             $fields['name']);
    define("MAIN_VENUE_TITLE",            $fields['title']);
    define("MAIN_VENUE_TAGLINE",          $fields['tagline']);
    define("MAIN_VENUE_DESCRIPTION",      $fields['description']);
    define("MAIN_VENUE_THEME",            $fields['active_theme']);
    define("MAIN_VENUE_ADMIN_ID",         $fields['venue_admin']);
    define("MAIN_VENUE_DEFAULT_PLUGIN",   $fields['default_plugin']);
    define("MAIN_VENUE_MAINTENANCE_FLAG", $fields['maintenance_flag']);

    unset($fields);

    /**
     * Setup Sub Site Constants
     *
     */

    /*
    $sql->dbSelect("sites", "name, title, tagline, description, active_theme, owner_id, default_plugin, maintenance_flag", "id = {$site_id}");
    $row = $sql->dbFetch();
    //*/

    /*
    $select = $connection->newSelect();
    $select->cols(['name, title, tagline, description, active_theme, venue_admin, default_plugin, maintenance_flag'])
    ->from('a_venues')
    ->where('name = :name');
    $bind = ['name' => $pathVenue]; // $pathVenue is defined in 'load_router.php'
    $fields = $connection->fetchOne($select, $bind);
    //*/

    $sql->dbSelect('venues',
        'name, title, tagline, description, active_theme, venue_admin, default_plugin, maintenance_flag',
        'name = :name',
        ['name' => $pathVenue]); // $pathVenue is defined in 'load_router.php'
    $fields = $sql->dbFetch('one');

    define("VENUE_NAME",             $fields['name']);
    define("VENUE_TITLE",            $fields['title']);
    define("VENUE_TAGLINE",          $fields['tagline']);
    define("VENUE_DESCRIPTION",      $fields['description']);
    define("VENUE_THEME",            $fields['active_theme']);
    define("VENUE_ADMIN_ID",         $fields['venue_admin']);
    define("VENUE_DEFAULT_PLUGIN",   $fields['default_plugin']);
    define("VENUE_MAINTENANCE_FLAG", $fields['maintenance_flag']);

    unset($fields);


    /**
     * Setup User Constants
     *
     */

    /*
    $sql->dbSelect("users", "display_name, email_address", "id = ".intval(CORE_SITE_ADMIN_ID));
    $row = $sql->dbFetch();

    define("VENUE_ADMIN_NAME", $row->fields['display_name']);
    define("VENUE_ADMIN_EMAIL", $row->fields['email_address']);
    //*/

    /**
     * Setup Theme Constants
     *
     */

    /*
    $sql->dbSelect("themes", "name, designer, folder_name, favicon", "id = ".intval(SITE_THEME));
    $row = $sql->dbFetch();

    define("THEME_NAME",        $row->fields['name']);
    define("THEME_DESIGNER",    $row->fields['designer']);
    define("THEME_FOLDER_NAME", $row->fields['folder_name']."/");
    define("THEME_FAVICON",     $row->fields['favicon']);
    //*/

    /**
     * Setup Plugin Constants
     *
     */

    /*
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
    //*/


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
