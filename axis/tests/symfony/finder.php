<?php

echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
//exit;

echo '<br />Begin Testing Symfony Finder<br />';


use Symfony\Component\Finder\Finder;

echo '<br />Begin Processing Axis Plugins<br />';

$finderAxis = new Finder();
$finderAxis
    ->files()
    ->name('main.php')
    ->in(PLUGINS_AXIS);

foreach ($finderAxis as $file) {
    // Print the absolute path
    print '<br />'.$file->getRealpath().'<br />';
    $pluginDirsAxis[] = $file->getRealpath();

    // Print the relative path to the file, omitting the filename
    print '<br />'.$file->getRelativePath().'<br />';
    $pluginDirPathsAxis[] = $file->getRelativePath();

    // Print the relative path to the file
    //print '<br />'.$file->getRelativePathname().'<br />';
}

echo '<br /><pre>';
echo print_r($pluginDirsAxis);
echo '</pre><br />';

echo '<br /><pre>';
echo print_r($pluginDirPathsAxis);
echo '</pre><br />';

echo '<br />End Processing Axis Plugins<br />';

echo '<br />Begin Processing Venue Plugins<br />';

$finderVenues = new Finder();
$finderVenues
->files()
->name('main.php')
->in(ZONES);

foreach ($finderVenues as $file) {
    // Print the absolute path
    print '<br />'.$file->getRealpath().'<br />';
    $pluginDirsVenues[] = $file->getRealpath();

    // Print the relative path to the file, omitting the filename
    print '<br />'.$file->getRelativePath().'<br />';
    $pluginDirPathsVenues[] = $file->getRelativePath();

    // Print the relative path to the file
    //print '<br />'.$file->getRelativePathname().'<br />';
}

echo '<br /><pre>';
echo print_r($pluginDirsVenues);
echo '</pre><br />';

echo '<br /><pre>';
echo print_r($pluginDirPathsVenues);
echo '</pre><br />';

echo '<br />End Processing Venue Plugins<br />';

echo '<br />End Testing Symfony Finder<br />';
