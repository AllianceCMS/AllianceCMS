<?php

if ($dispatch) {
    $auraRoute = $mapRoutes->match($path, $_SERVER);

    /*
    echo '<br /><pre>$auraRoute:<br />';
    echo print_r($auraRoute);
    echo '</pre><br />';
    //exit;
    //*/

    if (! $auraRoute) {

        //*
        // no route object was returned
        // TODO: Need to change this to redirect to custom 404
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

    $controller($template_vars);

    function index() {
        echo '<br />Hello Function index<br />';
    }

    function blog() {
        echo '<br />Hello Function blog<br />';
    }
}
