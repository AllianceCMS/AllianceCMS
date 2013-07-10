<?php

//*
// Initialize Twig's Autoloader
//require_once PACKAGES . 'Twig/lib/Twig/Autoloader.php';
//require_once '../axis/packages/Twig/lib/Twig/Autoloader.php';
//Twig_Autoloader::register();
//*/

echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
//exit;

//*
$twigLoader = new Twig_Loader_String();

echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
//exit;

$twig = new Twig_Environment($twigLoader);

echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
//exit;

echo $twig->render('<br />Hello {{ name }}!<br />', array('name' => 'Fabien'));
//*/

/*
$twigLoader = new Twig_Loader_Filesystem('/path/to/templates');
$twig = new Twig_Environment($twigLoader, array(
    'cache' => '/path/to/compilation_cache',
));

echo $twig->render('index.html', array('name' => 'Fabien'));
//*/
