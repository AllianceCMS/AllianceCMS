<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add(
    'admin_dashboard',
    new Route(
        '/dashboard', // path
        array('_controller' => 'Admin\AdminPages::dashboardHome'), // default values
        array(), // requirements
        array(), // options
        '', // host
        array(), // schemes
        array('GET') // methods
    )
);

/*
$moduleRoutes['Admin']['Dashboard'] = [
    'name' => 'admin_dashboard', // Required: Route name
    'path' => '/dashboard', // Required: Route path
    'type' => 'admin', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Admin',
            'controller' => 'AdminPages',
            'action' => 'dashboardHome',
        ] // Required: namespace/controller/action
    ]
];
//*/

return $collection;
