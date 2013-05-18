<?php

    require_once("../header.php");

    $errorQuery = 999;

    if (is_numeric($_SERVER['QUERY_STRING'])) {
        $errorQuery = $_SERVER['QUERY_STRING'];
    }

    switch ($errorQuery) {
        case 400:
            $body = new Template("views".DS."400error.tpl.php");
            break;
        case 401:
            $body = new Template("views".DS."401error.tpl.php");
            break;
        case 403:
            $body = new Template("views".DS."403error.tpl.php");
            break;
        case 404:
            $body = new Template("views".DS."404error.tpl.php");
            break;
        case 405:
            $body = new Template("views".DS."405error.tpl.php");
            break;
        case 408:
            $body = new Template("views".DS."408error.tpl.php");
            break;
        case 500:
            $body = new Template("views".DS."500error.tpl.php");
            break;
    }

    require_once("../footer.php");
