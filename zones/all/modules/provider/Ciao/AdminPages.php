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
 * Eases access to the AbstractAdmin and Template Classes
 */

use Acms\Core\Components\AbstractAdmin;
use Acms\Core\Templates\Template;

/**
 * Class Definition
 *
 * All 'admin' controllers need to extend the AbstractAdmin abstract Class.
 *     The AbstractAdmin Class extends the AbstractModule Class, and also provides functionality and helper methods used specifically for admin pages.
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

class AdminPages extends AbstractAdmin
{
    /**
     * Action Definitions
     *
     * Most Class methods will be attached to routes. This does not prevent you from creating custom methods for use inside routed actions.
     *
     * Most 'front' and 'admin' actions will need to return $content. $content should contain a processed template/view so content will display inside of the site theme, but this is not required.
     *     The only time (that I can think of at this time) a routed action does not need to return $content is if the routed action only processes form data and redirects the user agent to another route, i.e. processing for input and then redirecting them to a success page using "header('Location: ' . $this->basePath. '/success');".
     *
     * @return \Acms\Core\Templates\Template
     */

    public function adminCiao()
    {
        // The following uses the AbstractAdmin helper method 'compileTabs' to easily create consistent dynamic tabs in your module page output

        // This is a good example of how templates can be nested. See AbstractAdmin->compileTabs() for a more indepth look.
        $tabLabels = [
            'Settings',
            'Say Hello',
            'Say Goodbye',
        ];

        $settingsContent = new Template(dirname(__FILE__) . DS . 'views/admin.settings.tpl.php');
        $settingsContent->set('greeting', 'Ciao AllianceCMS Admin');

        $sayHelloContent = new Template(dirname(__FILE__) . DS . 'views/admin.say_hello.tpl.php');
        $sayHelloContent->set('greeting', 'Say Hello: Ciao AllianceCMS Admin');

        $sayGoodbyeContent = new Template(dirname(__FILE__) . DS . 'views/admin.say_goodbye.tpl.php');
        $sayGoodbyeContent->set('greeting', 'Say Goodbye: Ciao AllianceCMS Admin');

        $tabContent = [
            $settingsContent,
            $sayHelloContent,
            $sayGoodbyeContent,
        ];

        $tabTemplate = $this->compileTabs($tabLabels, $tabContent, $active = 2);

        // Create the main template, send the tabbed template to the main template, use the main template view to output the tabbed template along with your other view html code
        $content = new Template(dirname(__FILE__) . DS . 'views/admin.ciao.tpl.php');
        $content->set('tabTemplate', $tabTemplate);

        // Return $content to the route dispatcher
        return $content;
    }

    public function adminCiaoStats()
    {
        // Create a template, send the variable 'greeting' and it's value to the template, and use $greeting to access this value in the view
        $content = new Template(dirname(__FILE__) . DS . 'views/admin.forms.tpl.php');
        $content->set('greeting', 'Here\'s Some Stats For You!!!. Courtesy Of The Ciao Module!');

        return $content;
    }

    public function adminNavigation()
    {
        /**
         * Use this array to create Admin Dashboard navigation links. Using the Charisma template the links will be displayed in the sidebar on the left side of the page
         *
         * The first element should be either a Default catagory name, or the label 'Parent', which tells AllianceCMS you want to create a new Category
         *
         * The default categories are:
         *     'Dashboard'
         *     'Venues'
         *     'Users'
         *     'Content'
         *     'Statistics'
         *     'Module Manager'
         *     'Theme Manager'
         *     'Other'
         *
         * Once you have have listed a default category you will need to provide link labels and urls. Urls do not need to be internal references.
         *
         * The 'Parent' array element tells AllianceCMS that you would like to create a new Parent Category. This is only required if you would like to create a new category.
         *
         * After defining a new category using the 'Parent' element, you will still need to define links by referencing the newly created label.
         *
         */

        $adminNav = [
            'Parent' => [
                'Ciao Demo Category' => '#',
            ],
            'Other' => [
                'Ciao' => '/ciao',
                'Ciao Forms' => '/ciao/forms',
            ],
            'Ciao Demo Category' => [
                'Ciao Demo Link' => '#',
                'Ciao Demo Link 2' => '#',
            ],
        ];

        return $adminNav;
    }
}
