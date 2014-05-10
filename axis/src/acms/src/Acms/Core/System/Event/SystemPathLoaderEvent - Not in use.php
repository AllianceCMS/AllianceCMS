<?php
namespace Acms\Core\System\Event;

//use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class SystemPathLoaderEvent extends GetResponseEvent
{
    private $parameters;

    public function __construct($kernel, $request, $requestType, $parameters)
    {
        //*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/

        parent::__construct($kernel, $request, $requestType);

        $this->parameters = $parameters;

        /*
        exit;
        //*/
    }

    public function test()
    {
        //*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/
    }
}