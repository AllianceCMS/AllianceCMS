<?php
$pluginRoutes['PluginManager']['Current Plugins'] = [
    'name' => 'plugin_manager', // Required: Route name
    'path' => '/plugin-manager', // Required: Route path
    'type' => 'admin', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'PluginManager',
            'controller' => 'AdminPages',
            'action' => 'currentPlugins',
        ] // Required: namespace/controller/action
    ]
];

$pluginRoutes['PluginManager']['Install Local Plugins'] = [
    'name' => 'install_local_plugins', // Required: Route name
    'path' => '/plugin-manager/install-local-plugins/{:query_string*}', // Required: Route path
    'type' => 'admin', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'PluginManager',
            'controller' => 'AdminPages',
            'action' => 'installLocalPlugins',
        ] // Required: namespace/controller/action
    ]
];

$pluginRoutes['PluginManager']['Install Plugin'] = [
    'name' => 'install_plugin', // Required: Route name
    'path' => '/plugin-manager/install-plugin', // Required: Route path
    'type' => 'admin', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'PluginManager',
            'controller' => 'AdminPages',
            'action' => 'installPlugin',
        ] // Required: namespace/controller/action
    ]
];

/*
$pluginRoutes['PluginManager']['Install Remote Plugins'] = [
    'name' => 'install_remote_plugins', // Required: Route name
    'path' => '/plugin-manager/install-remote-plugins', // Required: Route path
    'type' => 'admin', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'PluginManager',
            'controller' => 'AdminPages',
            'action' => 'installRemotePlugins',
        ] // Required: namespace/controller/action
    ]
];
//*/
