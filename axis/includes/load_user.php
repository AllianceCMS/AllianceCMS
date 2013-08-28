<?php
use Acms\Core\Users\AxisRole;
use PhpRbac\Rbac;

$sessionAxis = include PACKAGE_AURA_SESSION . 'scripts/instance.php';
$segmentUser = $sessionAxis->newSegment('User');
$sessionAxis->commit();

$axis_rbac = new Rbac();

//*
echo '<br /><pre>$axis_rbac: ';
echo var_dump($axis_rbac);
echo '</pre><br />';
//exit;
//*/

$axis_rbac->Permissions->Add('edit_ciao', 'User Can Edit Ciao Content');

$count_perms = $rbacPermissions->Count();


//*
echo '<br />$count_perms is: ' . $count_perms . '<br />';
//exit;
//*/

//*
echo '<br />I am here: File: ' . __FILE__ . ': ' . __LINE__ . '<br />';
exit;
//*/