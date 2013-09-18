<?php
// Set Paths for AuraPHP's Autoloader
$acmsLoader = require PACKAGES . 'Aura.Autoload' . DS . 'scripts' . DS . 'instance.php';
$acmsLoader->register();

$acmsLoader->setPaths([
    'Acms\Core\\' => PACKAGES . 'Acms.Core' . DS . 'src' . DS,
    'Aura\Router\\' => PACKAGES . 'Aura.Router' . DS . 'src' . DS,
    'Aura\Sql\\' => PACKAGES . 'Aura.Sql' . DS . 'src' . DS,
    'PhpRbac\\' => PACKAGES . 'PhpRbac' . DS . 'src' . DS,
    'Respect\Validation\\' => PACKAGES . 'Respect.Validation' . DS . 'library' . DS,
    'Symfony\\' => PACKAGES . 'Symfony' . DS . 'src' . DS,
]);
