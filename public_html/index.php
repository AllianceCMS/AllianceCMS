<?php

require_once (dirname(__dir__) . ('/axis/hub.php'));

echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
//exit;

/*
// Testing /axis/configs/autoload.php (/axis/packages/Acms.Core/src/Acms/Core/System.php is not being used,
// and might not be used in the future)
$mySystem = new Acms\Core\System;
echo '<br />' . $mySystem->filePaths . '<br />';
//*/


//*
// Testing Gaufrette filesystem abstraction package

//require_once (TESTS . '/gaufrette.php');

//require_once (TESTS . 'twig/twig_01.php');

require_once ('../axis/tests/twig/twig_01.php');


//*/


/*
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
