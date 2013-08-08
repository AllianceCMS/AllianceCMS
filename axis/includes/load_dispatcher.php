<?php

if ($dispatch) {

    // Match route to Aura.Routes route map
    $auraRoute = $mapRoutes->match($path, $_SERVER);

    // If there is no match then we need to send user to custom '404'
    if (! $auraRoute) {

        // No route object was returned
        // @todo: Need to change this to redirect to custom 404
        echo "<br />No application route was found for that URI path.<br />";
        exit();
    }

    // Does the route indicate a controller?
    if (isset($auraRoute->values['controller'])) {
        // Take the controller class directly from the route
        $controller = $auraRoute->values['namespace'] . '\\' . $auraRoute->values['controller'];
    } else {
        // Use a default controller
        // @todo: ??? Implement this ???
        //$controller = 'index';
    }

    // Does the route indicate an action?
    if (isset($auraRoute->values['action'])) {
        // Take the controller action directly from the route
        $action = $auraRoute->values['action'];
    } else {
        // Use a default action
        // @todo: ??? Implement this ???
        //$action = 'action';
    }

    $page = new $controller;

    $basePath = BASE_URL . '/' . $auraRoute->values['venue'];

    $axis = new stdClass;
    $axis->acmsLoader = $acmsLoader;
    $axis->basePath = $basePath;
    $axis->routeInfo = $auraRoute;
    $axis->sql = $sql;

    /**
     * Process Navigation Links
     */

    // Create/set 'Main Nav Links' vars and template
    $sql->dbSelect('links',
        'label, url',
        'location = :location AND active = :active',
        ['location' => intval(1), 'active' => intval(2)],
        'ORDER BY link_order');
    $links = $sql->dbFetch();

    // Create navbar template
    $nav1 = new Acms\Core\Templates\Template(TEMPLATES . 'nav.tpl.php');
    $nav1->set('currentVenue', $auraRoute->values['venue']);
    $nav1->set('links', $links);

    // Send navbar to main template (the active theme.tpl.php)
    $tpl->set("nav1", $nav1);

    /**
     * Process Blocks
     */

    $process_blocks = new Acms\Core\Templates\Blocks();
    $active_blocks = $process_blocks->getBlocks($axis, $block_routes);

    $finished_blocks = new Acms\Core\Templates\Template();

    foreach ($active_blocks as $key => $blocks) {

        foreach ($blocks as $block_area => $block) {

            $block_area_label = 'block_area_' . $block_area;

            $build_block = new Acms\Core\Templates\Template(TEMPLATES . 'block.tpl.php');
            $build_block->set('block_title', $block['title']);
            $build_block->set('block_content', $block['content']);

            // $block_area_(area) = ...
            ${$block_area_label}[] = $build_block;
        }

        // Send blocks to main template (the active theme.tpl.php)
        $tpl->set('blocks_area_' . $block_area, $$block_area_label);
    }

    /**
     * Process plugin output
     */

    // Assign the controller to the body of the base/theme template
    $body = $page->$action($axis);
    $tpl->set("body",	$body);

    // If the function 'customHeaders' exists then include custom header into the themes 'header' tags
    if (function_exists('customHeaders')) {
        $tpl->set("customHeaders", customHeaders());
    }

    // Render active theme template (which in turn loads all other templates assigned to it)
    echo $tpl->fetch(PUBLIC_HTML . $theme_path . "/theme.tpl.php");
}
