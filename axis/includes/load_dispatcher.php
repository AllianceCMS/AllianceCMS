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

    $body = $controller($auraRoute->values);

    //*
    if (function_exists('customHeaders')) {
        $tpl->set("customHeaders", customHeaders());
    }

    $tpl->set("body",	$body);

    echo $tpl->fetch($theme_path . "/theme.tpl.php");
    //*/

    function index() {
        echo '<br />Hello Function index<br />';
    }

    function blog() {
        echo '<br />Hello Function blog<br />';
    }
}
