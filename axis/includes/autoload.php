<?php

$rootDir = dirname(dirname(dirname(__FILE__)));
$vendorDir = $rootDir . '/axis/vendor';

require_once $vendorDir . '/autoload.php';
use Symfony\Component\ClassLoader\ClassLoader;

$acmsLoader = new ClassLoader();

$acmsLoader->addPrefixes([
    'Acms\\Core' => $vendorDir . '/acms/src/',
    'PhpRbac' => $vendorDir . '/PhpRbac/src/',
    'Home' => $rootDir . '/axis/modules/',
]);

$acmsLoader->register();
