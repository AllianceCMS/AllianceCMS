<?php
namespace Admin;

use Acms\Core\Components\AbstractAdmin;
use Acms\Core\Entities\CurrentUser;
use Acms\Core\Templates\Template;
use Acms\Core\Html\FormHelper;
use Acms\Core\Html\HtmlHelper;

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
