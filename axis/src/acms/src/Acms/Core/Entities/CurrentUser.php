<?php
namespace Acms\Core\Entities;

use Acms\Core\Application;
use Acms\Core\Data\Db;

class CurrentUser
{
    protected $app;

    public $sessionId;

    public $id;
    public $loggedIn = false;
    public $displayName;
    public $sessionPersistent;

    public function __construct(Application $app)
    {
        //$this->app = $app;

        /*
        echo '<br /><pre>$this->app: ';
        echo var_dump($this->app['request']);
        echo '</pre><br />';
        //exit;
        //*/

        $request = $app['request'];

        //*
        echo '<br /><pre>$request: ';
        echo print_r($request['this']);
        echo '</pre><br />';
        //exit;
        //*/

        /*
        echo '<br /><pre>$request->server->all(): ';
        echo print_r($request->server->all());
        echo '</pre><br />';
        exit;
        //*/

        $cookieName = str_replace('.', '_', $_SERVER['SERVER_NAME']) . '_acms';

        if (isset($_COOKIE[$cookieName])) {

            $sql = new Db;

            $sql->dbSelect('users', 'id, display_name', 'acms_id = :acms_id', ['acms_id' => urldecode($_COOKIE[$cookieName])]);
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