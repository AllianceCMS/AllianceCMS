<?php

/*
$frontRoutes['example']['My Example Page']['name'] = 'example';
$frontRoutes['example']['My Example Page']['path'] = '/example';
$frontRoutes['example']['My Example Page']['type'] = 'front';
$frontRoutes['example']['My Example Page']['info'] = array(
    'values' => array(
        'controller' => 'example_01'
    ),
);


$adminRoutes['example']['Example Admin Page']['name'] = 'admin_example';
$adminRoutes['example']['Example Admin Page']['path'] = '/example';
$adminRoutes['example']['Example Admin Page']['type'] = 'admin';
$adminRoutes['example']['Example Admin Page']['info'] = array(
    'values' => array(
        'controller' => 'admin_example'
    ),
);
//*/

$pluginRoutes['example']['My Example Page']['name'] = 'example'; // Required: Route name
$pluginRoutes['example']['My Example Page']['path'] = '/example'; // Required: Route path
$pluginRoutes['example']['My Example Page']['type'] = 'front'; // Required: admin, front, back
$pluginRoutes['example']['My Example Page']['perms'] = array('View Example Page'); // Optional
$pluginRoutes['example']['My Example Page']['specs']['values'] = array('controller' => 'example_01'); // Required: Callback function

$pluginRoutes['example']['Example Admin Page']['name'] = 'admin_example'; // Required: Route name
$pluginRoutes['example']['Example Admin Page']['path'] = '/example'; // Required: Route path
$pluginRoutes['example']['Example Admin Page']['type'] = 'admin'; // Required: admin, front, back
$pluginRoutes['example']['Example Admin Page']['perms'] = array('Example Page Admin'); // Optional
$pluginRoutes['example']['Example Admin Page']['specs']['values'] = array('controller' => 'example_admin'); // Required: Callback function


/*
//$adminRoutes['example']['Example Admin Page']['name'] = 'example';
$adminRoutes['example']['Example Admin Page']['path'] = array(
    'example' => array(
        'path' => '/admin/example',
        'values' => array(
            'controller' => 'example_admin'
        ),
    ),
);
//*/

/*
$adminRoutes['example']['Example Admin Page']['info'] = array(
    'values' => array(
        'controller' => 'example_admin'
    ),
);
//*/

function example_01()
{
    echo '<br />Hello Example 01<br />';
}


function example_admin()
{
    echo '<br />Hello Example Admin<br />';
}

//*/

// Single Page Simple Example

//*
// New test 03 plan for setting up $plugins array

/*
$plugins['hello_world'] = array( // was a page entry
    'content_name' => 'General Greeting',
//    'route_path' => '/hello',
//    'route_callback' => 'helloSimple01',
    'permissions' => array('View Greeting' => true),
    'Specific Greeting' => array(
        'route' => 'helloSimple02',
        'permissions' => array('View Specific Greeting' => true),
    ),
);
//*/

/*
$routeName = null;
$routePath = '/plugin';
$routeFiller = array(
    'values' => array(
        'controller' => 'pluginSimple01'
    )
);

$mapRoutes->add($routeName, '/{:venue}' . $routePath, $routeFiller);
//*/



/*
echo "<br />\$routes['plugin_manager']['name'] = " . $routes['plugin_manager']['name'] . "<br />";
echo "<br />\$routes['plugin_manager']['path'] = " . $routes['plugin_manager']['path'] . "<br />";

echo '<br /><pre>$routes:<br />';
echo print_r($routes['plugin_manager']['info']);
echo '</pre><br />';
//exit;
//*/

//$mapRoutes->add($routes['plugin_manager']['name'], '/{:venue}' . $routes['plugin_manager']['path'], $routes['plugin_manager']['info']);

/*
$mapRoutes->add(null, '/hello', array(
    'values' => array(
        'controller' => 'helloSimple01',
    ),
));

$mapRoutes->add(null, '/goodbye', array(
    'values' => array(
        'controller' => 'goodbySimple01',
    ),
));

$mapRoutes->add(null, '/hi', array(
    'values' => array(
        'controller' => 'helloSimple02',
    ),
));

$mapRoutes->add(null, '/later', array(
    'values' => array(
        'controller' => 'goodbySimple02',
    ),
));

function helloSimple01()
{
    echo '<br />Hello Simple 01';
}

function goodbySimple01()
{
    echo '<br />Goodbye Simple 01';
}

function helloSimple02()
{
    echo '<br />Hello Simple 02';
}

function goodbySimple02()
{
    echo '<br />Goodbye Simple 02';
}
//*/

// Contents of 'specific_greeting.tpl.php' -
//     <h1>Hello John!</h1>
// Output:
//     Hello John!
//*/

/*
// Let's look at the resulting array
echo "<br />This is an example of the simple way to build the array: <br />";
echo "<pre>";
echo print_r($plugins);
echo "</pre>";

$plugins['example'] = array( // was a page entry
    'General Greeting' => array(
        'route' => array('/hello' => 'helloSimple03'),
        'permissions' => array('View Greeting' => true),
    ),
    'Specific Greeting' => array(
        'route' => 'helloSimple04',
        'permissions' => array('View Specific Greeting' => true),
    ),
);

function helloSimple03()
{
$body = new Template("general_greeting.tpl.php");
}

// Contents of 'general_greeting.tpl.php' -
//     <h1>Hello World!</h1>
// Output:
//     Hello World!

// Single Block Simple Example

function helloSimple04()
{
$body = new Template("specific_greeting.tpl.php");
}

// Contents of 'specific_greeting.tpl.php' -
//     <h1>Hello John!</h1>
// Output:
//     Hello John!

// Let's look at the resulting array
echo "<br />This is an example of the simple way to build the array: <br />";
echo "<pre>";
echo print_r($plugins);
echo "</pre>";
//*/

