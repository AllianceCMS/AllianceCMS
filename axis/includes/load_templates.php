<?php

// Check if current venue's active theme is active
// Get current venue's active theme info (folder_path, ???folder_name???)
// Load theme templates
// Load axis templates (html helper, form helper, media/css/js helper)
// ???Load custom templates???
// Create

use Acms\Core\Templates\Menus;
use Acms\Core\Templates\Template;

/**
 * Setup Theme Constants
 *
 * Was located in 'venue_info.php'
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
 * Setup Block Constants
 *
 * Was located in 'venue_info.php'
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

// Get the file system path to the venue's active theme: used for theme images/css/js links
$sql->dbSelect('themes',
    'name, folder_path, folder_name, artist, artist_email, artist_site',
    'id = :id',
    ['id' => intval(VENUE_THEME)]);
$fields = $sql->dbFetch('one');
$theme_path = $fields['folder_path'] . $fields['folder_name'];

// Create base/theme template
$tpl = new Template();
$tpl->set('base_url', BASE_URL);
$tpl->set('theme_folder', BASE_URL . '/' . $theme_path);
$tpl->set("venue_title", VENUE_TITLE);
//$tpl->set("venue_author", SITE_ADMIN_NAME);
$tpl->set("venue_description", VENUE_DESCRIPTION);
$tpl->set("venue_tagline", VENUE_TAGLINE);
