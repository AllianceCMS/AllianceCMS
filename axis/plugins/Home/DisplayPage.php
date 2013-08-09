<?php
namespace Home;

use Acms\Core\Templates\Template;

class DisplayPage
{
    function homeFrontPage($axis) {

        $content = new Template(dirname(__FILE__) . DS . 'views/main.tpl.php');

        return $content;

    }
}