<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add(
    'login_page',
    new Route(
        '/user/login', // path
        array('_controller' => 'AuthManager\UserAuth::loginPage'), // default values
        array(), // requirements
        array(), // options
        '', // host
        array(), // schemes
        array('GET') // methods
    )
);

/*
$moduleRoutes['AuthManager']['Login Block'] = [
    'name' => 'login_block', // Required: Route name
    'path' => '', // Required: Route path
    'type' => 'block', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'AuthManager',
            'controller' => 'UserAuth',
            'action' => 'loginBlock',
        ] // Required: namespace/controller/action
    ]
];

$moduleRoutes['AuthManager']['Login Page'] = [
    'name' => 'login_page', // Required: Route name
    'path' => '/user/login/{:errors*}', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'AuthManager',
            'controller' => 'UserAuth',
            'action' => 'loginPage',
        ] // Required: namespace/controller/action
    ]
];

$moduleRoutes['AuthManager']['Login Attempt'] = [
    'name' => 'login_attempt', // Required: Route name
    'path' => '/user/login-attempt', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'AuthManager',
            'controller' => 'UserAuth',
            'action' => 'loginAttempt',
        ] // Required: namespace/controller/action
    ]
];

$moduleRoutes['AuthManager']['Logout Attempt'] = [
    'name' => 'login_page', // Required: Route name
    'path' => '/user/logout/{:uid*}', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'AuthManager',
            'controller' => 'UserAuth',
            'action' => 'logoutAttempt',
        ] // Required: namespace/controller/action
    ]
];
//*/

return $collection;
