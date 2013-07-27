<?php
/**
 * Directory path for main domain 'Document Root'
 *     Domain: www.mysite.com
 *     Folder Structure: /home/username/public_html
 *
 * If AllianceCMS is installed on a subdomain, comment out the following line
 */

require_once (dirname(__dir__) . ('/axis/hub.php'));

/**
 * Directory path for subdomain 'Document Root'
 *     Domain: docs.mysite.com
 *     Folder Structure: /home/username/public_html/docs
 *
 * If AllianceCMS is installed on a subdomain, uncomment the following two lines and enter a subdomain folder name
 *     Do not switch the order of these two lines
 */

//$subDomainFolder = ''; // Enter subdomain folder name (i.e $subDomainFolder = 'docs';)
//require_once (dirname(dirname(__dir__)) . ('/axis/hub.php'));
