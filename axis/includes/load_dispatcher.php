<?php
use Acms\Core\Templates\Template;

if ($dispatch) {

    // Match route to Aura.Routes route map
    $axisRoute = $mapRoutes->match($path, $_SERVER);

    // If there is no match then we need to send user to custom '404'
    if (!$axisRoute) {

        // No route object was returned
        // @todo: Need to change this to redirect to custom 404
        echo "<p>No application route was found for this URI path.</p>";
        exit();
    }

    /*
     * Build Plugin Callback
     */

    // Does the route indicate a namespace?
    if (isset($axisRoute->values['namespace'])) {
        // Take the namespace directly from the route
        $namespace = $axisRoute->values['namespace'] . '\\';
    } else {
        // Use a default namespace
        // @todo: ??? Implement this ???
        //$namespace = 'PluginManager';
    }

    // Does the route indicate a controller?
    if (isset($axisRoute->values['controller'])) {
        // Take the controller class directly from the route
        $controller = $namespace . $axisRoute->values['controller'];
    } else {
        // Use a default controller
        // @todo: ??? Implement this ???
        //$controller = 'DefaultPlugin';
    }

    // Does the route indicate an action?
    if (isset($axisRoute->values['action'])) {
        // Take the controller action directly from the route
        $action = $axisRoute->values['action'];
    } else {
        // Use a default action
        // @todo: ??? Implement this ???
        //$action = 'index';
    }

    /*
     * Build $axis object for use in Plugin development
     */

    $basePath = BASE_URL . '/' . $axisRoute->values['venue'];

    $axis = new stdClass;
    $axis->acmsLoader = $acmsLoader;
    $axis->acmsSalt = $acmsSalt;
    $axis->basePath = $basePath;
    $axis->axisRoute = $axisRoute;
    $axis->sessionAxis = $sessionAxis;
    $axis->segmentUser = $segmentUser;
    $axis->currentUser = $currentUser;
    $axis->sql = $sql;

    /*
     * Create Theme/Admin Template
     */

    $tpl = new Template();
    $tpl->set('base_url', BASE_URL);
    $tpl->set('basePath', $basePath);
    $tpl->set('venue_name', VENUE_NAME);
    $tpl->set('venue_title', VENUE_TITLE);
    $tpl->set('venue_description', VENUE_DESCRIPTION);
    $tpl->set('venue_tagline', VENUE_TAGLINE);

    /*
     * Load Front End or Admin Output
     */

    // Is this Route an Admin route? If so, restrict access
    if ((string) '' !== (string) $axisRoute->path_prefix) {

        $pathArray = explode('/', $axisRoute->path_prefix);
        array_shift($pathArray);
        $isAdmin = $pathArray[1];
        unset($pathArray);

        if ('admin' === $isAdmin) {
            $rbac->enforce(1, $currentUser->getId());

            // Assign the controller to the body of the base/theme template
            $page = new $controller($axis);

            if ($page->$action() !== false) {
                $content = $page->$action();
            } else {
                $content = '';
            }


            /*
             * Create Admin Theme Template
             */

            //Define Admin Theme

            /*
            $adminTheme = 'Gumnum';
            //*/

            //*
            $adminTheme = 'Delta';
            //*/

            // Create Admin/theme template vars
            $tpl->set('theme_folder', BASE_URL . '/themes/' . $adminTheme);

            $load_theme = THEMES . $adminTheme . DS . 'admin.tpl.php';

            /*
             * Build Admin Callback
             */

            // Does the route indicate a namespace?
            if (isset($axisRoute->values['namespace'])) {
                // Take the namespace directly from the route
                $namespace = $axisRoute->values['namespace'] . '\\';
            } else {
                // Use a default namespace
                // @todo: ??? Implement this ???
                //$namespace = 'PluginManager';
            }

            $adminController = $namespace . 'AdminPages';
            $adminObject = new $adminController($axis);

            /*
             * Process Site Navigation Links (Top)
             */

            /*
            // Not Needed in Delta Admin Theme (YET!!!)

            // Create/set 'Main Nav Links' vars and template
            $sql->dbSelect('links',
                'label, url',
                'link_area = :link_area AND active = :active',
                ['link_area' => intval(1), 'active' => intval(2)],
                'ORDER BY link_order');
            $links = $sql->dbFetch();

            // Create navbar template
            $nav1 = new Acms\Core\Templates\Template(THEMES . $adminTheme . DS . 'nav.tpl.php');
            $nav1->set('currentVenue', $axisRoute->values['venue']);
            $nav1->set('links', $links);

            // Send navbar to main template (the active theme.tpl.php)
            $tpl->set("nav1", $nav1);
            //*/

            /*
             * Process Admin Navigation (Left Side)
             */

            $adminNavbar = $adminObject->getNavbar($adminTheme);

            $tpl->set('adminNavbar', $adminNavbar);

            $adminVars = $adminObject->getTemplateVars($axis);
            $adminBlocks = $adminObject->getTemplateBlocks($axis);
        }
    } else {

        // Assign the controller to the body of the base/theme template
        $page = new $controller;

        if ($page->$action($axis) !== false) {
            $content = $page->$action($axis);
        } else {
            $content = '';
        }

        // Create base/theme template vars
        $tpl->set('theme_folder', BASE_URL . '/' . $theme_path);

        $load_theme = PUBLIC_HTML . $theme_path . '/theme.tpl.php';

        /**
         * Process Navigation Links
         */

        // Create/set 'Main Nav Links' vars and template
        $sql->dbSelect('links',
            'label, url',
            'link_area = :link_area AND active = :active',
            ['link_area' => intval(1), 'active' => intval(2)],
            'ORDER BY link_order');
        $links = $sql->dbFetch();

        // Create navbar template
        $nav1 = new Acms\Core\Templates\Template(TEMPLATES . 'nav.tpl.php');
        $nav1->set('currentVenue', $axisRoute->values['venue']);
        $nav1->set('links', $links);

        // Send navbar to main template (the active theme.tpl.php)
        $tpl->set("nav1", $nav1);

        /**
         * Process Blocks
        */

        $finished_blocks = new Acms\Core\Templates\Template();

        $process_blocks = new Acms\Core\Templates\Blocks();
        $active_blocks = $process_blocks->getBlocks($axis, $block_routes);

        if(!empty($active_blocks)) {
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
        }
    }

    /**
     * Process plugin output
     */

    $tpl->set("content", $content);

    // If the function 'customHeaders' exists then include custom header into the themes 'header' tags
    if (function_exists('customHeaders')) {
        $tpl->set("customHeaders", customHeaders());
    }

    // Render active theme template (which in turn loads all other templates assigned to it)
    echo $tpl->fetch($load_theme);
}
