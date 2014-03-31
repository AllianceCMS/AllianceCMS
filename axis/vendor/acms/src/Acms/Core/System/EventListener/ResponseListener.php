<?php
namespace Acms\Core\System\EventListener;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\RequestStack;
//use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
//use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
//use Symfony\Component\Routing\Matcher\RequestMatcherInterface;
//use Symfony\Component\Routing\RequestContext;
//use Symfony\Component\Routing\RequestContextAwareInterface;

class ResponseListener implements EventSubscriberInterface
{
    public function onResponsePre(FilterResponseEvent $event)
    {
        return true;
    }

    public function onResponseMid(FilterResponseEvent $event)
    {
        return true;
    }

    public function onResponsePost(FilterResponseEvent $event)
    {
        return true;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => [
                ['onResponsePre', 100],
                ['onResponseMid', 50],
                ['onResponsePost', 0],
            ]
        ];
    }
}