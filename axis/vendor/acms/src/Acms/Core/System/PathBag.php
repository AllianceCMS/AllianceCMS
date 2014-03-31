<?php
namespace Acms\Core\System;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * FilesystemBag is a container for filesystem paths.
 *
 * @author Jesse Burns <jesse.burns@alliancecms.com>
 */
class PathBag extends ParameterBag
{
    /**
     * Constructor.
     *
     * @param string $acmsBaseDir A string containing the path of the base directory (i.e. /path/to/AllianceCMS)
     *
     * @api
     */
    /*
    public function __construct($acmsBaseDir = null)
    {
        $this->setPaths($acmsBaseDir);
    }
    //*/

    /**
     * Parses $acmsBaseDir to create filesystem parameters
     *
     * Parameters:
     *      dir.current - was THIS_DIR
     *      dir.base
     *      dir.axis
     *      dir.zones
     *      dir.public_html - maybe rename to www
     *      dir.configs
     *      dir.includes
     *      dir.tests
     *      dir.vendor
     *      dir.axis_modules
     *      dir.zones_modules
     *      dir.resources - was RESOURCE_PATH
     *      dir.themes
     *      dir.templates
     *      file.current - was THIS_FILE
     *      file.db_conn
     */
    public function buildPaths($acmsBaseDir = null)
    {
        //*
        echo '<br />$acmsBaseDir_bag is: ' . $acmsBaseDir . '<br />';
        //exit;
        //*/

        //$this->set($key, $file);
    }
}