<?php
require 'CustomView.php';

$app = new \Slim\Slim(array(
    'view' => new CustomView()
));