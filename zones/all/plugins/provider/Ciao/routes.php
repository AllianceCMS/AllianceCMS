<?php
/**
 * Plugin routes
 *
 * Use routes to define which class and method is called when a user navigates to a specific URL
 *
 * Explanation:
 *
 * @code
 * // One entry per route
 * $pluginRoutes[$pluginName][$pageName] = [ // $pluginName can be a human spoken name and must be unique, $pageName can be a human spoken name and is used as a descriptor and must be unique
 *     'name' => $routeName, // Required: Route name, must be unique, this is used for named routes. More explanation will be provided at a later date.
 *     'path' => '/ciao/hey/{:name*}', // Required: Route path, must be unique, this is the part of the URL that comes after the domain name and venue name and '/admin' if this is an admin route. Venue name will be provided by the system. Wildcards can be used in the form of '/{:wildcardName} for individual wildcards, and '/{:wildcardName*}' for an undefined number of wildcards. For the time being, reference AuraRouter documentation regarding wildcards: http://auraphp.com/packages/Aura.Router/1.1.0/
 *     'type' => 'front', // Required: admin, front, back. Defines if this route is for a front facing page or an admin page. back routes are not currently implemented.
 *     'perms' => ['view_ciao'], // Optional. An array of route permissions. This route will be denied to users that do not have this permission. Might be replaced by PluginPerms.php. Not implemented.
 *     'specs' => [ Route specs. For the time being see AuraRouter docs for options: http://auraphp.com/packages/Aura.Router/1.1.0/
 *         'values' => [// Route values that contain the code to be executed when this route is used. Also contains default values for wildcards.
 *             'namespace' => 'Ciao', // Required. The route dispatcher will use this to load the provided controller
 *             'controller' => 'SayStuff', // Required. controller == Class. This is the Class loaded when this route is loaded
 *             'action' => 'sayHi', // Required. action == Class Method. This is the Method loaded when this route is loaded
 *             'name' => 'User', // Optional. This is the default value for the 'name' wildcard.
 *         ]
 *     ]
 * ];
 * @endcode
 */
$pluginRoutes['Ciao']['Page Name 01'] = [
    'name' => 'tell_hi', // Required: Route name
    'path' => '/ciao/hey/{:name*}', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'perms' => ['view_ciao'], // Optional
    'specs' => [
        'values' => [
            'namespace' => 'Ciao',
            'controller' => 'SayStuff',
            'action' => 'sayHi',
            'name' => 'User',
        ] // Required: namespace/controller/action
    ]
];

$pluginRoutes['Ciao']['Page Name 02'] = [
    'name' => 'tell_bye', // Required: Route name
    'path' => '/ciao/later/{:name*}', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'perms' => ['view_ciao', 'edit_ciao'], // Optional
    'specs' => [
        'values' => [
            'namespace' => 'Ciao',
            'controller' => 'SayStuff',
            'action' => 'sayBye',
            'name' => 'User',
        ] // Required: namespace/controller/action
    ]
];

$pluginRoutes['Ciao']['Page Name 03'] = [
    'name' => 'admin_ciao', // Required: Route name
    'path' => '/ciao', // Required: Route path
    'type' => 'admin', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Ciao',
            'controller' => 'AdminPages',
            'action' => 'adminCiao',
            'name' => 'Wonderful AllianceCMS User',
        ] // Required: namespace/controller/action
    ]
];

$pluginRoutes['Ciao']['Stats'] = [
    'name' => 'ciao_stats', // Required: Route name
    'path' => '/ciao/forms/{:wildcard*}', // Required: Route path
    'type' => 'admin', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Ciao',
            'controller' => 'AdminPages',
            'action' => 'adminCiaoStats',
        ] // Required: namespace/controller/action
    ]
];
