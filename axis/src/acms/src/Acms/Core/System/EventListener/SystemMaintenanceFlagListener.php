<?php
namespace Acms\Core\System\EventListener;

use Acms\Core\Application;
use Acms\Core\System\SystemEvents;
use Acms\Core\System\Event\SiteMaintenanceFlagEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class SystemMaintenanceFlagListener implements EventSubscriberInterface
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function onKernelRequest(SiteMaintenanceFlagEvent $event)
    {
        $event->setFlagValue('2');
    }

    public static function getSubscribedEvents()
    {
        return [
            SystemEvents::SYSTEM_MAINTENANCE_FLAG => [
                ['onKernelRequest', 100],
                //['onKernelResponse', 0],
            ],
        ];
    }
}