<?php
$pluginRoutes['Admin']['Dashboard'] = [
    'name' => 'admin_dashboard', // Required: Route name
    'path' => '/{:wildcard*}', // Required: Route path
    'type' => 'admin', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Admin',
            'controller' => 'AdminPages',
            'action' => 'dashboardHome',
        ] // Required: namespace/controller/action
    ]
];
