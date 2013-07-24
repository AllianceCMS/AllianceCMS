<?php
namespace Home;

use Acms\Core\Templates\Template;

class DisplayPage
{
    function homeFrontPage($values) {

        $body = new Template(dirname(__FILE__) . DS . 'views/main.tpl.php');

        return $body;

    }
}