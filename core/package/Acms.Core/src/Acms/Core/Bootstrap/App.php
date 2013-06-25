<?php

//require 'CustomView.php';

/**
 * $root = /core
 */
$root = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
require $root.'/vendor/autoload.php';
//require $root.'/package/Acms.Core/src/Acms/Core/System.php';
//$loader = require $root.'/vendor/autoload.php';
//$loader->add('Acms\\Core\\System', 'package/Acms.Core/src/Acms/Core/System.php');

//require 'CustomView.php';

// Prepare app
$app = new \Slim\Slim(array(
    'mode' => 'development',
    'debug' => true,
//    'log.writer' => new \Slim\LogWriter("There's an Error", 1),
//    'log.level' => \Slim\Log::DEBUG,
//    'log.enabled' => true,
    'log.level' => 4,
    'log.enabled' => true,
    'log.writer' => new \Slim\Extras\Log\DateTimeFileWriter(array(
        'path' => $root.'/logs',
        'name_format' => 'y-m-d'
    )),
//    'templates.path' => $root.'/templates',
//    'view' => new CustomView()
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

\Slim\Extras\Views\Twig::$twigOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath($root.'/templates/cache'),
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true
);

\Slim\Extras\Views\Twig::$twigTemplateDirs = array(
    $root.'/templates',
    $root.'/templates/fallback'
);

$app->view(new \Slim\Extras\Views\Twig());

// Define routes
$app->get('/', function() use ($app) {
    $app->render('index.html', array('name' => 'Jesse'));
});

$app->get('/child', function() use ($app) {
    $app->render('child.html');
});

$mySystem = new \Acms\Core\System();

$app->get('/test', function() use ($mySystem) {
    echo $mySystem->filePaths;
});

/*
$app->setName('AllianceCMS');

$app->map('/', function() use ($app) {
    $app->render('myTemplate.php');
    echo 'Welcome to AllianceCMS.com!';
})->via('GET', 'POST');

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->get('/books/:id', function ($id) use ($app) {
    $app->render('show.php', array('title' => 'Sahara'));
});
//*/

//$app->run();