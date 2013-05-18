<?php

    require_once("../header.php");
    
    //var_dump($_GET);

    $body = new Template('views/posts.tpl.php');
    //$body->set('caption', 'My Test Page');
    //$body->set('intro', 'The intro paragraph.');
    //$body->set('list', array('cat', 'dog', 'mouse'));
    
	require_once("../footer.php");