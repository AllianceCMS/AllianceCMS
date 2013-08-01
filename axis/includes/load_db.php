<?php

use Acms\Core\Data\Db;

// If the database config file (dbConnection.php) exists create database object
if (file_exists(DBCONNFILE)) {

    $sql = new Db;

} else {

    // If the database config file (dbConnection.php) does not exist send user to installation page

    // Match Routes
    // @todo: The following five lines of active code needs to be a class method
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $pathArray = explode('/', $path);
    array_shift($pathArray);
    $pathVenue = $pathArray[0];
    unset($pathArray);

    // Go to the installation page if the dabase config file doesn't exist, and we're not already there.
    if ($pathVenue != 'install') {
        header('Location: /install');
        exit;
    } else {

        include_once(BASE_DIR . 'axis/plugins/Install/routes.php');

        $acmsLoader->add('Install\\', PLUGINS_AXIS);

        $installRoutes = require PACKAGES . 'Aura.Router/scripts/instance.php';

        // TODO: The next two 'if' statements need to be a class method
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

        $auraRoute = $installRoutes->match($path, $_SERVER);
        $basePath = BASE_URL;

        $system['routeInfo'] = $auraRoute;
        $system['basePath'] = $basePath;


        // Does the route indicate a controller?
        if (isset($auraRoute->values['controller'])) {
            // Take the controller class directly from the route
            $controller = $auraRoute->values['namespace'] . '\\' . $auraRoute->values['controller'];
        }

        // Does the route indicate an action?
        if (isset($auraRoute->values['action'])) {
            // Take the controller action directly from the route
            $action = $auraRoute->values['action'];
        }

        $page = new $controller;

        // Dynamically call Install plugin controller/action
        $page->$action($system);

        exit;
    }
}
