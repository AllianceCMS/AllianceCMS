<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add(
    'module_manager',
    new Route(
        '/module-manager/current-modules/', // path
        array('_controller' => 'ModuleManager\AdminPages::currentModules'), // default values
        array(), // requirements
        array(), // options
        '', // host
        array(), // schemes
        array('GET') // methods
    )
);

/*
$moduleRoutes['ModuleManager']['Current Modules'] = [
    'name' => 'module_manager', // Required: Route name
    'path' => '/module-manager/current-modules/{:query_string*}', // Required: Route path
    'type' => 'admin', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'ModuleManager',
            'controller' => 'AdminPages',
            'action' => 'currentModules',
        ] // Required: namespace/controller/action
    ]
];

$moduleRoutes['ModuleManager']['Install Local Modules'] = [
    'name' => 'install_local_modules', // Required: Route name
    'path' => '/module-manager/install-local-modules/{:query_string*}', // Required: Route path
    'type' => 'admin', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'ModuleManager',
            'controller' => 'AdminPages',
            'action' => 'installLocalModules',
        ] // Required: namespace/controller/action
    ]
];

$moduleRoutes['ModuleManager']['Install Module'] = [
    'name' => 'install_module', // Required: Route name
    'path' => '/module-manager/install-module', // Required: Route path
    'type' => 'admin', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'ModuleManager',
            'controller' => 'AdminPages',
            'action' => 'installModule',
        ] // Required: namespace/controller/action
    ]
];

$moduleRoutes['ModuleManager']['Confirm Uninstall Module'] = [
    'name' => 'confirm_uninstall_module', // Required: Route name
    'path' => '/module-manager/confirm-uninstall-module', // Required: Route path
    'type' => 'admin', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'ModuleManager',
            'controller' => 'AdminPages',
            'action' => 'confirmUninstallModule',
        ] // Required: namespace/controller/action
    ]
];

$moduleRoutes['ModuleManager']['Uninstall Module'] = [
    'name' => 'uninstall_module', // Required: Route name
    'path' => '/module-manager/uninstall-module', // Required: Route path
    'type' => 'admin', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'ModuleManager',
            'controller' => 'AdminPages',
            'action' => 'uninstallModule',
        ] // Required: namespace/controller/action
    ]
];
//*/

/*
$moduleRoutes['ModuleManager']['Install Remote Modules'] = [
    'name' => 'install_remote_modules', // Required: Route name
    'path' => '/module-manager/install-remote-modules', // Required: Route path
    'type' => 'admin', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'ModuleManager',
            'controller' => 'AdminPages',
            'action' => 'installRemoteModules',
        ] // Required: namespace/controller/action
    ]
];
//*/

return $collection;
