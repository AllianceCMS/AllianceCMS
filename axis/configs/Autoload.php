<?php

// Set Paths for AuraPHP's Autoloader
$auraLoader = require PACKAGES . 'Aura.Autoload' . DS . 'scripts' . DS . 'instance.php';
$auraLoader->register();

$auraLoader->setPaths([
    'Acms\Core\\' => PACKAGES . 'Acms.Core' . DS . 'src' . DS,
//    'Acms\Core\Templates\Template\\' => PACKAGES . 'Acms.Core' . DS . 'src' . DS . 'Acms' . DS . 'Core' . DS . 'Templates',
    'Aura\Router\\' => PACKAGES . 'Aura.Router' . DS . 'src' . DS,
    'Aura\Sql\\' => PACKAGES . 'Aura.Sql' . DS . 'src' . DS,
//    'Symfony\\' => PACKAGES . 'Symfony' . DS . 'src' . DS,
]);

