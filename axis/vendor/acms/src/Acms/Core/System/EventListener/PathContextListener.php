<?php
namespace Acms\Core\System\EventListener;

use Acms\Core\System\PathContext;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class PathContextListener implements EventSubscriberInterface
{
    public function __construct(PathContext $pathContext)
    {
        /*
        echo '<br /><pre>$context_listener: ';
        echo var_dump($context);
        echo '</pre><br />';
        //exit;
        //*/

        //$pathContext = new $context();

        //*
        echo '<br /><pre>$pathContext_listener: ';
        echo var_dump($pathContext);
        echo '</pre><br />';
        //exit;
        //*/
    }

    public function onRequest(GetResponseEvent $event)
    {

        /*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/

        /*
        echo '<br /><pre>$event: ';
        echo var_dump($event);
        echo '</pre><br />';
        //exit;
        //*/

        $request = $event->getRequest();


        /*
        echo '<br /><pre>$request: ';
        echo var_dump($request);
        echo '</pre><br />';
        exit;
        //*/


        $baseDir = dirname(dirname(dirname(__DIR__)));

        $request->attributes->set('baseDir', $baseDir);

        /*
        echo '<br /><pre>$request->attributes->all(): ';
        echo var_dump($request->attributes->all());
        echo '</pre><br />';
        exit;
        //*/
    }

    public static function getSubscribedEvents()
    {

        /*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/

        return [
            KernelEvents::REQUEST => [
                ['onRequest', 10],
                //['onKernelResponseMid', 5],
                //['onKernelResponsePost', 0],
            ],
        ];
    }
}