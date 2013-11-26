<?php
namespace VenueManager;

use Acms\Core\Components\AbstractModule;
use Acms\Core\Templates\Template;

class Venues extends AbstractModule
{
    public function venueCreate()
    {

        //*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/

        //*
        echo '<br /><pre>$this->axisRoute: ';
        echo print_r($this->axisRoute);
        echo '</pre><br />';
        //exit;
        //*/

        $content = new Template(dirname(__FILE__) . DS . 'views/venue_create.tpl.php');

        /*
        $content->set('zoneAllModules', $zoneAllModules);
        $content->set('zoneSpecificModules', $zoneSpecificModules);
        $content->set('axisModules', $axisModules);
        $content->set('formHelper', $this->formHelper);
        //*/

        return $content;
    }
}