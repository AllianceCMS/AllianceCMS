<?php
namespace Ciao;

//use \Admin\AbstractAdmin;
use Acms\Core\Components\AbstractAdmin;
use Acms\Core\Templates\Template;

class AdminPages extends AbstractAdmin
{
    public function adminCiao()
    {
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

        $content = $this->compilePage($tabLabels, $tabContent);

        return $content;
    }

    public function adminCiaoStats()
    {
        $content = new Template(dirname(__FILE__) . DS . 'views/admin.forms.tpl.php');
        $content->set('greeting', 'Here\'s Some Stats For You!!!. Courtesy Of The Ciao Plugin!');

        return $content;
    }

    public function adminNavigation()
    {
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
