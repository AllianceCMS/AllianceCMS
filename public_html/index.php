<?php
/**
 * Directory path for main domain 'Document Root'
 *     Domain: www.mysite.com
 *     Folder Structure: /home/username/public_html
 *
 * If AllianceCMS is installed on a subdomain, comment out the following line
 */

if (file_exists(dirname(__dir__) . ('/axis/hub.php'))) {
    $subDomainFolder = null;
    require_once (dirname(__dir__) . ('/axis/hub.php'));
} elseif (dirname(dirname(__dir__)) . ('/axis/hub.php')) {
    if ((count($serverNameArray = explode('.', $_SERVER['SERVER_NAME']))) > 2) {
        $subDomainFolder = $serverNameArray[0];
    }
    require_once (dirname(dirname(__dir__)) . ('/axis/hub.php'));
} else {
    echo '<br />';
    echo 'You may have a problem with your folder structure. You may have placed the AllianceCMS installation folders in the wrong place,
        please check your installation carefully.<br />
        You may also have a non-standard folder structure. If that is the case, please alter index.php and manually include the file /axis/hub.php.<br />';
}
/**
 * Directory path for non-standard directory structure
 *     Domain: docs.mysite.com
 *     Folder Structure: /home/username/docs
 */

//$subDomainFolder = ''; // Enter subdomain folder name (i.e $subDomainFolder = 'docs';)
//require_once (dirname(dirname(__dir__)) . ('/axis/hub.php'));
