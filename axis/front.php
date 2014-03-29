<?php
use Acms\Core\HttpKernel;
use Acms\Core\System\PathBag;
//use Acms\Core\Request;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\Reference;

$container = include __DIR__ . '/includes/container.php';
$collection = include __DIR__ . '/includes/routing.php';

// create the Request object
$request = Request::createFromGlobals();

// add custom container data

//$container->setParameter('debug', true);
$container->setParameter('rootDir', $rootDir);
$container->setParameter('rootUrl', $rootUrl);
$container->setParameter('charset', 'UTF-8');
$container->setParameter('request', $request);
$container->setParameter('routes', $collection);

/*
echo '<br /><pre>$request: ';
echo var_dump($request);
echo '</pre><br />';
//exit;
//*/

$request->systemPaths = new PathBag($pathParameters);

// actually execute the kernel, which turns the request into a response
// by dispatching events, calling a controller, and returning the response
$kernel = $container->get('httpkernel');

$response = $kernel->handle($request);

$response->send();

$kernel->terminate($request, $response);
