<?php
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\PhpFileLoader;
use Symfony\Component\Routing\RouteCollection;

$locator = new FileLocator(array(__DIR__));
$loader = new PhpFileLoader($locator);

$collection = new RouteCollection();
$collection->addCollection($loader->import("route_provider.php"), '', array(), array(), array(), 'localhost');

return $collection;