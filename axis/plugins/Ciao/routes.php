<?php
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
    'name' => 'hello', // Required: Route name
    'path' => '/ciao/{:name*}', // Required: Route path
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
    'path' => '/ciao/stats/{:wildcard*}', // Required: Route path
    'type' => 'admin', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Ciao',
            'controller' => 'AdminPages',
            'action' => 'adminCiaoStats',
        ] // Required: namespace/controller/action
    ]
];
