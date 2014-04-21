<?php
namespace AuthManager;

use Acms\Core\ModuleBuilder\AbstractModule;
use Acms\Core\Data\Db;
use Acms\Core\Html\FormHelper;
use Acms\Core\Html\HtmlHelper;
use Acms\Core\Templates\Template;
use Acms\Core\Entities\CurrentUser;
use Acms\Core\Data\Security;

/**
 * @todo: Multiple Items
 *
 *     - loginBlock loads separately and not instantiated with 'axis' as controller parameter
 *
 *     - Filter/Validate login name and password
 *
 *     - Create Registration Page
 *
 *     - Create Profile Pages (Possibly a separate module?)
 *
 *     - Create 'Forgot Password' Functionality
 *
 *     - Look into 'Remember Me' Functionality
 *
 *     - ???Remove loginSuccesful action/view???
 *
 *     - Comment Code
 */

class UserAuth extends AbstractModule
{
    public function loginBlock()
    {
        if ($this->axisRoute->name !== 'login_page') {
            $html_helper = new HtmlHelper($this->basePath);
            $form_helper = new FormHelper($this->basePath);

            $block_content = new Template(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views/login_block.tpl.php');
            $block_content->set('html_helper', $html_helper);
            $block_content->set('form_helper', $form_helper);
            $block_content->set('logged_in', (($this->currentUser->isLoggedIn()) ? intval(1) : ''));

            $block['title'] = (($this->currentUser->isLoggedIn()) ? 'Welcome ' . $this->currentUser->displayName() . '!' : 'Sign In');
            $block['content'] = $block_content;

            return $block;
        }

        return false;
    }

    public function loginPage()
    {
        $content = new Template(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views/login.tpl.php');
        $content->set('logged_in', (($this->currentUser->isLoggedIn()) ? intval(1) : ''));
        $content->set('html_helper', $this->htmlHelper);
        $content->set('form_helper', $this->formHelper);

        // If login-attempt found empty required fields, then process errors sent back to this action
        if (!empty($this->axisRoute->values['errors'])) {

            $form_data = $this->formHelper->processErrors($this->axisRoute->values['errors']);

            if (!empty($form_data)) {
                foreach($form_data as $attribute => $value) {
                    $content->set($attribute, $value);
                }
            }
        }

        return $content;
    }

    public function loginAttempt()
    {
        $sql = new Db();
        $security = new Security();

        $form_helper = new FormHelper($this->basePath);

        // Check for form errors
        $form_helper->checkRequired(['login_name', 'password']);
        $form_helper->sendErrors('/user/login');

        // No Errors

        // Attempt login

        $sql->dbSelect('users',
            'id, display_name, password',
            'login_name = :login_name',
            [
                'login_name' => $_POST['login_name'],
            ]
        );

        $result = $sql->dbFetch('one');

        if ($result !== false) {

            // User exists, check password

            $passwordAttempt = $_POST['password'];
            $passwordStored = $result['password'];

            if ((crypt($passwordAttempt, $passwordStored)) == $passwordStored) {

                // Setup Session
                $this->segmentUser->display_name = $result['display_name'];
                $this->sessionAxis->commit();

                $acms_id = crypt($result['display_name'], $security->randomBlowfishSalt());

                $tableColumns = [
                    'acms_id' => $acms_id,
                    'modified' => date("Y-m-d H:i:s", time()),
                ];

                $conditions = 'id = :id';

                $bind = ['id' => $result['id']];

                $result = $sql->dbUpdate('users', $tableColumns, $conditions, $bind);

                $cookieName = str_replace('.', '_', $_SERVER['SERVER_NAME']) . '_acms';

                setcookie($_SERVER['SERVER_NAME'] . '_acms', false, time() - 3600, '/', $_SERVER['SERVER_NAME']);

                if ((isset($_POST['stay_logged_in'])) && ($_POST['stay_logged_in'] === '1')) {
                    setcookie($_SERVER['SERVER_NAME'] . '_acms', $acms_id, time()+60*60*24*365, '/', $_SERVER['SERVER_NAME']);
                } else {
                    setcookie($_SERVER['SERVER_NAME'] . '_acms', $acms_id, 0, '/', $_SERVER['SERVER_NAME']);
                }

                header('Location: ' . $this->basePath);
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

    public function logoutAttempt()
    {
        $sql = new Db();

        $this->sessionAxis->start();

        $currentUser = new \Acms\Core\Entities\CurrentUser($this->sessionAxis);

        $tableColumns = [
            'acms_id' => '',
            'modified' => date("Y-m-d H:i:s", time()),
        ];

        $conditions = 'id = :id';

        $bind = ['id' => $currentUser->getId()];

        $sql->dbUpdate('users', $tableColumns, $conditions, $bind);

        $this->sessionAxis->destroy();

        $cookieName = str_replace('.', '_', $_SERVER['SERVER_NAME']) . '_acms';

        setcookie($_SERVER['SERVER_NAME'] . '_acms', false, time() - 3600, '/', $_SERVER['SERVER_NAME']);

        header('Location: ' . $this->basePath);
        exit;

        return false;
    }
}
