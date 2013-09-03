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
        if ($axis->routeInfo->name !== 'login_page') {
            $html_helper = new HtmlHelper($axis->basePath);
            $form_helper = new FormHelper($axis->basePath);

            $block_content = new Template(dirname(__FILE__) . DS . 'views/login_block.tpl.php');
            $block_content->set('html_helper', $html_helper);
            $block_content->set('form_helper', $form_helper);
            $block_content->set('logged_in', (($axis->currentUser->isLoggedIn()) ? intval(1) : ''));

            $block['title'] = (($axis->currentUser->isLoggedIn()) ? 'Welcome ' . $axis->currentUser->displayName() . '!' : 'Sign In');
            $block['content'] = $block_content;

            return $block;
        }

        return false;
    }

    public function adminNavigation($axis)
    {
        //parent::adminNavigation();
        $adminNav['title'] = 'Dashboard';
        $adminNav['link'] = '/dashboard';

        return $adminNav;
    }
}
