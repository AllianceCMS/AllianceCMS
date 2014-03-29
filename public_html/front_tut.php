<?php
require_once (dirname(__dir__) . ('/axis/hub.php'));

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\Reference;

//$routes = include __DIR__ . '/../src/app.php';
$sc = include __DIR__.'/../src/container.php';

$sc->register('listener.string_response', 'Acms\Core\EventDispatcher\Listeners\StringResponseListener');
$sc->getDefinition('dispatcher')
    ->addMethodCall('addSubscriber', array(new Reference('listener.string_response')))
;

$sc->setParameter('debug', true);

$sc->setParameter('charset', 'UTF-8');
$sc->setParameter('routes', include __DIR__.'/../src/app.php');

$request = Request::createFromGlobals();

$response = $sc->get('framework')->handle($request);

$response->send();
