<?php
/**
 * Ciao Module namespace
 *
 * Use the same name as the module folder to comply with PSR-0 and so internal autoloader will load this controller properly
 *
 */

namespace Ciao;

/**
 * Use statements needed for module dev
 *
 * Eases access to the AbstractModule and Template Classes
 */

use Acms\Core\Components\AbstractModule;
use Acms\Core\Templates\Template;

/**
 * Class Definition
 *
 * All 'front' controllers need to extend the AbstractModule abstract Class.
 *     The AbstractModule Class provides the __contruct method and other helper methods used for module development.
 *
 *     If you need to use a constructor, you will need to load the parent constructor:
 *
 *     @code
 *     public function __construct()
 *     {
 *         parent::__construct();
 *
 *         // Your code here
 *     }
 *     @endcode
 *
 *     This should not be a common occurence, as the route dispatcher should be the only entity to load controllers attached to routes
 *
 */

class SayStuff extends AbstractModule
{
    public function sayHi()
    {
        // Create template, provide the view file to the constructor
        $content = new Template(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views/greetings.tpl.php');

        // Send a variable to the view. The below variable can be accessed in the view (greetings.tpl.php) by using $name
        $content->set('name', $this->axisRoute->values['name'][0]);

        // Return final/complete template to route dispatcher

        // Note: Templates can be nested, but the final template must be returned so the route dispatcher can render the output using the main theme template

        return $content;
    }

    public function sayBye()
    {
        $content = new Template(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views/tata.tpl.php');
        $content->set('name', $this->axisRoute->values['name'][0]);

        return $content;
    }
}
