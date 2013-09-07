<?php
namespace Admin;

use Aura\Core\Entities\CurrentUser;
use Acms\Core\Templates\Template;
use Acms\Core\Html\FormHelper;
use Acms\Core\Html\HtmlHelper;

class AdminPages extends AbstractAdmin
{
    public function dashboardHome($axis)
    {
        $html_helper = new HtmlHelper($axis->basePath);
        $form_helper = new FormHelper($axis->basePath);

        $content = new Template(dirname(__FILE__) . DS . 'views/dashboard.tpl.php');
        $content->set('theme_folder', BASE_URL . '/themes/Delta');

        return $content;
    }

    public function adminNavigation()
    {
        $adminNav = [
            'Parent' => [
                'Dashboard' => '#',
                'TestCat' => '#',
            ],
            'Dashboard' => [
                'Dashboard' => '/dashboard',
                'Dashboard Test' => '/dashboard/test',
            ],
            'TestCat' => [
                'TestCat' => '/test-cat',
                'TestCat 2' => '/test-cat-2',
            ],
        ];

        return $adminNav;
    }
}
