<?php
namespace Acms\Core\System\EventListener;

use Acms\Core\System\Event\SystemInitEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\RequestStack;
//use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
//use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
//use Symfony\Component\Routing\Matcher\RequestMatcherInterface;
//use Symfony\Component\Routing\RequestContext;
//use Symfony\Component\Routing\RequestContextAwareInterface;

class ViewListener implements EventSubscriberInterface
{
    public function onViewPre(GetResponseForControllerResultEvent $event)
    {
        return true;
    }

    public function onViewMid(GetResponseForControllerResultEvent $event)
    {
        return true;
    }

    public function onViewPost(GetResponseForControllerResultEvent $event)
    {
        return true;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [
                ['onViewPre', 100],
                ['onViewMid', 50],
                ['onViewPost', 0],
            ]
        ];
    }
}