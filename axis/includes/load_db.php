<?php

use Acms\Core\Data\Db;

// If the database config file (/venues/default/dbConnections.php) exists:
if (file_exists(DBCONNFILE)) {

    $sql = new Db;

    /*
    require_once (DBCONNFILE);
    $connection_factory = new Aura\Sql\ConnectionFactory();

    // Instantiate Database Object
    $connection = $connection_factory->newInstance(

        // adapter name
        DB_ADAPTER,

        // DSN elements for PDO; this can also be
        // an array of key-value pairs
        'host=' . DB_HOST . ';dbname=' . DB_NAME,

        // username for the connection
        DB_USER,

        // password for the connection
        DB_PASSWORD);
    //*/
} else {

    // Match Routes
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $pathArray = explode('/', $path);
    array_shift($pathArray);

    /*
     echo '<br /><pre>$path:<br />';
    echo print_r($path);
    echo '</pre><br />';
    //exit;
    //*/

    /*
     echo '<br /><pre>$pathArray:<br />';
    echo print_r($pathArray);
    echo '</pre><br />';
    //exit;
    //*/

    //echo '<br />$pathArray[0]: '. $pathArray[0] . '<br />';

    $pathVenue = $pathArray[0];

    //echo '<br />$pathVenue: '. $pathVenue . '<br />';
    //exit;

    // Go to the installation page if the dabase config file doesn't exist, and we're not already there.
    if ($pathVenue != 'install') {
        header('Location: /install');
        exit;
    } else {

        include_once(BASE_DIR . 'axis/plugins/core/Install/main.php');

        $installRoutes = require PACKAGES . 'Aura.Router/scripts/instance.php';

        // TODO: This needs to be a class method
        if (isset($pluginRoutes)) {
            foreach ($pluginRoutes as $plugin => $pluginPage) {

                foreach ($pluginPage as $route) {

                    if ($route['type'] === 'front') {
                        $installRoutes->add($route['name'], $route['path'], $route['specs']);
                    } else if ($route['type'] === 'admin') {
                        // Create array so we can attach admin routes
                        $adminRoutes['routes'][$route['name']] = [
                        'path' => $route['path'],
                        ];

                        foreach ($route['specs'] as $key => $value) {

                            if ($value) {
                                $adminRoutes['routes'][$route['name']][$key] = $value;
                            }
                        }
                    }
                }
            }
        }

        if (isset($adminRoutes)) {

            // attach admin routes
            $installRoutes->attach('/admin', $adminRoutes);

        }

        //$installRoutes->add($route['name'], '/{:venue}' . $route['path'], $route['specs']);

        $auraRoute = $installRoutes->match($path, $_SERVER);

        /*
        echo '<br />$auraRoute: ';
        echo print_r($auraRoute);
        echo '<br />';
        //*/

        $controller = $auraRoute->values['controller'];

        $controller($auraRoute->values);
        exit;
        // Execute this block only during site installation (doesn't matter which step of the installation we're on).

        // You can initialize any code needed for every page loaded. Ask yourself, "Does this code really need to run on every page load?".
        // Maybe add session data here?

        // Will initialize helpers in Controller Actions
        //$htmlHelper = new HtmlHelper;
        //$formHelper = new HtmlFormHelper;

    }
}
