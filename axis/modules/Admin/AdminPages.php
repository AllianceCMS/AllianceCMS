<?php
namespace Admin;

use Acms\ModuleSystem\ModuleBuilder\AbstractAdmin;
use Acms\Entities\CurrentUser;
use Acms\Templates\Template;
use Acms\Html\FormHelper;
use Acms\Html\HtmlHelper;

class AdminPages extends AbstractAdmin
{
    public function dashboardHome()
    {
        $html_helper = new HtmlHelper($this->basePath);
        $form_helper = new FormHelper($this->basePath);

        $content = new Template(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views/dashboard.tpl.php');
        $content->set('theme_folder', BASE_URL . '/themes/Charisma');

        return $content;
    }

    public function adminNavigation()
    {
        $adminNav = [
            'Dashboard Navigation' => [
                'Admin Home' => '/dashboard',
            ],
        ];

        return $adminNav;
    }
}
