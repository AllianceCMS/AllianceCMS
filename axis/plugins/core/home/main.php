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
$pluginRoutes['home']['Front Page']['path'] = ''; // Required: Route path
$pluginRoutes['home']['Front Page']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['home']['Front Page']['perms'] = array('View Home Page'); // Optional
$pluginRoutes['home']['Front Page']['specs']['values'] = array('controller' => 'homeFrontPage'); // Required: Callback function

function homeFrontPage(&$template_vars) {

    $template_vars['template'] = 'index.tpl.php';
    $template_vars['body'] = 'Hello Home Front Page';
    //echo '<br />Hello Home Front Page<br />';

    //findPlugins();

}
