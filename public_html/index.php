<?php
/**
 * Make sure PHP version is not < 5.4.0
 *
 * If PHP version is < 5.4.0 display error message and halt execution.
 */

if (phpversion() < '5.4.0'): ?>
    <h1>AllianceCMS: Error</h1>
    <h2>
        <span style="color: red;">There are one or more errors that will prevent you from installing and using AllianceCMS</span>
    </h2>

    <p>
        Current PHP version: <strong><?php echo phpversion(); ?></strong>
    </p>
    <p>
        Required PHP version: <strong>5.4+</strong>
    </p>
    <p>
        Please talk to your system administrator about upgrading your PHP server software before continuing...
    </p>
    <?php
    
    exit;
endif;

/**
 * Try to locate and require hub.php automatically
 */

if (file_exists(dirname(__dir__) . ('/axis/hub.php'))):
    $subDomainFolder = null;
    require_once (dirname(__dir__) . ('/axis/hub.php'));
elseif (dirname(dirname(__dir__)) . ('/axis/hub.php')):
    if ((count($serverNameArray = explode('.', $_SERVER['SERVER_NAME']))) > 2) {
        $subDomainFolder = $serverNameArray[0];
    }
    require_once (dirname(dirname(__dir__)) . ('/axis/hub.php'));
else:
    // Can't find hub.php, display error message
?>
    <p>
        You may have a problem with your folder structure. You may have placed the AllianceCMS installation folders in the wrong place, please check your installation carefully.
    </p>
    <p>
        You may also have a non-standard folder structure. If that is the case, please alter index.php and manually include the file /axis/hub.php.
    </p>
    <p>
        <strong>NEVER, NEVER, NEVER PLACE THE 'axis' OR 'zones' FOLDERS INSIDE THE DOCUMENT ROOT OF YOUR WEB SERVER!!!</strong>
    </p>
<?php
endif;

/**
 * Directory path for non-standard directory structure
 *     Domain: docs.mysite.com
 *     Folder Structure: /home/username/docs
 *
 *     Comment the above if statements, uncomment the following statements and make sure to read the comments
 */

//$subDomainFolder = ''; // Enter subdomain folder name (i.e $subDomainFolder = 'docs';)
//require_once (dirname(dirname(__dir__)) . ('/axis/hub.php')); // Change location to include hub.php if needed
