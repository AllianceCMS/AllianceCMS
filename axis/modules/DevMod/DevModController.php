<?php
namespace DevMod;

use Acms\Core\Templates\Template;
use Acms\Core\ModuleBuilder\AbstractModule;

//*
// Temporary: Response will be built in the KernelEvents::VIEW listener
use Symfony\Component\HttpFoundation\Response;
//*/

class DevModController extends AbstractModule
{
    function indexAction()
    {
        /*
        echo '<br /><pre>$this->app["paths"]->all(): ';
        echo print_r($this->app['paths']->all());
        echo '</pre><br />';
        //exit;
        //*/

        /*
        echo '<br /><pre>$this->app["request"]->attributes->get("axis"): ';
        echo print_r($this->app['request']->attributes->get('axis'));
        echo '</pre><br />';
        //exit;
        //*/

        /*
        echo '<br /><pre>$this->app["request"]: ';
        echo print_r($this->app['request']);
        echo '</pre><br />';
        //exit;
        //*/

        /*
        echo '<br /><pre>$this: ';
        echo var_dump($this);
        echo '</pre><br />';
        //exit;
        //*/

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

        //*
        return new Response('<p>Greetings from your favorite DevMod!!!</p>');
        //*/
    }
}
