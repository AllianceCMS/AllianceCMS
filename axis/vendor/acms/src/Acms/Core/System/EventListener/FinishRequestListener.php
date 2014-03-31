<?php
namespace Acms\Core\System\EventListener;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\RequestStack;
//use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
//use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
//use Symfony\Component\Routing\Matcher\RequestMatcherInterface;
//use Symfony\Component\Routing\RequestContext;
//use Symfony\Component\Routing\RequestContextAwareInterface;

class FinishRequestListener implements EventSubscriberInterface
{
    public function onFinishRequestPre(FinishRequestEvent $event)
    {
        return true;
    }

    public function onFinishRequestMid(FinishRequestEvent $event)
    {
        return true;
    }

    public function onFinishRequestPost(FinishRequestEvent $event)
    {
        return true;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::FINISH_REQUEST => [
                ['onFinishRequestPre', 100],
                ['onFinishRequestMid', 50],
                ['onFinishRequestPost', 0],
            ]
        ];
    }
}