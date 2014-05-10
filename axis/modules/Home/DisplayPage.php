<?php
namespace Home;

use Acms\Templates\Template;
use Acms\ModuleSystem\ModuleBuilder\AbstractModule;

class DisplayPage extends AbstractModule
{
    function homeFrontPage() {

        $content = new Template(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views/main.tpl.php');

        return $content;
    }
}
