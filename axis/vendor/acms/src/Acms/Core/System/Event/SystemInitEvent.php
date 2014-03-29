<?php
namespace Acms\Core\System\Event;

use Symfony\Component\EventDispatcher\Event;

class SystemInitEvent extends Event
{
    public function __construct()
    {
        /*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/
    }

    public function test()
    {
        /*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/
    }
}