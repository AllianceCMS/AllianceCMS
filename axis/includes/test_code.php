<?php
use Acms\Core\Data\Security;

$testSalt = new Security();

echo $testSalt->randomBlowfishSalt();