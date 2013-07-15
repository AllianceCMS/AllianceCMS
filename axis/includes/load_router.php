<?php

//*
// Begin Testing Aura.Router

echo '<br />Begin Testing Aura.Router<br />';

echo '<br />';

// Initialize Aura.Router
$mapRoutes = require PACKAGES . 'Aura.Router/scripts/instance.php';

function themesSimple01()
{
    echo '<br />Hello Themes Admin Simple 01<br />';
}

// Mapping Routes
//$mapRoutes->add('home', '/');

$mapRoutes->add('read', '/blog/read/{:id}{:format}', array(
    'params' => array(
        'id' => '(\d+)',
        'format' => '(\..+)?',
    ),
    'values' => array(
    'controller' => 'blog',
    'action' => 'read',
    'format' => 'html',
    ),
));

/**
 * Query Db and find out which plugins are installed
 */

// Include only installed plugins 'main.php' so we have access to routes
$result = $sql->fetchAll('SELECT folder_path, folder_name FROM a_plugins WHERE active = 2');

/*
echo '<br /><pre>\$result:<br />';
echo print_r($result);
echo '</pre><br />';
//*/

foreach ($result as $row) {

    $plugin_folder_path = $row['folder_path'];
    $plugin_folder_name = $row['folder_name'];

    if (file_exists(BASE_DIR . $plugin_folder_path . $plugin_folder_name . DS . 'main.php')) {
        include_once(BASE_DIR . $plugin_folder_path . $plugin_folder_name . DS . 'main.php');
    }

    /*
    if ($plugin_folder_name === 'PluginManager') {
        $mapRoutes->add($routes['plugin_manager']['name'], '/{:venue}' . $routes['plugin_manager']['path'], $routes['plugin_manager']['info']);
    }
    //*/
}

/*
echo '<br /><pre>$frontRoutes:<br />';
echo print_r($frontRoutes);
echo '</pre><br />';
//exit;
//*/

/*
 echo '<br /><pre>$adminRoutes:<br />';
echo print_r($adminRoutes);
echo '</pre><br />';
//exit;
//*/

//*
if (isset($pluginRoutes)) {
    foreach ($pluginRoutes as $plugin => $pluginPage) {
        /*
        echo '<br /><pre>$plugin = ';
        echo print_r($plugin);
        echo '</pre><br />';
        //*/

        /*
        echo '<br /><pre>$pluginPage = ';
        echo print_r($pluginPage);
        echo '</pre><br />';
        //*/

        foreach ($pluginPage as $route) {

            //$mapRoutes->add($route['name'], '/{:venue}' . $route['path'], $route['info']);

            //*
            echo '<br /><pre>$route = ';
            echo print_r($route);
            echo '</pre><br />';
            //*/

            //*
            if ($route['type'] === 'front') {
                $mapRoutes->add($route['name'], '/{:venue}' . $route['path'], $route['specs']);
            } else if ($route['type'] === 'admin') {
                $adminRoutes['routes'][$route['name']] = array(
                    'path' => $route['path'],
                );

                /*
                echo '<br /><pre>$route["specs"] = ';
                echo print_r($route['specs']);
                echo '</pre><br />';
                //*/

                foreach ($route['specs'] as $key => $value) {

                    /*
                    echo '<br /><pre>$adminRoutes["routes"][$route["name"]] = ';
                    echo print_r($adminRoutes['routes'][$route['name']]);
                    echo '</pre><br />';
                    //*/

                    /*
                    echo '<br /><pre>$key = ';
                    echo print_r($key);
                    echo '</pre><br />';
                    //*/

                    /*
                    echo '<br /><pre>$value = ';
                    echo print_r($value);
                    echo '</pre><br />';
                    //*/

                    if ($value) {
                        $adminRoutes['routes'][$route['name']][$key] = $value;
                    }
                }
            }
            //*/
        }
    }
}
//*/

/*
echo '<br /><pre>$attachAdminRoutes = ';
echo print_r($attachAdminRoutes);
echo '</pre><br />';
//*/

if (isset($adminRoutes)) {
    /*
    echo '<br /><pre>$adminRoutes = ';
    echo print_r($adminRoutes);
    echo '</pre><br />';
    //*/

    $mapRoutes->attach('/{:venue}/admin', $adminRoutes);

    /*
    $mapRoutes->attach('/{:venue}/admin', array(

        // the routes to attach
        'routes' => array(

            // a short-form route named 'cron'
            //'cron' => '/cron',

            // a long-form route named 'themes'
            'plugin_admin' => array(
                'path' => '/plugins',
                'values' => array(
                    'controller' => 'pluginsAdmin',
                ),
            ),
        ),
    ));
    //*/

}

// Matching Routes
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// get the route based on the path and server
$auraRoute = $mapRoutes->match($path, $_SERVER);

//*
echo '<br /><pre>$auraRoute:<br />';
echo print_r($auraRoute);
echo '</pre><br />';
//exit;
//*/

if (! $auraRoute) {

    // NEED TO CHANGE THIS TO REDIRECT TO CUSTOM 404
    // NEED TO CHANGE THIS TO REDIRECT TO CUSTOM 404
    // NEED TO CHANGE THIS TO REDIRECT TO CUSTOM 404

    // If no route found then redirect client to root route
    //header("Location: /");

    // NEED TO CHANGE THIS TO REDIRECT TO CUSTOM 404
    // NEED TO CHANGE THIS TO REDIRECT TO CUSTOM 404
    // NEED TO CHANGE THIS TO REDIRECT TO CUSTOM 404


    //*
    // no route object was returned
    echo "<br />No application route was found for that URI path.<br />";
    exit();
    //*/
}

// does the route indicate a controller?
if (isset($auraRoute->values['controller'])) {
    // take the controller class directly from the route
    $controller = $auraRoute->values['controller'];
} else {
    // use a default controller
    $controller = 'index';
}

$controller();

function index() {
    echo '<br />Hello Function index<br />';
}

function blog() {
    echo '<br />Hello Function blog<br />';
}

/*
echo '<pre>$auraRoute = ';
echo print_r($auraRoute);
echo '</pre>';
//*/

echo '<br />';

echo '<br />End Testing Aura.Router<br />';


// Create loop so we can add routes to Aura.Router's mapped routes

/*
 foreach ($plugins as $key => $value) {
echo '$key = ' . $key . ' => $value = ' . $value;
echo '<br />Do something with $plugins array.<br />';
}
//*/

/*
 $keys = extract($plugins);

echo '<br />Result of $keys 2: <br />';
echo '<pre>';
echo print_r($keys);
echo '</pre>';
//*/

/*
 function multiarray_keys($ar) {

foreach($ar as $k => $v) {
$keys[] = $k;
if (is_array($ar[$k]))
    $keys = array_merge($keys, multiarray_keys($ar[$k]));
}
return $keys;
}

foreach ($plugins as $plugin_name) {
//echo '$plugin_name = ' . $plugin_name;
//echo array_keys($content_name);

$keys = multiarray_keys($plugin_name);

echo '<br />Result of $keys : <br />';
echo '<pre>';
echo print_r($plugins);
echo '</pre>';

echo '<br />Do something with $plugins array.<br />';
}
//*/


// End Testing Aura.Router
//*/
