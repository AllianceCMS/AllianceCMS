<?php
$paths['paths']['dir.base'] = $acmsBaseDir;
$paths['paths']['folder.subdomain'] = $subDomainFolder;

unset($acmsBaseDir);
unset($subDomainFolder);

$app = new Acms\Core\Application($paths);

$app->run();
