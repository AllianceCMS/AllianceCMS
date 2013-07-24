<?php
// Create route for Installation: Welcome page
$pluginRoutes['Install']['Start Installation'] = [
    'name' => 'install_welcome', // Required: Route name
    'path' => '/install', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Install',
            'controller' => 'InstallSite',
            'action' => 'installWelcome',
        ] // Required: namespace/controller/action
    ]
];

// Create route for Installation: Language page
$pluginRoutes['Install']['Select Language'] = [
    'name' => 'install_language', // Required: Route name
    'path' => '/install/language', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Install',
            'controller' => 'InstallSite',
            'action' => 'installLanguage',
            'method' => [
                'POST'
            ],
        ] // Required: namespace/controller/action
    ]
];

// Create route for Installation: Database Info page
$pluginRoutes['Install']['Prompt For DB Info'] = [
    'name' => 'install_db_info', // Required: Route name
    'path' => '/install/database-info/{:errors*}', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Install',
            'controller' => 'InstallSite',
            'action' => 'installDbInfo',
            'method' => [
                'POST',
                'GET',
            ],
        ] // Required: namespace/controller/action
    ]
];

// Create route for Installation: Confirm Database Info page
$pluginRoutes['Install']['Confirm DB Info'] = [
    'name' => 'install_confirm_db_info', // Required: Route name
    'path' => '/install/confirm-database-info', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Install',
            'controller' => 'InstallSite',
            'action' => 'installConfirmDbInfo',
            'method' => ['POST'],
        ] // Required: namespace/controller/action
    ]
];

// Create route for Installation: Test/Confirm Database Connection page
$pluginRoutes['Install']['Test/Confirm DB Connection'] = [
    'name' => 'install_test_db_connection', // Required: Route name
    'path' => '/install/test-database-connection', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Install',
            'controller' => 'InstallSite',
            'action' => 'installTestDbConnection',
            'method' => ['POST'],
        ] // Required: namespace/controller/action
    ]
];

// Create route for Installation: Prompt For Admin Info page
$pluginRoutes['Install']['Prompt For Admin Info'] = [
    'name' => 'install_admin_info', // Required: Route name
    'path' => '/install/admin-info/{:errors*}', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Install',
            'controller' => 'InstallSite',
            'action' => 'installAdminInfo',
            'method' => [
                'POST',
                'GET',
            ],
        ] // Required: namespace/controller/action
    ]
];

// Create route for Installation: Confirm Admin Info page
$pluginRoutes['Install']['Confirm Admin Info'] = [
    'name' => 'install_confirm_admin_info', // Required: Route name
    'path' => '/install/confirm-admin-info', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Install',
            'controller' => 'InstallSite',
            'action' => 'installConfirmAdminInfo',
            'method' => ['POST'],
        ] // Required: namespace/controller/action
    ]
];

// Create route for Installation: Prompt For Site Info page
$pluginRoutes['Install']['Prompt For Site Info'] = [
    'name' => 'install_site_info', // Required: Route name
    'path' => '/install/site-info', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Install',
            'controller' => 'InstallSite',
            'action' => 'installSiteInfo',
            'method' => ['POST'],
        ] // Required: namespace/controller/action
    ]
];

// Create route for Installation: Confirm Site Info page
$pluginRoutes['Install']['Confirm Site Info'] = [
    'name' => 'install_confirm_site_info', // Required: Route name
    'path' => '/install/confirm-site-info', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Install',
            'controller' => 'InstallSite',
            'action' => 'installConfirmSiteInfo',
            'method' => ['POST'],
        ] // Required: namespace/controller/action
    ]
];

// Create route for Installation: Confirm Installation page
$pluginRoutes['Install']['Confirm Installation'] = [
    'name' => 'install_confirm_installation', // Required: Route name
    'path' => '/install/confirm-installation', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Install',
            'controller' => 'InstallSite',
            'action' => 'installConfirmInstallation',
            'method' => ['POST'],
        ] // Required: namespace/controller/action
    ]
];

// Create route for Installation: Complete Installation page
$pluginRoutes['Install']['Complete Installation'] = [
    'name' => 'install_complete_installation', // Required: Route name
    'path' => '/install/complete-installation', // Required: Route path
    'type' => 'front', // Required: admin, front, back
    'specs' => [
        'values' => [
            'namespace' => 'Install',
            'controller' => 'InstallSite',
            'action' => 'installCompleteInstallation',
            'method' => ['POST'],
        ] // Required: namespace/controller/action
    ]
];
