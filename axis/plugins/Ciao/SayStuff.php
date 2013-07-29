<?php
namespace Ciao;

use Acms\Core\Templates\Template;

class SayStuff
{
    public function sayHi($values)
    {
        $body = new Template(dirname(__FILE__) . DS . 'views/greetings.tpl.php');
        $body->set('name', $values['name'][0]);

        return $body;
    }

    public function sayBye($values)
    {
        $body = new Template(dirname(__FILE__) . DS . 'views/tata.tpl.php');
        $body->set('name', $values['name'][0]);

        return $body;
    }

    public function yoAdmin($values)
    {
        $body = new Template(dirname(__FILE__) . DS . 'views/admin.tpl.php');
        $body->set('greeting', 'Hello Ciao Admin');

        return $body;
    }
}
