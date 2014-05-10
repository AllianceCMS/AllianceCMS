<?php
namespace Acms\Core\EventDispatcher\EventListener;

use Acms\Core\Application;
use Acms\Core\System\PathBag;
use Acms\Core\System\SystemEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class RequestListener implements EventSubscriberInterface
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $this->addRequestListeners();

        /*
         * Do the following things
         *
         *      [COMPLETE] SiteStatusEvent
         *          Check for maintenance flag
         *      UserLoaderEvent
         *          Load the user
         *              Start Session
         *              Create the $currentUser Object
         *              Load permission system (RBAC)
         *      PermissionValidationEvent
         *              Check for correct permissions to view page
         *
         */

        // Get model
        $model = $this->app['model'];

        // Get 'maintenance_flag' for main venue
        $model->dbSelect('venues', 'maintenance_flag', 'id = :id', ['id' => intval(1)]);
        $result = $model->dbFetch('one');

        // Pass 'maintenance_flag' to the Application
        $this->app['maintenance_flag'] = $result['maintenance_flag'];

        // Dispatch event so Modules can alter the 'Site Maintenance Flag' programmatically during page load
        $this->dispatchRequestEvent($event, SystemEvents::SYSTEM_MAINTENANCE_FLAG, 'Acms\\Core\\System\\Event\\SiteMaintenanceFlagEvent', $this->app);

        // If maintenance_flag is turned on send user to maintenance page/module (???possibly module that contains '404' pages???)
        if ((int) $this->app['maintenance_flag'] === intval(2)) {

            // Display 'Site undergoing maintenance' page
            echo 'Site is down for maintenance, please check back later.';
            exit;
        }

        // user loader
        //$this->dispatchRequestEvent($event, SystemEvents::MODEL_LOADER, 'Acms\\Core\\System\\Event\\ModelLoaderEvent');
    }

    public function onKernelResponse(GetResponseEvent $event)
    {
    }

    private function dispatchRequestEvent(GetResponseEvent $currentEvent, $eventName, $eventClass, Application $app)
    {
        $kernel = $currentEvent->getKernel();
        $request = $currentEvent->getRequest();
        $dispatcher = $currentEvent->getDispatcher();
        $type = $currentEvent->getRequestType();

        $eventSystemLoader = new $eventClass($kernel, $request, $type, $app);
        $dispatcher->dispatch($eventName, $eventSystemLoader);

        if ($eventSystemLoader->hasResponse()) {
            return $this->filterResponse($eventSystemLoader->getResponse(), $request, $type);
        }
    }

    protected function addRequestListeners()
    {
        /*
        // Used for testing purposes
        $this->app['listener.system_maintenance_flag'] = function ($c) {
            return new \Acms\Core\System\EventListener\SystemMaintenanceFlagListener($c);
        };

        $this->app['dispatcher']->addSubscriber($this->app['listener.system_maintenance_flag']);
        //*/
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [
                ['onKernelRequest', 1024],
                //['onKernelResponse', 0],
            ]
        ];
    }
}