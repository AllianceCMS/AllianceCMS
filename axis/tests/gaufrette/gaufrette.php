<?php

echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
//exit;

echo '<br />Begin Testing Gaufrette<br />';


use Gaufrette\Filesystem;
use Gaufrette\Adapter\Local as LocalAdapter;

$adapter = new LocalAdapter(PLUGINS_AXIS);
$pluginsAxis = new Filesystem($adapter);

echo '<br /><pre>';
//echo print_r($pluginsAxis->keys('home'));
echo '</pre><br />';

//echo '<br />File exists? ' . $pluginsAxis->read('PLACEHOLDER.md') . '<br />';

//*
$adapter = new LocalAdapter(TESTS . 'gaufrette/var/');
$filesystem = new Filesystem($adapter);

//echo $content = $filesystem->read('test_01.md');

//$content = 'Hello I am the new content';

//$filesystem->write('test_02.md', $content);

//$file = new File('main.php', $filesystem);
//$file->setContent('Hello World');

//echo $file->getContent(); // Hello World

//*/


echo '<br />End Testing Gaufrette<br />';
