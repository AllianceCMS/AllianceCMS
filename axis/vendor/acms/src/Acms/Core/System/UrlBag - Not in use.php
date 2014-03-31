<?php
namespace Acms\Core\System;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * UrlBag is a container for base Url paths.
 *
 * @author Jesse Burns <jesse.burns@alliancecms.com>
 */
class UrlBag extends ParameterBag
{
    /**
     * Constructor.
     *
     * @param string $baseUrl A string containing the base url (i.e. http://www.mysite.com)
     *
     * @api
     */
    public function __construct($baseUrl = null)
    {
        $this->setPaths($baseUrl);
    }

    /**
     * Parses $baseUrl to create url parameters
     *
     * Parameters:
     *      url.base
     *      url.query_string - was THIS_QUERY_STRING
     *      url.resources - was RESOURCE_URL
     */
    public function setPaths($baseUrl = null)
    {
        //*
        echo '<br />$baseUrl_bag is: ' . $baseUrl . '<br />';
        //exit;
        //*/

        //$this->set($key, $file);
    }
}