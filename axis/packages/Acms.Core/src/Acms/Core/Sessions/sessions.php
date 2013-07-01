<?php
require_once (PACKAGE_ACMS_CORE . "Db" . DS . "adodb" . DS . "session" . DS . "adodb-cryptsession2.php");
// $ADODB_SESS_DEBUG = true;
$options['table'] = $sql->getDbPrefix() . "sessions2";
ADOdb_Session::config($sql->getDbSoftware(), $sql->getDbHost(), $sql->getDbUser(), $sql->getDbPassword(), $sql->getDbName(), $options);
adodb_sess_open(false, false, $connectMode = false);
// ADODB_Session::filter(new ADODB_Compress_Bzip2());
// ADODB_Session::filter(new ADODB_Encrypt_MD5());
session_start();

// Check if member checked the "Remember Me" check box while logging in, if so, rebuild last session variables
if ($_COOKIE['logged_status'] == "logged_in") {
    $_SESSION['logged_status'] = $_COOKIE['logged_status'];
    $_SESSION['display_name'] = $_COOKIE['display_name'];
    $_SESSION['real_name'] = $_COOKIE['real_name'];
    $_SESSION['login_name'] = $_COOKIE['login_name'];
    $_SESSION['password'] = $_COOKIE['cookpass'];
}
