<?php
namespace Ciao;

use Acms\Core\Templates\Template;

class SayStuff
{
    public function sayHi($axis)
    {
        $body = new Template(dirname(__FILE__) . DS . 'views/greetings.tpl.php');
        $body->set('name', $axis->routeInfo->values['name'][0]);

        return $body;
    }

    public function sayBye($axis)
    {
        $body = new Template(dirname(__FILE__) . DS . 'views/tata.tpl.php');
        $body->set('name', $axis->routeInfo->values['name'][0]);

        return $body;
    }

    public function yoAdmin($axis)
    {
        $body = new Template(dirname(__FILE__) . DS . 'views/admin.tpl.php');
        $body->set('greeting', 'Hello Ciao Admin');

        return $body;
    }
}
