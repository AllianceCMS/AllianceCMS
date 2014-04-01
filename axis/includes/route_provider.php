<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();
$collection->add(
    'homepage',
    new Route(
        '/', // path
        array(
            '_controller' => 'Home\\DisplayPage::homeFrontPage',
            //'axis' => 'axisObject'
        ), // default values
        array(), // requirements
        array(), // options
        '', // host
        array(), // schemes
        array() // methods
    )
);

/*
$collection->add(
    'route_name',
    new Route('/foo', array('controller' => 'ExampleController'))
);
//*/

return $collection;