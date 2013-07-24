<?php

use Acms\Core\Templates\Template;

$pluginRoutes['example']['My Example Page']['name'] = 'example'; // Required: Route name
$pluginRoutes['example']['My Example Page']['path'] = '/example/{:name*}'; // Required: Route path
$pluginRoutes['example']['My Example Page']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['example']['My Example Page']['perms'] = array('View Example Page'); // Optional
//$pluginRoutes['example']['My Example Page']['specs']['params'] = array('name' => '(\..+)'); // Optional
$pluginRoutes['example']['My Example Page']['specs']['values'] = array('controller' => 'example_01', 'name' => 'User'); // Required: Callback function

$pluginRoutes['example']['Example Admin Page']['name'] = 'admin_example'; // Required: Route name
$pluginRoutes['example']['Example Admin Page']['path'] = '/example'; // Required: Route path
$pluginRoutes['example']['Example Admin Page']['type'] = 'admin'; // Required: admin, front, back
$pluginRoutes['example']['Example Admin Page']['perms'] = array('Example Page Admin'); // Optional
$pluginRoutes['example']['Example Admin Page']['specs']['values'] = array('controller' => 'example_admin'); // Required: Callback function

function example_01($values)
{
    $body = new Template(dirname(__FILE__) . DS . 'views/main.tpl.php');
    $body->set('name', $values['name'][0]);

    return $body;
}


function example_admin($values)
{
    $body = new Template(dirname(__FILE__) . DS . 'views/admin.tpl.php');
    $body->set('greeting', 'Hello Example Admin');

    return $body;
}
