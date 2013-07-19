<?php
//echo '<br />Begin Testing Plugin Manager<br />';

use Acms\Core\Templates\Template;

//*
$pluginRoutes['plugin_manager']['Plugins Admin Page']['name'] = 'plugin_admin'; // Required: Route name
$pluginRoutes['plugin_manager']['Plugins Admin Page']['path'] = '/plugins'; // Required: Route path
$pluginRoutes['plugin_manager']['Plugins Admin Page']['type'] = 'admin'; // Required: admin, front, back
$pluginRoutes['plugin_manager']['Plugins Admin Page']['perms'] = array('Manage Plugins'); // Optional
$pluginRoutes['plugin_manager']['Plugins Admin Page']['specs']['params'] = array('id' => '(\d+)'); // Optional
$pluginRoutes['plugin_manager']['Plugins Admin Page']['specs']['values'] = array('controller' => 'pluginsAdmin', 'id' => '1'); // Required: Callback function
//$pluginRoutes['plugin_manager']['Plugins Admin Page']['specs']['secure'] = false; // Optional
//$pluginRoutes['plugin_manager']['Plugins Admin Page']['specs']['method'] = array('GET'); // Optional
//$pluginRoutes['plugin_manager']['Plugins Admin Page']['specs']['routable'] = true; // Optional
//$pluginRoutes['plugin_manager']['Plugins Admin Page']['specs']['is_match'] = myMatchFunction(); // Optional
//$pluginRoutes['plugin_manager']['Plugins Admin Page']['specs']['generate'] = myDataFunction(); // Optional
//*/

function pluginsAdmin($values) {

    $body = new Template(dirname(__FILE__) . DS . 'templates/main.tpl.php');
    $body->set('hello', 'Hello Plugins Admin Page');

    return $body;

    //echo '<br />Hello Plugins Admin Page<br />';

    //findPlugins();

}

function findPlugins($values) {

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

//echo '<br />End Testing Plugin Manager<br />';
