<?php

require_once PACKAGES . 'Twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

// Set Paths for AuraPHP's Autoloader
$auraLoader = require PACKAGES . 'Aura.Autoload' . DS . 'scripts' . DS . 'instance.php';
$auraLoader->register();

echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
//exit;

$auraLoader->setPaths([
    'Acms\\' => PACKAGES . 'Acms.Core' . DS . 'src' . DS,
    'Aura\Router\\' => PACKAGES . 'Aura.Router' . DS . 'src' . DS,
    'Aura\View\\' => PACKAGES . 'Aura.View' . DS . 'lib' . DS,
//    'Twig\\' => PACKAGES . 'Twig' . DS . 'lib' . DS,
    'Gaufrette\\' => PACKAGES . 'Knp.Gaufrette' . DS . 'src' . DS,
]);

echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
//exit;
