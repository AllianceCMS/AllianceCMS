<?php
use Acms\Core\Users\AxisRole;
use PhpRbac\Rbac;

$sessionAxis = include PACKAGE_AURA_SESSION . 'scripts/instance.php';
$segmentUser = $sessionAxis->newSegment('User');
$sessionAxis->commit();

/*
$axisRbac = new Rbac();

$axisRbac->reset(true);
//*/





/*
echo '<br />I am here: File: ' . __FILE__ . ': ' . __LINE__ . '<br />';
exit;
//*/