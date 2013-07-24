<?php
$pluginRoutes['Home']['Front Page'] = [
    'name' => 'home', // Required: Route name
    'path' => '', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'perms' => 'View Home Page', // Optional
    'specs' => [
        'values' => [
            'namespace' => 'Home',
            'controller' => 'DisplayPage',
            'action' => 'homeFrontPage',
            'name' => 'User'
        ] // Required: namespace/controller/action
    ]
];
