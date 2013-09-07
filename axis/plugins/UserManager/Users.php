<?php
namespace UserManager;

use Aura\Core\Entities\CurrentUser;
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
        if ($axis->axisRoute->name !== 'login_page') {
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

    public function loginPage($axis)
    {
        $html_helper = new HtmlHelper($axis->basePath);
        $form_helper = new FormHelper($axis->basePath);

        $content = new Template(dirname(__FILE__) . DS . 'views/login.tpl.php');
        $content->set('html_helper', $html_helper);
        $content->set('form_helper', $form_helper);

        // If login-attempt found empty required fields, then process errors sent back to this action
        if (!empty($axis->axisRoute->values['errors'])) {

            $form_data = $form_helper->processErrors($axis->axisRoute->values['errors']);

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

        /*
        echo '<br /><pre>$result: ';
        echo var_dump($result);
        echo '</pre><br />';
        //exit;
        //*/

        if ($result !== false) {
            // User exists, check password

            $passwordAttempt = $_POST['password'];
            $passwordStored = $result['password'];

            if ((crypt($passwordAttempt, $passwordStored)) == $passwordStored)
            {
                // Remove Old Session
                //$this->logoutAttempt($axis);

                // Setup Session
                $axis->segmentUser->uid = $result['id'];
                $axis->segmentUser->display_name = $result['display_name'];
                $axis->segmentUser->logged_in = '1';

                // Store Session in Database
                $axis->sql->dbSelect('users',
                    'id, display_name, password',
                    'login_name = :login_name',
                    [
                    'login_name' => $_POST['login_name'],
                    ]
                );

                $tableColumns = [
                    'user_id' => $result['id'],
                    'session_id' => $axis->sessionAxis->getId(),
                    'hostname' => $_SERVER['REMOTE_ADDR'],
                    'persistent' => 1,
                    'created' => date("Y-m-d H:i:s", time()),
                ];

                $axis->sql->dbInsert('sessions', $tableColumns);

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

        $axis->sql->dbDelete('sessions', 'session_id = :session_id', ['session_id' => $axis->sessionAxis->getId()]);

        $axis->sessionAxis->destroy();

        header('Location: ' . $axis->basePath);
        exit;

        return false;
    }
}