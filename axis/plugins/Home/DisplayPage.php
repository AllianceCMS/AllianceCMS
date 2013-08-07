<?php
namespace Home;

use Acms\Core\Templates\Template;

class DisplayPage
{
    function homeFrontPage($axis) {

        $body = new Template(dirname(__FILE__) . DS . 'views/main.tpl.php');

        return $body;

    }
}