<?php

// Single Page Simple Example

//*
 // New test 03 plan for setting up $plugins array

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
