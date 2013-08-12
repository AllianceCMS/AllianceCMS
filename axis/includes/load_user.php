<?php
use Acms\Core\Users\AxisRole;
use Zend\Permissions\Rbac\Rbac;

$sessionAxis = include PACKAGE_AURA_SESSION . 'scripts/instance.php';
$segmentUser = $sessionAxis->newSegment('User');
$sessionAxis->commit();

$admin  = new AxisRole('admin');

//*
echo '<br /><pre>$admin: ';
echo var_dump($admin);
echo '</pre><br />';
//exit;
//*/

$rbac = new Rbac();
$rbac->addRole($admin);

//*
echo '<br /><pre>$rbac: ';
echo var_dump($rbac);
echo '</pre><br />';
//exit;
//*/

var_dump($rbac->hasRole('admin')); // true

//*
exit;
//*/