<?php
use Acms\Core\EventDispatcher\EventListener\PathsListener;
use Acms\Core\HttpKernel;
use Acms\Core\Paths\FileSystemPaths;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

// create the Request object
$request = Request::createFromGlobals();

//*
echo '<br /><pre>$request->attributes->all(): ';
echo var_dump($request->attributes->all());
echo '</pre><br />';
//exit;
//*/

/*
exit;
//*/

$dispatcher = new EventDispatcher();

// ... add some event listeners
$dispatcher->addSubscriber(new PathsListener(new FileSystemPaths()));

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

// create your controller resolver
$resolver = new ControllerResolver();

// instantiate the kernel
$kernel = new HttpKernel($dispatcher, $resolver);

// actually execute the kernel, which turns the request into a response
// by dispatching events, calling a controller, and returning the response
$response = $kernel->handle($request);

/*
echo '<br /><pre>$request->attributes->all(): ';
echo var_dump($request->attributes->all());
echo '</pre><br />';
exit;
//*/

// send the headers and echo the content
$response->send();

// triggers the kernel.terminate event
$kernel->terminate($request, $response);