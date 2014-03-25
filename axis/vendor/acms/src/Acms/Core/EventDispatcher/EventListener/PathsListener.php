<?php
namespace Acms\Core\EventDispatcher\EventListener;

//use Acms\Core\EventDispatcher\Event\GetResponseEvent;
use Acms\Core\Paths\FileSystemPaths;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class PathsListener implements EventSubscriberInterface
{
    public function __construct(FileSystemPaths $fileSystemPaths)
    {
        //*
        echo '<br /><pre>$fileSystemPaths: ';
        echo var_dump($fileSystemPaths);
        echo '</pre><br />';
        //exit;
        //*/
    }

    public function onRequest(GetResponseEvent $event)
    {

        //*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/

        //*
        echo '<br /><pre>$event: ';
        echo var_dump($event);
        echo '</pre><br />';
        //exit;
        //*/

        $request = $event->getRequest();

        $baseDir = dirname(dirname(dirname(__DIR__)));

        $request->attributes->set('baseDir', $baseDir);

        /*
        echo '<br /><pre>$request->attributes->all(): ';
        echo var_dump($request->attributes->all());
        echo '</pre><br />';
        exit;
        //*/

        /*
        $response = $event->getResponse();
        $headers = $response->headers;

        if (!$headers->has('Content-Length') && !$headers->has('Transfer-Encoding')) {
            $headers->set('Content-Length', strlen($response->getContent()));
        }
        //*/


    }

    public static function getSubscribedEvents()
    {

        //*
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