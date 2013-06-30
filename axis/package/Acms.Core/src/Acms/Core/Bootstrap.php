<?php
$axis = dirname(dirname(dirname(dirname(dirname(__DIR__)))));
echo '$root is: ' . $axis . '<br />';

// *
$loader = require $axis . '/package/Aura.Autoload/scripts/instance.php';
//$loader = require 'C:\xampp-acms\htdocs\alliancecms\axis\package\Aura.Autoload\scripts/instance.php';
$loader->register();
$loader->setPaths([
    'Acms\\' => $axis . '/package/Acms.Core/src/',
    'Aura\View\\' => $axis . '/package/Aura.View/src/'
]);
// */

echo '$root is: ' . $axis . '<br />';