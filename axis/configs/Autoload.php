<?php
// Set Paths for AuraPHP's Autoloader
$loader = require PACKAGES . 'Aura.Autoload' . DS . 'scripts' . DS . 'instance.php';
$loader->register();
$loader->setPaths([
    'Acms\\' => PACKAGES . 'Acms.Core' . DS . 'src' . DS,
    'Aura\Router\\' => PACKAGES . 'Aura.Router' . DS . 'src' . DS,
    'Aura\View\\' => PACKAGES . 'Aura.View' . DS . 'src' . DS
]);
