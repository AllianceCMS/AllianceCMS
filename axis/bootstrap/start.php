<?php
/*
$var_array = get_defined_vars();
//*/

/*
echo '<br /><pre>$var_array: ';
echo var_dump($var_array);
echo '</pre><br />';
exit;
//*/

$paths['paths']['dir.base'] = $acmsBaseDir;
$paths['paths']['folder.subdomain'] = $subDomainFolder;

unset($acmsBaseDir);
unset($subDomainFolder);

$app = new Acms\Core\Application($paths);

$app->run();
