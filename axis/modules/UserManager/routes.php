<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

/*
$moduleRoutes['UserManager']['Login Block'] = [
    'name' => 'login_block', // Required: Route name
    'path' => '', // Required: Route path
    'type' => 'block', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'UserManager',
            'controller' => 'Users',
            'action' => 'loginBlock',
        ] // Required: namespace/controller/action
    ]
];

$moduleRoutes['UserManager']['Login Page'] = [
    'name' => 'login_page', // Required: Route name
    'path' => '/user/login/{:errors*}', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'UserManager',
            'controller' => 'Users',
            'action' => 'loginPage',
        ] // Required: namespace/controller/action
    ]
];

$moduleRoutes['UserManager']['Login Attempt'] = [
    'name' => 'login_attempt', // Required: Route name
    'path' => '/user/login-attempt', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'UserManager',
            'controller' => 'Users',
            'action' => 'loginAttempt',
        ] // Required: namespace/controller/action
    ]
];

$moduleRoutes['UserManager']['Logout Attempt'] = [
    'name' => 'login_page', // Required: Route name
    'path' => '/user/logout/{:uid*}', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'UserManager',
            'controller' => 'Users',
            'action' => 'logoutAttempt',
        ] // Required: namespace/controller/action
    ]
];
//*/

return $collection;
