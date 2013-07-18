<?php

/*
echo '<br />Begin Testing Aura.Router<br />';
echo '<br />';
//*/

$dispatch = false;

// Initialize Aura.Router
$mapRoutes = require PACKAGES . 'Aura.Router/scripts/instance.php';

/**
 * Query Db and find out which plugins are installed
 */

// Include only installed plugins 'main.php' so we have access to routes
$result = $connection->fetchAll('SELECT folder_path, folder_name FROM a_plugins WHERE active = 2');

foreach ($result as $row) {

    $plugin_folder_path = $row['folder_path'];
    $plugin_folder_name = $row['folder_name'];

    if (file_exists(BASE_DIR . $plugin_folder_path . $plugin_folder_name . DS . 'main.php')) {
        include_once(BASE_DIR . $plugin_folder_path . $plugin_folder_name . DS . 'main.php');
    }
}

if (isset($pluginRoutes)) {
    foreach ($pluginRoutes as $plugin => $pluginPage) {

        foreach ($pluginPage as $route) {

            if ($route['type'] === 'front') {
                $mapRoutes->add($route['name'], '/{:venue}' . $route['path'], $route['specs']);
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
    $mapRoutes->attach('/{:venue}/admin', $adminRoutes);

}

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

if ($path === '/') {
    // Send user to main venue
    // create a new Select object
    $select = $connection->newSelect();

    // SELECT * FROM foo WHERE bar > :bar ORDER BY baz
    $select->cols(['name'])
    ->from('a_venues')
    ->where('id = :id');

    $bind = ['id' => intval(1)];

    // If there is a main venue, redirect to the main venue
    if($list = $connection->fetchAll($select, $bind)) {
        header("Location: /" . $list[0]['name']);
        exit;
    } else {
        // No main venue (should never happen if site has been installed)
        // This means the db was corrupted, since we'll never reach this if there is a dbConnections.php)
        // Give some kind of error
    }
}

// Check if venue exists (in database)

$select = $connection->newSelect();
$select->cols(['name, active, active_theme'])
    ->from('a_venues')
    ->where('name = :name')
    ->orderBy(['name']);

$bind = ['name' => $pathVenue];
//$list = $connection->fetchAll($select, $bind);

// If venue exists
if ($currentVenue = $connection->fetchAll($select, $bind)) {

    /*
    echo '<br /><pre>$list:<br />';
    echo print_r($list);
    echo '</pre><br />';
    //exit;
    //*/

    //echo '<br />$list[0]["active"] is: ' . $list[0]['active'] . '<br />';

    // Check if venue is active

    // If venue is active, load venue
    if ($currentVenue[0]['active'] === '2') {
        echo '<br />Load Venue<br />';
        $dispatch = true;
    } else {
        // If venue is not active, give message stating it exists but is not active/available
        echo '<br />Venue Is Not Active<br />';
    }
} else {
    // Venue does not exist
    // Send to 'venue' plugin and prompt user to create venue (Should probably make some venue names unavailable for use)
    echo '<br />Create Venue<br />';
    $dispatch = true;
}

/*
echo '<br />';
echo '<br />End Testing Aura.Router<br />';
//*/

// End Testing Aura.Router
//*/
