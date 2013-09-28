<?php

// Setup Main Venue Constants

$sql->dbSelect('venues',
    'name, title, tagline, description, active_theme, venue_admin, default_module, maintenance_flag',
    'id = :id',
    ['id' => intval(1)]);
$fields = $sql->dbFetch('one');

define("MAIN_VENUE_NAME",             $fields['name']);
define("MAIN_VENUE_TITLE",            $fields['title']);
define("MAIN_VENUE_TAGLINE",          $fields['tagline']);
define("MAIN_VENUE_DESCRIPTION",      $fields['description']);
define("MAIN_VENUE_THEME",            $fields['active_theme']);
define("MAIN_VENUE_ADMIN_ID",         $fields['venue_admin']);
define("MAIN_VENUE_DEFAULT_MODULE",   $fields['default_module']);
define("MAIN_VENUE_MAINTENANCE_FLAG", $fields['maintenance_flag']);

unset($fields);

// Setup Sub Venue Constants

$sql->dbSelect('venues',
    'name, title, tagline, description, active_theme, venue_admin, default_module, maintenance_flag',
    'name = :name',
    ['name' => $pathVenue]); // $pathVenue is defined in 'load_router.php'
$fields = $sql->dbFetch('one');

define("VENUE_NAME",             $fields['name']);
define("VENUE_TITLE",            $fields['title']);
define("VENUE_TAGLINE",          $fields['tagline']);
define("VENUE_DESCRIPTION",      $fields['description']);
define("VENUE_THEME",            $fields['active_theme']);
define("VENUE_ADMIN_ID",         $fields['venue_admin']);
define("VENUE_DEFAULT_MODULE",   $fields['default_module']);
define("VENUE_MAINTENANCE_FLAG", $fields['maintenance_flag']);

unset($fields);

// Setup User Constants

/*
$sql->dbSelect("users", "display_name, email_address", "id = ".intval(CORE_SITE_ADMIN_ID));
$row = $sql->dbFetch();

define("VENUE_ADMIN_NAME", $row->fields['display_name']);
define("VENUE_ADMIN_EMAIL", $row->fields['email_address']);
//*/

// Setup Module Constants

/*
$sql->dbSelect("modules", "name, folder_base_dir, folder_name", "id = ".intval(SITE_DEFAULT_MODULE));
$row = $sql->dbFetch();

$baseModuleDir = NULL;
if (($row->fields['folder_base_dir'] != NULL) && ($row->fields['folder_base_dir'] != "basedir")) {
    $baseModuleDir = $row->fields['folder_base_dir'].DS;
} else {
    $baseModuleDir = BASEDIR;
}

define("MODULES_NAME",            $row->fields['name']);
define("MODULES_FOLDER_BASE_DIR", $baseModuleDir);
define("MODULES_FOLDER_NAME",     $row->fields['folder_name']);
//*/
