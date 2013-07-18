<?php

// Set Paths for AuraPHP's Autoloader
$auraLoader = require PACKAGES . 'Aura.Autoload' . DS . 'scripts' . DS . 'instance.php';
$auraLoader->register();

$auraLoader->setPaths([
    'Acms\\' => PACKAGES . 'Acms.Core' . DS . 'src' . DS,
    'Aura\Router\\' => PACKAGES . 'Aura.Router' . DS . 'src' . DS,
    'Aura\Sql\\' => PACKAGES . 'Aura.Sql' . DS . 'src' . DS,
//    'Aura\View\\' => PACKAGES . 'Aura.View' . DS . 'src' . DS,
    'Twig' => PACKAGES . 'SensioLabs.Twig' . DS . 'lib' . DS,
    'Symfony\\' => PACKAGES . 'Symfony' . DS . 'src' . DS,
    'Gaufrette\\' => PACKAGES . 'Knp.Gaufrette' . DS . 'src' . DS,
]);
