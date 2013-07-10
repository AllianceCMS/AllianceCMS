<?php
/**
 * Plugin array structure
*
* Goals:
*     To define routes so we can facilitate 'Clean URLS' and future development
*     To define permissions
*     To allow plugins to override/add to other core, provider (3rd Pary) and custom plugins, without touching their core code
*         Note: Template overrides are separate from Plugin overrides and will be applied in
*               the Template system using the directory structure
*/

/**
 * Plugin page array structure
*
* Defines:
*     plugin page name -
*         Example Values:
*             array('Blog Posts' => array($route, $permissions)) // page to list blog posts
*             array('View Blog Post' => array($route, $permissions)) // page to display on full blog post
*
*     plugin page route -
*         Example Value:
*             array('/blog/2013/06/19' => 'page_view_post')
*
*         The resulting URL would be:
*             http://your_site.com/index.php?a=/blog/2013/06/19 - without clean URLS
*             http://your_site.com/blog/2013/06/19 - with clean URLS
*
*         The function that is called would be:
*             function page_view_post() {}
*
*     plugin page permissions -
*         Example Value:
*             array('Edit Post' => true) // means this permission is active and will display on the Permissions admin page
*/

/*
$plugins[$plugin_name] = array();
$plugins[$plugin_name][$pages] = array();
$plugins[$plugin_name][$pages][$page_name] = array();
$plugins[$plugin_name][$pages][$page_name][$route] = array();
$plugins[$plugin_name][$pages][$page_name][$route][$route_path] = 'callbackFunction';
$plugins[$plugin_name][$pages][$page_name][$permissions] = array();
$plugins[$plugin_name][$pages][$page_name][$permissions][$perm_name] = true;
//*/

/**
 * Plugin blocks array structure
 *
 * Defines:
 *     plugin block name -
 *         Examples:
 *             array('Blog Categories' => array($route, $permissions)) // block to list recent blog posts
 *
 *     plugin block route -
 *         Example Value:
 *             'block_blog_categories'
 *
 *         The function that is called would be:
 *             function block_blog_categories() {}
 *
 *     plugin block permissions -
 *         Example:
 *             array('View Block' => true) -  means this permission is active and will display on the Permissions admin page
 */

/*
$plugins[$plugin_name][$blocks] = array();
$plugins[$plugin_name][$blocks][$block_name] = array();
$plugins[$plugin_name][$blocks][$block_name][$route] = 'callbackFunction';
$plugins[$plugin_name][$blocks][$block_name][$permissions] = array();
$plugins[$plugin_name][$blocks][$block_name][$permissions][$perm_name] = true;
//*/

/**
 * Plugin overrides array structure
 *
 * First the plugin data structures will be parsed and compiled, then overrides will be applied. Any conflicts between
 * overrides (inside the current plugin and with other plugins) will be caught and an error/exception will be thrown.
 */

/*
$plugins[$plugin_name][$overrides] = array();
$plugins[$plugin_name][$overrides][$plugin_name] = array();
$plugins[$plugin_name][$overrides][$plugin_name][$pages] = array();
$plugins[$plugin_name][$overrides][$plugin_name][$pages][$page_name] = array();
$plugins[$plugin_name][$overrides][$plugin_name][$pages][$page_name][$route] = array();
$plugins[$plugin_name][$overrides][$plugin_name][$pages][$page_name][$route][$route_path] = 'callbackFunction';
$plugins[$plugin_name][$overrides][$plugin_name][$pages][$page_name][$permissions] = array();
$plugins[$plugin_name][$overrides][$plugin_name][$pages][$page_name][$permissions][$perm_name] = true;

$plugins[$plugin_name][$overrides][$plugin_name][$blocks] = array();
$plugins[$plugin_name][$overrides][$plugin_name][$blocks][$block_name] = array();
$plugins[$plugin_name][$overrides][$plugin_name][$blocks][$block_name][$route] = 'callbackFunction';
$plugins[$plugin_name][$overrides][$plugin_name][$blocks][$block_name][$permissions] = array();
$plugins[$plugin_name][$overrides][$plugin_name][$blocks][$block_name][$permissions][$perm_name] = true;
//*/

// Single Page Simple Example
$plugins['hello_world']['pages']['General Greeting']['route']['/hello'] = 'pageHelloSimple';
$plugins['hello_world']['pages']['General Greeting']['permissions']['View Greeting'] = true;

function pageHelloSimple()
{
    $body = new Template("general_greeting.tpl.php");
}

// Contents of 'general_greeting.tpl.php' -
//     <h1>Hello World!</h1>
// Output:
//     Hello World!



// Single Block Simple Example
$plugins['hello_world']['blocks']['Specific Greeting']['route'] = 'blockHelloSimple';
$plugins['hello_world']['blocks']['Specific Greeting']['permissions']['View Block'] = true;

