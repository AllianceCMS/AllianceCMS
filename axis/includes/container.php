<?php
use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;

$container = new DependencyInjection\ContainerBuilder();

$container->register('context', 'Symfony\Component\Routing\RequestContext');

$container->register('matcher', 'Symfony\Component\Routing\Matcher\UrlMatcher')
    ->setArguments(array('%routes%', new Reference('context')))
;

$container->register('generator', 'Symfony\Component\Routing\Generator\UrlGenerator')
->setArguments(array('%routes%', new Reference('context')))
;

$container->register('resolver', 'Symfony\Component\HttpKernel\Controller\ControllerResolver');

$container->register('listener.router', 'Symfony\Component\HttpKernel\EventListener\RouterListener')
    ->setArguments(array(new Reference('matcher')))
;

//*
$container->register('listener.response', 'Symfony\Component\HttpKernel\EventListener\ResponseListener')
    ->setArguments(array('%charset%'))
;
//*/

$container->register('listener.exception', 'Symfony\Component\HttpKernel\EventListener\ExceptionListener')
    ->setArguments(array('Acms\\Core\\Calendar\\Controller\\ErrorController::exceptionAction'))
;

$container->register('dispatcher', 'Symfony\Component\EventDispatcher\EventDispatcher')
    ->addMethodCall('addSubscriber', array(new Reference('listener.router')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.response')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.exception')))
    //->addMethodCall('addSubscriber', array(new Reference('listener.path_context')))
;

/*
$container->register('path.context', 'Acms\Core\System\PathContext')
    //->setArguments(array(null, null))
    ->setArguments(array('%baseDir%', '%baseUrl%'))
;

$container->register('listener.path_context', 'Acms\Core\System\EventListener\PathContextListener')
    ->setArguments(array(new Reference('path.context')))
;
//*/

$container->register('httpkernel', 'Acms\Core\HttpKernel')
    ->setArguments(array(new Reference('dispatcher'), new Reference('resolver')))
;

return $container;