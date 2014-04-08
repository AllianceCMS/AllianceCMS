<?php
/**
 * Make sure PHP version is not < 5.4.0
 *
 * If PHP version is < 5.4.0 display error message and halt execution.
 */

try {
    if (phpversion() < '5.4.0') {
        throw new Exception('AllianceCMS requires PHP v5.4+');
    }
} catch(Exception $e) {
    echo '<p>System Error!</p>' .
        '<p>Location: ' . $e->getFile() . ': ' . $e->getLine() . '</p>' .
        '<p>Error message: ' . $e->getMessage() . '</p>';
    exit;
}

/**
 * Directory path for a non-standard directory structure
 *      Example:
 *          Domain: docs.mysite.com
 *          Location of AllianceCMS folder: /home/username/AllianceCMS
 *          Location of subdomain folder: /home/username/public_html/domains/docs
 *
 *          $acmsBaseDir = '/home/username/AllianceCMS';
 *          $subDomainFolder = 'docs'
 *
 *
 *     Uncomment the following statements and make sure to read the above example
 */

/*
$acmsBaseDir = '/path/to/AllianceCMS'; // No trailing slash
$subDomainFolder = ''; // Enter subdomain folder name (i.e $subDomainFolder = 'docs';)
*/

/**
 * Attempt to automatically locate both AllianceCMS's base directory and the subdomain folder name (if one exists)
 */

try {
    if (file_exists(dirname(__DIR__) . '/axis')) {

        $acmsBaseDir = dirname(__DIR__);
        $subDomainFolder = '';

    } elseif (file_exists(dirname(dirname(__DIR__)) . '/axis')) {

        $acmsBaseDir = dirname(dirname(__DIR__));

        if ((count($serverNameArray = explode('.', $_SERVER['SERVER_NAME']))) > 2) {
            $subDomainFolder = '/' . $serverNameArray[0];
        } else {
            $subDomainFolder = '/' . basename(__DIR__, __FILE__);
        }

    } else {
        if (!isset($acmsBaseDir) || empty($acmsBaseDir)) {
            throw new Exception('Can not locate base directory');
        }

    }
} catch(Exception $e) {
    echo '<p>System Error!</p>' .
        '<p>Location: ' . $e->getFile() . ': ' . $e->getLine() . '</p>' .
        '<p>Error message: ' . $e->getMessage() . '</p>';
    exit;
}

/**
 * Attempt to include /path/to/AllianceCMS/axis/hub.php
 */

try {
    if (file_exists($acmsBaseDir . '/axis/hub.php')) {
        require_once ($acmsBaseDir . '/axis/hub.php');
    } else {
        throw new Exception('Can not locate hub.php');
    }
} catch(Exception $e) {
    echo '<p>System Error!</p>' .
        '<p>Location: ' . $e->getFile() . ': ' . $e->getLine() . '</p>' .
        '<p>Error message: ' . $e->getMessage() . '</p>';
    exit;
}
