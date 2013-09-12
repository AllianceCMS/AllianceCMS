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

        if ($result !== false) {

            // User exists, check password

            $passwordAttempt = $_POST['password'];
            $passwordStored = $result['password'];

            if ((crypt($passwordAttempt, $passwordStored)) == $passwordStored) {

                // Setup Session
                $axis->segmentUser->display_name = $result['display_name'];
                $axis->sessionAxis->commit();

                $acms_id = crypt($result['display_name'], $axis->acmsSalt);

                $tableColumns = [
                    'acms_id' => $acms_id,
                    'modified' => date("Y-m-d H:i:s", time()),
                ];

                $conditions = 'id = :id';

                $bind = ['id' => $result['id']];

                $result = $axis->sql->dbUpdate('users', $tableColumns, $conditions, $bind);

                $cookieName = str_replace('.', '_', $_SERVER['SERVER_NAME']) . '_cookie';

                setcookie($_SERVER['SERVER_NAME'] . '_cookie', false, time() - 3600, '/', $_SERVER['SERVER_NAME']);

                if ($_POST['stay_logged_in'] === '1') {
                    setcookie($_SERVER['SERVER_NAME'] . '_cookie', $acms_id, time()+60*60*24*365, '/', $_SERVER['SERVER_NAME']);
                } else {
                    setcookie($_SERVER['SERVER_NAME'] . '_cookie', $acms_id, 0, '/', $_SERVER['SERVER_NAME']);
                }

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

        $currentUser = new \Acms\Core\Entities\CurrentUser($sessionAxis);

        $tableColumns = [
            'acms_id' => '',
            'modified' => date("Y-m-d H:i:s", time()),
        ];

        $conditions = 'id = :id';

        $bind = ['id' => $currentUser->getId()];

        $axis->sql->dbUpdate('users', $tableColumns, $conditions, $bind, $dbPrefix);

        $axis->sessionAxis->destroy();

        $cookieName = str_replace('.', '_', $_SERVER['SERVER_NAME']) . '_cookie';

        setcookie($_SERVER['SERVER_NAME'] . '_cookie', false, time() - 3600, '/', $_SERVER['SERVER_NAME']);

        header('Location: ' . $axis->basePath);
        exit;

        return false;
    }
}