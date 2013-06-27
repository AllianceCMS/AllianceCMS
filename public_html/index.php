<?php
require dirname(__DIR__) . '/core/package/Acms.Core/src/Acms/Core/Bootstrap.php';

$mySystem = new Acms\Core\System;
echo $mySystem->filePaths;

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

$tpl = new Acms\Core\Template();
$tpl->set("themeImages", "emplode/images");
$tpl->set("site_title", 'AllianceCMS.com');
$tpl->set("site_author", 'Burnsy');
$tpl->set("site_description", 'This is a site description');
$tpl->set("site_styleSheet", "emplode/style.css");
/*
$tpl->set("nav1", $nav1);
$tpl->set("menu1", $menu1);
$tpl->set("menu2", $menu2);
$tpl->set("menu3", $menu3);
$tpl->set("menu4", $menu4);
$tpl->set("menu5", $menu5);
//*/

include 'news/index.php';

$tpl->set("body",	$body);

echo $tpl->fetch("emplode/theme.tpl.php");

