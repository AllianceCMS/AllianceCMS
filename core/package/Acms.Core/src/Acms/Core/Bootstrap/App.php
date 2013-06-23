<?php

$root = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
$loader = require $root.'/vendor/autoload.php';
$loader->add('Acms', $root.'/package/Acms.Core/src');

$app = new \Slim\Slim(array(
    'mode' => 'development',
    'debug' => true,
//    'log.writer' => new \Slim\LogWriter("There's an Error", 1),
//    'log.level' => \Slim\Log::DEBUG,
//    'log.enabled' => true,
//    'templates.path' => './templates',
//    'view' => new \My\View(),
//    'cookies.lifetime' => '20 minutes',
//    'cookies.path' => '/',
//    'cookies.domain' => 'domain.com',
//    'cookies.secure' => false,
//    'cookies.httponly' => false,
//    'cookies.secret_key' => 'secret',
//    'cookies.cipher' => MCRYPT_RIJNDAEL_256,
//    'cookies.cipher_mode' => MCRYPT_MODE_CBC,
//    'http.version' => '1.1',

));

$app->setName('AllianceCMS');

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

//$app->run();