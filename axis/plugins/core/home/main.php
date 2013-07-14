<?php

/*
$frontRoutes['home']['Front Page']['name'] = 'home';
$frontRoutes['home']['Front Page']['path'] = '/home';
$frontRoutes['home']['Front Page']['info'] = array(
    'values' => array(
        'controller' => 'homeFrontPage'
    ),
);
//*/

$pluginRoutes['home']['Front Page']['name'] = 'home'; // Required: Route name
$pluginRoutes['home']['Front Page']['path'] = '/home'; // Required: Route path
$pluginRoutes['home']['Front Page']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['home']['Front Page']['perms'] = array('View Home Page'); // Optional
$pluginRoutes['home']['Front Page']['specs']['values'] = array('controller' => 'homeFrontPage'); // Required: Callback function

function homeFrontPage() {

    echo '<br />Hello Home Front Page<br />';

    //findPlugins();

}
