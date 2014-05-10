<?php
namespace Acms\Core\System;

/**
 * PathBag is a container for HTTP headers from the $_SERVER variable.
 *
 * @author Jesse Burns <jesse.burns@alliancecms.com>
 */
class SystemContext
{
    public $filesystem;
    public $url;


    public function __construct($acmsBaseDir = null, $baseUrl = null)
    {
        //*
        echo '<br />I am here: ' . __FILE__ . ': ' . __LINE__ . '<br />';
        //exit;
        //*/

        $this->initialize($acmsBaseDir, $baseUrl);
    }

    /**
     * Sets the parameters for this context.
     *
     * This method also re-initializes all properties.
     *
     * @param string $acmsBaseDir       A string containing the path of the base directory (i.e. /path/to/AllianceCMS)
     * @param string $baseUrl       A string containing the base url (i.e. http://www.mysite.com)
     */
    public function initialize($acmsBaseDir = null, $baseUrl = null)
    {
        $this->filesystem = new FilesystemBag($acmsBaseDir);
        $this->url = new UrlBag($baseUrl);
    }
}