/*
// New test 02 plan for setting up $plugins array

$plugins['hello_world'] = array( // was a page entry
    'General Greeting' => array(
        'route' => array('/hello' => 'helloSimple01'),
        'permissions' => array('View Greeting' => true),
    ),
    'Specific Greeting' => array(
        'route' => 'helloSimple02',
        'permissions' => array('View Specific Greeting' => true),
    ),
);

function helloSimple01()
{
    $body = new Template("general_greeting.tpl.php");
}

// Contents of 'general_greeting.tpl.php' -
//     <h1>Hello World!</h1>
// Output:
//     Hello World!

// Single Block Simple Example

function helloSimple02()
{
    $body = new Template("specific_greeting.tpl.php");
}

// Contents of 'specific_greeting.tpl.php' -
//     <h1>Hello John!</h1>
// Output:
//     Hello John!

// Let's look at the resulting array
echo "<br />This is an example of the simple way to build the array: <br />";
echo "<pre>";
echo print_r($plugins);
echo "</pre>";

$plugins['example'] = array( // was a page entry
    'General Greeting' => array(
        'route' => array('/hello' => 'helloSimple03'),
        'permissions' => array('View Greeting' => true),
    ),
    'Specific Greeting' => array(
        'route' => 'helloSimple04',
        'permissions' => array('View Specific Greeting' => true),
    ),
);

function helloSimple03()
{
    $body = new Template("general_greeting.tpl.php");
}

// Contents of 'general_greeting.tpl.php' -
//     <h1>Hello World!</h1>
// Output:
//     Hello World!

// Single Block Simple Example

function helloSimple04()
{
    $body = new Template("specific_greeting.tpl.php");
}

// Contents of 'specific_greeting.tpl.php' -
//     <h1>Hello John!</h1>
// Output:
//     Hello John!

// Let's look at the resulting array
echo "<br />This is an example of the simple way to build the array: <br />";
echo "<pre>";
echo print_r($plugins);
echo "</pre>";
//*/


/*
// New test 01 plan for setting up $plugins array

// $plugins[$plugin_name][$content_name][$route][$route_path] = 'callbackFunction';
$plugins['hello_world']['General Greeting']['route']['/hello'] = 'helloSimple01'; // was a page entry

// $plugins[$plugin_name][$content_name][$permissions][$perm_name] = true;
$plugins['hello_world']['General Greeting']['permissions']['View Greeting'] = true; // was a page entry

// $plugins[$plugin_name][$content_name][$route] = 'callbackFunction';
$plugins['hello_world']['Specific Greeting']['route'] = 'helloSimple02'; // was a block entry

// $plugins[$plugin_name][$content_name][$permissions][$perm_name] = true;
$plugins['hello_world']['Specific Greeting']['permissions']['View Block'] = true; // was a block entry

function helloSimple01()
{
    $body = new Template("general_greeting.tpl.php");
}

// Contents of 'general_greeting.tpl.php' -
//     <h1>Hello World!</h1>
// Output:
//     Hello World!

// Single Block Simple Example

function helloSimple02()
{
    $body = new Template("specific_greeting.tpl.php");
}

// Contents of 'specific_greeting.tpl.php' -
//     <h1>Hello John!</h1>
// Output:
//     Hello John!

// Let's look at the resulting array
echo "<br />This is an example of the simple way to build the array: <br />";
echo "<pre>";
echo print_r($plugins);
echo "</pre>";

// $plugins[$plugin_name][$content_name][$route][$route_path] = 'callbackFunction';
$plugins['example']['General Greeting']['route']['/hello'] = 'helloSimple03'; // was a page entry

// $plugins[$plugin_name][$content_name][$permissions][$perm_name] = true;
$plugins['example']['General Greeting']['permissions']['View Greeting'] = true; // was a page entry

// $plugins[$plugin_name][$content_name][$route] = 'callbackFunction';
$plugins['example']['Specific Greeting']['route'] = 'helloSimple04'; // was a block entry

// $plugins[$plugin_name][$content_name][$permissions][$perm_name] = true;
$plugins['example']['Specific Greeting']['permissions']['View Block'] = true; // was a block entry

function helloSimple03()
{
    $body = new Template("general_greeting.tpl.php");
}

// Contents of 'general_greeting.tpl.php' -
//     <h1>Hello World!</h1>
// Output:
//     Hello World!

// Single Block Simple Example

function helloSimple04()
{
    $body = new Template("specific_greeting.tpl.php");
}

// Contents of 'specific_greeting.tpl.php' -
//     <h1>Hello John!</h1>
// Output:
//     Hello John!
//*/

/*
// Let's look at the resulting array
echo "<br />This is an example of the simple way to build the array: <br />";
echo "<pre>";
echo print_r($plugins);
echo "</pre>";
//*/
