<?php
namespace Ciao;

use \Admin\AbstractAdmin;
use Acms\Core\Templates\Template;

class AdminPages extends AbstractAdmin
{
    public function adminCiao($axis)
    {
        $content = new Template(dirname(__FILE__) . DS . 'views/admin.tpl.php');
        $content->set('greeting', 'Hello Ciao Admin');

        return $content;
    }

    public function adminNavigation($axis)
    {
        //parent::adminNavigation();
        $adminNav['title'] = 'Ciao';
        $adminNav['link'] = '/ciao';
        $adminNav['submenu'] = [
                'Page 1' => '/ciao',
                'Page 2' => '/ciao/stats',
                'Page 3' => '/ciao/Jane Doe',
        ];

        return $adminNav;
    }
}
