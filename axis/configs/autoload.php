<?php
require_once VENDOR . 'autoload.php';
use Symfony\Component\ClassLoader\ClassLoader;

$acmsLoader = new ClassLoader();

$acmsLoader->addPrefixes([
    'Acms\\Core' => VENDOR . 'Acms.Core' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR,
    'PhpRbac' => VENDOR . 'PhpRbac' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR,
]);

$acmsLoader->register();
