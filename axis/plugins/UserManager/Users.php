<?php
namespace UserManager;

use Acms\Core\Templates\Template;
use Acms\Core\Html\FormHelper;
use Acms\Core\Html\HtmlHelper;

/**
 * @todo: Multiple Items
 *     - Filter/Validate login name and password
 *
 *     - Create Registration Page
 *
 *     - Create Profile Pages (Possibly a separate plugin?)
 *
 *     - Create 'Forgot Password' Functionality
 *
 *     - Look into 'Remember Me' Functionality
 *
 *     - ???Remove loginSuccesful action/view???
 *
 *     - Comment Code
 */

class Users
{
    public function loginBlock($axis)
    {
        if ($axis->routeInfo->name !== 'login_page') {
            $html_helper = new HtmlHelper($axis->basePath);
            $form_helper = new FormHelper($axis->basePath);

            $block_content = new Template(dirname(__FILE__) . DS . 'views/login_block.tpl.php');
            $block_content->set('html_helper', $html_helper);
            $block_content->set('form_helper', $form_helper);
            $block_content->set('uid', $axis->segmentUser->uid);
            $block_content->set('logged_in', ((isset($axis->segmentUser->logged_in) && ($axis->segmentUser->logged_in == '1')) ? intval(1) : ''));

            $block['title'] = ((isset($axis->segmentUser->logged_in) && ($axis->segmentUser->logged_in == '1')) ? 'Welcome ' . $axis->segmentUser->display_name . '!' : 'Sign In');
            $block['content'] = $block_content;

            return $block;
        }

        return false;
    }

    public function loginPage($axis)
    {
        $html_helper = new HtmlHelper($axis->basePath);
        $form_helper = new FormHelper($axis->basePath);

        $content = new Template(dirname(__FILE__) . DS . 'views/login.tpl.php');
        $content->set('html_helper', $html_helper);
        $content->set('form_helper', $form_helper);

        // If login-attempt found empty required fields, then process errors sent back to this action
        if (!empty($axis->routeInfo->values['errors'])) {

            $form_data = $form_helper->processErrors($axis->routeInfo->values['errors']);

            if (!empty($form_data)) {
                foreach($form_data as $attribute => $value) {
                    $content->set($attribute, $value);
                }
            }
        }

        return $content;
    }

    public function loginAttempt($axis)
    {
        $form_helper = new FormHelper($axis->basePath);

        // Check for form errors
        $form_helper->checkRequired(['login_name', 'password']);
        $form_helper->sendErrors('/user/login');

        // No Errors

        // Attempt login

        $axis->sql->dbSelect('users',
            'id, display_name, password',
            'login_name = :login_name',
            [
                'login_name' => $_POST['login_name'],
            ]
        );

        $result = $axis->sql->dbFetch('one');

        if ($result !== false) {
            // User exists, check password

            $passwordAttempt = $_POST['password'];
            $passwordStored = $result['password'];

            if ((crypt($passwordAttempt, $passwordStored)) == $passwordStored)
            {
                $axis->segmentUser->uid = $result['id'];
                $axis->segmentUser->display_name = $result['display_name'];
                $axis->segmentUser->logged_in = '1';

                header('Location: ' . $axis->basePath);
                exit;

            } else {

                $form_helper->addError('invalid_password');
                $form_helper->sendErrors('/user/login');
            }
        } else {
            $form_helper->addError('invalid_login_name');
            $form_helper->sendErrors('/user/login');
        }

        return false;
    }

    public function loginSuccessful($axis)
    {
        $html_helper = new HtmlHelper($axis->basePath);
        $form_helper = new FormHelper($axis->basePath);

        $content = new Template(dirname(__FILE__) . DS . 'views/login_successful.tpl.php');
        $content->set('html_helper', $html_helper);
        $content->set('form_helper', $form_helper);

        return $content;
    }


    public function logoutAttempt($axis)
    {
        $axis->sessionAxis->start();

        $axis->sessionAxis->destroy();

        header('Location: ' . $axis->basePath);
        exit;

        return false;
    }
}