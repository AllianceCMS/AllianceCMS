<?php
namespace Acms\Core\System\EventListener;

use Acms\Core\System\PathBag;
use Acms\Core\System\SystemEvents;
use Acms\Core\System\Event\SystemPathLoaderEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class RequestListener implements EventSubscriberInterface
{
    private $pathBag;

    public function onRequestPre(GetResponseEvent $event)
    {
    }

    public function onRequestMid(GetResponseEvent $event)
    {
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        //*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/

        /*
        echo '<br /><pre>$event->getKernel(): ';
        echo var_dump($event->getKernel());
        echo '</pre><br />';
        exit;
        //*/

        /*
         * Do the following things
         *
         *      SystemPathLoaderEvent
         *          Build PathBag and add it to $request
         *      ??SystemInstallEvent??
         *          (Maybe the data loader should check for db config file then send to install if needed
         *          Check if site is installed
         *              if not start installer
         *      ModelLoader
         *          Load database abstraction layer
         *      SiteStatusEvent
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


        // system path loader
        //$this->systemInit = new SystemInit();
        //$this->pathBag = new PathBag();
        $pathBag = new PathBag();

        // build $pathParameters array
        //$this->systemInit->setParams($params);

        // dispatch event so we can alter $pathParameters array before giving it to $request
        $this->dispatchResponseEvent($event, SystemEvents::SYSTEM_PATH_LOADER, 'Acms\\Core\\System\\Event\\SystemPathLoaderEvent', $pathBag);

        // pass path array to $request: $request->systemPaths = new PathBag($pathParameters);
        //$this->systemInit->commitParams($params);

        // model loader
        //$this->dispatchResponseEvent($event, SystemEvents::MODEL_LOADER, 'Acms\\Core\\System\\Event\\ModelLoaderEvent');

        // site status
        //$this->dispatchResponseEvent($event, SystemEvents::MODEL_LOADER, 'Acms\\Core\\System\\Event\\ModelLoaderEvent');

        // user loader
        //$this->dispatchResponseEvent($event, SystemEvents::MODEL_LOADER, 'Acms\\Core\\System\\Event\\ModelLoaderEvent');

        return true;
    }

    private function dispatchResponseEvent(GetResponseEvent $currentEvent, $eventName, $eventClass, $eventClassParameters)
    {
        //*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/

        $kernel = $currentEvent->getKernel();
        $request = $currentEvent->getRequest();
        $dispatcher = $currentEvent->getDispatcher();
        $type = $currentEvent->getRequestType();

        $eventSystemLoader = new $eventClass($kernel, $request, $type, $eventClassParameters);
        $dispatcher->dispatch($eventName, $eventSystemLoader);

        if ($eventSystemLoader->hasResponse()) {
            return $this->filterResponse($eventSystemLoader->getResponse(), $request, $type);
        }
    }

    public function onRequestPost(GetResponseEvent $event)
    {
        return true;
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        //*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        exit;
        //*/

        $dispatcher = $event->getDispatcher();
        $dispatcher->dispatch('system.path_loader', new SystemPathLoaderEvent());

        try {
            return $this->handleRaw($request, $type);
        } catch (\Exception $e) {
            if (false === $catch) {
                $this->finishRequest($request, $type);

                throw $e;
            }

            return $this->handleException($e, $request, $type);
        }
    }

    private function handleRaw(Request $request, $type = self::MASTER_REQUEST)
    {

    }

    public static function getSubscribedEvents()
    {
        /*
        return [
            KernelEvents::REQUEST => [
                ['handle', 100],
            ]
        ];
        //*/

        //*
        return [
            KernelEvents::REQUEST => [
                ['onKernelRequest', 1024],
                ['onRequestPre', 100],
                ['onRequestMid', 50],
                ['onRequestPost', 0],
            ]
        ];
        //*/
    }
}