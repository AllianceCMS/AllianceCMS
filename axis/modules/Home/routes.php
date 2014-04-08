<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add(
    'homepage',
    new Route(
        '/', // path
        array('_controller' => 'Home\DisplayPage::homeFrontPage'), // default values
        array(), // requirements
        array(), // options
        '', // host
        array(), // schemes
        array('') // methods
    )
);

return $collection;

/*
$moduleRoutes['Home']['Front Page'] = [
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

$moduleRoutes['Home']['Welcome Block'] = [
    'name' => 'welcome_block', // Required: Route name
    'path' => '', // Required: Route path
    'type' => 'block', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Home',
            'controller' => 'HomeBlocks',
            'action' => 'welcomeToAcms',
        ] // Required: namespace/controller/action
    ]
];

$moduleRoutes['Home']['Contact Us Block'] = [
    'name' => 'contact_us', // Required: Route name
    'path' => '', // Required: Route path
    'type' => 'block', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Home',
            'controller' => 'HomeBlocks',
            'action' => 'contactUs',
        ] // Required: namespace/controller/action
    ]
];
//*/
