<?php
namespace Acms\Core\EventDispatcher\EventListener;

use Acms\Core\System\SystemContext;
use Acms\Core\System\Event\SystemPathLoaderEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class SystemContextListener implements EventSubscriberInterface
{
    public function __construct(SystemContext $systemContext)
    {

        //*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/

        /*
        echo '<br /><pre>$context_listener: ';
        echo var_dump($context);
        echo '</pre><br />';
        //exit;
        //*/

        //$systemContext = new $context();

        /*
        echo '<br /><pre>$systemContext_listener: ';
        echo var_dump($systemContext);
        echo '</pre><br />';
        exit;
        //*/
    }

    public function onRequestPre(GetResponseEvent $event)
    //public function onRequestPre(SystemPathLoaderEvent $event)
    {

        ///*
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
        //$test = $event->test();

        //*
        echo '<br /><pre>$request: ';
        echo var_dump($request);
        echo '</pre><br />';
        exit;
        //*/


        //$acmsBaseDir = dirname(dirname(dirname(__DIR__)));

        //$request->attributes->set('acmsBaseDir', $acmsBaseDir);

        /*
        echo '<br /><pre>$request->attributes->all(): ';
        echo var_dump($request->attributes->all());
        echo '</pre><br />';
        exit;
        //*/
    }

    public static function getSubscribedEvents()
    {

        //*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/

        //return ['system.path_loader' => ['onRequest', 10]];

        //*
        return [
            KernelEvents::REQUEST => [
                ['onRequestMid', 50],
                //['onKernelResponseMid', 5],
                //['onKernelResponsePost', 0],
            ],
        ];
        //*/
    }
}