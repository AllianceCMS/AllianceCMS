<?php
// $axis = dirname(dirname(dirname(dirname(dirname(__DIR__)))));
// echo '$root is: ' . $axis . '<br />';

// *
$loader = require PACKAGES . 'Aura.Autoload/scripts/instance.php';
// $loader = require 'C:\xampp-acms\htdocs\alliancecms\axis\package\Aura.Autoload\scripts/instance.php';
$loader->register();
$loader->setPaths([
    'Acms\\' => PACKAGES . 'Acms.Core/src/',
    'Aura\View\\' => PACKAGES . 'Aura.View/src/'
]);
// */

//echo '$axis is: ' . $axis . '<br />';