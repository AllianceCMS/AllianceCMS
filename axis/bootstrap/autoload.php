<?php

$vendorDir = $acmsBaseDir . '/axis/vendor';

require_once $vendorDir . '/autoload.php';

use Symfony\Component\ClassLoader\ClassLoader;

$acmsLoader = new ClassLoader();

$acmsLoader->addPrefixes([
    'Acms\\Core' => $vendorDir . '/acms/src/',
    'PhpRbac' => $vendorDir . '/PhpRbac/src/',
]);

$acmsLoader->register();

unset($acmsLoader);
unset($vendorDir);