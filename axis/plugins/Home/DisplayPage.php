<?php
namespace Home;

use Acms\Core\Templates\Template;
use Acms\Core\Components\AbstractPlugin;

class DisplayPage extends AbstractPlugin
{
    function homeFrontPage() {

        $content = new Template(dirname(__FILE__) . DS . 'views/main.tpl.php');

        return $content;
    }
}