function blockHelloSimple()
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

// Single Array Complex Example
$plugins['hello_world'] = array(
    'pages' => array(
        'General Greeting' => array(
            'route' => array(
                '/hello' => 'pageHelloComplex'
            ),
            'permissions' => array(
                'View Greeting' => true
            ),
        ),
    ),
    'blocks' => array(
        'Specific Greeting' => array(
            'route' => 'blockHelloComplex',
            'permissions' => array(
                'View Block' => true
            ),
        ),
    ),
);

function pageHelloComplex()
{
    $body = new Template("general_greeting.tpl.php");
}

// Contents of 'general_greeting.tpl.php' -
//     <h1>Hello World!</h1>
// Output:
//     Hello World!

function blockHelloComplex()
{
    $body = new Template("specific_greeting.tpl.php");
}

// Contents of 'specific_greeting.tpl.php' -
//     <h1>Hello John!</h1>
// Output:
//     Hello John!

// Let's look at the resulting array
echo "<br />This is an example of the complex way to build the array: <br />";
echo "<pre>";
echo print_r($plugins);
echo "</pre>";

// Multiple Pages and Blocks Example
$plugins['hello_world'] = array(
    'pages' => array(
        'General Greeting' => array(
            'route' => array(
                '/hello' => 'pageHelloMultiple'
            ),
            'permissions' => array(
                'View Greeting' => true
            ),
        ),
        'General Farewell' => array(
            'route' => array(
                '/goodbye' => 'pageFarewellMultiple'
            ),
            'permissions' => array(
                'View Farewell' => true
            ),
        ),
    ),
    'blocks' => array(
        'Specific Greeting' => array(
            'route' => 'blockHelloMultiple',
            'permissions' => array(
                'View Block' => true
            ),
        ),
        'Specific Farewell' => array(
            'route' => 'blockFarewellMultiple',
            'permissions' => array(
                'View Block' => true
            ),
        ),
    ),
);

function pageHelloMultiple()
{
    $body = new Template("general_greeting.tpl.php");
}

// Contents of 'general_greeting.tpl.php' -
//     <h1>Hello World!</h1>
// Output:
//     Hello World!

function pageFarewellMultiple()
{
    $body = new Template("general_farewell.tpl.php");
}

// Contents of 'general_farewell.tpl.php' -
//     <h1>Goodnight World!</h1>
// Output:
//     Goodnight World!

function blockHelloMultiple()
{
    $body = new Template("specific_greeting.tpl.php");
}

// Contents of 'specific_greeting.tpl.php' -
//     <h1>Hello John!</h1>
// Output:
//     Hello John!

function blockFarewellMultiple()
{
    $body = new Template("specific_farewell.tpl.php");
}

// Contents of 'specific_farewell.tpl.php' -
//     <h1>Goodnight John!</h1>
// Output:
//     Goodnight John!

// Let's look at the resulting array
echo "<br />This is an example of building multiple pages and blocks using the complex way to build the array: <br />";
echo "<pre>";
echo print_r($plugins);
echo "</pre>";

// Overrides  Example
//
// Let's add some overrides to the 'Multiple Pages and Blocks' array.
// This will:
//     Call a my own custom callback function when the page route '/goodbye' is processed
//     Add the permission 'Site Member Only' to the page route '/goodbye'
//     Disable the 'View Block' permission for the 'Specific Greeting' and 'Specific Farewell' Blocks
$plugins['hello_world'] = array(
    'overrides' => array(
        'pages' => array(
            'General Farewell' => array(
                'route' => array(
                    '/goodbye' => 'myPageFarewellMultiple'
                ),
                'permissions' => array(
                    'Site Member Only' => true
                ),
            ),
        ),
        'blocks' => array(
            'Specific Greeting' => array(
                'permissions' => array(
                    'View Block' => false
                ),
            ),
            'Specific Farewell' => array(
            'permissions' => array(
            'View Block' => false
            ),
            ),
        ),
    )
);

function myPageFarewellMultiple()
{
    $body = new Template("my_general_farewell.tpl.php");
}

// Contents of 'my_general_farewell.tpl.php' -
//     <h1>Goodnight Folks!</h1>
// Output:
//     Goodnight Folks!

// Let's look at the resulting array
echo "<br />This is an example of how to change and add to the \$plugins array using overrides: <br />";
echo "<br />Note: First the plugin data structures will be parsed and compiled, then overrides will be applied.<br />";
echo "Any conflicts between overrides (inside the current plugin and with other plugins) will be caught and an error/exception will be thrown.<br />";
echo "<pre>";
echo print_r($plugins);
echo "</pre>";