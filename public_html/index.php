<?php

// Directory path for main domain 'Document Root' (Domain: www.mysite.com, Folder Structure: /home/username/public_html)
require_once (dirname(__dir__) . ('/axis/hub.php'));

// Directory path for sub domain 'Document Root' (Domain: docs.mysite.com, Folder Structure: /home/username/public_html/docs)
// Need to change open '/axis/configs/system.php' and change 'define('PUBLIC_HTML', BASE_DIR . 'public_html' . DS);' to point to your subdomain folder
//     i.e. 'define('PUBLIC_HTML', BASE_DIR . 'public_html' . DS . 'docs' . DS);'
//require_once (dirname(dirname(__dir__)) . ('/axis/hub.php'));
