<?php
$moduleRoutes['AdminManager']['Dashboard'] = [
    'name' => 'admin_dashboard', // Required: Route name
    'path' => '/dashboard', // Required: Route path
    'type' => 'admin', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'AdminManager',
            'controller' => 'AdminPages',
            'action' => 'dashboardHome',
        ] // Required: namespace/controller/action
    ]
];
