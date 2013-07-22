<?php

if ($dispatch) {

    // Match route to Aura.Routes route map
    $auraRoute = $mapRoutes->match($path, $_SERVER);

    // If there is no match then we need to send user to custom '404'
    if (! $auraRoute) {

        //*
        // No route object was returned
        // TODO: Need to change this to redirect to custom 404
        echo "<br />No application route was found for that URI path.<br />";
        exit();
        //*/
    }

    // Does the route indicate a controller?
    if (isset($auraRoute->values['controller'])) {
        // Take the controller class directly from the route
        $controller = $auraRoute->values['controller'];
    } else {
        // Use a default controller
        $controller = 'index';
    }

    /*
    echo '<br /><pre>$auraRoute: ';
    echo print_r($auraRoute);
    echo '</pre><br />';
    //*/

    // Assign the controller to the body of the base/theme template
    $body = $controller($auraRoute->values);
    $tpl->set("body",	$body);

    //*
    // If the function 'customHeaders' exists then include custom header into the themes 'header' tags
    if (function_exists('customHeaders')) {
        $tpl->set("customHeaders", customHeaders());
    }

    // Render all templates
    echo $tpl->fetch($theme_path . "/theme.tpl.php");
    //*/

    // Default controller to load if there is none defined in plugin route
    function index() {
        echo '<br />Hello Function index<br />';
    }

    // Dummy controller
    // TODO: Need to remove before alpha release
    function blog() {
        echo '<br />Hello Function blog<br />';
    }
}
