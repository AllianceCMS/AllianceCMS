<?php

// Don't dispatch route if not explicitly told to do so
$dispatch = false;

// Get 'maintenance_flag' for main venue
$sql->dbSelect('venues', 'maintenance_flag', 'id = :id', ['id' => intval(1)]);
$result = $sql->dbFetch('one');

// If maintenance_flag is turned on send user to maintenance page/plugin (???possibly plugin that contains '404' pages???)
if ((int) $result['maintenance_flag'] === intval(2)) {
    // Display 'Site undergoing maintenance' page
    echo 'Site is down for maintenance, please check back later.';
    exit;
} else {

    // Initialize Aura.Router
    $mapRoutes = require PACKAGES . 'Aura.Router/scripts/instance.php';

    /**
     * Query Db and find out which plugins are installed
     */

    // Include only installed plugins 'routes.php' so we have access to routes
    $sql->dbSelect('plugins', 'folder_path, folder_name', 'active = :active', ['active' => intval(2)]);
    $result = $sql->dbFetch();

    foreach ($result as $row) {

        /**
         * Dynamically load plugins based on 'folder_path' ('plugins' db table field)
         *
         * The plugin folder must reside in '/axis/plugins' or '/zones/some-zone/plugins/some-directory'
         *     (i.e.  '/zones/all/plugins/provider', '/zones/subdomain.mysite.com/plugins/custom')
         */

        $loadPlugin = null;
        $plugin_path_array = null;
        $plugin_path = null;
        $plugin_folder_name = null;

        $plugin_path_array = explode('/', $row['folder_path']);

        if ($plugin_path_array['0'] == 'axis') {
            $plugin_path = PLUGINS_AXIS;
            $loadPlugin = 1;
        } elseif ($plugin_path_array['0'] == 'zones') {
            if ($plugin_path_array['1'] == 'all') {
                $plugin_path = ZONES . $plugin_path_array['1'] . DS . $plugin_path_array['2'] . DS . $plugin_path_array['3'] . DS;
                $loadPlugin = 1;
            } elseif ($plugin_path_array['1'] == $_SERVER['SERVER_NAME']) {
                $plugin_path = ZONES . $_SERVER['SERVER_NAME'] . DS . $plugin_path_array['2'] . DS . $plugin_path_array['3'] . DS;
                $loadPlugin = 1;
            }
        }

        $plugin_folder_name = $row['folder_name'];

        // Get routes for active plugins and add plugin namespace to autoloader
        if ($loadPlugin) {
            if (file_exists($plugin_path . $plugin_folder_name . DS . 'routes.php')) {
                include_once($plugin_path . $plugin_folder_name . DS . 'routes.php');
                $acmsLoader->add($plugin_folder_name . '\\', $plugin_path);
            }
        }
    }

    // @todo: The next two 'if' statements should be a class method
    // Parse plugin routes and add them to the routing map
    if (isset($pluginRoutes)) {
        foreach ($pluginRoutes as $plugin => $pluginPage) {

            foreach ($pluginPage as $route) {

                if ($route['type'] === 'front') {
                    // If plugin route is a front end route then add route to routing map
                    $mapRoutes->add($route['name'], '/{:venue}' . $route['path'], $route['specs']);
                } else if ($route['type'] === 'admin') {
                    // Create array so we can attach admin routes to routing map
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

    // If there are 'admin' routes, attach routes to routing map
    if (isset($adminRoutes)) {

        // attach admin routes
        $mapRoutes->attach('/{:venue}/admin', $adminRoutes);

    }

    // Match Routes
    // @todo: The following five lines of active code should be a class method
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Used in this file and in load_dispatcher.php
    $pathArray = explode('/', $path);
    array_shift($pathArray);
    $pathVenue = $pathArray[0];
    unset($pathArray);

    // If there is no venue in the path, send user to main venue
    if ((strtolower($pathVenue) === strtolower('Install'))) {
        if (file_exists(DBCONNFILE)) {

            // Send user to main venue

            $sql->dbSelect('venues', 'name', 'id = :id', ['id' => intval(1)]);

            // If there is a main venue, redirect to the main venue
            if($list = $sql->dbFetch()) {
                header("Location: /" . $list[0]['name']);
                exit;
            }
        }
    } elseif ($path === '/') {

        // Send user to main venue

        $sql->dbSelect('venues', 'name', 'id = :id', ['id' => intval(1)]);

        // If there is a main venue, redirect to the main venue
        if($list = $sql->dbFetch()) {
            header("Location: /" . $list[0]['name']);
            exit;
        } else {
            // No main venue (should never happen if site has been installed)
            // This means the db was corrupted, since we'll never reach this if there is a dbConnection.php)
            // Give some kind of error
            exit;
        }
    }

    // If there is a venue parameter in the path, try to load the venue

    // Check if venue exists (in database)
    $sql->dbSelect('venues', 'name, active, active_theme', 'name = :name', ['name' => $pathVenue], 'ORDER BY name');

    // If venue exists
    if ($currentVenue = $sql->dbFetch()) {

        // Check if venue is active

        // If venue is active, load venue
        if ($currentVenue[0]['active'] === '2') {
            $dispatch = true;
        } else {
            // If venue is not active, give message stating it exists but is not active/available
            echo '<br />Venue Exists But Is Not Active<br />';
            $dispatch = true;
        }
    } else {
        // Venue does not exist

        // Send to 'venue' plugin and prompt user to create venue (Should probably make some venue names unavailable for use)

        // Get main venue
        $sql->dbSelect('venues', 'name', 'id = :id', ['id' => intval(1)]);
        $list = $sql->dbFetch();

        // Redirect user to 'Venue Creation' page (Venues plugin)
        header('Location: /'. $list[0]['name'] . '/admin/venues/create/'. $pathVenue);
        exit;
    }
}

unset($result);
