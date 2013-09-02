<?php
namespace Acms\Core\Entities;

use \Acms\Core\Data\Db;

class CurrentUser
{
    public $sessionId;

    private $id;
    private $loggedIn = false;
    private $displayName;
    private $sessionPersistent;

    public function __construct()
    {
        $sql = new Db;

        $sql->dbSelect('sessions', 'user_id, persistent', 'session_id = :session_id', ['session_id' => session_id()]);
        $result = $sql->dbFetch('one');

        if ($result !== false) {

            // Setup Current User Info
            $this->id = $result['user_id'];
            $this->loggedIn = true;

            $sql->dbSelect('users', 'id, display_name', 'id = :user_id', ['user_id' => $this->id]);
            $result = $sql->dbFetch('one');

            if ($result !== false) {

                $this->displayName = $result['display_name'];
            }

            $sql->dbUpdate('users',
                [
                    'last_login_time' => (string) date("Y-m-d H:i:s", time()),
                    'last_ip' => $_SERVER['REMOTE_ADDR'],
                ], 'id = :id', ['id' => $result['id']]);

        } else {
            return false;
        }
    }

    public function getId()
    {
        if (!empty($this->id)) {
            return $this->id;
        }

        return 0;
    }

    public function isLoggedIn()
    {
        return $this->loggedIn;
    }

    public function displayName()
    {
        return $this->displayName;
    }
}