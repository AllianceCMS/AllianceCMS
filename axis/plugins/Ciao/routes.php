<?php
$pluginRoutes['Ciao']['Page Name 01'] = [
    'name' => 'tell_hi', // Required: Route name
    'path' => '/hello/hey/{:name*}', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'perms' => 'View Ciao Page', // Optional
    'specs' => [
        'values' => [
            'namespace' => 'Ciao',
            'controller' => 'SayStuff',
            'action' => 'sayHi',
            'name' => 'User'
        ] // Required: namespace/controller/action
    ]
];

$pluginRoutes['Ciao']['Page Name 02'] = [
    'name' => 'tell_bye', // Required: Route name
    'path' => '/hello/later/{:name*}', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'perms' => 'View Ciao Page', // Optional
    'specs' => [
        'values' => [
            'namespace' => 'Ciao',
            'controller' => 'SayStuff',
            'action' => 'sayBye',
            'name' => 'User'
        ] // Required: namespace/controller/action
    ]
];

$pluginRoutes['Ciao']['Page Name 03'] = [
    'name' => 'hello', // Required: Route name
    'path' => '/hello/{:name*}', // Required: Route path
    'type' => 'admin', // Required: admin, front, back
    'perms' => 'View Hello Admin Page', // Optional
    'specs' => [
        'values' => [
            'namespace' => 'Ciao',
            'controller' => 'SayStuff',
            'action' => 'yoAdmin',
            'name' => 'Admin'
        ] // Required: namespace/controller/action
    ]
];
