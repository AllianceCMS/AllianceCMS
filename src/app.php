<?php
use Symfony\Component\Routing;

/*
echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
//exit;
//*/

$routes = new Routing\RouteCollection();
$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', [
	'year' => null,
    '_controller' => 'Acms\\Core\\Calendar\\Controller\\LeapYearController::indexAction',
]));

/*
echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
//exit;
//*/

return $routes;