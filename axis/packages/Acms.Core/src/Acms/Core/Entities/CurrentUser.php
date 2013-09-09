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
        if (isset($_COOKIE['acms_cookie'])) {

            $sql = new Db;

            $sql->dbSelect('users', 'id, display_name', 'acms_id = :acms_id', ['acms_id' => $_COOKIE['acms_cookie']]);
            $result = $sql->dbFetch('one');

            if ($result !== false) {

                // Setup Current User Info
                $this->id = $result['id'];
                $this->displayName = $result['display_name'];
                $this->loggedIn = true;

                $sql->dbUpdate('users',
                    [
                        'last_login_time' => (string) date("Y-m-d H:i:s", time()),
                        'last_ip' => $_SERVER['REMOTE_ADDR'],
                    ], 'id = :id', ['id' => $result['id']]
                );
            }
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