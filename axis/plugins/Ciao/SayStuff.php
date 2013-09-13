<?php
namespace Ciao;

use Acms\Core\Templates\Template;
use Acms\Core\Components\AbstractPlugin;

class SayStuff extends AbstractPlugin
{
    public function sayHi()
    {
        $content = new Template(dirname(__FILE__) . DS . 'views/greetings.tpl.php');
        $content->set('name', $this->axis->axisRoute->values['name'][0]);

        return $content;
    }

    public function sayBye()
    {
        $content = new Template(dirname(__FILE__) . DS . 'views/tata.tpl.php');
        $content->set('name', $this->axis->axisRoute->values['name'][0]);

        return $content;
    }
}
