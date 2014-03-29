<?php
use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;

$container = new DependencyInjection\ContainerBuilder();

//$container->register('container', 'Symfony\Component\DependencyInjection\DependencyInjection\ContainerBuilder');

$container->register('context', 'Symfony\Component\Routing\RequestContext');

$container->register('matcher', 'Symfony\Component\Routing\Matcher\UrlMatcher')
    ->setArguments(array('%routes%', new Reference('context')))
;

$container->register('generator', 'Symfony\Component\Routing\Generator\UrlGenerator')
    ->setArguments(array('%routes%', new Reference('context')))
;

$container->register('resolver', 'Acms\Core\ModuleLoader\Controller\ControllerResolver')
    ->setArguments(array('%request%'))
;

$container->register('listener.router', 'Symfony\Component\HttpKernel\EventListener\RouterListener')
    ->setArguments(array(new Reference('matcher')))
;

$container->register('listener.system_request', 'Acms\Core\System\EventListener\RequestListener');

$container->register('listener.system_controller', 'Acms\Core\System\EventListener\ControllerListener');

$container->register('listener.system_view', 'Acms\Core\System\EventListener\ViewListener');

$container->register('listener.system_response', 'Acms\Core\System\EventListener\ResponseListener');

$container->register('listener.system_finish_request', 'Acms\Core\System\EventListener\FinishRequestListener');

$container->register('listener.system_terminate', 'Acms\Core\System\EventListener\TerminateListener');

$container->register('listener.response', 'Symfony\Component\HttpKernel\EventListener\ResponseListener')
    ->setArguments(array('%charset%'))
;

$container->register('listener.exception', 'Symfony\Component\HttpKernel\EventListener\ExceptionListener')
    ->setArguments(array('Acms\\Core\\ErrorHandler\\Controller\\ErrorController::exceptionAction'))
;

//$container->register('system.init', 'Acms\Core\System\Event\SystemInitEvent');

/*
$container->register('path.context', 'Acms\Core\System\PathContext')
    //->setArguments(array(null, null))
    ->setArguments(array('%rootDir%', '%rootUrl%'))
;
//*/

/*
$container->register('listener.path_context', 'Acms\Core\System\EventListener\PathContextListener')
    ->setArguments(array(new Reference('path.context')))
;
//*/

$container->register('dispatcher', 'Symfony\Component\EventDispatcher\EventDispatcher')
    ->addMethodCall('addSubscriber', array(new Reference('listener.router')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.response')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.exception')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.system_request')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.system_controller')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.system_view')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.system_response')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.system_finish_request')))
    ->addMethodCall('addSubscriber', array(new Reference('listener.system_terminate')))
    //->addMethodCall('addSubscriber', array(new Reference('listener.path_context')))
;

$container->register('httpkernel', 'Acms\Core\HttpKernel')
->setArguments(array(new Reference('dispatcher'), new Reference('resolver')))
;

return $container;