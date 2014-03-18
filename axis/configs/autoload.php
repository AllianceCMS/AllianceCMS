<?php
// Set Paths for Symfony's ClassLoader
require_once PACKAGES . 'Symfony/src/Symfony/Component/ClassLoader/ClassLoader.php';
use Symfony\Component\ClassLoader\ClassLoader;

$acmsLoader = new ClassLoader();

$acmsLoader->addPrefixes([
    'Acms\\Core' => PACKAGES . 'Acms.Core' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR,
    'Aura\\Router' => PACKAGES . 'Aura.Router' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR,
    'Aura\\Sql' => PACKAGES . 'Aura.Sql' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR,
    'PhpRbac' => PACKAGES . 'PhpRbac' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR,
    'Symfony' => PACKAGES . 'Symfony' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR,
]);

$acmsLoader->register();