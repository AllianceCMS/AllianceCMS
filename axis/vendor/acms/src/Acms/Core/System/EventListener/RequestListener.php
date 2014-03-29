<?php
namespace Acms\Core\System\EventListener;

use Acms\Core\System\Event\SystemInitEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\RequestStack;
//use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
//use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
//use Symfony\Component\Routing\Matcher\RequestMatcherInterface;
//use Symfony\Component\Routing\RequestContext;
//use Symfony\Component\Routing\RequestContextAwareInterface;

class RequestListener implements EventSubscriberInterface
{
    public function onRequestPre(GetResponseEvent $event)
    {
        $dispatcher = $event->getDispatcher();
        $dispatcher->dispatch('system.init', new SystemInitEvent());
    }

    public function onRequestMid(GetResponseEvent $event)
    {
        /*
         * Do the following things
         *
         *      Build PathBag and add it to $request
         *      Check if site is installed
         *          if not start installer
         *      Load the user
         *          Start Session
         *          Create the $currentUser Object
         *          Load permission system (RBAC)
         *      Check for maintenance flag
         */

        return true;
    }

    public function onRequestPost(GetResponseEvent $event)
    {
        return true;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [
                ['onRequestPre', 100],
                ['onRequestMid', 50],
                ['onRequestPost', 0],
            ]
        ];
    }
}