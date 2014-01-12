<?php

// Don't dispatch route if not explicitly told to do so
$dispatch = false;

// Get 'maintenance_flag' for main venue
$sql->dbSelect('venues', 'maintenance_flag', 'id = :id', ['id' => intval(1)]);
$result = $sql->dbFetch('one');

// If maintenance_flag is turned on send user to maintenance page/module (???possibly module that contains '404' pages???)
if ((int) $result['maintenance_flag'] === intval(2)) {
    // Display 'Site undergoing maintenance' page
    echo 'Site is down for maintenance, please check back later.';
    exit;
} else {

    // Initialize Aura.Router
    $mapRoutes = require PACKAGES . 'Aura.Router/scripts/instance.php';

    /**
     * Query Db and find out which modules are installed
     */

    // Include only installed modules 'routes.php' so we have access to routes
    $sql->dbSelect('modules', 'folder_path, folder_name', 'active = :active', ['active' => intval(2)]);
    $result = $sql->dbFetch();

    foreach ($result as $row) {

        /**
         * Dynamically load modules based on 'folder_path' ('modules' db table field)
         *
         * The module folder must reside in '/axis/modules' or '/zones/some-zone/modules/some-directory'
         *     (i.e.  '/zones/all/modules/provider', '/zones/subdomain.mysite.com/modules/custom')
         */

        $loadModule = null;
        $module_path_array = null;
        $module_path = null;
        $module_folder_name = null;

        $module_path_array = explode('/', $row['folder_path']);

        if ($module_path_array['0'] == 'axis') {
            $module_path = MODULES_AXIS;
            $loadModule = 1;
        } elseif ($module_path_array['0'] == 'zones') {
            if ($module_path_array['1'] == 'all') {
                $module_path = ZONES . $module_path_array['1'] . DS . $module_path_array['2'] . DS . $module_path_array['3'] . DS;
                $loadModule = 1;
            } elseif ($module_path_array['1'] == $_SERVER['SERVER_NAME']) {
                $module_path = ZONES . $_SERVER['SERVER_NAME'] . DS . $module_path_array['2'] . DS . $module_path_array['3'] . DS;
                $loadModule = 1;
            }
        }

        $module_folder_name = $row['folder_name'];

        // Get routes for active modules and add module namespace to autoloader
        if ($loadModule) {
            if (file_exists($module_path . $module_folder_name . DS . 'routes.php')) {
                include_once($module_path . $module_folder_name . DS . 'routes.php');
                $acmsLoader->add($module_folder_name . '\\', $module_path);
            }
        }
    }

    // @todo: The next two 'if' statements should be a class method
    // Parse module routes and add them to the routing map
    if (isset($moduleRoutes)) {
        foreach ($moduleRoutes as $module => $modulePage) {

            foreach ($modulePage as $route) {

                if ($route['type'] === 'front') {
                    // If module route is a front end route then add route to routing map
                    $mapRoutes->add($route['name'], '/{:venue}' . $route['path'], $route['specs']);
                } else if ($route['type'] === 'admin') {

                    // Create array so we can attach admin routes to routing map
                    $adminRoutes['routes'][$route['name']] = [
                        'path' => $route['path'],
                    ];

                    foreach ($route['specs'] as $key => $specs) {
                        if ($specs) {
                            $adminRoutes['routes'][$route['name']][$key] = $specs;
                        }
                    }
                } else if ($route['type'] === 'back') {
                    // Get route namespace, controller and action
                    // @todo: Need to implement this
                    $backRoutes[$route['name']] = [
                        'namespace' => $route['specs']['values']['namespace'],
                        'controller' => $route['specs']['values']['controller'],
                        'action' => $route['specs']['values']['action'],
                    ];
                } else if ($route['type'] === 'block') {
                    $block_routes[] = [
                        'name' => $route['name'],
                        'namespace' => $route['specs']['values']['namespace'],
                        'controller' => $route['specs']['values']['controller'],
                        'action' => $route['specs']['values']['action'],
                    ];
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

    $redirectAdminDashboard = false;
    if (isset($pathArray[1])) {
        if (('admin' === $pathArray[1]) && (!isset($pathArray[2])))
            $redirectAdminDashboard = true;
    }

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
    } elseif ($path === '/admin') {

        // Send user to admin dashboard
        $sql->dbSelect('venues', 'name', 'id = :id', ['id' => intval(1)]);

        // If there is a main venue, redirect to the main venue admin dashboard
        if($list = $sql->dbFetch()) {
            header('Location: /' . $list[0]['name'] . '/admin/dashboard');
            exit;
        } else {
            // No main venue (should never happen if site has been installed)
            // This means the db was corrupted, since we'll never reach this if there is a dbConnection.php)
            // Give some kind of error
            exit;
        }
    } elseif ($redirectAdminDashboard) {

        // Send user to admin dashboard
        header('Location: ' . BASE_URL . $path . '/dashboard');
        exit;
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

        // Send to 'venue' module and prompt user to create venue (Should probably make some venue names unavailable for use)

        // Get main venue
        $sql->dbSelect('venues', 'name', 'id = :id', ['id' => intval(1)]);
        $list = $sql->dbFetch();

        if ($pathVenue === 'venues') {
            $pathVenue = '';
        } else {
            $pathVenue = '/' . $pathVenue;
        }

        header('Location: /'. $list[0]['name'] . '/venues/create/start'. $pathVenue);
        exit;
    }
}

unset($result);
