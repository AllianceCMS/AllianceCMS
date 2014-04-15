<?php

/**
 * Get Venue Name stored in 'labels' database table
 */

$sql->dbSelect('labels',
    'cryptonym, name',
    'cryptonym = :cryptonym AND active = :active',
    [
        'cryptonym' => 'venue',
        'active' => intval(2),
    ]
);

$fields = $sql->dbFetch('one');

define("VENUE_LABEL", $fields['name']);

unset($fields);

/**
 * Setup Main Venue Constants
 *
 * @todo: Should we move these to a class and call dynamically rather than on every page load?
 */

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

/**
 * Setup Sub Venue Constants
 *
 * @todo: Should we move these to a class and call dynamically rather than on every page load?
 */

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