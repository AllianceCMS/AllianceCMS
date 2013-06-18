<?php

//use \Slim\Slim;

require 'vendor/autoload.php';

$app = new \Slim\Slim(array(
    'mode' => 'development',
    'debug' => true,
//    'log.writer' => new \Slim\LogWriter("There's an Error", 1),
//    'log.level' => \Slim\Log::DEBUG,
//    'log.enabled' => true,
//    'templates.path' => './templates',
//    'view' => new \My\View()
));

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->run();