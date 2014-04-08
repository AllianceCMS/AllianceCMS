<?php
namespace Acms\Core\EventDispatcher\EventListener;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

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