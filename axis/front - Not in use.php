<?php
use Acms\Core\HttpKernel;
use Acms\Core\System\PathBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\Reference;

$var_array = get_defined_vars();

/*
echo '<br /><pre>$var_array: ';
echo var_dump($var_array);
echo '</pre><br />';
exit;
//*/

$container = include __DIR__ . '/includes/container.php';
$collection = include __DIR__ . '/includes/routing.php';

// create the Request object
$request = Request::createFromGlobals();

// add custom container data

//$container->setParameter('debug', true);
$container->setParameter('acmsBaseDir', $systemPaths['base']);
$container->setParameter('acmsBaseUrl', $acmsBaseUrl);
$container->setParameter('charset', 'UTF-8');
$container->setParameter('request', $request);
$container->setParameter('routes', $collection);

//$request->systemPaths = new PathBag($pathParameters);
//$request->systemPaths = new PathBag();
//$request->systemPaths->add($pathParameters);

/*
echo '<br /><pre>$request: ';
echo var_dump($request);
echo '</pre><br />';
//exit;
//*/

// actually execute the kernel, which turns the request into a response
// by dispatching events, calling a controller, and returning the response
$kernel = $container->get('httpkernel');

//$container->setParameter('httpkernel', $kernel);

$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
