<?php
use Acms\Core\Users\Role;

$admin  = new Role('admin');

$sessionAxis = include PACKAGE_AURA_SESSION . 'scripts/instance.php';

$segmentUser = $sessionAxis->newSegment('User');

$sessionAxis->commit();
