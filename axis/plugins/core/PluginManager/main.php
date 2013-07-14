<?php
echo '<br />Begin Testing Plugin Manager<br />';

//use Symfony\Component\Finder\Finder;

/*
$pluginRoute = array(
    'type' => 'admin', // admin, front, back
    'perms' => array(
        'Manage Plugins',
    ),
    'name' => 'plugin_admin',
    'path' => '/admin/plugins',
    'params' => array( // The regular expression subpatterns for path params; inline params will override these settings
        'id' => '(\d+)',
    ),
    'values' => array( // The default values for the route. These will be overwritten by matching params from the path
        'controller' => 'blog',
        'action' => 'read',
        'id' => 1,
    ),
    'method' => array( // The $server['REQUEST_METHOD'] must match one of these values
        'GET',
        'POST',
    ),
    'secure' => false, // When true the $server['HTTPS'] value must be on, or the request must be on port 443; when false, neither of those must be in place
    'routable' = true, // When false the route will not be used for matching, only for generating paths
    'is_match ' = 'myMatchFunction', // NEED TO TEST. A custom callback or closure with the signature function(array $server, \ArrayObject $matches) that returns true on a match, or false if not. This allows developers to build any kind of matching logic for the route, and to change the $matches for param values from the path
    'generate' = 'myDataFunction', // NEED TO TEST. A custom callback or closure with the signature function(\aura\router\Route $route, array $data) that returns a modified $data array to be used when generating the path
)
//*/

//*
$pluginRoutes['plugin_manager']['Plugins Admin Page']['name'] = 'plugin_admin'; // Required: Route name
$pluginRoutes['plugin_manager']['Plugins Admin Page']['path'] = '/plugins'; // Required: Route path
$pluginRoutes['plugin_manager']['Plugins Admin Page']['type'] = 'admin'; // Required: admin, front, back
$pluginRoutes['plugin_manager']['Plugins Admin Page']['perms'] = array('Manage Plugins'); // Optional
$pluginRoutes['plugin_manager']['Plugins Admin Page']['specs']['params'] = array('id' => '(\d+)'); // Optional
//$pluginRoutes['plugin_manager']['Plugins Admin Page']['specs']['values'] = array('controller' => 'pluginsAdmin', 'id' => '1'); // Required: Callback function
//$pluginRoutes['plugin_manager']['Plugins Admin Page']['specs']['secure'] = false; // Optional
//$pluginRoutes['plugin_manager']['Plugins Admin Page']['specs']['method'] = array('GET'); // Optional
//$pluginRoutes['plugin_manager']['Plugins Admin Page']['specs']['routable'] = true; // Optional
//$pluginRoutes['plugin_manager']['Plugins Admin Page']['specs']['is_match'] = myMatchFunction(); // Optional
//$pluginRoutes['plugin_manager']['Plugins Admin Page']['specs']['generate'] = myDataFunction(); // Optional
//*/

/*
$adminRoutes['plugin_manager']['Plugins Admin Page']['path'] = array(
    'plugin_admin' => array(
        'path' => '/admin/plugins',
        'values' => array(
            'controller' => 'pluginsAdmin'
        ),
    ),
);
//*/

function pluginsAdmin() {

    echo '<br />Hello Plugins Admin Page<br />';

    //findPlugins();

}

function findPlugins() {

    echo '<br />Begin Processing Axis Plugins<br />';


    $finderAxis = new Symfony\Component\Finder\Finder();
    $finderAxis
    ->files()
    ->name('main.php')
    ->in(PLUGINS_AXIS);

    foreach ($finderAxis as $file) {
        // Print the absolute path
        print '<br />'.$file->getRealpath().'<br />';
        $pluginDirsAxis[] = $file->getRealpath();

        // Print the relative path to the file, omitting the filename
        print '<br />'.$file->getRelativePath().'<br />';
        $pluginDirPathsAxis[] = $file->getRelativePath();

        // Print the relative path to the file
        //print '<br />'.$file->getRelativePathname().'<br />';
    }

    echo '<br /><pre>';
    echo print_r($pluginDirsAxis);
    echo '</pre><br />';

    echo '<br /><pre>';
    echo print_r($pluginDirPathsAxis);
    echo '</pre><br />';

    echo '<br />End Processing Axis Plugins<br />';

    echo '<br />Begin Processing Venue Plugins<br />';

    $finderVenues = new Symfony\Component\Finder\Finder();
    $finderVenues
    ->files()
    ->name('main.php')
    ->in(VENUES);

    foreach ($finderVenues as $file) {
        // Print the absolute path
        print '<br />'.$file->getRealpath().'<br />';
        $pluginDirsVenues[] = $file->getRealpath();

        // Print the relative path to the file, omitting the filename
        print '<br />'.$file->getRelativePath().'<br />';
        $pluginDirPathsVenues[] = $file->getRelativePath();

        // Print the relative path to the file
        //print '<br />'.$file->getRelativePathname().'<br />';
    }

    echo '<br /><pre>';
    echo print_r($pluginDirsVenues);
    echo '</pre><br />';

    echo '<br /><pre>';
    echo print_r($pluginDirPathsVenues);
    echo '</pre><br />';

    echo '<br />End Processing Venue Plugins<br />';
}

echo '<br />End Testing Plugin Manager<br />';
