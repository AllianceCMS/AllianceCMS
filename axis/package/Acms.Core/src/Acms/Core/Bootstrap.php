<?php

$root = dirname(dirname(dirname(dirname(dirname(__DIR__)))));
echo '$root is: ' . $root . '<br />';

//*
$loader = require $root.'/package/Aura.Autoload/scripts/instance.php';
$loader->register();
$loader->setPaths([
    'Acms\\' => $root.'/package/Acms.Core/src/',
    'Aura\View\\' => $root.'/package/Aura.View/src/'
    ]);
//*/

echo '$root is: ' . $root . '<br />';