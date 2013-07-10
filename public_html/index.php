<?php

require_once (dirname(__dir__) . ('/axis/hub.php'));

echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
//exit;

//*
// Testing Aura.Router

echo '<br />Begin Testing Aura.Router<br />';

echo '<br />';

// Create loop so we can add routes to Aura.Router's mapped routes

/*
foreach ($plugins as $key => $value) {
    echo '$key = ' . $key . ' => $value = ' . $value;
    echo '<br />Do something with $plugins array.<br />';
}
//*/

/*
$keys = extract($plugins);

echo '<br />Result of $keys 2: <br />';
echo '<pre>';
echo print_r($keys);
echo '</pre>';
//*/

/*
function multiarray_keys($ar) {

    foreach($ar as $k => $v) {
        $keys[] = $k;
        if (is_array($ar[$k]))
            $keys = array_merge($keys, multiarray_keys($ar[$k]));
    }
    return $keys;
}

foreach ($plugins as $plugin_name) {
    //echo '$plugin_name = ' . $plugin_name;
    //echo array_keys($content_name);

    $keys = multiarray_keys($plugin_name);

    echo '<br />Result of $keys : <br />';
    echo '<pre>';
    echo print_r($plugins);
    echo '</pre>';

    echo '<br />Do something with $plugins array.<br />';
}
//*/

// Initialize Aura.Router
$mapRoutes = require PACKAGES . 'Aura.Router/scripts/instance.php';

// Mapping Routes
$mapRoutes->add('home', '/');

$mapRoutes->add('read', '/blog/read/{:id}{:format}', array(
    'params' => array(
        'id' => '(\d+)',
        'format' => '(\..+)?',
    ),
    'values' => array(
    'controller' => 'blog',
    'action' => 'read',
    'format' => 'html',
    ),
));

// Include plugin's 'main.php' so we have access to routes and the $plugins array
include_once PLUGINS_AXIS . 'core' . DS . 'example' . DS . 'main.php'; // Allows us to have access to this plugins $plugins array

// Matching Routes
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// get the route based on the path and server
$route = $mapRoutes->match($path, $_SERVER);

if (! $route) {
    // no route object was returned
    echo "No application route was found for that URI path.";
    exit();
}

// does the route indicate a controller?
if (isset($route->values['controller'])) {
    // take the controller class directly from the route
    $controller = $route->values['controller'];
} else {
    // use a default controller
    $controller = 'index';
}

$controller();

function index() {
    echo '<br />Hello Function index<br />';
}

function blog() {
    echo '<br />Hello Function blog<br />';
}

echo '<pre>';
echo print_r($route);
echo '</pre>';

echo '<br />';

echo '<br />End Testing Aura.Router<br />';

//*/


/*
// Testing /axis/configs/autoload.php (/axis/packages/Acms.Core/src/Acms/Core/System.php is not being used,
// and might not be used in the future)
$mySystem = new Acms\Core\System;
echo '<br />' . $mySystem->filePaths . '<br />';
//*/


/*
// Testing Gaufrette filesystem abstraction package

//require_once (TESTS . '/gaufrette.php');
//*/

/*
// Testing Twig

//require_once (TESTS . 'twig/twig_01.php');

require_once ('../axis/tests/twig/twig_01.php');
//*/


/*
// Testing Aura.View

use Aura\View\Template;
use Aura\View\EscaperFactory;
use Aura\View\TemplateFinder;
use Aura\View\HelperLocator;

$template = new Aura\View\Template(
    new EscaperFactory,
    new TemplateFinder,
    new HelperLocator
);
//*/

/*
$locator = $template->getHelperLocator();
$locator->set('image', function () {
    return new \Aura\View\Helper\Image;
});
//*/

/*
$finder = $template->getTemplateFinder();
$finder->setPaths([
//    $root . '/themes/zerofour'
    '/themes/zerofour'
]);
//*/

//echo $template->fetch(__DIR__ . '/zerofour/index');

/*
$tpl = new Acms\Core\Template();
$tpl->set("themeImages", 'C:\xampp-acms\htdocs\alliancecms\axis\themes/emplode/images');
$tpl->set("site_title", 'AllianceCMS.com');
$tpl->set("site_author", 'Burnsy');
$tpl->set("site_description", 'This is a site description');
$tpl->set("site_styleSheet", 'C:\xampp-acms\htdocs\alliancecms\axis\themes/emplode/style.css');
//*/

/*
$tpl->set("nav1", $nav1);
$tpl->set("menu1", $menu1);
$tpl->set("menu2", $menu2);
$tpl->set("menu3", $menu3);
$tpl->set("menu4", $menu4);
$tpl->set("menu5", $menu5);
//*/

/*
include 'C:\xampp-acms\htdocs\alliancecms\axis\plugins\axis\news/index.php';

$tpl->set("body",	$body);

echo $tpl->fetch('C:\xampp-acms\htdocs\alliancecms\axis\themes/emplode/theme.tpl.php');
//*/

echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
exit;
