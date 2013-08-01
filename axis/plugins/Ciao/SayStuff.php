<?php
namespace Ciao;

use Acms\Core\Templates\Template;

class SayStuff
{
    public function sayHi($system)
    {
        $body = new Template(dirname(__FILE__) . DS . 'views/greetings.tpl.php');
        $body->set('name', $system['routeInfo']->values['name'][0]);

        return $body;
    }

    public function sayBye($system)
    {
        $body = new Template(dirname(__FILE__) . DS . 'views/tata.tpl.php');
        $body->set('name', $system['routeInfo']->values['name'][0]);

        return $body;
    }

    public function yoAdmin($system)
    {
        $body = new Template(dirname(__FILE__) . DS . 'views/admin.tpl.php');
        $body->set('greeting', 'Hello Ciao Admin');

        return $body;
    }
}
