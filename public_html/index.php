<?php
require dirname(__DIR__) . '/core/package/Acms.Core/src/Acms/Core/Bootstrap.php';

$mySystem = new Acms\Core\System;
echo $mySystem->filePaths;

use Aura\View\Template;
use Aura\View\EscaperFactory;
use Aura\View\TemplateFinder;
use Aura\View\HelperLocator;

$template = new Aura\View\Template(
    new EscaperFactory,
    new TemplateFinder,
    new HelperLocator
);

$locator = $template->getHelperLocator();
$locator->set('image', function () {
    return new \Aura\View\Helper\Image;
});

$finder = $template->getTemplateFinder();
$finder->setPaths([
    $root . '/themes/zerofour'
    ]);

echo $template->fetch('index');