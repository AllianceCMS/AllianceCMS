<?php
use Acms\Core\Users\AxisRole;
use Acms\Core\Entities\CurrentUser;
use PhpRbac\Rbac;

//*
$sessionAxis = include PACKAGE_AURA_SESSION . 'scripts/instance.php';
$sessionAxis->start();
$segmentUser = $sessionAxis->newSegment('User');

$currentUser = new CurrentUser($sessionAxis);
//*/



/*
$rbac = new \PhpRbac\Rbac();

$rbac->enforce(1, $currentUser->getId());

//*/



/*
echo '<br /$sessionAxis->getId() is: ' . $sessionAxis->getId() . '<br />';
//exit;
//*/

/*
echo '<br />$currentUser->getId() is: ' . $currentUser->getId() . '<br />';
//exit;
//*/

/*
echo '<br /><pre>$_SESSION: ';
echo var_dump($_SESSION);
echo '</pre><br />';
//exit;
//*/

/*
echo '<br /><pre>$sessionAxis: ';
echo var_dump($sessionAxis);
echo '</pre><br />';
//exit;
//*/

/*
echo '<br /><pre>$segmentUser: ';
echo var_dump($segmentUser);
echo '</pre><br />';
//exit;
//*/

/*
$axisRbac = new Rbac();

$axisRbac->reset(true);
//*/

/*
echo '<br /><pre>$result: ';
echo var_dump($result);
echo '</pre><br />';
exit;
//*/

/*
echo '<br />I am here: File: ' . __FILE__ . ': ' . __LINE__ . '<br />';
exit;
//*/