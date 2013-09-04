<?php
use Acms\Core\Templates\Template;

if ($dispatch) {

    // Match route to Aura.Routes route map
    $axisRoute = $mapRoutes->match($path, $_SERVER);

    // If there is no match then we need to send user to custom '404'
    if (! $axisRoute) {

        // No route object was returned
        // @todo: Need to change this to redirect to custom 404
        echo "<br />No application route was found for that URI path.<br />";
        exit();
    }

    // Does the route indicate a controller?
    if (isset($axisRoute->values['controller'])) {
        // Take the controller class directly from the route
        $controller = $axisRoute->values['namespace'] . '\\' . $axisRoute->values['controller'];
    } else {
        // Use a default controller
        // @todo: ??? Implement this ???
        //$controller = 'index';
    }

    // Does the route indicate an action?
    if (isset($axisRoute->values['action'])) {
        // Take the controller action directly from the route
        $action = $axisRoute->values['action'];
    } else {
        // Use a default action
        // @todo: ??? Implement this ???
        //$action = 'action';
    }

    $basePath = BASE_URL . '/' . $axisRoute->values['venue'];

    $axis = new stdClass;
    $axis->acmsLoader = $acmsLoader;
    $axis->basePath = $basePath;
    $axis->routeInfo = $axisRoute;
    $axis->sessionAxis = $sessionAxis;
    $axis->segmentUser = $segmentUser;
    $axis->currentUser = $currentUser;
    $axis->sql = $sql;

    // Create Admin/theme template
    $tpl = new Template();
    $tpl->set('base_url', BASE_URL);
    $tpl->set('basePath', $basePath);
    $tpl->set('venue_name', VENUE_NAME);
    $tpl->set('venue_title', VENUE_TITLE);
    $tpl->set('venue_description', VENUE_DESCRIPTION);
    $tpl->set('venue_tagline', VENUE_TAGLINE);

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


            $adminTheme = 'Delta';

            // Create Admin/theme template vars
            $tpl->set('theme_folder', BASE_URL . '/themes/' . $adminTheme);

            $load_theme = THEMES . $adminTheme . DS . 'admin.tpl.php';

            // Does the route indicate a namespace?
            if (isset($axisRoute->values['namespace'])) {
                // Take the controller class directly from the route
                $namespace = $axisRoute->values['namespace'] . '\\';
            } else {
                // Use a default controller
                // @todo: ??? Implement this ???
                //$controller = 'index';
            }

            $adminController = $namespace . 'AdminPages';

            $adminObject = new $adminController($axis);

            /**
             * Process Site Navigation Links
             */

            /*
            // Not Needed in Delta Admin Theme

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

            /**
             * Process Admin Navigation
             */

            $currentlyLoadedUrl =  BASE_URL . $axisRoute->matches[0];

            $adminNavArray = $adminObject->getTemplateNav($axis);

            $adminNav = new Acms\Core\Templates\Template();

            if(!empty($adminNavArray)) {
                foreach ($adminNavArray as $pluginFolder => $value) {

                    $value['link'] = $basePath . '/admin' . $value['link'];

                    $buildNav = new Acms\Core\Templates\Template(THEMES . $adminTheme . DS . 'admin.nav.tpl.php');
                    $buildNav->set('pluginFolder', $pluginFolder);

                    if(!empty($value['submenu'])) {
                        $count = null;
                        foreach ($value['submenu'] as $subTitle => $subLink) {
                            $newSubLinks[$subTitle] = $basePath . '/admin' . $subLink;
                            if ($currentlyLoadedUrl === $newSubLinks[$subTitle]) {
                                $value['activeSublink'] = $currentlyLoadedUrl;
                            }

                            ++$count;
                        }
                        $value['submenu'] = $newSubLinks;
                        $buildNav->set('numberOfItems', $count);
                    }

                    $active = '';
                    if ($pluginFolder === $axisRoute->values['namespace']) {
                        $active = 'active';
                    }

                    $buildNav->set('active', $active);
                    $buildNav->set('adminNavigation', $value);

                    $buildNavArray[] = $buildNav;
                }

                $tpl->set('adminNavLinks', $buildNavArray);
            }

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
