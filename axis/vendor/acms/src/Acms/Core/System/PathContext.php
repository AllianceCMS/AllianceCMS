<?php
namespace Acms\Core\System;

/**
 * PathBag is a container for HTTP headers from the $_SERVER variable.
 *
 * @author Jesse Burns <jesse.burns@alliancecms.com>
 */
class PathContext
{
    public $filesystem;
    public $url;

    /**
     * Constructor.
     *
     * @param string $rootDir       A string containing the path of the base directory (i.e. /path/to/AllianceCMS)
     * @param string $baseUrl       A string containing the base url (i.e. http://www.mysite.com)
     */
    public function __construct($rootDir = null, $baseUrl = null)
    {
        //*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/

        $this->initialize($rootDir, $baseUrl);
    }

    /**
     * Sets the parameters for this context.
     *
     * This method also re-initializes all properties.
     *
     * @param string $rootDir       A string containing the path of the base directory (i.e. /path/to/AllianceCMS)
     * @param string $baseUrl       A string containing the base url (i.e. http://www.mysite.com)
     */
    public function initialize($rootDir = null, $baseUrl = null)
    {
        $this->filesystem = new FilesystemBag($rootDir);
        $this->url = new UrlBag($baseUrl);
    }
}