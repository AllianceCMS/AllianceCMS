<?php

    if (function_exists('customHeaders')) {
        $tpl->set("customHeaders", customHeaders());
    }
    
    $tpl->set("body",	$body);
    
    echo $tpl->fetch(THEMES.THEME_FOLDER_NAME."theme.tpl.php");