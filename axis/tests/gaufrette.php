<?php

use Gaufrette\Filesystem;
use Gaufrette\Adapter\Local as LocalAdapter;

$adapter = new LocalAdapter(PLUGINS_AXIS);
$pluginsAxis = new Filesystem($adapter);

echo '<br /><pre>';
echo print_r($pluginsAxis->keys('home'));
echo '</pre><br />';

//echo '<br />File exists? ' . $pluginsAxis->read('PLACEHOLDER.md') . '<br />';

/*
$adapter = new LocalAdapter(TESTS . 'var/');
$filesystem = new Filesystem($adapter);

//echo $content = $filesystem->read('test_01.md');

$content = 'Hello I am the new content';

$filesystem->write('test_02.md', $content);
//*/