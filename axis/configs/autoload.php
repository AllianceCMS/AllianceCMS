<?php
// Set Paths for AuraPHP's Autoloader
$acmsLoader = require PACKAGES . 'Aura.Autoload' . DIRECTORY_SEPARATOR . 'scripts' . DIRECTORY_SEPARATOR . 'instance.php';
$acmsLoader->register();

$acmsLoader->setPaths([
    'Acms\Core\\' => PACKAGES . 'Acms.Core' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR,
    'Aura\Router\\' => PACKAGES . 'Aura.Router' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR,
    'Aura\Sql\\' => PACKAGES . 'Aura.Sql' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR,
    'PhpRbac\\' => PACKAGES . 'PhpRbac' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR,
    'Respect\Validation\\' => PACKAGES . 'Respect.Validation' . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR,
    'Symfony\\' => PACKAGES . 'Symfony' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR,
]);
