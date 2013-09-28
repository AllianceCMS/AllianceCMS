<?php
namespace Home;

use Acms\Core\Templates\Template;
use Acms\Core\Components\AbstractModule;

class DisplayPage extends AbstractModule
{
    function homeFrontPage() {

        $content = new Template(dirname(__FILE__) . DS . 'views/main.tpl.php');

        return $content;
    }
}
