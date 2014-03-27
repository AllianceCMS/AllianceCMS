<?php
use Acms\Core\HttpKernel;
use Acms\Core\System\PathBag;
//use Acms\Core\Request;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\Reference;

/*
echo '<br /><pre>get_defined_vars(): ';
echo print_r(get_defined_vars());
echo '</pre><br />';
exit;
//*/

/*
 * @todo: Temp vars till PathContext replaces system.php ($baseDir, $baseUrl)
 */
$baseDir = dirname(dirname(__FILE__));

if (isset($_SERVER['HTTPS'])) {
    $baseUrl = 'https://' . $_SERVER['SERVER_NAME'];
} else {
    $baseUrl = 'http://' . $_SERVER['SERVER_NAME'];
}

$container = include __DIR__ . '/includes/container.php';
$collection = include __DIR__ . '/includes/routing.php';

// add custom containers

/*
$container->register('listener.string_response', 'Acms\Core\EventDispatcher\EventListener\StringResponseListener');
$container->getDefinition('dispatcher')
    ->addMethodCall('addSubscriber', array(new Reference('listener.string_response')))
;
//*/

//*
$container->setParameter('baseDir', $baseDir);
$container->setParameter('baseUrl', $baseUrl);
//*/

$container->setParameter('debug', true);
$container->setParameter('charset', 'UTF-8');
$container->setParameter('routes', $collection);
//$container->setParameter('routes', include __DIR__ . '/../src/app.php');


// create the Request object
$request = Request::createFromGlobals();

$request->systemPaths = new PathBag($pathParameters);

/*
echo '<br /><pre>$_SERVER: ';
echo print_r($_SERVER);
echo '</pre><br />';
exit;
//*/

//*
echo '<br /><pre>$request: ';
echo var_dump($request);
echo '</pre><br />';
//exit;
//*/

//*
echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
//exit;
//*/

//*
echo '<br /><pre>$request->getBaseUrl(): ';
echo var_dump($request->getBaseUrl());
echo '</pre><br />';
//exit;
//*/

//*
echo '<br /><pre>$request->getPathInfo(): ';
echo var_dump($request->getPathInfo());
echo '</pre><br />';
exit;
//*/

// actually execute the kernel, which turns the request into a response
// by dispatching events, calling a controller, and returning the response
$response = $container->get('httpkernel')->handle($request);



$kernel = $container->get('httpkernel');
$context = $container->get('context');

/*
echo '<br /><pre>$context: ';
echo var_dump($context);
echo '</pre><br />';
//exit;
//*/

//$myMatcher = $container->get('matcher');

/*
echo '<br /><pre>$myMatcher: ';
echo var_dump($myMatcher);
echo '</pre><br />';
//exit;
//*/

//$parameters = $container->get('matcher')->match('/is_leap_year/2004');

/*
echo '<br /><pre>$parameters: ';
echo var_dump($parameters);
echo '</pre><br />';
//exit;
//*/

$generator = $container->get('generator');

$response->send();

$kernel->terminate($request, $response);

/*
// kernel.request

require_once ('configs/system.php');
require_once ('includes/autoload.php');
require_once (INCLUDES . 'load_db.php');
require_once (INCLUDES . 'load_user.php');
require_once (INCLUDES . 'load_router.php');
require_once (CONFIGS . 'venue_info.php');
require_once (INCLUDES . 'load_templates.php');

// kernel.controller

require_once (INCLUDES . 'load_dispatcher.php');

// kernel.view

// kernel.response

// kernel.finish_request

// kernel.terminate

// kernel.exception

//*/

/*
// create your controller resolver
$resolver = new ControllerResolver();

// instantiate the kernel
$kernel = new HttpKernel($dispatcher, $resolver);

// actually execute the kernel, which turns the request into a response
// by dispatching events, calling a controller, and returning the response
$response = $kernel->handle($request);

// send the headers and echo the content
$response->send();

// triggers the kernel.terminate event
$kernel->terminate($request, $response);
//*/