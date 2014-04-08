<?php
use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;

$container = new DependencyInjection\ContainerBuilder();

/**
 * Symfony container elements
 */

//$container->register('container', 'Symfony\Component\DependencyInjection\DependencyInjection\ContainerBuilder');

$container->register('RequestContext', 'Symfony\Component\Routing\RequestContext');

$container->register('matcher', 'Symfony\Component\Routing\Matcher\UrlMatcher')
    ->setArguments(array('%routes%', new Reference('RequestContext')))
;

$container->register('generator', 'Symfony\Component\Routing\Generator\UrlGenerator')
    ->setArguments(array('%routes%', new Reference('RequestContext')))
;

$container->register('listener.router', 'Symfony\Component\HttpKernel\EventListener\RouterListener')
    ->setArguments(array(new Reference('matcher')))
;

$container->register('listener.response', 'Symfony\Component\HttpKernel\EventListener\ResponseListener')
    ->setArguments(array('%charset%'))
;

$container->register('listener.exception', 'Symfony\Component\HttpKernel\EventListener\ExceptionListener')
    ->setArguments(array('Acms\\Core\\ErrorHandler\\Controller\\ErrorController::exceptionAction'))
;

/**
 * Acms container elements
 */

$container->register('resolver', 'Acms\Core\ModuleLoader\Controller\ControllerResolver')
    ->setArguments(array('%request%'))
;

$container->register('system.path_loader', 'Acms\Core\System\Event\SystemPathLoaderEvent')
    ->setArguments(array(new Reference('httpkernel'), new Reference('RequestContext')))
;

$container->register('system.path_bag', 'Acms\Core\System\PathBag')
    ->setArguments(array('%pathBagParameters%'))
;

/*
 $container->register('system.context', 'Acms\Core\System\SystemContext')
    //->setArguments(array(null, null))
    ->setArguments(array('%acmsBaseDir%', '%acmsBaseUrl%'))
;
//*/

$container->register('listener.system_request', 'Acms\Core\EventDispatcher\EventListener\RequestListener');

/*
 $container->register('listener.system_context', 'Acms\Core\EventDispatcher\EventListener\SystemContextListener')
    ->setArguments(array(new Reference('system.context')))
;
//*/

$container->register('listener.system_controller', 'Acms\Core\EventDispatcher\EventListener\ControllerListener');

$container->register('listener.system_view', 'Acms\Core\EventDispatcher\EventListener\ViewListener');

$container->register('listener.system_response', 'Acms\Core\EventDispatcher\EventListener\ResponseListener');

$container->register('listener.system_finish_request', 'Acms\Core\EventDispatcher\EventListener\FinishRequestListener');

$container->register('listener.system_terminate', 'Acms\Core\EventDispatcher\EventListener\TerminateListener');

$container->register('httpkernel', 'Acms\Core\HttpKernel')
    ->setArguments(array(new Reference('dispatcher'), new Reference('resolver')))
;

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
    //->addMethodCall('addSubscriber', array(new Reference('listener.system_context')))
;

return $container;