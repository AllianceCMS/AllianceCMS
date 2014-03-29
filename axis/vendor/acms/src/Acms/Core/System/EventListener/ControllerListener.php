<?php
namespace Acms\Core\System\EventListener;

use Acms\Core\System\Event\SystemInitEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\RequestStack;
//use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
//use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
//use Symfony\Component\Routing\Matcher\RequestMatcherInterface;
//use Symfony\Component\Routing\RequestContext;
//use Symfony\Component\Routing\RequestContextAwareInterface;

class ControllerListener implements EventSubscriberInterface
{
    public function onControllerPre(FilterControllerEvent $event)
    {
        return true;
    }

    public function onControllerMid(FilterControllerEvent $event)
    {
        return true;
    }

    public function onControllerPost(FilterControllerEvent $event)
    {
        return true;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => [
                ['onControllerPre', 100],
                ['onControllerMid', 50],
                ['onControllerPost', 0],
            ]
        ];
    }
}