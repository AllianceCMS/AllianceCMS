<?php
namespace Ciao;

use Acms\Core\Templates\Template;

class SayStuff
{
    public function sayHi($axis)
    {
        $content = new Template(dirname(__FILE__) . DS . 'views/greetings.tpl.php');
        $content->set('name', $axis->axisRoute->values['name'][0]);

        return $content;
    }

    public function sayBye($axis)
    {
        $content = new Template(dirname(__FILE__) . DS . 'views/tata.tpl.php');
        $content->set('name', $axis->axisRoute->values['name'][0]);

        return $content;
    }
}
