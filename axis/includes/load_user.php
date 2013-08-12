<?php
use Acms\Core\Users\AxisRole;
use Zend\Permissions\Rbac\Rbac;

$sessionAxis = include PACKAGE_AURA_SESSION . 'scripts/instance.php';
$segmentUser = $sessionAxis->newSegment('User');
$sessionAxis->commit();

/*
$admin  = new AxisRole('admin');

$rbac = new Rbac();
$rbac->addRole($admin);

var_dump($rbac->hasRole('admin')); // true
//*/


//*
echo '<br />I am here: File: ' . __FILE__ . ': ' . __LINE__ . '<br />';
exit;
//*/