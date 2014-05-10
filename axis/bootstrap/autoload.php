<?php
$vendorDir = $acmsBaseDir . '/axis/vendor';

require_once $vendorDir . '/autoload.php';

use Symfony\Component\ClassLoader\ClassLoader;

$acmsLoader = new ClassLoader();

$acmsLoader->addPrefixes([
    'Acms\\Core' => $acmsBaseDir . '/axis/src/',
    'PhpRbac' => $acmsBaseDir . '/axis/src/PhpRbac/src/',
]);

$acmsLoader->register();

unset($vendorDir);