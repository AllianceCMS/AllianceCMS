<?php

use Acms\Core\Templates\Template;

/*
$frontRoutes['home']['Front Page']['name'] = 'home';
$frontRoutes['home']['Front Page']['path'] = '/home';
$frontRoutes['home']['Front Page']['info'] = array(
    'values' => array(
        'controller' => 'homeFrontPage'
    ),
);
//*/

$pluginRoutes['Home']['Front Page']['name'] = 'home'; // Required: Route name
$pluginRoutes['Home']['Front Page']['path'] = ''; // Required: Route path
$pluginRoutes['Home']['Front Page']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['Home']['Front Page']['perms'] = array('View Home Page'); // Optional
$pluginRoutes['Home']['Front Page']['specs']['values'] = array('controller' => 'homeFrontPage'); // Required: Callback function

function homeFrontPage($values) {

    $body = new Template(dirname(__FILE__) . DS . 'views/main.tpl.php');

    return $body;

}

/* Twig Implementation
function homeFrontPage(&$template_vars) {

    $template_vars['template'] = 'index.tpl.php'
    $template_vars['body'] = 'Hello Home Front Page';
    //echo '<br />Hello Home Front Page<br />';

    //findPlugins();

}
//*/
