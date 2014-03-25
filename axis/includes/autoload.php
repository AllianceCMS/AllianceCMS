<?php

$baseDir = dirname(dirname(dirname(__FILE__)));
$vendorDir = $baseDir . '/axis/vendor';

/*
echo '<br />$baseDir is: ' . $baseDir . '<br />';
//exit;
//*/

/*
echo '<br />$vendorDir is: ' . $vendorDir . '<br />';
//exit;
//*/

require_once $vendorDir . '/autoload.php';
use Symfony\Component\ClassLoader\ClassLoader;

$acmsLoader = new ClassLoader();

$acmsLoader->addPrefixes([
    'Acms\\Core' => $vendorDir . '/acms/src/',
    'PhpRbac' => $vendorDir . '/PhpRbac/src/',
]);

$acmsLoader->register();
