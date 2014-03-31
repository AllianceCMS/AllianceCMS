<?php
namespace Home;

use Acms\Core\Templates\Template;
use Acms\Core\Components\AbstractModule;
use Symfony\Component\HttpFoundation\Response;

class DisplayPage extends AbstractModule
{
    function homeFrontPage($axis = null)
    {

        /*
        echo '<br /><pre>$axis_homeFrontPage: ';
        echo var_dump($axis);
        echo '</pre><br />';
        //exit;
        //*/

        /*
        echo '<br /><pre>get_defined_vars(): ';
        echo print_r(get_defined_vars());
        echo '</pre><br />';
        //exit;
        //*/

        /*
        echo '<br /><pre>get_class_vars($this): ';
        echo print_r(get_class_vars('DisplayPage'));
        echo '</pre><br />';
        //exit;
        //*/

        /*
        echo '<br /><pre>get_class_methods($this): ';
        echo print_r(get_class_methods($this));
        echo '</pre><br />';
        //exit;
        //*/

        /*
        echo '<br /><pre>get_object_vars($this): ';
        echo print_r(get_object_vars($this));
        echo '</pre><br />';
        //exit;
        //*/

        $content = new Template(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views/main.tpl.php');

        //return $content;
        return new Response('<p>Greetings from your favorite home page!!!</p>');
    }
}
