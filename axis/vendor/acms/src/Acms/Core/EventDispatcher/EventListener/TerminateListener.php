<?php
namespace Acms\Core\EventDispatcher\EventListener;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\RequestStack;
//use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
//use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
//use Symfony\Component\Routing\Matcher\RequestMatcherInterface;
//use Symfony\Component\Routing\RequestContext;
//use Symfony\Component\Routing\RequestContextAwareInterface;

class TerminateListener implements EventSubscriberInterface
{
    public function onTerminatePre(PostResponseEvent $event)
    {
        return true;
    }

    public function onTerminateMid(PostResponseEvent $event)
    {
        return true;
    }

    public function onTerminatePost(PostResponseEvent $event)
    {
        return true;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::TERMINATE => [
                ['onTerminatePre', 100],
                ['onTerminateMid', 50],
                ['onTerminatePost', 0],
            ]
        ];
    }
}